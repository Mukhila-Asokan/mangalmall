
<?php $__env->startSection('content'); ?>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Occasion Data Field</h4>
                       
                        <div class="text-end">
                         <a href = "<?php echo e(route('admin/occasiondatafield')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Occasion Data Fields List
                           </a>
                       </div>
                          <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('admin/occasiondatafield/store')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="occasion_id">Occasion Type Name</label>
                                            <div class="col-md-8">
                                                  <select id="occasion_id" name="occasion_id" class="form-control">
                                                      <option value="">Select Occasion Type</option>
                                                      <?php $__currentLoopData = $occasionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <option value="<?php echo e($occasionType->id); ?>" <?php echo e(old('occasion_id') == $occasionType->id ? 'selected' : ''); ?>><?php echo e($occasionType->eventtypename); ?></option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </select>
                                                <?php $__errorArgs = ['occasion_id'];
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
                                            <label class="col-md-4 col-form-label" for="datafieldname">Occasion Data Field Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="datafieldname" name="datafieldname" class="form-control" placeholder="Enter the Occasion Data Field name" value="<?php echo e(old('datafieldname')); ?>" >
                                                  <?php $__errorArgs = ['datafieldname'];
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
                                            <label class="col-md-4 col-form-label" for="datafieldtype">Data Field Type</label>
                                            <div class="col-md-8">
                                                <select id="datafieldtype" name="datafieldtype" class="form-control">
                                                    <option value="">Select Data Field Type</option>                                                   
                                                    <option value="text" <?php echo e(old('datafieldtype') == 'text' ? 'selected' : ''); ?>>Text</option>
                                                    <option value="textarea" <?php echo e(old('datafieldtype') == 'textarea' ? 'selected' : ''); ?>>Textarea</option>
                                                </select>
                                                <?php $__errorArgs = ['datafieldtype'];
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
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Occasion Data Field</button>
                                                </div>
                                            </div>
                                        </div>
                                   
                                    </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/occasiondatafields/create.blade.php ENDPATH**/ ?>