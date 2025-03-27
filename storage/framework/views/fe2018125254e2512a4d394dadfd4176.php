<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">List of <?php echo $pagetitle; ?></h4>
            <div class="text-end">
               <a href = "<?php echo e(route('roles/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
            </div>
            <div class="table-responsive">
               <?php $i=1; ?>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Department Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($roles) > 0): ?>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($i++); ?></th>
                                <td><?php echo e($role->rolename); ?></td>
                                <td><?php echo e($role->departments->departmentname); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.module.access.edit', ['id' => $role->id])); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($roles->links('pagination::bootstrap-4')); ?>

                        <?php else: ?>
                            No Records Found
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(route('admin.module.access')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/StaffManagement\resources/views/staff/module_access/list.blade.php ENDPATH**/ ?>