
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Assign Checklist to Events</h4>

            <div class="text-end">
                <a href="<?php echo e(route('admin.eventchecklist.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Assign Checklist </a>
            </div>

            <div class="table-responsive">
                <?php $i=1; ?>

                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Checklist Category</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(count($eventChecklists) > 0): ?>
                        <?php $__currentLoopData = $eventChecklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventChecklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($i++); ?></th>
                            <td><?php echo e($eventChecklist->occasion->eventtypename ?? ''); ?></td>
                            <td><?php echo e($eventChecklist->checklist->name ?? ''); ?></td>                          
                            <td>
                                <a href="<?php echo e(route('admin.eventchecklist.edit', $eventChecklist->id)); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i></a>
                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($eventChecklist->id); ?>" title="Delete"><i class="fa fa-trash action_icon"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No Records Found</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($eventChecklists->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/settings/eventchecklist/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Settings\resources/views/eventchecklist/index.blade.php ENDPATH**/ ?>