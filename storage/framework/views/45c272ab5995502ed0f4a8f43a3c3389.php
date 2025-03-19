
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Checklist</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('admin.checklist')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Checklist List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('admin.checklist.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="name">Checklist Name</label>
                <div class="col-md-8">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter the Checklist name" value = "<?php echo e(old('checklistname')); ?>">
                        <?php $__errorArgs = ['name'];
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
            <label class="col-md-4 col-form-label" for="maintitle">Main Title</label>
            <div class="col-md-8">
                <select id="maintitle" name="maintitle" class="form-control">
                    <option value="">Select Main Title</option>
                    <option value = "0">None</option>
                    <?php $__currentLoopData = $maintitles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($maintitle->id); ?>" <?php echo e(old('maintitle') == $maintitle->id ? 'selected' : ''); ?>><?php echo e($maintitle->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['maintitle'];
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
                <label class="col-md-4 col-form-label" for="occasion">Occasion</label>
                <div class="col-md-8">
                    <select id="occasion" name="occasion" class="form-control">
                        <option value="">Select Occasion</option>
                        <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($occasion->id); ?>" <?php echo e(old('occasion') == $occasion->id ? 'selected' : ''); ?>><?php echo e($occasion->eventtypename); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['occasion'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Checklist</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Settings\resources/views/checklist/create.blade.php ENDPATH**/ ?>