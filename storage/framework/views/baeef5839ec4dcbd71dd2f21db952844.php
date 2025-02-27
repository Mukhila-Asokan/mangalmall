

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">List of Menu</h4>
               
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-4">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Menu Name</th> 
                                <th class="text-center">Action</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through states here -->
                             <?php $__currentLoopData = $deletedMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($menu->id); ?></td>
                                <td class="text-center"><?php echo e($menu->menuname); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('menus.restore', $menu->id)); ?>" class="btn btn-success btn-sm" title="Restore">
                                        <i class="fas fa-trash-restore"></i>
                                    </a>
                                    <a href="<?php echo e(route('menus.deletepermanent', $menu->id)); ?>" class="btn btn-danger btn-sm" title="Delete Permanently">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- End loop -->
                        </tbody>
                    </table>
                    <!-- Pagination links here -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="#">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/deletedrecords/index.blade.php ENDPATH**/ ?>