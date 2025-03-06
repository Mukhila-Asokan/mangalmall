<?php echo $__env->make('venueadmin::layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
      <?php echo $__env->make('venueadmin::layouts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
   </div>
     <div class="leftside-menu" style="background: #40161C;color:#ffffff!important">
         <?php echo $__env->make('venueadmin::layouts.left-sidemenubar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
     </div>


  <div class="content-page">
      <div class="content">

          <!-- Start Content-->
          <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="bg-flower">
                      <img src="<?php echo e(asset('venueasset/images/girl.png')); ?>">
                  </div>

                  <div class="bg-flower-2">
                      <img src="<?php echo e(asset('venueasset/images/flowers/img-1.png')); ?>">
                  </div>
                
              </div>

        </div>

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                      <ol class="breadcrumb mb-0 p-2">
                          <li class="breadcrumb-item"><a href="#"><i class="ri-home-4-line"></i> Home</a></li>
                          <li class="breadcrumb-item" active><a href="#"><?php echo e($pagetitle); ?></a></li>
                         
                      </ol>
                  </nav>
            </div>
        </div>
               <?php echo $__env->yieldContent('content'); ?>

          </div>
      </div>
  </div>



</div>
<?php echo $__env->make('venueadmin::layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php echo $__env->make('admin.layouts.popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->make('admin.layouts.popupscripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>





<?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/admin-layout.blade.php ENDPATH**/ ?>