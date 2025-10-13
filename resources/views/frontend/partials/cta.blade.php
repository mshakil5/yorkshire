@php
  $cta = App\Models\Master::firstOrCreate(['name' => 'cta']);
@endphp

<section id="call-to-action" class="call-to-action section dark-background">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row align-items-center">

      <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
        <div class="cta-content">
          <div class="badge mb-3">
            <i class="bi bi-rocket-takeoff"></i>
            {{ $cta->short_title ?? '' }}
          </div>
          <h2>{{ $cta->long_title ?? '' }}</h2>
          <p class="lead">{!! $cta->short_description ?? '' !!}</p>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
        <div class="features-list mb-4">
          {!! $cta->long_description ?? '' !!}
        </div>

        <div class="cta-buttons">
          <a href="{{ route('contact') }}" class="btn btn-primary">Get In Touch</a>
          <a href="{{ route('home') }}#services" class="btn btn-outline">Services</a>
        </div>
      </div>

    </div>

  </div>

</section>