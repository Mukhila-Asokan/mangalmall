<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>Mangal Mall</title>

        <!-- Fonts -->
     <link rel="stylesheet" href="<?php echo e(asset('frontassets/css/main.css')); ?>">
    <!-- endbuild -->
    <link rel="stylesheet" href="<?php echo e(asset('frontassets/css/custom.css')); ?>">

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
         <?php echo $__env->make('layouts.menubar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <div class="main">
             <?php echo $__env->yieldContent('content'); ?>
         </div>
          <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     </div>
     <!--bottom to top button start-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="ti-rocket"></span>
    </button>
    <!--bottom to top button end-->
    </body>

    <!--build:js-->
    <script src="<?php echo e(asset('frontassets/js/vendors/jquery-3.5.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/bootstrap-slider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/jquery.countdown.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/validator.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/jquery.rcounterup.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/vendors/hs.megamenu.js')); ?>"></script>
    <script src="<?php echo e(asset('frontassets/js/app.js')); ?>"></script>

<?php echo $__env->yieldPushContent('scripts'); ?> 


</html>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/layouts/guest.blade.php ENDPATH**/ ?>