
<?php $__env->startSection('content'); ?>

<form class="form-horizontal" role="form" method="post" action="<?php echo e(route('venueadmin.storeRequest')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="mobileno">Mobile No</label>
                    <div class="col-md-6">
                        <input type="text" id="new_mobile" name="new_mobile" class="form-control border border-warning" placeholder="Enter the new mobile number" value="<?php echo e(old('new_mobile')); ?>" required>
                        <?php $__errorArgs = ['new_mobile'];
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
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Send Request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/profile/changemobileno.blade.php ENDPATH**/ ?>