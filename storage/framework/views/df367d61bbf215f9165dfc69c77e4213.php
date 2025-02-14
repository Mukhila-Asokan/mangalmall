<?php $__env->startSection('content'); ?>



         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Venue Category List</h4>
                         <div class="row">
                            <div class="col-md-4">
                                <div class="card border border-primary">
                                    <h5 class="card-header border-bottom">Venue Type</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new Venue type</h5><br>
                                        <a href="<?php echo e(route('venuetype/create')); ?>" class="btn btn-primary waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venuetype/show')); ?>" class="btn btn-primary waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                             <div class="col-md-4">
                                <div class="card border border-primary">
                                    <h5 class="card-header border-bottom">Venue Sub Type</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new Venue subtype</h5><br>
                                        <a href="<?php echo e(route('venuesubtype/create')); ?>" class="btn btn-primary waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venuesubtype/show')); ?>" class="btn btn-primary waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venuetype/index.blade.php ENDPATH**/ ?>