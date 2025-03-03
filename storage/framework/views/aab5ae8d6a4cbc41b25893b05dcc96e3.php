
<?php $__env->startSection('content'); ?>
<style type="text/css">
textarea {
    width: 100%;
    height: 250px;
}
.ck-content
{
    height: 250px;
    overflow-y: auto;
    overflow-x: hidden;
}

</style>
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Subscription Plan</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('subcriptionplan')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Subscription Plan List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('subcriptionplan.plan_update', $plan->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="col-12">
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="name">Name</label>
                <div class="col-md-8">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter the plan name" value = "<?php echo e(old('name', $plan->name)); ?>">
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
                <label class="col-md-2 col-form-label" for="description">Description</label>
                <div class="col-md-8">
                        <textarea id="description" name="description" class="form-control" placeholder="Enter the plan description"><?php echo e(old('description', $plan->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
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
                <label class="col-md-2 col-form-label" for="price">Price</label>
                <div class="col-md-8">
                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter the plan price" value = "<?php echo e(old('price', $plan->price)); ?>">
                        <?php $__errorArgs = ['price'];
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
                <label class="col-md-2 col-form-label" for="duration">Duration</label>
                <div class="col-md-8">
                        <input type="text" id="duration" name="duration" class="form-control" placeholder="Enter the plan duration in month" value = "<?php echo e(old('duration', $plan->duration)); ?>">
                        <?php $__errorArgs = ['duration'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Subscription Plan</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
       ClassicEditor.create(document.querySelector('#description')).catch(error => {
            console.error(error);
        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Subcription\resources/views/subcriptionplan/edit.blade.php ENDPATH**/ ?>