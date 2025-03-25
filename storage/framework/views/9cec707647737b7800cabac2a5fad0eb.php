        <div class="px-1" style="max-height: 300px;" data-simplebar>
    
<?php if($todayNotifications->count() > 0): ?>
    <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
    <?php $__currentLoopData = $todayNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.markNotification', $notification->id)); ?>" 
           class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 text-truncate ms-2">
                        <h5 class="noti-item-title fw-semibold font-size-14"><?php echo e($notification->data['user_name']); ?> 
                            <small class="fw-normal text-muted ms-1"><?php echo e($notification->created_at->format('H:i A')); ?></small>
                        </h5>
                        <small class="noti-item-subtitle text-muted">
                            <?php echo e($notification->data['message'] ?? 'New Notification'); ?>

                        </small>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if($yesterdayNotifications->count() > 0): ?>
    <h5 class="text-muted font-size-13 fw-normal mt-2">Yesterday</h5>
    <?php $__currentLoopData = $yesterdayNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.markNotification', $notification->id)); ?>" 
           class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 text-truncate ms-2">
                        <h5 class="noti-item-title fw-semibold font-size-14"><?php echo e($notification->data['user_name']); ?> 
                            <small class="fw-normal text-muted ms-1"><?php echo e($notification->created_at->format('d-m-Y H:i A')); ?></small>
                        </h5>
                        <small class="noti-item-subtitle text-muted">
                            <?php echo e($notification->data['message'] ?? 'New Notification'); ?>

                        </small>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if($olderNotifications->count() > 0): ?>
    <h5 class="text-muted font-size-13 fw-normal mt-2">Earlier</h5>
    <?php $__currentLoopData = $olderNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.markNotification', $notification->id)); ?>" 
           class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 text-truncate ms-2">
                        <h5 class="noti-item-title fw-semibold font-size-14"><?php echo e($notification->data['user_name']); ?> 
                            <small class="fw-normal text-muted ms-1"><?php echo e($notification->created_at->format('d-m-Y H:i A')); ?></small>
                        </h5>
                        <small class="noti-item-subtitle text-muted">
                            <?php echo e($notification->data['message'] ?? 'New Notification'); ?>

                        </small>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
        </div>
<?php if($todayNotifications->count() === 0 && $yesterdayNotifications->count() === 0 && $olderNotifications->count() === 0): ?>
    <a class="dropdown-item text-center">No new notifications</a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/notification-list.blade.php ENDPATH**/ ?>