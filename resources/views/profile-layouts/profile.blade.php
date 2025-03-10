<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mangal Mall</title>
        @routes 
        @viteReactRefresh
        @vite(['resources/js/mount-venuecalendar.jsx'])
        
       <style type="text/css">
           .container
           {
            max-width:100%;
           }
       </style>
        <!-- Fonts -->
     <link rel="stylesheet" href="{{ asset('frontassets/css/main.css'); }}">
    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset('frontassets/css/custom.css'); }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
         @include('profile-layouts.menubar')
         <div class="main">
         <!--breadcrumb bar start-->
        <div class="breadcrumb-bar py-3 gray-light-bg border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="custom-breadcrumb">
                            <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0 pl-0">
                                <li class="list-inline-item breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="list-inline-item breadcrumb-item active"><a href="#">Dashboard</a></li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb bar end-->

        <section class="page-header-section pt-4">
              <div class="container">
                  <div class="row"> 
                   
                         @yield('content')
                                 
                    
                  </div>
				</div>
        </section>
        <hr>
        <section class = "page-header-section pt-4 shadow-sm">
        @include('layouts.trustedvendor')

        </section>
         </div>
          @include('profile-layouts.footer')
     </div>
     <!--bottom to top button start-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="ti-rocket"></span>
    </button>
    <!--bottom to top button end-->


    </body>

    <!--build:js-->
    <script src="{{ asset('frontassets/js/vendors/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/validator.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/jquery.rcounterup.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontassets/js/vendors/hs.megamenu.js') }}"></script>
    <script src="{{ asset('frontassets/js/app.js') }}"></script>

@stack('scripts') 


</html>
