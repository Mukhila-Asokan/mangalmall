
<?php $__env->startSection('content'); ?>

<form class="form-horizontal" role="form" method="post" action="<?php echo e(route('bookingadons.update', $bookingadon->id)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="col-12">
        <div class="card">
        <div class="row mt-4">
                <div class="text-end me-2">   
                        <a href="<?php echo e(route('venue.bookingadons')); ?>" class="me-4 btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-eye"></i> View
                        </a>
                </div>
        </div>
            <div class="card-body">
             
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addonname">Addon Name</label>
                    <div class="col-md-6">
                        <input type="text" id="addonname" name="addonname" class="form-control border border-warning" placeholder="Enter the addon name" value="<?php echo e(old('addonname', $bookingadon->addonname)); ?>" required>
                        <?php $__errorArgs = ['addonname'];
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
                    <div class="col-md-6">
                        <input type="text" id="price" name="price" class="form-control border border-warning" placeholder="Enter the price" value="<?php echo e(old('price', $bookingadon->price)); ?>" required>
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
                    <label class="col-md-2 col-form-label" for="addon_description">Addon Description</label>
                    <div class="col-md-6">
                        <textarea id="addon_description" name="addon_description" class="form-control border border-warning" placeholder="Enter the addon description" required><?php echo e(old('addon_description', $bookingadon->addon_description)); ?></textarea>
                        <?php $__errorArgs = ['addon_description'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/bookingadon/edit.blade.php ENDPATH**/ ?>