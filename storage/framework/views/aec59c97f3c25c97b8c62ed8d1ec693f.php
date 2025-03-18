
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Checklist Item</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('admin.checklistitems.index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Checklist Items
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('admin.checklistitems.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="category_id">Checklist Category</label>
                <div class="col-md-8">
                    <select id="category_id" name="category_id" class="form-control">
                            <option value = "">Select Checklist Category</option>
                        <?php $__currentLoopData = $checklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
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
                <label class="col-md-4 col-form-label" for="item_name">Item Name</label>
                <div class="col-md-8">
                    <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Enter the Item name" value = "<?php echo e(old('item_name')); ?>">
                    <?php $__errorArgs = ['item_name'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Checklist Item</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Settings\resources/views/checklistitems/create.blade.php ENDPATH**/ ?>