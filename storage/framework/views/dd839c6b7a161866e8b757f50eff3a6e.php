
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">List of Card Thicknesses</h4>

                
            <div class="text-end">
                    <a href = "<?php echo e(route('cardthickness.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
            </div>
        

                <div class="table-responsive">
                    <?php $i=1; ?>

                    <?php if(count($cardThickness) > 0): ?>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Thickness Name</th>            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php $__currentLoopData = $cardThickness; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thickness): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($i++); ?></th>
                            <td><?php echo e($thickness->cardthickness); ?></td>           
                            
                            
                            <td><?php if($thickness->status == 'Active'): ?>
        <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($thickness->id); ?>" title="Status"><i class="fa fa-eye action_icon"></i></button>
    <?php else: ?> 
    <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($thickness->id); ?>" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
    <?php endif; ?>
    <a href="<?php echo e(url('/admin/invitation/cardthickness/'.$thickness->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
    </a>
        <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($thickness->id); ?>" title="Delete"  >
        <i class="fa fa-trash action_icon"></i>
    </button>
</td>
                        </tr>                                             
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                </table>
                            <?php echo e($cardThickness->links('pagination::bootstrap-4')); ?>

<?php else: ?>
    No Records Found
<?php endif; ?>
                    
            </div> 
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/invitation/cardthickness/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Invitation\resources/views/cardthickness/index.blade.php ENDPATH**/ ?>