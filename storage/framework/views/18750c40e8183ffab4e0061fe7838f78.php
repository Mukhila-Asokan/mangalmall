
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
                <h3 class="text-center">Add Pricing for Venue </h3>
            </div>

            <div class="card-body">

            <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

                <div class="mb-4 mt-4 row">
                    <label class="col-md-2 col-form-label" for="venue_id">Venue Name</label>
                    <div class="col-md-6">
                        <select id="venue_id" name="venue_id" class="form-control border border-warning" required>
                            <option value="">Select Venue</option>
                            <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($venue->id); ?>"><?php echo e($venue->venuename); ?></option>
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
                    <label class="col-md-2 col-form-label" for="pricing_type">Pricing Type</label>
                    <div class="col-md-6">
                        <select id="pricing_type" name="pricing_type" class="form-control border border-warning" required>
                            <option value="">Select Pricing Type</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Day">Day</option>
                            <option value="Weekend">Weekend</option>
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

              <!-- Addon Selection -->
<div class="mb-4 row">
    <label class="col-md-2 col-form-label" for="addon_id">Addon</label>
    <div class="col-md-6">
        <select id="addon_id" class="form-control border border-warning">
            <option value="">Select Addon</option>
            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($addon->id); ?>" data-price="<?php echo e($addon->price); ?>"><?php echo e($addon->addonname); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<!-- Addon Price Display -->
<div class="mb-4 row">
    <label class="col-md-2 col-form-label" for="addon_price">Addon Price</label>
    <div class="col-md-6">
        <input type="text" id="addon_price" class="form-control border border-warning" placeholder="Addon price will be displayed here" readonly>
    </div>
</div>

<!-- Add Button -->
<div class="mb-4 row">
    <div class="col-md-6 offset-md-2">
        <button type="button" id="addAddonBtn" class="btn btn-success">Add</button>
    </div>
</div>

<!-- List of Selected Addons -->
<div class="mb-4 row">
    <label class="col-md-2 col-form-label">Selected Addons</label>
    <div class="col-md-6">
        <ul id="addonList" class="list-group"></ul>
    </div>
</div>


<div id="addonInputs"></div>



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

    document.getElementById('venue_id').addEventListener('change', function() {
        var venueId = this.value;
        if (venueId) {
            fetch(`/venueadmin/venuepricing/getRate/${venueId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('base_price').value = data.bookingprice;                    
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script>
$(document).ready(function () {
    // Update addon price when dropdown selection changes
    $('#addon_id').change(function () {
        let selectedOption = $(this).find(':selected');
        let price = selectedOption.data('price') || ''; 
        $('#addon_price').val(price);
    });

    // Add selected addon to list
    $('#addAddonBtn').click(function () {
        let selectedOption = $('#addon_id').find(':selected');
        let addonId = selectedOption.val();
        let addonName = selectedOption.text();
        let addonPrice = selectedOption.data('price');

        if (addonId && addonPrice) {
            // Check if addon already exists
            if ($('#addonList').find(`[data-id="${addonId}"]`).length === 0) {
                let listItem = `
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${addonId}">
                        ${addonName} - ₹${addonPrice}
                        <button type="button" class="btn btn-danger btn-sm remove-addon">Delete</button>
                    </li>
                `;
                $('#addonList').append(listItem);

                // Add hidden input fields to the form
                $('#addonInputs').append(`
                    <input type="hidden" name="addon_id[]" value="${addonId}">
                    <input type="hidden" name="addon_price[]" value="${addonPrice}">
                `);
            } else {
                alert('Addon already added!');
            }
        } else {
            alert('Please select a valid addon.');
        }
    });

    // Remove addon from list and hidden inputs
    $(document).on('click', '.remove-addon', function () {
        let addonId = $(this).closest('li').data('id');

        // Remove the list item
        $(this).closest('li').remove();

        // Remove hidden inputs
        $(`#addonInputs input[value="${addonId}"]`).remove();
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/venuepricing/create.blade.php ENDPATH**/ ?>