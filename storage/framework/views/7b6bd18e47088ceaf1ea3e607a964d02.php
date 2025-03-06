

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
             
                <h4 class="header-title mb-4">Venue Hall - <?php echo e($venue->venuename); ?></h4>

                <div class="text-end">
                    <a href="<?php echo e(route('venue.hallcreate',$parentid)); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-plus me-1"></span> Add
                    </a>
                </div>

                <div class="table-responsive">
                    <?php $i=1; ?>
                    <?php if(count($venuehalls) > 0): ?>
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Hall Name</th>                              
                                <th>Contact Person</th>
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Budget</th>                       
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                            <?php $__currentLoopData = $venuehalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($i++); ?></th>
                                <td><?php echo e($hall->venuename); ?></td>                                
                                <td><?php echo e($hall->contactperson); ?></td>
                                <td><?php echo e($hall->area->areaname); ?>, <?php echo e($hall->area->city->cityname); ?></td>
                                <td><?php echo e($hall->capacity); ?></td>
                                <td><?php echo e($hall->bookingprice); ?></td>
                                
                                <td>                             

                                    <?php if($hall->status == 'Active'): ?>
                                    <button type="button" class="btn btn-primary waves-effect statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($hall->id); ?>" title="Active Status">
                                        <i class="fa fa-eye action_icon"></i>
                                    </button>
                                    <?php else: ?>
                                    <button type="button" class="btn-info btn waves-effect statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($hall->id); ?>" title="Inactive Status">
                                        <i class="fa fa-eye-slash action_icon"></i>
                                    </button>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url('/admin/venue/hall/'.$hall->id.'/edit')); ?>" class="btn-warning btn waves-effect" title="Edit">
                                        <i class="fa fa-pencil action_icon"></i>
                                    </a>
                                    <button type="button" class="btn-danger waves-effect btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($hall->id); ?>" title="Delete">
                                        <i class="fa fa-trash action_icon"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                        </tbody>
                    </table>
                    <?php echo e($venuehalls->links('pagination::bootstrap-4')); ?>

                    <?php else: ?>
                    No Records Found
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/venue/hall/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/allhall.blade.php ENDPATH**/ ?>