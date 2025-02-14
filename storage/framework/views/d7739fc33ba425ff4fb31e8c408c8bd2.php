
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Printing Methods</h4>

                
            <div class="text-end">
                    <a href = "<?php echo e(route('printingmethod.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
            </div>
        

                <div class="table-responsive">
                    <?php $i=1; ?>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Printing Method</th>            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($printingmethod) > 0): ?>
                        <?php $__currentLoopData = $printingmethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($i++); ?></th>
                            <td><?php echo e($method->printingmethod); ?></td>           
                            
                            
                            <td><?php if($method->status == 'Active'): ?>
        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($method->id); ?>" title="Status"><i class="fa fa-eye action_icon"></i></button>
    <?php else: ?> 
    <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($method->id); ?>" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
    <?php endif; ?>
    <a href="<?php echo e(url('/admin/invitation/printingmethod/'.$method->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
    </a>
        <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($method->id); ?>" title="Delete"  >
        <i class="fa fa-trash action_icon"></i>
    </button>
</td>
                        </tr>                                             
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($printingmethod->links('pagination::bootstrap-4')); ?>

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
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/invitation/printingmethod/')); ?>">  
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Invitation\resources/views/printingmethod/index.blade.php ENDPATH**/ ?>