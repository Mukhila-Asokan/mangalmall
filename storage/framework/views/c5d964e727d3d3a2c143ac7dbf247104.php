<style>
    .image-container {
        position: relative;
        display: inline-block;
    }
    
    .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        display: none;
        background:rgb(115, 17, 0);
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 50%;
    }
    .delete-btn::after{
        opacity: 0.5;
    }
    
    .image-container:hover .delete-btn {
        display: block;
    }
</style>

<?php $__env->startSection('content'); ?>
<style type="text/css"></style>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-start">
                                <a href ="<?php echo e(route('venue/detailview', ['id' => $venue->id])); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <a href = "<?php echo e(route('venue/index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                                </a>
                            </div>
                        </div>
                        <div class="row">
                      
                        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('venue.venueimage_add')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="venue_id" value="<?php echo e($venue->id); ?>">
                        <div class="col-8">
                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="sliderimage">Slider</label>
                            <div class="col-md-10">
                            <input id="images" type="file" class="form-control" name="sliderimage[]" multiple>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="sliderimage">Gallery</label>
                            <div class="col-md-10">
                            <input id="images" type="file" class="form-control" name="galleryimage[]" multiple>
                            </div>
                        </div>
                        <?php if($errors->has('sliderimage')): ?>
                            <div class="text-danger"><?php echo e($errors->first('sliderimage')); ?></div>
                        <?php elseif($errors->has('galleryimage')): ?>
                            <div class="text-danger"><?php echo e($errors->first('galleryimage')); ?></div>
                        <?php endif; ?>

                        <br><br>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Gallery</button>
                            </div>
                        </div>



      
                        </form>

                    <br><br><br>

                    <?php if($venueimage->count() > 0): ?>    
                        <h3>Uploaded Images</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Slider Images</h5>
                                <div class="row">
                                    <?php $__currentLoopData = $venueimage->where('image_type', 'slider'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <div class="col-md-4">
                                        <div class="image-container">
                                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" class="img-thumbnail" width="350">
                                            <button class="delete-btn" data-id="<?php echo e($image->id); ?>"><span class="tf-icon mdi mdi-delete me-1"></span></button>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                    <div class="clearfix" style="height:20px;width:100%;float:none;position:relative"></div>
                    <div class="col-md-12">
                        <h5>Gallery Images</h5>
                        <div class="row">
                            <?php $__currentLoopData = $venueimage->where('image_type', 'gallery'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div class="col-md-4">
                                        <div class="image-container">
                                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" class="img-thumbnail" width="350">
                                            <button class="delete-btn" data-id="<?php echo e($image->id); ?>"><span class="tf-icon mdi mdi-delete me-1"></span></button>
                                        </div>
                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <?php endif; ?>
                        
                            
                      </div>
                    </div>
              




                    </div>
                </div>
            </div>
       
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script>
    $(document).ready(function() {
        $(".delete-btn").click(function() {
            let imageId = $(this).data("id");
            let imageContainer = $(this).closest(".col-md-4");

            if (confirm("Are you sure you want to delete this image?")) {
                $.ajax({
                    url: "<?php echo e(route('venue.image_delete')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        id: imageId
                    },
                    success: function(response) {
                        if (response.success) {
                            imageContainer.fadeOut(500, function() {
                                $(this).remove();
                            });
                        } else {
                            alert("Error deleting image.");
                        }
                    },
                    error: function(response) {
                        alert("Something went wrong.");
                    }
                });
            }
        });
    });
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/venueimage.blade.php ENDPATH**/ ?>