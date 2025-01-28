<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mangal Mall</title>

        <!-- Fonts -->
     <link rel="stylesheet" href="{{ asset('frontassets/css/main.css'); }}">
    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset('frontassets/css/custom.css'); }}">

    </head>
    <body>
          <!--loader start-->
    <div id="preloader">
        <div class="loader1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
         @include('layouts.menubar')
         <div class="main">
             @yield('content')
         </div>
          @include('layouts.footer')
     </div>
     <!--bottom to top button start-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="ti-rocket"></span>
    </button>
    <!--bottom to top button end-->
    </body>

    <!--build:js-->
    <script src="{{ asset('frontassets/js/vendors/jquery-3.5.1.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/bootstrap.bundle.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/bootstrap-slider.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.countdown.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.easing.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/owl.carousel.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/validator.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.waypoints.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.rcounterup.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/magnific-popup.min.js'); }}"></script>
    <script src="{{ asset('frontassets/js/vendors/hs.megamenu.js'); }}"></script>
    <script src="{{ asset('frontassets/js/app.js'); }}"></script>

@stack('scripts') 


</html>
