<?php echo $__env->make('venueadmin::layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="main-wrapper">
<?php echo $__env->make('venueadmin::layouts.left-sidemenubar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-wrapper">
     
<?php echo $__env->make('venueadmin::layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('venueadmin::layouts.sidemenubar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4">
              <div class="row align-items-center">
                <div class="col-12">
                  <h4 class="fw-semibold mb-8"><?php echo e($pagetitle); ?></h4>
                  <nav aria-label="breadcrumb">
                    <!--ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="#"><?php echo e($pageroot); ?></a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page"><?php echo e($pagetitle); ?></li>
                    </ol-->
                  </nav>
                </div>
                
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-12">
            
            		 <?php echo $__env->yieldContent('content'); ?>
            </div>
          </div>






    </div>
 </div>






</div>

</div>

<?php echo $__env->make('venueadmin::layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/admin-layout.blade.php ENDPATH**/ ?>