
<style>
  .card {
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .image-container {
        position: relative!important;
        overflow: hidden;
        border-radius: 8px;
        z-index: 5!important;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
    }

    /* Make sure the overlay doesn't block clicks */
    .image-overlay {
        pointer-events: none;
    }

    /* But make the buttons inside clickable */
    .image-overlay a {
        pointer-events: auto;
    }

    .edit-btn, .delete-btn {
        color: white;
        background: rgba(255, 255, 255, 0.2);
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        text-decoration: none;
        margin: 0 5px;
        font-size: 1.1rem;
        border: 2px solid rgba(191, 200, 69, 0.3);
        z-index: 10!important;
    }

    .edit-btn:hover, .delete-btn:hover {
        background: rgba(255, 255, 255, 0.4);
        transform: scale(1.1);
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }

    .card-header {      
        border-radius: 8px 8px 0 0 !important;
        font-weight: bold;
    }
</style>
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
                <div class="d-flex justify-content-end mt-3">
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvitationModal">Create Invitation</a>

                 
                </div>
                <div class="clearfix m-5"></div>
                <div class="row">
					<?php $__currentLoopData = $usertemplate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <div class="col-md-4 mb-3">
					<div class="card shadow-lg border-0 rounded-3">
						<div class="card-header text-center bg-primary text-white">
							<h5 class="m-3 text-white"><?php echo e($template->template_name); ?></h5>
						</div>
						<div class="card-body position-relative">
							<div class="image-container position-relative">
								<img src="<?php echo e(asset('storage/'.$template->thumb)); ?>" class="img-fluid rounded" alt="invitation card">
								<div class="image-overlay d-flex justify-content-center align-items-center">
									<a href="<?php echo e(route('invitationcard.edit', $template->id)); ?>" class="me-2 edit-btn"><i class="fas fa-pencil"></i></a>
									<a href="javascript:void(0);" class="me-2 delete-btn" onclick="confirmDelete(<?php echo e($template->id); ?>)"><i class="fas fa-trash"></i></a>
								</div>
							</div>
							<div class="clearfix my-2"></div>
							<p class="text-muted small">Size: <?php echo e($template->template_size); ?></p>
							<p class="text-muted small">Event: <?php echo e($template->occasion->eventtypename); ?></p>
						</div>
					</div>
				</div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->startPush('scripts'); ?>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this template?")) {
            // Example delete logic; modify according to your app's flow
            window.location.href = '/invitationcard/delete/' + id;
        }
    }
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/invitation/card/index.blade.php ENDPATH**/ ?>