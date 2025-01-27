@include('venueadmin::layouts.header')
<div id="main-wrapper" class="auth-customizer-none">
	<div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
        	@php

        	$bgurl = asset('public/venueassets/images/authbg.jpg');
        	@endphp
        	<div class="col-xl-7 col-xxl-8" style = "background: url('{{ $bgurl }}'); no-repeat center center / cover">
            <a href="#" class="text-nowrap logo-img d-block px-4 py-9 w-100">
              <img src="{{ asset('public/venueassets/images/logo-light.png') }}" class="dark-logo" alt="Logo-Dark" />
              <img src="{{ asset('public/venueassets/images/logo-light.png') }}" class="light-logo" alt="Logo-light" />
            </a>
           
          </div>
           <div class="col-xl-5 col-xxl-4">

            @include('venueadmin::layouts.flash-messages')
           	 @yield('content')
           </div>
        </div>
       </div>
      </div>
</div>	
@include('venueadmin::layouts.footer')
@stack('scripts')

</body>

</html>