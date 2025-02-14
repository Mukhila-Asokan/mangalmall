
<?php $__env->startSection('content'); ?>


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Venue Settings</h4>
                         <div class="row">
                            <div class="col-md-4">
                                <div class="card border border-primary">
                                    <h5 class="card-header border-bottom">Add State</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new state for Venue Location</h5><br>
                                        <a href="<?php echo e(route('venue.state/create')); ?>" class="btn btn-primary waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venue.state')); ?>" class="btn btn-primary waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                            <div class="col-md-4">
                                <div class="card border border-danger">
                                    <h5 class="card-header border-bottom">Add District</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new District for Venue Loction</h5><br>
                                        <a href="<?php echo e(route('venue.district/create')); ?>" class="btn btn-danger waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venue.district')); ?>" class="btn btn-danger waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                             <div class="col-md-4">
                                <div class="card border border-warning">
                                    <h5 class="card-header border-bottom">Add City</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new city for Venue Loction</h5><br>
                                        <a href="<?php echo e(route('venue.city/create')); ?>" class="btn btn-warning waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venue.city')); ?>" class="btn btn-warning waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                            
                              <div class="col-md-4">
                                <div class="card border border-info">
                                    <h5 class="card-header border-bottom">Add Area</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new area for city in Venue Loction</h5><br>
                                        <a href="<?php echo e(route('venue.area/create')); ?>" class="btn btn-info waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venue.area')); ?>" class="btn btn-info waves-effect waves-light">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border border-success">
                                    <h5 class="card-header border-bottom">Add Data Fields</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new fields to Venue Details</h5><br>
                                        <a href="<?php echo e(route('venuesettings/datafield/create')); ?>" class="btn btn-success waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venuesettings/datafield')); ?>" class="btn btn-success waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>

                            <div class="col-md-4">
                                <div class="card border border-dark">
                                    <h5 class="card-header border-bottom">Venue Type</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new Venue type</h5><br>
                                        <a href="<?php echo e(route('venuetype/show')); ?>" class="btn btn-dark waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venuetype/create')); ?>" class="btn btn-dark waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>

                            
                            <div class="col-md-4">
                                <div class="card border border-secondary">
                                    <h5 class="card-header border-bottom">Venue Amenities</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new Venue Amenities</h5><br>
                                        <a href="<?php echo e(route('venue/venueamenities')); ?>" class="btn btn-secondary waves-effect waves-light">Add</a>
                                        <a href="<?php echo e(route('venueamenities/create')); ?>" class="btn btn-secondary waves-effect waves-light">View</a>
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

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venuesettings.blade.php ENDPATH**/ ?>