@extends('frontend.master')

@section('content')
  <div class="page-title">
    <div class="heading">
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="current">{{ $service->title }}</li>
        </ol>
      </div>
    </nav>
  </div>

  <section class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6 position-relative">
          <div class="about-img" data-aos="fade-right">
            <img src="{{ asset('images/products/' . $service->image) }}" alt="{{ $service->title ?? '' }}" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
          <h2 class="display-4 fw-bold mb-4">{{ $service->title }}</h2>
          <p class="lead mb-4">{!! $service->long_description !!}</p>
        </div>
      </div>

    </div>

  </section>

  @foreach($service->features as $key => $feature)
  <section class="about section {{ $key % 2 == 0 ? 'light-background' : '' }}">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-5 align-items-center">
        @if($key % 2 == 0)
        <div class="col-lg-6" data-aos="fade-left">
          <h2 class="display-4 fw-bold mb-4">{{ $service->title }}</h2>
          <p class="lead mb-4">{!! $service->long_description !!}</p>

          @if(!empty($feature->features))
            <div class="features">
              <ul class="check-list" data-aos="fade-up" data-aos-delay="200">
                @foreach(explode(',', $feature->features) as $item)
                  <li><i class="bi bi-check-circle"></i> {{ trim($item) }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        <div class="col-lg-6 position-relative">
          <div class="about-img" data-aos="fade-right">
            <img src="{{ asset('images/product-features/' . $feature->image) }}" alt="{{ $feature->title ?? '' }}" class="img-fluid">
          </div>
        </div>
        @else
        <div class="col-lg-6 position-relative">
          <div class="about-img" data-aos="fade-right">
            <img src="{{ asset('images/product-features/' . $feature->image) }}" alt="{{ $feature->title ?? '' }}" class="img-fluid">
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
          <h2 class="display-4 fw-bold mb-4">{{ $service->title }}</h2>
          <p class="lead mb-4">{!! $service->long_description !!}</p>

          @if(!empty($feature->features))
            <div class="features">
              <ul class="check-list" data-aos="fade-up" data-aos-delay="200">
                @foreach(explode(',', $feature->features) as $item)
                  <li><i class="bi bi-check-circle"></i> {{ trim($item) }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        @endif
      </div>
    </div>
  </section>
  @endforeach


  @if($service->process)
  <section id="process" class="faq section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="row g-5 align-items-start">
            <div class="col-lg-6" data-aos="fade-right">
              <h4 class="display-4 fw-bold mb-3">{{ $service->process->title }}</h4>
              <p class="lead">{{ $service->process->sub_title }}</p>
              <div class="features">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg mt-4" data-aos="fade-up" data-aos-delay="300">Get a Quote</a>
              </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">

              @php
                  $steps = json_decode($service->process->steps, true) ?? [];
              @endphp
              <div class="faq-list">
                @if($service->process && $service->process->steps)
                  @foreach($steps as $index => $step)
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ 200 + ($index * 100) }}">
                      <h3>
                        <span class="num">{{ $index + 1 }}</span>
                        <span class="question">{{ $step['title'] ?? '' }}</span>
                        <i class="bi bi-plus-lg faq-toggle"></i>
                      </h3>
                      @if(!empty($step['description']))
                        <div class="faq-content">
                          {!! $step['description'] !!}
                        </div>
                      @endif
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  @endif

  @if($service->faqs && $service->faqs->count())
  <section id="faq" class="faq section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="text-center mb-5">
            <h2 class="display-4 fw-bold">FAQ</h2>
            <p class="lead">Frequently Asked Questions About {{ $service->title }}</p>
          </div>

          <div class="faq-list">
            @foreach($service->faqs as $index => $faq)
              @if($faq->status)
                <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ 200 + ($index * 100) }}">
                  <h3>
                    <span class="num">{{ $index + 1 }}</span>
                    <span class="question">{{ $faq->question }}</span>
                    <i class="bi bi-plus-lg faq-toggle"></i>
                  </h3>
                  @if($faq->answer)
                    <div class="faq-content">
                      {!! $faq->answer !!}
                    </div>
                  @endif
                </div>
              @endif
            @endforeach
          </div>

          <div class="faq-cta text-center mt-5" data-aos="fade-up" data-aos-delay="300">
            <p>Still have questions? We're here to help!</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Contact Support</a>
          </div>

        </div>
      </div>
    </div>
  </section>
  @endif

  @include('frontend.partials.gallery')

  @include('frontend.partials.cta')
  
  @include('frontend.partials.features')

@endsection