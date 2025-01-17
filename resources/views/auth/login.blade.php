<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Login | ECOHUB</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
/>
<link rel="stylesheet" href="{{ asset('vendors/fonts/boxicons.css') }}" />
<link rel="stylesheet" href="{{ asset('vendors/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('vendors/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/css/pages/page-auth.css') }}" />

<script src="{{ asset('vendors/js/helpers.js') }}"></script>

<script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/favicons/favicon-32x32.png') }}" width="25px" alt="">
                  </span>
                  <span class="app-brand-text fw-bolder">ECOHUB</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to ECOBHUB! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
              <form id="formAuthentication" class="mb-3"  action="{{ route('login') }}" method="POST">
                @csrf
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="#">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="defaultSelect" class="form-label"> chọn thùng rác (Lưu ý phải chọn đúng thùng rác, nếu chọn sai scan QR sẽ không được)</label>
                  <select id="defaultSelect" name="location" class="form-select">
                    <option value="" selected disabled>Chọn thùng rác</option>
                    @foreach ( $trashs as $trash )
                    <option value="{{$trash->id}}">{{$trash->name}}</option>
                    @endforeach
                  </select>
              </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit" name="submit">Sign in</button>
                </div>
              </form>
              <p class="text-center">
                <span>New on our platform?</span>
                <a href="/signup">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendors/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendors/libs/popper/popper.js') }}"></script>
<script src="{{ asset('vendors/js/bootstrap.js') }}"></script>
<script src="{{ asset('vendors/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('vendors/js/menu.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
