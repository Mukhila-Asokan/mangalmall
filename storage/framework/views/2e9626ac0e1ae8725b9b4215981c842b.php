
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Subscription Plans</h4>

            <div class="text-end">
                <a href="<?php echo e(route('subcriptionplan.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-plus me-1"></span> Add 
                </a>
            </div>

            <div class="table-responsive">
                <?php $i=1; ?>

                <?php if(count($subscriptionPlans) > 0): ?>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $subscriptionPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($i++); ?></th>
                            <td><?php echo e($plan->name); ?></td>
                            <td><?php echo e($plan->description); ?></td>
                            <td><?php echo e($plan->price); ?></td>
                            <td><?php echo e($plan->duration); ?></td>
                            <td>
                                <a href="<?php echo e(url('/admin/subscriptionplan/'.$plan->id.'/edit')); ?>" class="btn-warning btn" title="Edit">
                                    <i class="fa fa-pencil action_icon"></i>
                                </a>
                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($plan->id); ?>" title="Delete">
                                    <i class="fa fa-trash action_icon"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($subscriptionPlans->links('pagination::bootstrap-4')); ?>

                <?php else: ?>
                No Records Found
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/subscriptionplan/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Subcription\resources/views/subcriptionplan/index.blade.php ENDPATH**/ ?>