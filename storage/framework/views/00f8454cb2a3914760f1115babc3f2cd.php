
<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Subscription Menu Permission</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('admin.subscriptionmenupermission')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Subscription Menu Permission List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('subscriptionmenupermission.permission_add')); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-12">
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="menu_id">Menu</label>
                <div class="col-md-8">
                        <select id="menu_id" name="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php $__currentLoopData = $usermenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usermenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($usermenu->id); ?>" <?php echo e(old('menu_id') == $usermenu->id ? 'selected' : ''); ?>><?php echo e($usermenu->menuname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['menu_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="subscriber_id">Subscriber Plan</label>
                <div class="col-md-8">
                        <select id="subscriber_id" name="subscriber_id" class="form-control">
                            <option value="">Select Subscriber Plan</option>
                            <?php $__currentLoopData = $subscriberplans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriberplan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subscriberplan->id); ?>" <?php echo e(old('subscriber_id') == $subscriberplan->id ? 'selected' : ''); ?>><?php echo e($subscriberplan->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['subscriber_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="access">Access</label>
                <div class="col-md-8">
                        <select id="access" name="access" class="form-control">
                            <option value="">Select Access</option>
                            <option value="Granted" <?php echo e(old('access') == 'Granted' ? 'selected' : ''); ?>>Granted</option>
                            <option value="Revoked" <?php echo e(old('access') == 'Revoked' ? 'selected' : ''); ?>>Revoked</option>
                        </select>
                        <?php $__errorArgs = ['access'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Subscription Menu Permission</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Subcription\resources/views/subscriptionmenupermission/create.blade.php ENDPATH**/ ?>