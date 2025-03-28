<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4"><?php echo e($pagetitle); ?></h4>
            <div class="text-end">
               <a href = "<?php echo e(route('admin.module.access')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
               <span class="tf-icon mdi mdi-eye me-1"></span>Module Access List
               </a>
            </div>
            <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('admin.module.access.update')); ?>">
               <?php echo csrf_field(); ?>
               <input type="hidden" name="role_id" value="<?php echo e($role->id ?? null); ?>">
               <div class="col-6">
                    <div class="mb-4 row">
                        <label for="role_name" class="col-md-4 col-form-label">Role Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?php echo e($role->rolename); ?>" id="role_name" disabled>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label class="col-md-4 col-form-label" for="menu">Menu</label>
                        <div class="col-md-8">
                            <select id="menu" name="menu[]" class="form-control select2" multiple>
                                <option>Select Menu</option>
                                <?php $__currentLoopData = $menues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($menu->id); ?>" <?php if(in_array($menu->id, old('menu', $moduleAccess ?? []))): ?> selected <?php endif; ?>> <?php echo e($menu->menuname); ?></option> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['menu'];
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/StaffManagement\resources/views/staff/module_access/edit.blade.php ENDPATH**/ ?>