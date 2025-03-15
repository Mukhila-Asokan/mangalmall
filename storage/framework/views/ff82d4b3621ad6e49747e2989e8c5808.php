
<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Venue User Request</h4>



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
                             <?php $i=1; ?>
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>venue Admin Name</th>
                                        <th>City</th>
                                        <th>Mobile No</th>
                                        <th>Registered Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($venueuser) > 0): ?>
                                    <?php $__currentLoopData = $venueuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($i++); ?></th>
                                        <td><?php echo e($typename->name); ?></td>           
                                        <td><?php echo e($typename->city); ?></td>           
                                        <td><?php echo e($typename->mobileno); ?></td>
                                        <td><?php echo e($typename->created_at->format('d/m/y')); ?></td>
                                        <td><?php if($typename->status == 'Active'): ?>
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($typename->id); ?>" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                <?php else: ?> 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($typename->id); ?>" title="Inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
                <?php endif; ?>
           
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($typename->id); ?>" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>                                             
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <?php echo e($venueuser->links('pagination::bootstrap-4')); ?>

           <?php else: ?>
                No Records Found
        <?php endif; ?>
                                </tbody>
                            </table>
                        </div> 
                      
                       
                    </div>
                        
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/venueportalrequest/')); ?>">  
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venueportalrequest.blade.php ENDPATH**/ ?>