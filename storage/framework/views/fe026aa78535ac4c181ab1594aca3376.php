<?php echo $__env->make('venueadmin::layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="main-wrapper" class="auth-customizer-none">
	<div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
        	<?php

        	$bgurl = asset('public/venueassets/images/authbg.jpg');
        	?>
        	<div class="col-xl-7 col-xxl-8" style = "background: url('<?php echo e($bgurl); ?>'); no-repeat center center / cover">
            <a href="#" class="text-nowrap logo-img d-block px-4 py-9 w-100">
              <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="dark-logo" alt="Logo-Dark" />
              <img src="<?php echo e(asset('public/venueassets/images/logo-light.png')); ?>" class="light-logo" alt="Logo-light" />
            </a>
           
          </div>
           <div class="col-xl-5 col-xxl-4">

            <?php echo $__env->make('venueadmin::layouts.flash-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           	 <?php echo $__env->yieldContent('content'); ?>
           </div>
        </div>
       </div>
      </div>
</div>	
<?php echo $__env->make('venueadmin::layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/auth-layout.blade.php ENDPATH**/ ?>