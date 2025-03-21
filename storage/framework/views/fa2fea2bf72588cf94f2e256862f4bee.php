

<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Budget Settings</h4>
            <div class="row">
            <div class="col-md-4">
                <div class="card border border-primary">
                    <h5 class="card-header border-bottom">Budget Category</h5>
                    <div class="card-body">
                        
                        <h5 class="card-title">Create a category for Budget</h5><br>
                        <a href="<?php echo e(route('admin.budgetcat.create')); ?>" class="btn btn-primary waves-effect waves-light">Add</a>
                        <a href="<?php echo e(route('admin.budgetcat.index')); ?>" class="btn btn-primary waves-effect waves-light">View</a>
                    </div>
                </div>
                <!-- end card-box-->
            </div>

            <div class="col-md-4">
                <div class="card border border-danger">
                    <h5 class="card-header border-bottom">Budget Items</h5>
                    <div class="card-body">
                        
                        <h5 class="card-title">Create a new items for Budget Category</h5><br>
                        <a href="<?php echo e(route('admin.budgetitems.create')); ?>" class="btn btn-danger waves-effect waves-light">Add</a>
                        <a href="<?php echo e(route('admin.budgetitems.index')); ?>" class="btn btn-danger waves-effect waves-light">View</a>
                    </div>
                </div>
                <!-- end card-box-->
            </div>

            <div class="col-md-4">
                <div class="card border border-warning">
                    <h5 class="card-header border-bottom">Budget for events</h5>
                    <div class="card-body">
                        
                        <h5 class="card-title">Create a events for Budget category </h5><br>
                        <a href="<?php echo e(route('admin.eventbudget.create')); ?>" class="btn btn-warning waves-effect waves-light">Add</a>
                        <a href="<?php echo e(route('admin.eventbudget.index')); ?>" class="btn btn-warning waves-effect waves-light">View</a>
                    </div>
                </div>
                <!-- end card-box-->
            </div>

            </div>
        </div> 
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Settings\resources/views/budget.blade.php ENDPATH**/ ?>