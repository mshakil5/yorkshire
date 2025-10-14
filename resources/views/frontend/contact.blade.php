@extends('frontend.master')

@section('content')
  <div class="page-title">
    <div class="heading">
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="current">Contact</li>
        </ol>
      </div>
    </nav>
  </div>

  <section id="contact" class="contact section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="contact-main-wrapper">
        <div class="map-wrapper">
          <iframe src="{{ $company->google_map ?? '' }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="contact-content">
          <div class="contact-cards-container" data-aos="fade-up" data-aos-delay="300">
            <div class="contact-card">
              <div class="icon-box">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="contact-text">
                <h4>Location</h4>
                <p>{{ $company->address1 }}</p>
              </div>
            </div>

            <div class="contact-card">
              <div class="icon-box">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="contact-text">
                <h4>Email</h4>
                <p>{{ $company->email1 }}</p>
              </div>
            </div>

            <div class="contact-card">
              <div class="icon-box">
                <i class="bi bi-telephone"></i>
              </div>
              <div class="contact-text">
                <h4>Call</h4>
                <p>{{ $company->phone1 }}</p>
              </div>
            </div>

            @if ($company->whatsapp)
            <div class="contact-card">
              <div class="icon-box">
                <i class="bi bi-whatsapp"></i>
              </div>
              <div class="contact-text">
                <h4>WhatsApp</h4>
                <p><a href="https://wa.me/{{ $company->whatsapp }}" target="_blank">{{ $company->whatsapp }}</a></p>
              </div>
            </div>
            @endif
          </div>

          <div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
            <h3>Get in Touch</h3>
            <form action="{{ route('contact.store') }}" method="post" class="php-email-form">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                              id="name" placeholder="Full Name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                              id="email" placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                              id="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-3">
                    <input type="text" name="company" class="form-control @error('company') is-invalid @enderror"
                          id="company" placeholder="Company (If Applicable)" value="{{ old('company') }}">
                    @error('company')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                              rows="5" placeholder="Message" required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-submit mt-3">
                    <button type="submit" class="btn btn-primary" id="submit-btn">Send Message</button>

                    <div id="loading-text" class="alert alert-info d-none">
                        Sending your message...
                    </div>

                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span id="captcha-question" class="fw-bold"></span>
                        <input type="number" id="captcha-answer" class="form-control" style="width: 120px;" placeholder="Answer" required>
                        <span id="captcha-error" class="text-danger d-none"></span>
                    </div>

                    <div class="social-links mt-2">
                        @if(!empty($company->twitter))
                            <a href="{{ $company->twitter }}"><i class="bi bi-twitter"></i></a>
                        @endif
                        @if(!empty($company->facebook))
                            <a href="{{ $company->facebook }}"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if(!empty($company->linkedin))
                            <a href="{{ $company->linkedin }}"><i class="bi bi-linkedin"></i></a>
                        @endif
                    </div>
                </div>
            </form>
            @if(session('success'))
              <div id="sent-message" class="alert alert-success mt-3">
                  {{ session('success') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('script')
<script>
  $(document).ready(function() {
      let num1 = Math.floor(Math.random() * 10) + 1;
      let num2 = Math.floor(Math.random() * 10) + 1;
      let correctAnswer = num1 + num2;

      $('#captcha-question').text(`What is ${num1} + ${num2}? *`);

      $('.php-email-form').on('submit', function(e) {
          let userAnswer = parseInt($('#captcha-answer').val());
          if(userAnswer !== correctAnswer) {
              e.preventDefault();
              $('#captcha-error').removeClass('d-none').text('Incorrect answer');
          } else {
              $('#captcha-error').addClass('d-none');

              // Show the loading div
              $('.loading').show();

              // Disable submit button
              $(this).find('button[type="submit"]').prop('disabled', true).text('Sending...');
          }
      });

      // If session success exists, show sent-message
      @if(session('success'))
          $('.sent-message').show();
      @endif
  });
</script>
@endsection