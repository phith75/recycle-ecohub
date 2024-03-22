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
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->

    <script></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-Yfku/8UX2xSueh6Yk39iRE/iIkcrqACqR6gyYO4FAYqNHjPfaunC6GU+ZyI5j4aAOhqWq6f+SuCcFwtI9mMYmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <div class="container"><a class="navbar-brand" href="/"><span class="fas fa-leaf"></span> ECOHUB
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i
                        class="fa-solid fa-bars text-white fs-3"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item ms-2"><a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item ms-2 me-2"><a class="nav-link glow-on-hover" aria-current="page"
                                    href="#">Chào
                                    <span class="">{{ Auth::user()->name }} !</span></a></li>



                            @if (Auth::user()->role == 0)

                                <div class="dropdown">

                                    <a style="border-radius: 4px" class="btn btn-warning dropdown-toggle nav-link"
                                        id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"
                                        type="button">
                                        Đổ rác
                                        @foreach ($trasheType as $trashNoti)
                                            @if ($trashNoti->notification > 70)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                </span>
                                            @endif
                                        @endforeach
                                    </a>
                                    <ul style="border-radius: 0px; padding:10px"
                                        class="dropdown-menu dropdown-menu-warning"
                                        aria-labelledby="dropdownMenuButton2">
                                        @foreach ($trasheType as $trash)
                                        <?php
                                        
                                    
                                            $class = "text-success"; // Mặc định là text-success
                                        
                                            if ($trash->notification > 70) {
                                                $class = "text-danger";
                                            } elseif ($trash->notification >= 50) {
                                                $class = "text-warning";
                                        }
                                        ?>
                                                <a class="dropdown-item" href="{{route('trashDelete', $trash->id)}}">{{ $trash->name }} <span
                                                        class="{{$class }}">{{ $trash->notification }}%</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif (Auth::user()->role == 1)
                                <div class="dropdown">
                                    <a style="border-radius: 4px" class="btn btn-warning dropdown-toggle nav-link"
                                        id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"
                                        type="button">
                                        <span class="text-success">{{ Auth::user()->point }}</span> coin
                                    </a>
                                    <ul style="border-radius: 0px; padding: 10px 0px;"
                                        class="dropdown-menu dropdown-menu-warning"
                                        aria-labelledby="dropdownMenuButton2">
                                        <!-- Nút "Đổi điểm" ẩn -->
                                        <li>
                                            <a class="dropdown-item" href="#">Đổi điểm</a>

                                        </li>
                                    </ul>
                                </div>
                            @endif
                            <li class="nav-item ms-2 mt-2 mt-lg-0">
                                <a style="background: #ffffff; border:none"
                                    class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100"
                                    aria-current="page" href="{{ route('logout') }}">Log Out</a>
                            </li>
                        @else
                            <li class="nav-item ms-2 mt-2 mt-lg-0">
                                <a style="background: #ffffff; border:none"
                                    class="nav-link btn btn-light text-black w-md-25 w-50 w-lg-100"
                                    aria-current="page" href="/login">Log In</a>
                            </li>
                            <li class="nav-item ms-2 mt-2 mt-lg-0">
                                <a style="background: #65e4a3; border:none"
                                    class="nav-link btn text-white w-md-25 w-50 w-lg-100" aria-current="page"
                                    href="signup">Sign Up</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
        <div class="bg-dark"><img class="img-fluid position-absolute end-0" src="assets/img/hero/hero-bg.png"
                alt="" />
