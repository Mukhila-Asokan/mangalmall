
<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Venue User Mobile No Change Request</h4>



                <div class="text-end">
                    <a href="<?php echo e(route('venue.mobilechangerequest')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span> ChangeMobileNo Request 
                    </a>
                </div>

            <?php if($id == 2): ?>    
            <div class="text-end">
                <a href="<?php echo e(route('venue.venueadminlist')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-eye me-1"></span> Venue Admin 
                </a>
            </div>
            <?php else: ?>
                <div class="text-end">
                    <a href="<?php echo e(route('venue.venueportalrequest')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span> Venue Portal Request 
                    </a>
                </div>
            <?php endif; ?>
                    <div class="row">

                    <div class="table-responsive">
                    <?php if($notifications->isEmpty()): ?>
        <p>No mobile change requests found.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>New Mobile No.</th>
                    <th>Requested Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($notification->data['user_name']); ?></td>
                        <td><?php echo e($notification->data['new_mobile']); ?></td>
                        <td><?php echo e($notification->created_at->format('d-m-Y H:i A')); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('mobilechange.approve', $notification->data['user_id'])); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="new_mobile" value="<?php echo e($notification->data['new_mobile']); ?>">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form method="POST" action="<?php echo e(route('admin.notifications.markAsRead', $notification->id)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning btn-sm">Mark as Read</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
                        </div> 
                      
                       
                    </div>
                        
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/venueportalrequest/')); ?>">  
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/mobilechangerequest.blade.php ENDPATH**/ ?>