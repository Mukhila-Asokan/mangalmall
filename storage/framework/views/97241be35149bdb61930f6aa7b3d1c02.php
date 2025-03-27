<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Invitation Webpages</h4>

            <div class="text-end">
                <a href="<?php echo e(route('webpage.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-plus me-1"></span> Add 
                </a>
            </div>

            <div class="table-responsive">
                <?php $i=1; ?>

                <?php if(count($invitationwebpage) > 0): ?>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Webpage Name</th>
                            <th>Preview Image</th>                         
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $start = ($invitationwebpage->currentPage() - 1) * $invitationwebpage->perPage() + 1;
                    ?>
                        <?php $__currentLoopData = $invitationwebpage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webpage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($start++); ?></th>
                            <td><?php echo e($webpage->webpagename); ?></td>
                            <td><img src="<?php echo e(asset('storage/' . $webpage->preview_image )); ?>" alt="<?php echo e($webpage->name); ?>" width="100"></td>
                          
                            <td>
                                <?php if($webpage->status == 'Active'): ?>
                                <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($webpage->id); ?>" title="Status">
                                    <i class="fa fa-eye action_icon"></i>
                                </button>
                                <?php else: ?> 
                                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="<?php echo e($webpage->id); ?>" title="Status">
                                    <i class="fa fa-eye-slash action_icon"></i>
                                </button>
                                <?php endif; ?>
                                <a href="<?php echo e(url('/admin/invitation/webpage/'.$webpage->id.'/edit')); ?>" class="btn-warning btn" title="Edit">
                                    <i class="fa fa-pencil action_icon"></i>
                                </a>
                                <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($webpage->id); ?>" title="Delete">
                                    <i class="fa fa-trash action_icon"></i>
                                </button>
                            </td>
                        </tr>                                             
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($invitationwebpage->links('pagination::bootstrap-4')); ?>

                <?php else: ?>
                No Records Found
                <?php endif; ?>
            </div> 
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/invitation/webpage/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Invitation\resources/views/invitationwebpage/index.blade.php ENDPATH**/ ?>