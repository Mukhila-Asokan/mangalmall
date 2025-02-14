

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
                    <a href = "<?php echo e(route('venue.district')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-eye me-1"></span>View List
                    </a>
                </div>
            </div>
    <form action="<?php echo e(route('districts.update', $district->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="districtname">District Name</label>
                <div class="col-md-8">
            <input type="text" class="form-control" id="districtname" name="districtname" value="<?php echo e($district->districtname); ?>" required>
            <?php $__errorArgs = ['districtname'];
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
            <select class="form-control" id="stateid" name="stateid" required>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($state->id); ?>" <?php echo e($district->stateid == $state->id ? 'selected' : ''); ?>><?php echo e($state->statename); ?></option>
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
            </div>
            <br>
            <div class="justify-content-end row">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update District</button>
                </div>
            </div>
    </form>
    <br>
    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/district/edit.blade.php ENDPATH**/ ?>