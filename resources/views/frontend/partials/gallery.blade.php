@php
    $contents = App\Models\Content::with('images')
        ->where('type', 1)
        ->whereHas('images') 
        ->where('status', 1)
        ->get();
@endphp

@if($contents->isNotEmpty())
<section id="portfolio" class="portfolio section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      
      <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
        <li data-filter="*" class="filter-active">All</li>
        @foreach($contents as $content)
          <li data-filter=".filter-{{ $content->id }}">{{ $content->short_title }}</li>
        @endforeach
      </ul>

      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">
        @foreach($contents as $content)
          @foreach($content->images as $image)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $content->id }}">
              <div class="portfolio-card">
                <div class="portfolio-img">
                  <img src="{{ asset('images/content/'.$image->image) }}" class="img-fluid" alt="{{ $content->short_title }}">
                  <div class="portfolio-overlay">
                    <a href="{{ asset('images/content/'.$image->image) }}" class="glightbox portfolio-lightbox" data-gallery="portfolio-gallery-{{ $content->id }}">
                      <i class="bi bi-plus"></i>
                    </a>
                  </div>
                </div>
                <div class="portfolio-info">
                  <h4>{{ $content->short_title }}</h4>
                  <p>{{ $content->short_desc }}</p>
                  <div class="portfolio-tags">
                    @foreach($content->tags as $tag)
                      <span>{{ $tag->name }}</span>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endforeach
      </div>

    </div>

  </div>
</section>
@endif