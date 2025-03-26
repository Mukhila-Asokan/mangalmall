
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        <?php echo $__env->make('profile-layouts.invitationmenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-lg-11 col-md-11 stickymenucontent"> 

            <!--blog section start-->
    
        <div class="container">
    <div class="row justify-content-center">
    <center><h2 class="text-center"><?php echo e(__('Create Slideshow Video')); ?></h2></center>
    <div class="col-md-12 mb-12">
    <div class="col-md-12 mb-12">
            <div class="card shadow-lg border-0 rounded-3">
           

                <div class="card-body">
                <div id="video-creator"></div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/videos/create.blade.php ENDPATH**/ ?>