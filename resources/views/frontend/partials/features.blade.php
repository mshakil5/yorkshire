@php
  $feature = App\Models\Master::firstOrCreate(['name' => 'feature']);

  $services = App\Models\Service::orderByRaw('sl = 0, sl ASC')
    ->where('type', 1)
    ->where('status', 1)
    ->get();
@endphp

<section id="features" class="features section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
      <div class="col-lg-4" data-aos="fade-right" data-aos-delay="200">
        <div class="features-content">
          <h2>{{ $feature->short_title }}</h2>
          <p>{{ $feature->long_title }}</p>

          <a href="{{ route('contact') }}" class="btn-get-started">Get In Touch</a>
        </div>
      </div>

      <div class="col-lg-8" data-aos="fade-left" data-aos-delay="300">
        <div class="features-grid">
            @foreach($services as $service)
                <div class="feature-card" data-aos="zoom-in" data-aos-delay="{{ 400 + ($loop->index * 50) }}">
                    <div class="icon-wrapper">
                        @if($service->icon)
                            <i class="{{ $service->icon }}"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    </div>
                    <h5>{{ $service->title }}</h5>
                    <p>{{ $service->short_desc }}</p>
                </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>

</section>