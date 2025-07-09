<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Avflowril')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="@yield('description', 'Avflowril - Spesialis bucket bunga terbaik untuk hadiah istimewa. Koleksi lengkap bucket bunga berkualitas tinggi.')">
    <meta name="author" content="Avflowril">
    <meta name="generator" content="Avflowril">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font.awesome.min.css') }}">
    <!-- Font Awesome CDN Backup -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <!-- Linear Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/linearicons.min.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">
    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">

    <!-- Main Style CSS (Deactivated) -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> -->

    <!-- Flora Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/flora-theme.css') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Authentication Styles -->
    <style>
        .header-icon {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            margin-left: 10px;
            color: #2c3e50;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .header-icon:hover {
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
        }

        .header-icon i {
            margin-right: 5px;
        }

        .register-link {
            background-color: #27ae60;
            color: white !important;
        }

        .register-link:hover {
            background-color: #229954;
            color: white !important;
        }

        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 180px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 10px 0;
            z-index: 1000;
            margin-top: 5px;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 8px 20px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #e74c3c;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 8px 0;
        }

        .logout-btn {
            cursor: pointer;
        }

        .cart-count {
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 18px;
            text-align: center;
        }

        .user-name {
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Cart Count Styling */
        .cart-count {
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 18px;
            text-align: center;
            font-weight: bold;
            line-height: 1.2;
            display: inline-block;
        }

        /* FontAwesome Icon Fallback */
        .fa:before {
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", "FontAwesome";
            font-weight: 900;
        }

        /* Loading state for icons */
        .fa-shopping-cart:before {
            content: "\f07a";
        }

        .fa-user:before {
            content: "\f007";
        }

        .fa-sign-in-alt:before {
            content: "\f2f6";
        }

        .fa-user-plus:before {
            content: "\f234";
        }

        .fa-bars:before {
            content: "\f0c9";
        }

        @media (max-width: 768px) {
            .header-icon span {
                display: none !important;
            }
            
            .header-icon {
                padding: 8px;
                margin-left: 5px;
            }
            
            .cart-count {
                font-size: 10px;
                min-width: 16px;
                padding: 1px 4px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Include Header Partial -->
    @include('partials.header')

    <!-- Main Content -->
    @yield('content')

    <!-- Include Footer Partial -->
    @include('partials.footer')

    <!-- Scroll to Top Start -->
    <a class="scroll-to-top" href="#">
        <i class="lnr lnr-arrow-up"></i>
    </a>
    <!-- Scroll to Top End -->

    <!-- JS -->
    <!-- jQuery JS -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- jQuery Migrate JS -->
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
    <!-- Modernizer JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

    <!-- Swiper Slider JS -->
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <!-- nice select JS -->
    <script src="{{ asset('assets/js/plugins/nice-select.min.js') }}"></script>
    <!-- Ajaxchimpt js -->
    <script src="{{ asset('assets/js/plugins/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Jquery Ui js -->
    <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
    <!-- Jquery Countdown js -->
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <!-- jquery magnific popup js -->
    <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Cart JS -->
    <script src="{{ asset('assets/js/cart.js') }}"></script>

    @stack('scripts')
</body>

</html>