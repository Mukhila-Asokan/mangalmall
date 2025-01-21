@include('venueadmin::layouts.header')
<div id="main-wrapper">
@include('venueadmin::layouts.left-sidemenubar')

<div class="page-wrapper">
     
@include('venueadmin::layouts.topbar')
@include('venueadmin::layouts.sidemenubar')

 <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4">
              <div class="row align-items-center">
                <div class="col-12">
                  <h4 class="fw-semibold mb-8">Dashboard</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="#">Home</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                    </ol>
                  </nav>
                </div>
                
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-12">
            
            		 @yield('content')
            </div>
          </div>






    </div>
 </div>






</div>

</div>

@include('venueadmin::layouts.footer')
@stack('scripts')
</body>

</html>