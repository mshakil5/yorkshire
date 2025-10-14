<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqQuestion;
use Illuminate\Support\Facades\Cache;
use App\Models\CompanyDetails;
use SEOMeta;
use OpenGraph;
use Twitter;
use App\Models\Master;
use App\Models\Contact;
use App\Models\ContactEmail;
use App\Mail\ContactMail;
use App\Models\ClientReview;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use App\Models\Slider;
use App\Models\Content;
use App\Models\Tag;
use App\Models\ContentCategory;
use App\Models\Plan;
use App\Models\Section;
use App\Models\TeamMember;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\Subscription;

class FrontendController extends Controller
{
    public function index()
    {
      $company = CompanyDetails::select('meta_title', 'meta_description', 'meta_keywords', 'meta_image')->first();

      $hero = Master::firstOrCreate(['name' => 'hero']);
      $about = Master::firstOrCreate(['name' => 'about']);
      $service = Master::firstOrCreate(['name' => 'service']);

      $sliders = Cache::remember('active_sliders', now()->addDay(), function () {
          return Slider::where('status', 1)->latest()->get();
      });

      $products = Product::where('status', 1)->select('id', 'title', 'icon', 'short_description', 'slug')->orderByRaw('sl = 0, sl ASC')->orderBy('id', 'desc')->get();

      $sections = Section::where('status', 1)
          ->orderBy('sl', 'asc')
          ->get();

      $this->seo(
          $company?->meta_title ?? '',
          $company?->meta_description ?? '',
          $company?->meta_keywords ?? '',
          $company?->meta_image ? asset('images/company/meta/' . $company->meta_image) : null
      );

      return view('frontend.index', compact('hero','sliders','about','service','sections','products'));
    }

    public function type($slug)
    {
        $typeMap = [
            'blog'    => ['id' => 2, 'cache' => 'active_blogs'],
            'event'   => ['id' => 3, 'cache' => 'active_events'],
            'news'    => ['id' => 4, 'cache' => 'active_news'],
        ];

        if(!isset($typeMap[$slug])) {
            abort(404);
        }

        $typeId = $typeMap[$slug]['id'];
        $cacheKey = $typeMap[$slug]['cache'];

        $contents = Cache::remember($cacheKey, now()->addDay(), function() use ($typeId) {
            return Content::with('category')
                ->where('status', 1)
                ->where('type', $typeId)
                ->latest()
                ->get();
        });

        return view('frontend.contents', compact('contents', 'slug'));
    }

    public function contentDetails($type, $slug)
    {
        $typeMap = [
            'blog'  => 2,
            'event' => 3,
            'news'  => 4,
        ];

        if (!isset($typeMap[$type])) abort(404);

        $typeId = $typeMap[$type];

        $content = Content::with(['category', 'tags', 'createdBy'])
            ->where('slug', $slug)
            ->where('type', $typeId)
            ->where('status', 1)
            ->firstOrFail();

        $otherContents = Content::select('id', 'slug', 'short_title', 'publishing_date')
            ->where('type', $typeId)
            ->where('status', 1)
            ->where('id', '!=', $content->id)
            ->latest('publishing_date')
            ->take(5)
            ->get();

        $tags = Tag::whereHas('contents', fn($q) => $q->where('type', $typeId))->get();

        $this->seo(
            $content?->meta_title ?? '',
            $content?->meta_description ?? '',
            $content?->meta_keywords ?? '',
            $content?->meta_image ? asset('images/content/' . $content->meta_image) : null
        );

        return view('frontend.content-details', compact('content', 'otherContents', 'tags', 'type', 'slug'));
    }

    public function serviceDetails($slug)
    {
        $service = Product::where('slug', $slug)->with(['features', 'faqs', 'clients', 'process'])->firstOrFail();

        $this->seo(
            $service->meta_title,
            $service->meta_description,
            $service->meta_keywords,
            $service->meta_image ? asset('images/products/meta/' . $service->meta_image) : null
        );
        return view('frontend.service-details', compact('service'));
    }

    public function categoryContents($type, $categorySlug)
    {
        $typeMap = [
            'blog'    => 2,
            'event'   => 3,
            'news'    => 4,
        ];

        if (!isset($typeMap[$type])) abort(404);

        $typeId = $typeMap[$type];

        $category = ContentCategory::where('slug', $categorySlug)->firstOrFail();

        $relationMap = [
            2 => 'blogContents',
            3 => 'eventContents',
            4 => 'newsContents',
        ];

        $contents = $category->{$relationMap[$typeId]}()->latest('publishing_date')->get();

        return view('frontend.content-category', compact('contents', 'type', 'category'));
    }

    public function tagContents($type, $tagSlug)
    {
        $typeMap = [
            'blog'  => 2,
            'event' => 3,
            'news'  => 4,
        ];

        if (!isset($typeMap[$type])) abort(404);
        $typeId = $typeMap[$type];

        $tag = Tag::where('slug', $tagSlug)->firstOrFail();

        $contents = $tag->contents()
                        ->where('type', $typeId)
                        ->where('status', 1)
                        ->latest('publishing_date')
                        ->get();

        return view('frontend.content-tag', compact('contents', 'type', 'tag'));
    }

    public function searchContent(Request $request)
    {
        $query = $request->get('query', '');
        $type = $request->get('type', '');

        $typeMap = [
            'blog'  => 2,
            'event' => 3,
            'news'  => 4,
        ];

        if(!isset($typeMap[$type])) {
            return '<p>No results found.</p>';
        }

        $typeId = $typeMap[$type];

        $contents = Content::where('type', $typeId)
            ->where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('short_title', 'like', "%{$query}%")
                  ->orWhere('long_title', 'like', "%{$query}%");
            })
            ->latest('publishing_date')
            ->take(5)
            ->get();

        if($contents->isEmpty()) return '<p>No results found.</p>';

        $html = '';
        foreach($contents as $content) {
            $html .= '<div class="post-item">';
            $html .= '<h4><a href="'.route('content.show', ['type' => array_search($content->type, $typeMap), 'slug' => $content->slug]).'">'
                    .($content->short_title ?? $content->title).'</a></h4>';
            $html .= '<time datetime="'.$content->publishing_date.'">'
                    .date('M j, Y', strtotime($content->publishing_date)).'</time>';
            $html .= '</div>';
        }

        return $html;
    }
    
    public function contact()
    {
      $contact = Master::firstOrCreate(['name' => 'contact']);

      if($contact){
          $this->seo(
              $contact->meta_title,
              $contact->meta_description,
              $contact->meta_keywords,
              $contact->meta_image ? asset('images/meta_image/' . $contact->meta_image) : null
          );
      }

      $company = CompanyDetails::select('address1', 'phone1', 'email1', 'google_map', 'opening_time', 'facebook', 'twitter', 'linkedin', 'whatsapp')->first();
      return view('frontend.contact', compact('contact', 'company'));
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|min:2|max:100',
            'email'   => 'required|email|max:50',
            'phone'   => ['required', 'regex:/^(?:\+44|0)(?:7\d{9}|1\d{9}|2\d{9}|3\d{9})$/'],
            'company' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        $contact = new Contact();
        $contact->name    = $request->input('name');
        $contact->email   = $request->input('email');
        $contact->phone   = $request->input('phone');
        $contact->company = $request->input('company');
        $contact->message = $request->input('message');
        $contact->save();

        $contactEmails = ContactEmail::where('status', 1)->pluck('email');

        // foreach ($contactEmails as $contactEmail) {
        //     Mail::mailer('gmail')->to($contactEmail)
        //         ->send(new ContactMail($contact));
        // }

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function privacyPolicy()
    {
        $companyPrivacy = Cache::rememberForever('company_privacy', function () {
            return CompanyDetails::select('privacy_policy')->first();
        });

        return view('frontend.privacy', compact('companyPrivacy'));
    }

    public function termsAndConditions()
    {
        $companyDetails = Cache::rememberForever('company_terms', function () {
            return CompanyDetails::select('terms_and_conditions')->first();
        });
        return view('frontend.terms', compact('companyDetails'));
    }

    public function frequentlyAskedQuestions()
    {
        $faqs = FaqQuestion::orderBy('id', 'asc')->get();
        return view('frontend.faq', compact('faqs'));
    }

    public function gallery()
    {
        $contents = Content::with('images')
                    ->where('type', 1)
                    ->where('status', 1)
                    ->latest()
                    ->get();

        return view('frontend.gallery', compact('contents'));
    }

    public function team()
    {
        $teamMembers = TeamMember::where('status', 1)->latest()->get();
        return view('frontend.team', compact('teamMembers'));
    }

    private function seo($title = null, $description = null, $keywords = null, $image = null)
    {
        if ($title) {
            SEOMeta::setTitle($title);
            OpenGraph::setTitle($title);
            Twitter::setTitle($title);
        }

        if ($description) {
            SEOMeta::setDescription($description);
            OpenGraph::setDescription($description);
            Twitter::setDescription($description);
        }

        if ($keywords) {
            SEOMeta::setKeywords($keywords);
        }

        if ($image) {
            OpenGraph::addImage($image);
            Twitter::setImage($image);
        }
    }

    public function checkout($planId)
    {
        $plan = Plan::findOrFail($planId);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                    'unit_amount' => $plan->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url("/checkout-success/{$plan->id}/{CHECKOUT_SESSION_ID}"),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($session->url);
    }

    public function checkoutSuccess($planId, $session_id)
    {
       Stripe::setApiKey(env('STRIPE_SECRET'));
       $session = Session::retrieve($session_id);
       $customer = $session->customer_details;

          Subscription::create([
              'user_id' => auth()->id() ?? null,
              'plan_id' => $planId,
              'name' => $customer->name ?? null,
              'email' => $customer->email ?? null,
              'phone' => $customer->phone ?? null,
              'country' => $customer->address->country ?? null,
              'state' => $customer->address->state ?? null,
              'city' => $customer->address->city ?? null,
              'line1' => $customer->address->line1 ?? null,
              'line2' => $customer->address->line2 ?? null,
              'postal_code' => $customer->address->postal_code ?? null,
              'amount' => $session->amount_total / 100,
              'stripe_session_id' => $session->id,
              'payment_status' => $session->payment_status,
          ]);

        return redirect()->route('home')->with('subscription_success', true);
    }

    public function checkoutCancel()
    {
        return redirect()->route('home')->with('subscription_cancel', true);
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'Your newsletter request has been sent. Thank you!')->withFragment('footer');
    }

}
