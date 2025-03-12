
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Subscriber Menu Permissions</h4>

            <div class="text-end">
                <a href="<?php echo e(route('subscriptionmenupermission.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-plus me-1"></span> Add 
                </a>
            </div>

            <div class="accordion" id="subscriberAccordion">
    <?php if(count($menuPermissions) > 0): ?>
        <?php $i = 1; ?>

        <?php $__currentLoopData = $menuPermissions->groupBy('subscriber_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriberId => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?php echo e($subscriberId); ?>">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($subscriberId); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($subscriberId); ?>">
                        Subscriber Plan ID: <?php echo e($subscriberId); ?> - <?php echo e($permissions->first()->subscriberplan->name ?? 'Unknown Plan'); ?>

                    </button>
                </h2>
                <div id="collapse<?php echo e($subscriberId); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo e($subscriberId); ?>" data-bs-parent="#subscriberAccordion">
                    <div class="accordion-body">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Menu Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($i++); ?></th>
                                        <td><?php echo e($permission->usermenu->menuname ?? ''); ?></td>
                                        <td>
                                            <?php if($permission->status == 'Active'): ?>
                                                <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($permission->id); ?>" title="Active">
                                                    <i class="fa fa-eye action_icon"></i>
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($permission->id); ?>" title="Inactive">
                                                    <i class="fa fa-eye-slash action_icon"></i>
                                                </button>
                                            <?php endif; ?>
                                            <a href="<?php echo e(url('/admin/subscription/subscriptionmenupermission/'.$permission->id.'/edit')); ?>" class="btn-warning btn" title="Edit">
                                                <i class="fa fa-pencil action_icon"></i>
                                            </a>
                                            <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($permission->id); ?>" title="Delete">
                                                <i class="fa fa-trash action_icon"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p>No Records Found</p>
    <?php endif; ?>
</div>

        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/subscription/subscriptionmenupermission/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Subcription\resources/views/subscriptionmenupermission/index.blade.php ENDPATH**/ ?>