@php
    use Illuminate\Support\Facades\Auth;

@endphp
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>ECOHUB | website xịn</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->

    <script></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-Yfku/8UX2xSueh6Yk39iRE/iIkcrqACqR6gyYO4FAYqNHjPfaunC6GU+ZyI5j4aAOhqWq6f+SuCcFwtI9mMYmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFOnpDpgdthxrwVBWTVqQzLJ8o7mhIqMXpS9IKrTdtdI4z9ACoqbQ83SX+a" crossorigin="anonymous">
    </script>

    <link href="{{ asset('vendors/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet" />
    <style>
        body {
            background-image: url('{{ asset('assets/img/bg.jpg') }}');
            /* Nếu bạn muốn lặp lại hình ảnh */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            /* Đây là điểm quan trọng */
            /* Hoặc background-repeat: no-repeat; nếu bạn không muốn lặp lại */
            /* Có thể thêm các thuộc tính khác như background-size, background-position tùy theo nhu cầu */
        }
        .text-center-qr {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .validation-error {
            display: flex;
            align-items: center;
            /* Căn giữa theo chiều dọc */
            justify-content: center;
            /* Căn giữa theo chiều ngang */
            color: #ff0000;
            margin-top: 5px;
            /* Khoảng cách với trường input */
        }


        @import url('https://fonts.googleapis.com/css?family=Source+Code+Pro:200,900');

        :root {
            --text-color: hsla(210, 50%, 85%, 1);
            --shadow-color: hsl(165, 73%, 33%);
            --btn-color: hsl(165, 73%, 33%);
            --bg-color: #0d8063;
        }

        * {
            box-sizing: border-box;
        }

        button {
            position: relative;
            padding: 10px 20px;
            border: none;
            background: none;
            cursor: pointer;

            font-family: "Source Code Pro";
            font-weight: 900;
            text-transform: uppercase;
            font-size: 30px;
            color: var(--text-color);
            background-color: var(--btn-color);
            box-shadow: var(--shadow-color) 2px 2px 22px;
            border-radius: 4px;
            z-index: 0;
            overflow: hidden;
        }

        button:focus {
            outline-color: transparent;
            box-shadow: var(--btn-color) 2px 2px 22px;
        }

        .right::after,
        button::after {
            content: var(--content);
            display: block;
            position: absolute;
            white-space: nowrap;
            padding: 40px 40px;
            pointer-events: none;
        }

        button::after {
            font-weight: 200;
            top: -30px;
            left: -20px;
        }

        .right,
        .left {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
        }

        .right {
            left: 66%;
        }

        .left {
            right: 66%;
        }

        .right::after {
            top: -30px;
            left: calc(-66% - 20px);

            background-color: var(--bg-color);
            color: transparent;
            transition: transform .4s ease-out;
            transform: translate(0, -90%) rotate(0deg)
        }

        button:hover .right::after {
            transform: translate(0, -47%) rotate(0deg)
        }

        button .right:hover::after {
            transform: translate(0, -50%) rotate(-7deg)
        }

        button .left:hover~.right::after {
            transform: translate(0, -50%) rotate(7deg)
        }

        /* bubbles */
        button::before {
            content: '';
            pointer-events: none;
            opacity: .6;
            background:
                radial-gradient(circle at 20% 35%, transparent 0, transparent 2px, var(--text-color) 3px, var(--text-color) 4px, transparent 4px),
                radial-gradient(circle at 75% 44%, transparent 0, transparent 2px, var(--text-color) 3px, var(--text-color) 4px, transparent 4px),
                radial-gradient(circle at 46% 52%, transparent 0, transparent 4px, var(--text-color) 5px, var(--text-color) 6px, transparent 6px);

            width: 100%;
            height: 300%;
            top: 0;
            left: 0;
            position: absolute;
            animation: bubbles 5s linear infinite both;
        }

        @keyframes bubbles {
            from {
                transform: translate();
            }

            to {
                transform: translate(0, -66.666%);
            }
        }

        @keyframes glowing {
            0% {
                background-position: 0 0;
            }

            50% {
                background-position: 400% 0;
            }

            100% {
                background-position: 0 0;
            }
        }
    </style>

</head>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <nav class="navbar navbar-expand-lg fixed-top navbar-dark" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="/index"><img width="50px"
                        src="{{ asset('assets/img/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i
                        class="fa-solid fa-bars text-white fs-3"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item ms-2"><a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item ms-2"><a class="nav-link active" aria-current="page" href="#about-us">Về chúng tôi</a>
                        </li>
                        <li class="nav-item ms-2 mt-2 mt-lg-0">
                            <a style="background: #ffffff; border:none"
                                class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page"
                                href="/sign-in">Log In</a>
                        </li>
                        <li class="nav-item ms-2 mt-2 mt-lg-0">
                            <a style="background: #65e4a3; border:none"
                                class="nav-link btn text-white w-md-25 w-50 w-lg-100" aria-current="page"
                                href="signup">Sign Up</a>

                    </ul>
                </div>
            </div>
        </nav>
        <section class="py-5 container text-center items-center mt-5 ">
            <h1 class="text-center text-white">Số lượng thùng rác đang thí điểm tại<br> <span class="text-primary">Hà Nội</span> của chúng tôi: <span class="text-success">{{count($trashs)}} </span></h1>
        <div class="flex items-center mt-5">
            <div class="container py-5" id="map" style=" height: 500px !important"></div>

        </div>
    </section>
    <section>

        <div class="container" id="about-us">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start"><img class="img-fluid" src="assets/img/offer/1.png"
                        alt="" /></div>
                <div class="col-lg-6">
                    <h1 class="fs-xl-5 fs-lg-4 fs-3">We connect our customers with the best, and help them keep up-and stay
                        open.</h1>
                    <ul class="list-unstyled my-xl-5 my-3">
                        <li class="fs-2 my-4 d-flex align-items-center gap-3 text-black"><i
                                class="fa-solid fa-circle-check fs-4 text-dark"></i><span>We connect our customers with the
                                best.</span></li>
                        <li class="fs-2 my-4 d-flex align-items-center gap-3 text-black"><i
                                class="fa-solid fa-circle-check fs-4 text-dark"></i><span>Advisor success customer launch
                                party.</span></li>
                        <li class="fs-2 my-4 d-flex align-items-center gap-3 text-black"><i
                                class="fa-solid fa-circle-check fs-4 text-dark"></i><span>Business-to-consumer long
                                tail.</span></li>
                    </ul>
                    <button class="btn btn-dark">Start now</button>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-8 pt-lg-0">
        <style>
            .container span{
                color: #65e4a3;
            }
            .container h1{
                color: white;
            }
        </style>
        <div class="container" style="color: white">
            <div class="d-flex flex-column-reverse flex-lg-row">
                <div class="col-lg-6">
                    <h1 class="fs-lg-4 fs-md-3 fs-xl-5 mb-5 text-white">We connect our customers with the best, and help them keep
                        up-and stay open.</h1>
                    <ul class="list-unstyled">
                        <li class="fs-2 shadow-sm offer-list-item"><i class="fa-solid fa-leaf fs-lg-4 fs-3"></i><span class="">We
                                connect our customers with the best.</span></li>
                        <li class="fs-2 shadow-sm offer-list-item"><i class="fa-solid fa-eye fs-lg-4 fs-3"></i><span>Advisor
                                success customer launch party.</span></li>
                        <li class="fs-2 shadow-sm offer-list-item"><i
                                class="fa-solid fa-sun fs-lg-4 fs-3"></i><span>Business-to-consumer long tail.</span></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-center text-lg-end"><img class="img-fluid" src="assets/img/offer/2.png"
                        alt="" /></div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-dark pt-6">

        <div class="container">
            <div class="col-md-6">
                <h1 class="text-white fs-lg-5 fs-md-3 fs-2">An enterprise template to ramp up your company website</h1>
            </div>
            <div class="swiper mt-7">
                <div class="swiper-container swiper-theme"
                    data-swiper='{"slidesPerView":1,"breakpoints":{"640":{"slidesPerView":1,"spaceBetween":10},"768":{"slidesPerView":2,"spaceBetween":20},"1025":{"slidesPerView":3,"spaceBetween":40}},"spaceBetween":10,"grabCursor":true,"pagination":{"el":".swiper-pagination","clickable":true},"navigation":{"nextEl":".swiper-button-next","prevEl":".swiper-button-prev"},"loop":true,"freeMode":true,"loopedSlides":3}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide bg-white p-5 rounded-3 h-auto">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <h4 class="text-black">“Buyer buzz partner network disruptive non-disclosure agreement
                                    business”</h4>
                                <div class="d-flex align-items-center gap-3 mt-5"><img src="assets/img/review/1.png"
                                        alt="" />
                                    <div class="text-black">
                                        <p class="mb-0 fw-bold text-dark">Albus Dumbledore</p><small>Manager @
                                            Howarts</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide bg-white p-5 rounded-3 h-auto">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <h4 class="text-black">“Learning curve infrastructure value proposition advisor strategy
                                    user experience hypotheses investor.”</h4>
                                <div class="d-flex align-items-center gap-3 mt-5"><img src="assets/img/review/2.png"
                                        alt="" />
                                    <div class="text-black">
                                        <p class="mb-0 fw-bold text-dark">Severus Snape</p><small>Manager @
                                            Slytherin</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide bg-white p-5 rounded-3 h-auto">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <h4 class="text-black">“Release facebook responsive web design business model canvas seed
                                    money monetization.”</h4>
                                <div class="d-flex align-items-center gap-3 mt-5"><img src="assets/img/review/3.png"
                                        alt="" />
                                    <div class="text-black">
                                        <p class="mb-0 fw-bold text-dark">Harry Potter</p><small>Team Leader @
                                            Gryffindor</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide bg-white p-5 rounded-3 h-auto">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <h4 class="text-black">“Buyer buzz partner network disruptive non-disclosure agreement
                                    business”</h4>
                                <div class="d-flex align-items-center gap-3 mt-5"><img src="assets/img/review/1.png"
                                        alt="" />
                                    <div class="text-black">
                                        <p class="mb-0 fw-bold text-dark">Albus Dumbledore</p><small>Manager @
                                            Howarts</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"><span class="fas fa-arrow-right fs-lg-3 fs-2"></span></div>
                <div class="swiper-button-prev"><span class="fas fa-arrow-left fs-lg-3 fs-2"></span></div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
        <section class="pt-5">

            <div class="container">
                <div class="m-auto text-center">
                    © Trần Hoàng Phi
                </div>
            </div>
            <!-- end of .container-->

        </section>
        </div>
        <script>
            var map = L.map('map').setView([21.027778, 105.834160], 12);
          
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
          
            <?php // Assuming you're using Blade templating ?>
            <?php foreach ($trashs as $trash): ?>
              <?php
                // Check for latitude and longitude existence:
                if (isset($trash->latitude) && isset($trash->longitude)) {
                  $lat = $trash->latitude;
                  $lng = $trash->longitude;
                } else {
                  // Handle cases where coordinates are missing:
                  // - You could skip the marker placement for this item.
                  // - You could display a default marker or message.
                  // - You could provide a fallback mechanism (e.g., using location data if available).
                  continue;
                }
              ?>
          
              var markerLabel = L.marker([<?php echo $lat; ?>, <?php echo $lng; ?>]).addTo(map);
          
              <?php if (isset($trash->name)): ?>
                // Use name for popup content if available
                markerLabel.bindPopup("<?php echo $trash->name; ?>").addTo(map);
              <?php else: ?>
                // Provide default popup content if name is missing
                markerLabel.bindPopup("Trash Item").addTo(map);
              <?php endif; ?>
            <?php endforeach; ?>
          </script>
          
        <!-- <section> close ============================-->
        <!-- ============================================-->

        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        <!-- ===============================================-->

        <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
        <script src="{{ asset('vendors/is/is.min.js') }}"></script>
        <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
        <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="{{ asset('vendors/prism/prism.js') }}"></script>
        <script src="{{ asset('vendors/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
    </main>
</body>

</html>
