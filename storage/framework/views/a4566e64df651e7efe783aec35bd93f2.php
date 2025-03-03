
<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add User Menu</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('admin.usermenu')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>User Menu List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('usermenu.menu_add')); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-12">
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="menuname">Menu Name</label>
                <div class="col-md-8">
                        <input type="text" id="menuname" name="menuname" class="form-control" placeholder="Enter the menu name" value = "<?php echo e(old('menuname')); ?>">
                        <?php $__errorArgs = ['menuname'];
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
                <label class="col-md-2 col-form-label" for="icon">Icon</label>
                <div class="col-md-8">
                        <input type="text" id="icon" name="icon" class="form-control" placeholder="Enter the icon class" value = "<?php echo e(old('icon')); ?>">
                        <?php $__errorArgs = ['icon'];
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
                <label class="col-md-2 col-form-label" for="parentid">Parent Menu</label>
                <div class="col-md-8">
                        <select id="parentid" name="parentid" class="form-control">
                            <option value="">Select Parent Menu</option>
                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($menu->id); ?>" <?php echo e(old('parentid') == $menu->id ? 'selected' : ''); ?>><?php echo e($menu->menuname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['parentid'];
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
                <label class="col-md-2 col-form-label" for="sortorder">Sort Order</label>
                <div class="col-md-8">
                        <input type="text" id="sortorder" name="sortorder" class="form-control" placeholder="Enter the sort order" value = "<?php echo e(old('sortorder')); ?>">
                        <?php $__errorArgs = ['sortorder'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add User Menu</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Subcription\resources/views/usermenu/create.blade.php ENDPATH**/ ?>