@extends('main_layout')

@section('content')

<div class="container" style="margin-top:10rem">
    <div class="row">
        <div class="col-sm-12">
            <div class="about-img-box">
              <img src="{{ asset('img/slide-about-1.jpg') }}" alt="" class="img-fluid">
            </div>
            <div class="sinse-box">
              <h3 class="sinse-title">Personalized Lifestyle Consultations</h3>
              <span>Our experts work with you to understand your lifestyle preferences and recommend properties that fit your needs.</span><br>
              <button class="btn btn-primary btn-sm mt-3">Book Consultation?</button>
            </div>
          </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-12">
            <div class="about-img-box">
              <img src="{{ asset('img/slide-about-1.jpg') }}" alt="" class="img-fluid">
            </div>
            <div class="sinse-box">
              <h3 class="sinse-title">Lifestyle Planning Packages</h3>
              <span>Choose from tailored packages designed for family-friendly living, urban explorers, or eco-conscious individuals.</span>
            </div>
          </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-12">
            <div class="about-img-box">
              <img src="{{ asset('img/slide-about-1.jpg') }}" alt="" class="img-fluid">
            </div>
            <div class="sinse-box">
              <h3 class="sinse-title">Relocation Support</h3>
              <span>We offer end-to-end relocation assistance, including moving logistics and community integration.</span><br>
              <button class="btn btn-primary btn-sm mt-3">Need Support?</button>
            </div>
          </div>
    </div>
</div>

@endsection
