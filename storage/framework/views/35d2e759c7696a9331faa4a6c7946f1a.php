

<?php $__env->startSection('content'); ?>
<div class="row">
   
    <form action="<?php echo e(route('menus.bulkAction')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    
    <input type="hidden" name = "menuid" value = "<?php echo e($deletedMenus->id ?? ''); ?>" />
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">List of Deleted <?php echo e($deletedMenus->menuname ?? ''); ?> </h4>
               
                <div class="table-responsive">
                    
                        <table class="table table-bordered table-hover mb-4">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" id="select-all"></th>
                                <th class="text-center">#</th>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="text-center"><?php echo e(ucfirst(str_replace('_', ' ', $column))); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
                            </tr>
                        </thead>
                        <tbody>
                        <?php
    $start = ($deletedRecords->currentPage() - 1) * $deletedRecords->perPage() + 1;
?>
                            <?php $__currentLoopData = $deletedRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="record_ids[]" value="<?php echo e($record->id); ?>" class="record-checkbox"></td>
                                    <td class="text-center"><?php echo e($start++); ?></td>
                                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-center"><?php echo e($record->$column); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        </table>

                       
                    
                    <!-- Pagination links here -->

                    <div class="d-flex justify-content-center"> 
                            <?php echo e($deletedRecords->appends(request()->query())->links('pagination::bootstrap-4')); ?>


                     </div>

                        
                </div>
            </div>
            <div class="d-flex justify-content-between m-5">
                            <button type="submit" name="action" value="restore" class="btn btn-success"><i class="fas fa-trash-restore"></i> Restore Selected</button>
                            <button type="submit" name="action" value="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete Selected Permanently</button>
            </div>

            </form>
       
    </div>
</div>

<script>
  document.getElementById('select-all').addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('.record-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/deletedrecords/show.blade.php ENDPATH**/ ?>