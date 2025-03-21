<?php use App\Models\UserChecklist; ?>



<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        <?php echo $__env->make('profile-layouts.sticky', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-lg-11 col-md-11 stickymenucontent"> 
 <center><h2 class="text-center">Checklist Board</h2></center>		
        <?php $__currentLoopData = $userOccasion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-12 mb-12">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">

            <?php $stats = UserChecklist::dashboardStats($occasion->id); ?>

            <!-- Event Title + Add Checklist Button -->
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><?php echo e($occasion->Occasionname->eventtypename); ?></h4>
                <a href="<?php echo e(route('checklist.create', ['occasion_id' => $occasion->id])); ?>" 
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Checklist
                </a>
            </div>
            <hr class="my-3">

            <!-- Occasion Details -->
            <div class="d-flex justify-content-between align-items-center">
                <p class="card-text"><strong>Date:</strong> <?php echo e(\Carbon\Carbon::parse($occasion->occasiondate)->format('d/m/y')); ?></p>
                <p class="card-text"><strong>Place:</strong> <?php echo e($occasion->occasion_place); ?></p>
                <p class="card-text"><strong>Notes:</strong> <?php echo e($occasion->notes); ?></p>
            </div>

            <!-- Checklist Summary -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-warning">
                        <div class="card-body">
                            <h5>Total Tasks</h5>
                            <h2><?php echo e($stats['total_tasks']); ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-success text-white">
                        <div class="card-body">
                            <h5>Completed Tasks</h5>
                            <h2><?php echo e($stats['completed_tasks']); ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-warning">
                        <div class="card-body">
                            <h5>Not Yet Started</h5>
                            <h2><?php echo e($stats['not_yet_task']); ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-lg text-center bg-info text-white">
                        <div class="card-body">
                            <h5>Ongoing</h5>
                            <h2><?php echo e($stats['pending_tasks']); ?></h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                 

        </div>
    </div>
</div>

<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/eventplan/index.blade.php ENDPATH**/ ?>