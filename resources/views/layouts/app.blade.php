<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body class="animsition">
    <header class="header-v4">
        <div class="container-menu-desktop">
            <div class="wrap-menu-desktop how-shadow1">
                <nav class="limiter-menu-desktop container">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO">
                    </a>

                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu"><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/product') }}">Shop</a></li>
                            <li><a href="{{ url('/features') }}">Features</a></li>
                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                        </ul>
                    </div>

                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <a href="{{ url('/cart') }}">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </a>

                        <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- resources/views/layouts/footer.blade.php -->
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">Categories</h4>
                    <ul>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Women</a></li>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Men</a></li>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Shoes</a></li>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Watches</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">Help</h4>
                    <ul>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Track Order</a></li>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Returns</a></li>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Shipping</a></li>
                        <li class="p-b-10"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">GET IN TOUCH</h4>
                    <p class="stext-107 cl7 size-201">
                        Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                    </p>
                    <div class="p-t-27">
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">Newsletter</h4>
                    <form>
                        <div class="wrap-input1 w-full p-b-4">
                            <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                            <div class="focus-input1 trans-04"></div>
                        </div>
                        <div class="p-t-18">
                            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="p-t-40">
                <div class="flex-c-m flex-w p-b-18">
                    <a href="#" class="m-all-1"><img src="{{ asset('images/icons/icon-pay-01.png') }}" alt="ICON-PAY"></a>
                    <a href="#" class="m-all-1"><img src="{{ asset('images/icons/icon-pay-02.png') }}" alt="ICON-PAY"></a>
                    <a href="#" class="m-all-1"><img src="{{ asset('images/icons/icon-pay-03.png') }}" alt="ICON-PAY"></a>
                    <a href="#" class="m-all-1"><img src="{{ asset('images/icons/icon-pay-04.png') }}" alt="ICON-PAY"></a>
                    <a href="#" class="m-all-1"><img src="{{ asset('images/icons/icon-pay-05.png') }}" alt="ICON-PAY"></a>
                </div>
                <p class="stext-107 cl6 txt-center">
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
    <script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>