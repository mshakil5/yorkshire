@extends('frontend.master')

@section('content')

  @foreach($sections as $section)
  
  @if($section->name == 'hero')

  <section id="hero" class="hero section dark-background">

    <div class="info d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-8 text-center">
            <h2>{{ $hero->short_title ?? '' }}</h2>
            <p>{{ $hero->long_title ?? '' }}</p>
            <div class="d-flex justify-content-center gap-2">
              <a href="{{ route('home') }}#services" class="btn-get-started">Services</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('images/slider/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title ?? 'Slider Image' }}">
          </div>
        @endforeach
      </div>

      <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>

  </section>

  @endif

  @if($section->name == 'services')

  <section id="services" class="services section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <div class="col-lg-6">
          <div class="services-content" data-aos="fade-left" data-aos-duration="900">
            <span class="subtitle">{{ $service->short_title ?? '' }}</span>
            <h2>{{ $service->long_title ?? '' }}</h2>
            <p data-aos="fade-right" data-aos-duration="800">{!! $service->long_description ?? '' !!}</p>
            <div class="mt-4" data-aos="fade-right" data-aos-duration="1100">
              <a href="{{ route('contact') }}" class="btn-consultation"><span>Get In Touch</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="services-image" data-aos="fade-left" data-aos-delay="200">
            <img src="{{ asset('images/meta_image/' . $service->meta_image) }}" class="img-fluid" alt="{{ $service->short_title ?? '' }}">
            <div class="shape-circle"></div>
            <div class="shape-accent"></div>
          </div>
        </div>
      </div>

      <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="col-12">
          <div class="services-slider swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "slidesPerView": 3,
                "spaceBetween": 20,
                "loop": true,
                "speed": 600,
                "autoplay": { "delay": 5000 },
                "navigation": { "nextEl": ".swiper-nav-next", "prevEl": ".swiper-nav-prev" },
                "breakpoints": { "320": {"slidesPerView":1}, "768": {"slidesPerView":2}, "992": {"slidesPerView":3} }
              }
            </script>

            <div class="swiper-wrapper">
              @foreach($products as $key => $product)
                <div class="swiper-slide">
                  <div class="service-card">
                    <div class="icon-box">
                      @if($product->icon)
                        <i class="{{ $product->icon ?? 'bi bi-lightbulb-fill' }}"></i>
                      @endif
                    </div>

                    <a href="#" class="arrow-link">
                      <i class="bi bi-arrow-right"></i>
                    </a>

                    <div class="content">
                      <h4>
                        <a href="{{ route('service.show', $product->slug) }}" class="stretched-link">
                          {{ $product->title }}
                        </a>
                      </h4>
                      <p>{{ $product->short_description ?? '' }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="swiper-navigation">
              <button class="swiper-nav-prev"><i class="bi bi-chevron-left"></i></button>
              <button class="swiper-nav-next"><i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section>

  @endif

  @if($section->name == 'about')

  <section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6 position-relative">
          <div class="about-img" data-aos="fade-right">
            <img src="{{ asset('images/meta_image/' . $about1->meta_image) }}" class="img-fluid" alt="{{ $about1->short_title ?? '' }}">
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
          <h2 class="display-4 fw-bold mb-4">{{ $about1->short_title }}</h2>
          <p class="lead mb-4">{!! $about1->long_description !!}</p>

          <div class="features">
            <a href="{{ route('home') }}#services" class="btn btn-primary btn-lg mt-4" data-aos="fade-up" data-aos-delay="300">View Our Services</a>
          </div>
        </div>
      </div>

    </div>

  </section>

  @endif

  @if($section->name == 'gallery')

  @include('frontend.partials.gallery')

  @endif

  @if($section->name == 'cta')

  @include('frontend.partials.cta')

  @endif

  @if($section->name == 'features')

  @include('frontend.partials.features')

  @endif

  @endforeach

@endsection