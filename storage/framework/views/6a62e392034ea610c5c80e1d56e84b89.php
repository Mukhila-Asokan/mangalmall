<?php
use Carbon\Carbon;

$today = Carbon::today();
$yesterday = Carbon::yesterday();
?>

<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown"
       href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <i class="mdi mdi-bell font-size-24"></i>
        <span class="badge bg-danger rounded-circle noti-icon-badge" id = "notificationcount"><?php echo e(auth()->guard('admin')->user()->unreadNotifications->count()); ?></span>
    </a>

    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 font-size-16 fw-semibold">Notification</h6>
                </div>
                <div class="col-auto">
                    <a href="javascript:void(0);" class="text-dark text-decoration-underline">
                        <small>Clear All</small>
                    </a>
                </div>
            </div>
        </div>

        <div class="px-1" style="max-height: 300px;" data-simplebar>

            
            <?php
                $todayNotifications = auth()->guard('admin')->user()->unreadNotifications->filter(function ($notification) use ($today) {
                    return Carbon::parse($notification->created_at)->isToday();
                });
            ?>

            <?php if($todayNotifications->count() > 0): ?>
                <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                <?php $__currentLoopData = $todayNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.markNotification', $notification->id)); ?>"
                       class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
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

            
            <?php
                $yesterdayNotifications = auth()->guard('admin')->user()->unreadNotifications->filter(function ($notification) use ($yesterday) {
                    return Carbon::parse($notification->created_at)->isYesterday();
                });
            ?>

            <?php if($yesterdayNotifications->count() > 0): ?>
                <h5 class="text-muted font-size-13 fw-normal mt-2">Yesterday</h5>
                <?php $__currentLoopData = $yesterdayNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.markNotification', $notification->id)); ?>"
                       class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
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

            
            <?php
                $olderNotifications = auth()->guard('admin')->user()->unreadNotifications->filter(function ($notification) use ($today, $yesterday) {
                    return Carbon::parse($notification->created_at)->lt($yesterday);
                });
            ?>

            <?php if($olderNotifications->count() > 0): ?>
                <h5 class="text-muted font-size-13 fw-normal mt-2">Earlier</h5>
                <?php $__currentLoopData = $olderNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.markNotification', $notification->id)); ?>"
                       class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
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

            <?php if(auth()->guard('admin')->user()->unreadNotifications->count() == 0): ?>
                <a class="dropdown-item text-center">No new notifications</a>
            <?php endif; ?>

        </div>

        <!-- View All -->
        <a href="<?php echo e(route('admin.notifications')); ?>"
           class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
            View All
        </a>
    </div>
</li>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/notification.blade.php ENDPATH**/ ?>