
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Silhouette</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('invitation.silhouette')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Silhouette List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('silhouette.update', $silhouette->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="silhouttename">Silhouette Name</label>
                <div class="col-md-8">
                        <input type="text" id="silhouttename" name="silhouttename" class="form-control" placeholder="Enter the silhouette name" value = "<?php echo e(old('silhouttename', $silhouette->silhouttename)); ?>">
                        <?php $__errorArgs = ['silhouttename'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Silhouette</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Invitation\resources/views/silhoutte/edit.blade.php ENDPATH**/ ?>