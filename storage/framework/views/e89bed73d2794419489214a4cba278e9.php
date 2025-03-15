<?php $__env->startSection('content'); ?>
<div class="row m-3">
    <div class="col-12">
        <div class="card">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Booking Date</th>
                        <th>Mobile Number</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;                                              
                    ?>
                    <?php $__currentLoopData = $getAllEnquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e($enquiry->name); ?></td>
                            <td><?php echo e($enquiry->booking_date); ?></td>
                            <td><?php echo e($enquiry->mobile_number); ?></td>
                            <td><?php echo e($enquiry->message); ?></td>
                            <td><?php echo e($enquiry->status); ?></td>
                            <td>
                                <?php if($enquiry->status != 'ENQUIRED'): ?>
                                    <a href = "<?php echo e(route('update.enquiry.status', ['id' => $enquiry->id])); ?>" class="btn btn-warning" title = "Invoice">
                                        Click here to update status
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($getAllEnquiries) == 0): ?>
                        <tr>
                            <td colspan="11" class="text-center">No Records Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/booking/enquiries.blade.php ENDPATH**/ ?>