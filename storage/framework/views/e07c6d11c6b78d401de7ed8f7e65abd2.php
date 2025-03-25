
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        <?php echo $__env->make('profile-layouts.invitationmenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-lg-11 col-md-11 stickymenucontent"> 

            <!--blog section start-->
    
        <div class="container">
    <div class="row justify-content-center">
    <center><h2 class="text-center"><?php echo e(__('Invitation')); ?></h2></center>
    <div class="col-md-12 mb-12">
    <div class="col-md-12 mb-12">
            <div class="card shadow-lg border-0 rounded-3">
           

                <div class="card-body">
                <div class="d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvitationModal">Create Invitation</a>

                 
                </div>
				<div>
					
				</div>

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
   <!-- Modal -->
   <div class="modal fade" id="createInvitationModal" tabindex="-1" aria-labelledby="createInvitationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="homemodal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInvitationModalLabel">Create Invitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('invitationcard.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="template_name" name="template_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <select class="form-control" id="template_size" name="template_size" required>
                                <option value="">Select Size</option>
                                <?php $__currentLoopData = $invitationCardSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($size->size_name); ?>"><?php echo e($size->size_width); ?> -  <?php echo e($size->size_height); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                     
                        <div class="mb-3">
                            <label for="cat_id" class="form-label">Occasion Type</label>
                            <select class="form-control" id="cat_id" name="cat_id" required>
                                <option value="">Select Event</option>
                                <?php $__currentLoopData = $occasionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($occasionType->id); ?>"><?php echo e($occasionType->eventtypename); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/invitation/card/index.blade.php ENDPATH**/ ?>