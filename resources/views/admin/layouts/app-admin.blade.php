@include('admin.layouts.header')
<style>
    .navbar-custom
    {
        background:#752c37!important;
    }
    .navbar-custom .topbar .nav-link
    {
        color:white!important;
    }
</style>
   <!-- Begin page -->
    <div class="layout-wrapper">
    	
    	@include('admin.layouts.sidemenu')	
    	   
    	   <div class="page-content">
    	   		
    	   		@include('admin.layouts.topbar')


                <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                 
                  @yield('content')
               </div>

            </div>



    	@include('admin.layouts.footer')
    	</div>	
    </div>

@include('admin.layouts.scripts')

@yield('scripts') 
</body>

</html>