<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MangalMall') }}</title>

    <link rel="stylesheet" href="{{ asset('frontassets/css/main.css'); }}">
    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset('frontassets/css/custom.css'); }}">
       
    </head>

    <body>

       
    <div class="main">

        <section class="ptb-100 height-lg-100vh d-flex align-items-center" style="background: #752c37 !important;">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-9 col-lg-7">
                        <div class="error-content text-center text-white">
                            <div class="notfound-404">
                                <h1 class="text-white">404</h1>
                            </div>
                            <h3 class="text-white">Sorry, something went wrong</h3>
                            <p>The page you are looking for might have been removed had its name changed or is temporarily
                                unavailable.</p><a class="btn outline-white-btn" href="{{ route('home')}}">Go to Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!--footer section start-->
    <footer class="bg-transparent position-relative d-none d-md-block d-lg-block">
        <!--footer copyright start-->
        <div class="footer-bottom bottom-sticky-footer py-3">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-5 col-lg-5">
                        <p class="copyright-text pb-0 mb-0 text-white">Copyrights © 2024. All
                            rights reserved by MangalMall
                            
                        </p>
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="social-nav text-right">
                            <ul class="list-unstyled social-list mb-0">
                                <li class="list-inline-item tooltip-hover">
                                    <a href="#" class="rounded"><span
                                            class="ti-facebook"></span></a>
                                    <div class="tooltip-item">Facebook</div>
                                </li>
                                <li class="list-inline-item tooltip-hover"><a href="#" class="rounded"><span
                                        class="ti-twitter"></span></a>
                                    <div class="tooltip-item">Twitter</div>
                                </li>
                                <li class="list-inline-item tooltip-hover"><a href="#" class="rounded"><span
                                        class="ti-linkedin"></span></a>
                                    <div class="tooltip-item">Linkedin</div>
                                </li>
                                <li class="list-inline-item tooltip-hover"><a href="#" class="rounded"><span
                                        class="ti-dribbble"></span></a>
                                    <div class="tooltip-item">Dribbble</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer copyright end-->
    </footer>
    <!--footer section end-->
    <!--bottom to top button start-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="ti-rocket"></span>
    </button>
</body>
</html>