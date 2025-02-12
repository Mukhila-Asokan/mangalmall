@include('venueadmin::layouts.header')
    @php 

$url1 = asset("venueasset/images/bg-auth.jpg");

@endphp
<body style="background-image: url('{{ $url1 }}'); background-repeat: no-repeat;background-size: cover;">

 <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
      <div class="container">
          <div class="row justify-content-center">

              @include('venueadmin::layouts.flash-messages')
              @yield('content')
            </div>
              <!-- end row -->
        </div>
          <!-- end container -->
 </div>
      <!-- end page -->

@include('venueadmin::layouts.footer')


@stack('scripts')

</body>

</html>