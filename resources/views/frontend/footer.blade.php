<footer id="footer" class="footer dark-background">
  <div class="container text-center">
    <div class="row justify-content-center">

      <div class="col-lg-3 col-md-6">
        <div class="footer-content text-center">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center justify-content-center">
            <img src="{{ asset('images/company/' . $company->footer_logo) }}" 
                alt="{{ $company->company_name ?? '' }}" 
                class="img-fluid me-2"
                style="max-height: 60px; width: auto;">
            <h1 class="sitename mb-0" style="font-size: 22px;">{{ $company->company_name ?? '' }}</h1>
          </a>

          <p class="mb-4 mt-3">{{ $company->footer_content ?? '' }}</p>

          <div class="newsletter-form d-none">
            <h5>Stay Updated</h5>
            <form action="{{ route('subscribe.newsletter') }}" method="POST" class="php-email-form">
              @csrf
              <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                <button type="submit" class="btn-subscribe">
                  <i class="bi bi-send"></i>
                </button>
              </div>
              <div class="loading" style="display:none;">Loading</div>

              @if(session('success'))
                <div class="sent-message">{{ session('success') }}</div>
              @endif

              @error('email')
                <div class="error-message">{{ $message }}</div>
              @enderror
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-1"></div>

      <div class="col-lg-3 col-md-6 text-center">
        <div class="footer-links">
          <h4>Navigation</h4>
          <ul>
            <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
            <li><a href="{{ route('home') }}#about"><i class="bi bi-chevron-right"></i> About Us</a></li>
            <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Contact</a></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="footer-links">
          <h4>Services</h4>
          <ul>
            @foreach($products as $product)
              <li>
                <a href="{{ route('service.show', $product->slug) }}"><i class="bi bi-chevron-right"></i> {{ $product->title }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="col-lg-2 col-md-6">
        <div class="footer-contact">
          <h4>Get in Touch</h4>

          @if ($company->address1)
          <div class="contact-item">
            <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
            <div class="contact-info"><p>{{ $company->address1 }}</p></div>
          </div>
          @endif

          @if ($company->phone1)
          <div class="contact-item">
            <div class="contact-icon"><i class="bi bi-telephone"></i></div>
            <div class="contact-info"><p>{{ $company->phone1 }}</p></div>
          </div>
          @endif

          @if ($company->email1)
          <div class="contact-item">
            <div class="contact-icon"><i class="bi bi-envelope"></i></div>
            <div class="contact-info"><p>{{ $company->email1 }}</p></div>
          </div>
          @endif

          @if ($company->whatsapp)
            <div class="contact-item">
              <div class="contact-icon"><i class="bi bi-whatsapp"></i></div>
              <div class="contact-info">
                <p><a href="https://wa.me/{{ $company->whatsapp }}" target="_blank">Chat on WhatsApp</a></p>
              </div>
            </div>
          @endif

          <div class="social-links">
            @if ($company->facebook)
            <a href="{{ $company->facebook }}"><i class="bi bi-facebook"></i></a>
            @endif
            @if ($company->twitter)
            <a href="{{ $company->twitter }}"><i class="bi bi-twitter-x"></i></a>
            @endif
            @if ($company->linkedin)
            <a href="{{ $company->linkedin }}"><i class="bi bi-linkedin"></i></a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="copyright">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $company->company_name ?? 'Company Name' }}</strong> <span>All Rights Reserved</span></p>
            <p>Company No: <span>{{ $company->company_reg_number ?? '' }} </span></p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="footer-bottom-links">
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
            <a href="{{ route('terms-and-conditions') }}">Terms of Service</a>
            {{-- <a href="{{ route('faq') }}">FAQ</a> --}}
          </div>
          <div class="credits">
            Designed & Developed by <a href="https://www.mentosoftware.co.uk/" target="_blank">Mento Soft</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>