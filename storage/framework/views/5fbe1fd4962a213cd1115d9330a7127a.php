   <?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?> 
    <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.jsx'); ?>
    <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->head; } ?>
<?php $__env->startSection('content'); ?>
<div class="col-lg-10 col-md-10">
                        <!-- Search widget-->
     <!-- <aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
    </aside> -->

    <!-- <hr>   -->
   
    <!-- <div class="row white-bg shadow-sm p-2 mt-md-4 mt-lg-4">   -->
        

        <!-- <div class = "row pt-2 col-12">
            <div class="col-md-12 col-12"> -->


             <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
    <!-- </div>
        </div> -->
    <!-- </div> -->
</div>
<div class="col-lg-2 col-md-2">
<div id="adsslider-component"></div>
   <!-- Subscribe widget-->
   <aside class="widget widget-categories">
        <div class="widget-title">
            <h6>Newsletter</h6>
        </div>
        <p>Enter your email address below to subscribe to my newsletter</p>
        <form action="#" method="post" class="d-none d-md-block d-lg-block">
            <input type="text" class="form-control input" id="email-footer" name="email" placeholder="info@yourdomain.com">
            <button type="submit" class="btn primary-solid-btn btn-block btn-not-rounded mt-3">Subscribe</button>
        </form>
    </aside>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/app.blade.php ENDPATH**/ ?>