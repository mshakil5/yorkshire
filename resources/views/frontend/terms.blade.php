@extends('frontend.master')

@section('content')
  <div class="page-title">
    <div class="heading">
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="current">Terms & Conditions</li>
        </ol>
      </div>
    </nav>
  </div>

  <section id="terms" class="terms section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Terms & Conditions</h2>
    </div>

    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-12">
          <div class="terms-content">
            {!! $companyDetails->terms_and_conditions !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection