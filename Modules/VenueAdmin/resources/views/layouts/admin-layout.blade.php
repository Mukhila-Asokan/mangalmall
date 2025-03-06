@include('venueadmin::layouts.header')
<style>
  .side-nav-item
  {
    color:#ffffff!important;
  }
  .side-nav .side-nav-link
  {
    color:#ffffff!important;
  }
  .side-nav-second-level li a{
    color:#ffffff!important;
  }
  .side-nav
  {
    color:#ffffff!important;
  }
</style>
<body>
<div class="wrapper">
   <div class="navbar-custom">
      @include('venueadmin::layouts.topbar')
   </div>
     <div class="leftside-menu" style="background: #40161C;color:#ffffff!important">
         @include('venueadmin::layouts.left-sidemenubar')
     </div>


  <div class="content-page">
      <div class="content">

          <!-- Start Content-->
          <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="bg-flower">
                      <img src="{{ asset('venueasset/images/girl.png') }}">
                  </div>

                  <div class="bg-flower-2">
                      <img src="{{ asset('venueasset/images/flowers/img-1.png') }}">
                  </div>
                
              </div>

        </div>

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                      <ol class="breadcrumb mb-0 p-2">
                          <li class="breadcrumb-item"><a href="#"><i class="ri-home-4-line"></i> Home</a></li>
                          <li class="breadcrumb-item" active><a href="#">{{ $pagetitle }}</a></li>
                         
                      </ol>
                  </nav>
            </div>
        </div>
               @yield('content')

          </div>
      </div>
  </div>



</div>
@include('venueadmin::layouts.footer')
</div>
@include('admin.layouts.popup')
@stack('scripts')
@include('admin.layouts.popupscripts')
</body>

</html>





