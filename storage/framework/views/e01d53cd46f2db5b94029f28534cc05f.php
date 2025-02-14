
<?php $__env->startSection('content'); ?>

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add District</h4>
                        <div class="row">
                             <div class="col-6">
                                 <a href = "<?php echo e(route('venuesettings')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                           </a>
                             </div>
                        <div class="col-6 text-end">
                         <a href = "<?php echo e(route('venue.city')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('venue.city_add')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="cityname">City Name</label>
                            <div class="col-md-8">
                                <input type="text" id="cityname" name="cityname" class="form-control" placeholder="Enter the City name" value = "<?php echo e(old('cityname')); ?>" >
                                <?php $__errorArgs = ['cityname'];
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
                            <label class="col-md-4 col-form-label" for="statename">State Name</label>
                            <div class="col-md-8">
                                <select name="stateid" class="form-control" id ="stateDropdown">
                                    <option value="">Select State</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sta->id); ?>" <?php echo e(old('stateid') ==  $sta->id ? 'selected' : ''); ?> > <?php echo e($sta->statename); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['stateid'];
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
                           <label class="col-md-4 col-form-label" for="districtid">District Name</label>
                           <div class="col-md-8">
                               <select name="districtid" class="form-control" id="districtDropdown">
                                   <option value="">Select District</option>
                                   <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <option value="<?php echo e($dis->id); ?>" <?php echo e(old('districtid') ==  $sta->id ? 'selected' : ''); ?> > <?php echo e($dis->districtname); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                               <?php $__errorArgs = ['districtid'];
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

                        </div>
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add City</button>
                                </div>
                            </div>
                     
                    </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>


<script>
$(document).ready(function () {
    $('#stateDropdown').on('change', function () {
        var stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: "<?php echo e(route('get.districts')); ?>",
                type: "GET",
                data: { state_id: stateId },
                dataType: "json",
                success: function (data) {
                    $('#districtDropdown').empty().append('<option value="">All District</option>');
                    $.each(data, function (key, value) {
                        $('#districtDropdown').append('<option value="' + value.id + '">' + value.districtname + '</option>');
                    });
                }
            });
        } else {
            $('#districtDropdown').empty().append('<option value="">All District</option>');
        }
    });
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/city/create.blade.php ENDPATH**/ ?>