

<?php $__env->startSection('content'); ?>


<div class="col-lg-8 col-md-8">
<aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
</aside>

<div class="container py-5">
        <h5 class="mb-4 text-center text-primary">Make a Website for Your Event</h5>

        <div class="row">

                     
        <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webpage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title
                ">Choose a Template</h5>
                <?php
                $userid = Auth::user()->id;
                $preview_imageurl = url("home/webpage/".$webpage->id."/preview");
                $editorurl = url("home/webpage/".$userid."/".$webpage->id."/editor");
                ?>

                <a href ="<?php echo e($preview_imageurl); ?>" target="_new"><img src="<?php echo e(asset('storage/' . $webpage->preview_image)); ?>" style = "width:100%"/></a>
                </div> 
                <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                                <h6 class="card-title text-center"><?php echo e($webpage->webpagename); ?></h6>
                        </div>
                        <div>
                                <a href="<?php echo e($editorurl); ?>" target="_new" class="btn btn-danger">Use</a>
                        </div>
                        </div>
                 </div>
               
                </div>
        </div>
                
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
    
        
</div>


</div>
<div class="col-lg-2 col-md-2"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/home/userwebpage_template.blade.php ENDPATH**/ ?>