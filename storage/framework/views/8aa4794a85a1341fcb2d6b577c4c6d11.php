<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>" />

        <title>Mangal Mall</title>
        <?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?> 
        <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/mount-venuecalendar.jsx']); ?>
        
       <style type="text/css">
           .container
           {
            max-width:100%;
           }
       </style>
        <!-- Fonts -->
     <link rel="stylesheet" href="<?php echo e(asset('frontassets/css/main.css')); ?>">
    <!-- endbuild -->
    <link rel="stylesheet" href="<?php echo e(asset('frontassets/css/custom.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="bg-light profilebackground">
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
         <?php echo $__env->make('profile-layouts.menubar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         <div class="main">
         <!--breadcrumb bar start-->
        <div class="breadcrumb-bar py-3 gray-light-bg border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="custom-breadcrumb">
                            <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0 pl-0">
                                <li class="list-inline-item breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                                <li class="list-inline-item breadcrumb-item active"><a href="#">Dashboard</a></li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb bar end-->

        <section class="page-header-section">
              <div class="container">
                  <div class="row"> 
                   
                         <?php echo $__env->yieldContent('content'); ?>
                                 
                    
                  </div>
				</div>
        </section>
        <hr>
        <section class = "page-header-section pt-4 shadow-sm">
        <?php echo $__env->make('layouts.trustedvendor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </section>
         </div>
          <?php echo $__env->make('profile-layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?> 


</html>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/profile-layouts/profile.blade.php ENDPATH**/ ?>