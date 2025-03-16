@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        @include('components.header-menu')
    </div>

    <!-- # Sidenav Left -->
    @auth
        <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
            aria-labelledby="affanOffcanvsLabel">
            @include('components.sidenav-leaft')
        </div>
    @else
        <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
            aria-labelledby="affanOffcanvsLabel">
            <div class="offcanvas-body p-4">
                <div class="d-flex justify-content-center">
                    <p class="text-center mb-3">Anda harus login terlebih dahulu</p>
                    <br>
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
            </div>
        </div>
    @endauth
    <div class="page-content-wrapper">

        <!-- Welcome Toast -->
        @include('components.welcome-toast')

        <!-- Tiny Slider One Wrapper -->
        <div class="tiny-slider-one-wrapper">
            <div class="tiny-slider-one">
                <!-- Single Hero Slide -->
                <div>
                    <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/31.jpg')">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h3 class="text-white mb-1">Build with Bootstrap 5</h3>
                                <p class="text-white mb-4">Build fast, responsive sites with Bootstrap.</p>
                                <a class="btn btn-creative btn-warning" href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Hero Slide -->
                <div>
                    <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/33.jpg')">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h3 class="text-white mb-1">Vanilla JavaScript</h3>
                                <p class="text-white mb-4">The whole code is written with vanilla JS.</p>
                                <a class="btn btn-creative btn-warning" href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Hero Slide -->
                <div>
                    <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/32.jpg')">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h3 class="text-white mb-1">PWA Ready</h3>
                                <p class="text-white mb-4">Click the "Install Now" button &amp; <br> enjoy it like an app.
                                </p>
                                <a class="btn btn-creative btn-warning" href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Hero Slide -->
                <div>
                    <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/33.jpg')">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h3 class="text-white mb-1">Lots of Elements &amp; Pages</h3>
                                <p class="text-white mb-4">Create your website in days, not months.</p>
                                <a class="btn btn-creative btn-warning" href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Hero Slide -->
                <div>
                    <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/1.jpg')">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h3 class="text-white mb-1">Dark &amp; RTL Ready</h3>
                                <p class="text-white mb-4">You can use the Dark or <br> RTL mode of your choice.</p>
                                <a class="btn btn-creative btn-warning" href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-3"></div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/bag.png" alt="">
                                </div>
                                <p class="mb-0">PWA Ready</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/garbage-truck.png" alt="">
                                </div>
                                <p class="mb-0">Garbage Truck</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/recycle.png" alt="">
                                </div>
                                <p class="mb-0">Recycle</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card card-bg-img bg-img bg-overlay mb-3" style="background-image: url('img/bg-img/3.jpg')">
                <div class="card-body direction-rtl p-4">
                    <h2 class="text-white">220+ Reusable Elements</h2>
                    <p class="mb-3 text-white">More than 220+ reusable modern design elements. Just copy the code and paste
                        it on
                        your desired page.</p>
                    <a class="btn btn-warning" href="elements.html">All elements <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/sass.png" alt="">
                                </div>
                                <p class="mb-0">SCSS</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/npm.png" alt="">
                                </div>
                                <p class="mb-0">npm</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/gulp.png" alt="">
                                </div>
                                <p class="mb-0">Gulp 4</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card bg-primary mb-3 bg-img" style="background-image: url('img/core-img/1.png')">
                <div class="card-body direction-rtl p-4">
                    <h2 class="text-white">35+ Ready Pages</h2>
                    <p class="mb-3 text-white">Already designed more than 35+ pages for your needs. Such as -
                        Authentication,
                        Chats, eCommerce, Blog &amp; Miscellaneous pages.</p>
                    <a class="btn btn-warning" href="pages.html">All Pages <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/dark.png" alt="">
                                </div>
                                <p class="mb-0">Dark Mode</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/rtl.png" alt="">
                                </div>
                                <p class="mb-0">RTL Ready</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/code.png" alt="">
                                </div>
                                <p class="mb-0">Easy Code</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>Customer Review</h3>

                    <div class="testimonial-slide-three-wrapper">
                        <div class="testimonial-slide3 testimonial-style3">

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide">
                                <div class="text-content">
                                    <span class="d-inline-block badge bg-warning mb-2">
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.
                                    </h6>
                                    <span class="d-block">Mrrickez, Themeforest</span>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide">
                                <div class="text-content">
                                    <span class="d-inline-block badge bg-warning mb-2">
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <h6 class="mb-2">All complete, <br> great craft.</h6>
                                    <span class="d-block">Mazatlumm, Themeforest</span>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide">
                                <div class="text-content">
                                    <span class="d-inline-block badge bg-warning mb-2">
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <h6 class="mb-2">Awesome template! <br> Excellent support!</h6>
                                    <span class="d-block">Vguntars, Themeforest</span>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide">
                                <div class="text-content">
                                    <span class="d-inline-block badge bg-warning mb-2">
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill me-1"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <h6 class="mb-2">Nice modern design, <br> I love the product.</h6>
                                    <span class="d-block">electroMEZ, Themeforest</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/star.png" alt="">
                                </div>
                                <p class="mb-0">Best Rated</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/elegant.png" alt="">
                                </div>
                                <p class="mb-0">Elegant</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/lightning.png" alt="">
                                </div>
                                <p class="mb-0">Trendsetter</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Google Maps -->
            <div class="card">
                <div class="card-body">
                    <div class="google-maps">
                        <h5 class="mb-3 text-center">Wilayah Layanan</h5>
                        <iframe class="w-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.9019689861403!2d107.6106274!3d-6.3762693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e696bceb80de31b%3A0x77fc53a83fede33e!2sGempolsari%2C%20Kec.%20Patokbeusi%2C%20Kabupaten%20Subang%2C%20Jawa%20Barat!5e0!3m2!1sen!2sid!4v1697021234567!5m2!1sen!2sid"
                            allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-3"></div>
    </div>

    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            @include('components.footer')
        </div>
    </div>

@endsection
