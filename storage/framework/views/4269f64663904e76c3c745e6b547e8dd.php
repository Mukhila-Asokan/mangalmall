

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">Menu</h4>
                 
                <div class="text-end">   
                    <a href="<?php echo e(route('menu.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-plus me-1"></span>Add
                    </a>
                </div>
                <div class="table-responsive">
                <?php if(count($menus) > 0): ?>
                
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Menu Name</th>
                                <th class="text-center">Parent Name</th>
                                <th class="text-center">Model Name</th>
                                <th class="text-center">Controller Name</th>
                                <th class="text-center">Module Name</th>
                                <th class="text-center">Route</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        <?php
    $start = ($menus->currentPage() - 1) * $menus->perPage() + 1;
?>
                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($start++); ?></td>
                                <td><?php echo e($menu->menuname); ?></td>
                                <td><?php echo e($menu->parentname->menuname ?? ''); ?></td>
                                <td><?php echo e($menu->modelname); ?></td>
                                <td><?php echo e($menu->controllername); ?></td>
                                <td><?php echo e($menu->parentname->menuname ?? ''); ?></td>
                                <td><?php echo e($menu->route); ?></td>
                                <td><?php echo e($menu->url); ?></td>
                                <td>
                                    <?php if($menu->status == 'Active'): ?>
                                        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($menu->id); ?>" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                                    <?php else: ?> 
                                        <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($menu->id); ?>" title="Inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url('/admin/menu/'.$menu->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                    <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($menu->id); ?>" title="Delete"><i class="fa fa-trash action_icon"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                   
                            <?php echo e($menus->links('pagination::bootstrap-4')); ?>

                        <?php else: ?>
                            No Records Found
                        <?php endif; ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/menu/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>