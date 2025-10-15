<!DOCTYPE html>
<html lang="en">
@php
    $company = App\Models\CompanyDetails::select('company_name', 'fav_icon', 'google_site_verification', 'footer_content', 'facebook', 'twitter', 'linkedin', 'website', 'phone1', 'email1', 'address1', 'company_logo', 'company_reg_number', 'whatsapp', 'footer_logo')->first();

    $products = App\Models\Product::where('status', 1)->select('id', 'title', 'icon', 'short_description', 'slug')->orderByRaw('sl = 0, sl ASC')->orderBy('id', 'desc')->get();
@endphp

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    {{-- <title>{{ $company->meta_title ?? $company->company_name }}</title> --}}
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    <meta property="og:type" content="website">

    @if($company->google_site_verification)
    <meta name="google-site-verification" content="{{ $company->google_site_verification }}">
    @endif

    <link href="{{ asset('images/company/' . $company->fav_icon) }}" rel="icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="{{ asset('resources/frontend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend/css/custom.css') }}" rel="stylesheet">
</head>

<body class="{{ request()->routeIs('home') ? 'index-page' : '' }}">

    @include('frontend.header')

    <main class="main">
        @yield('content')
    </main>

    @include('frontend.cookies')

    @include('frontend.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <script src="{{ asset('resources/frontend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/frontend/aos/aos.js') }}"></script>
    <script src="{{ asset('resources/frontend/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('resources/frontend/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('resources/frontend/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('resources/frontend/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('resources/frontend/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('resources/frontend/js/main.js') }}"></script>
    <script src="{{ asset('resources/frontend/js/custom.js') }}"></script>

    @yield('script')

</body>

</html>