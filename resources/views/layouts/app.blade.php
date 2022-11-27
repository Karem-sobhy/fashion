@php
    $loader = asset('assets/img/loader/Preloader_3.gif');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fashion</title>
    <!-- Start Loader -->
    <style type="text/css">
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
      if it's not present, don't show loader */
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url({{ $loader }}) center no-repeat #fff;
        }
    </style>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).on("load", function() {
            // Animate loader off screen
            $(".se-pre-con").delay(0).fadeOut("slow");
        });
    </script>
    <!-- End Loader -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/fashion.css') }}" rel="stylesheet" />
    @livewireStyles()
</head>

<body>
    <!-- Loader Div -->
    <div class="se-pre-con"></div>
    <!-- Loader Div -->

    <!-- Header -->
    <!-- Start TopNav -->
    <nav class="navbar navbar-expand-lg bg-light navbar-top">
        <div class="container">
            <a class="navbar-brand text-black-50 text-wrap w-50" href="{{ route('home.shop') }}">Free Shipping on All
                orders Over $75</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavTop"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavTop">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="fa fa-user"></i> {{ Auth::user()->name }} <i class="fa-solid fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.wish') }}">Wishlist</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.orders') }}">My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.changePassword') }}">Change Password</a>
                                </li>
                            </ul>
                        </li>

                        @if (Auth::user()->utype != 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                                        class="fa-solid fa-gauge-high"></i>
                                    Admin Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link cart" href="{{ route('user.cart') }}"><i
                                    class="fa-solid fa-cart-shopping"></i> My Cart</a>
                        </li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                            </li>
                        </form>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- End TopNav -->
    <!-- Start SearchBar -->
    @livewire('header-search-component')
    <!-- End SearchBar -->
    @php

        $categories = App\Models\Category::take(5)->get();
    @endphp
    <!-- Start Nav -->
    <nav class="navbar sticky-top navbar-dark navbar-expand-lg bg-black main-navbar">
        <div class="container">
            <a class="navbar-brand text-white text-wrap w-50" href="{{ route('home.index') }}">Fashion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('home.index') }}">Home</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('product.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Nav -->
    <!-- Header End -->
    {{-- Start Content --}}
    {{ $slot }}
    <!-- End Content -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row my-5">
                    <div class="col-12 col-md-4">
                        <h3 class="footer-title mb-4">Categories</h3>
                        <ul class="list nav flex-column">

                            @foreach ($categories as $category)
                                <li class="list-item"><a class="item"
                                        href="{{ route('product.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3 class="footer-title mb-4">Customer Service</h3>
                        <ul class="list nav flex-column">

                            <li class="list-item">
                                <a href="{{ route('user.orders') }}" class="item">My Orders</a>
                            </li>
                            <li class="list-item"><a href="{{ route('user.cart') }}" class="item">Cart</a></li>
                            <li class="list-item"><a href="{{ route('user.wish') }}" class="item">Wishlist</a>
                            </li>
                            @auth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <li class="list-item"><a class="item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                    </li>
                                </form>
                            @else
                                <li class="list-item"><a href="{{ route('login') }}" class="item">Login</a></li>
                                <li class="list-item"><a href="{{ route('register') }}" class="item">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3 class="footer-title mb-4">Find Us !</h3>
                        <span class="d-block mb-2">Our Social Media Links</span>
                        <span class="icons">
                            <a href="#"> <i class="fa-brands fa-square-facebook"></i></a>
                            <a href="#"> <i class="fa-brands fa-square-twitter"></i></a>
                            <a href="#"> <i class="fa-brands fa-square-youtube"></i></a>
                            <a href="#"> <i class="fa-brands fa-vimeo"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="d-flex align-items-center">
                    <p class="m-0">
                        © 2022 Karem Sobhy. All Rights Reserved. Ecommerce
                    </p>
                    <div class="money ms-auto">
                        <img src="{{ asset('assets/img/money/visa.svg') }}" alt="Visa" />
                        <img src="{{ asset('assets/img/money/mastercard.svg') }}" alt="Master Card" />
                        <img src="{{ asset('assets/img/money/paypal.svg') }}" alt="PayPal" />
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- JS Libs -->
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/fashion.js') }}"></script>
    @livewireScripts()
</body>

</html>
