<?php $__env->startSection('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body p-4">
            <h3 class="text-center mt-2 mb-4">Venue Booking List</h3>
            <ul class="nav nav-tabs" id="venueTab" role="tablist">
                <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if($loop->first): ?> active <?php endif; ?>" id="tab<?php echo e($venue->id); ?>" data-bs-toggle="tab" data-bs-target="#content<?php echo e($venue->id); ?>" type="button" role="tab" aria-controls="content<?php echo e($venue->id); ?>" aria-selected="true">
                            <?php echo e($venue->venuename); ?>

                        </button>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="accordion" id="venueAccordion">
                <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-content" id="venueTabContent">
                        <div class="tab-pane fade <?php if($loop->first): ?> show active <?php endif; ?>" id="content<?php echo e($venue->id); ?>" role="tabpanel" aria-labelledby="tab<?php echo e($venue->id); ?>">
                            <div class="table-responsive mb-4 border rounded-1">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>#</th>
                                            <th>Event Title</th>
                                            <th>Event Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>No of Days</th>
                                            <th>Booking Status</th>
                                            <th>Total Price</th>
                                            <th>Payment Status</th>
                                            <th>Special Requirements</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;                                              
                                        ?>
                                        <?php $__currentLoopData = $venue->bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i++); ?></td>
                                                <td><?php echo e($booking->event_title); ?></td>
                                                <td><?php echo e($booking->event_name); ?></td>
                                                <td><?php echo e($booking->start_date); ?></td>
                                                <td><?php echo e($booking->end_date); ?></td>
                                                <td><?php echo e($booking->noofdays); ?></td>
                                                <td><?php echo e($booking->booking_status); ?></td>
                                                <td><?php echo e($booking->total_price); ?></td>
                                                <td><?php echo e($booking->payment_status); ?></td>
                                                <td><?php echo e($booking->special_requirements); ?></td>
                                                <td>
                                                    <a href = "<?php echo e(url('/venueadmin/venuebooking/'.$booking->id.'/invoicegenerator')); ?>" target="_new" class="btn btn-warning" title = "Invoice">
                                                        <i class="bi bi-file-spreadsheet"></i>

                                                    </a>
                                                    <a href="<?php echo e(url('/venueadmin/venuebooking/'.$booking->id.'/edit')); ?>" class="btn btn-info" title="Edit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="<?php echo e($booking->id); ?>" title="Delete">
                                                        <i class="bi bi-trash2-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($venue->bookings) == 0): ?>
                                            <tr>
                                                <td colspan="11" class="text-center">No Records Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/venueadmin/venuebooking/')); ?>">

<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/booking/venuebookinglist.blade.php ENDPATH**/ ?>