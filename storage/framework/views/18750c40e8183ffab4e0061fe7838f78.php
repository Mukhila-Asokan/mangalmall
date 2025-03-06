
<?php $__env->startSection('content'); ?>

<form class="form-horizontal" role="form" method="post" action="<?php echo e(route('venuepricing.add')); ?>">
    <?php echo csrf_field(); ?>
    <div class="col-12">
        <div class="card">
            <div class="row mt-4">
                <div class="text-end me-2">   
                    <a href="<?php echo e(route('venue.pricing')); ?>" class="me-4 btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-eye"></i> View
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="venue_id">Venue Name</label>
                    <div class="col-md-6">
                        <select id="venue_id" name="venue_id" class="form-control border border-warning" required>
                            <option value="">Select Venue</option>
                            <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($venue->id); ?>"><?php echo e($venue->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['venue_id'];
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
                    <label class="col-md-2 col-form-label" for="pricing_type">Pricing Type</label>
                    <div class="col-md-6">
                        <select id="pricing_type" name="pricing_type" class="form-control border border-warning" required>
                            <option value="Hourly">Hourly</option>
                            <option value="Day">Day</option>
                            <option value="Weekday">Weekday</option>
                            <option value="Custom">Custom</option>
                        </select>
                        <?php $__errorArgs = ['pricing_type'];
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
                    <label class="col-md-2 col-form-label" for="base_price">Base Price</label>
                    <div class="col-md-6">
                        <input type="text" id="base_price" name="base_price" class="form-control border border-warning" placeholder="Enter the base price" value="<?php echo e(old('base_price')); ?>" required>
                        <?php $__errorArgs = ['base_price'];
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
                    <label class="col-md-2 col-form-label" for="peak_rate">Peak Rate</label>
                    <div class="col-md-6">
                        <input type="text" id="peak_rate" name="peak_rate" class="form-control border border-warning" placeholder="Enter the peak rate" value="<?php echo e(old('peak_rate')); ?>" required>
                        <?php $__errorArgs = ['peak_rate'];
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
                    <label class="col-md-2 col-form-label" for="deposit_amount">Deposit Amount</label>
                    <div class="col-md-6">
                        <input type="text" id="deposit_amount" name="deposit_amount" class="form-control border border-warning" placeholder="Enter the deposit amount" value="<?php echo e(old('deposit_amount')); ?>" required>
                        <?php $__errorArgs = ['deposit_amount'];
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
                    <label class="col-md-2 col-form-label" for="cancellation_policy">Cancellation Policy</label>
                    <div class="col-md-6">
                        <textarea id="cancellation_policy" name="cancellation_policy" class="form-control border border-warning" placeholder="Enter the cancellation policy" required><?php echo e(old('cancellation_policy')); ?></textarea>
                        <?php $__errorArgs = ['cancellation_policy'];
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
                    <label class="col-md-2 col-form-label" for="addon_id">Addon</label>
                    <div class="col-md-6">
                        <select id="addon_id" name="addon_id" class="form-control border border-warning" required>
                            <option value="">Select Addon</option>
                            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($addon->id); ?>" data-price="<?php echo e($addon->price); ?>"><?php echo e($addon->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['addon_id'];
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
                    <label class="col-md-2 col-form-label" for="addon_price">Addon Price</label>
                    <div class="col-md-6">
                        <input type="text" id="addon_price" name="addon_price" class="form-control border border-warning" placeholder="Addon price will be displayed here" readonly>
                    </div>
                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('addon_id').addEventListener('change', function() {
        var selectedAddon = this.options[this.selectedIndex];
        var addonPrice = selectedAddon.getAttribute('data-price');
        document.getElementById('addon_price').value = addonPrice;
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/venuepricing/create.blade.php ENDPATH**/ ?>