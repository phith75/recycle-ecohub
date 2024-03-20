@php
  use Illuminate\Support\Facades\Auth;

@endphp
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>ECOHUB | website xịn</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
  
    <script>

    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-Yfku/8UX2xSueh6Yk39iRE/iIkcrqACqR6gyYO4FAYqNHjPfaunC6GU+ZyI5j4aAOhqWq6f+SuCcFwtI9mMYmQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('vendors/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet" />
    <style>
      .text-center-qr {
        margin-top: 2rem;
       display: flex;
        justify-content: center;
        align-items: center;
}
    </style>

  </head>
  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="/"><span class="fas fa-leaf"></span> ECOHUB
        </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars text-white fs-3"></i></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
              <li class="nav-item ms-2"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
              <li class="nav-item ms-2"><a class="nav-link" aria-current="page" href="about.html">About</a></li>
              <li class="nav-item ms-2"><a class="nav-link" aria-current="page" href="blogs.html">Blogs</a></li>
              @if(Auth::check())
              <li class="nav-item ms-2"><a class="nav-link" aria-current="page" href="#">Xin chào <span class="text-primary">{{Auth::user()->name}}</span> </a></li>
              <li class="nav-item ms-2 mt-2 mt-lg-0">
                <a style="background: #ffffff; border:none" class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" href="{{route('logout')}}">Log Out</a>
            </li>
              @else
    <li class="nav-item ms-2 mt-2 mt-lg-0">
        <a style="background: #ffffff; border:none" class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" href="/login">Log In</a>
    </li>
    <li class="nav-item ms-2 mt-2 mt-lg-0">
        <a style="background: #65e4a3; border:none" class="nav-link btn text-white w-md-25 w-50 w-lg-100" aria-current="page" href="signup">Sign Up</a>
    </li>
  @endif

              </ul>
          </div>
        </div>
      </nav>
      <div class="bg-dark"><img class="img-fluid position-absolute end-0" src="assets/img/hero/hero-bg.png" alt="" />
