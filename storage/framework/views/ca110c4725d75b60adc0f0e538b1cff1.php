<?php $__env->startSection('content'); ?>
 <div class="col-12">
 
  <div class="card">
	<div class="card-body p-4">
	  <div class="table-responsive mb-4 border rounded-1">
        <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
				  <tr>
						<th>#</th>
						<th>Venue Name</th>
						<th>Website Link</th>						
						<th>Venue Pricing</th>
						<th>Venue Booking</th>
						<th>Theme Builder</th>
						<th width="100px">Action</th>
				  </tr>
				  </thead>
				  <tbody>
				   <?php $i=1; ?>
				     <?php if(count($venues) > 0): ?>
					<?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ven): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 <tr>
                            <td><?php echo e($i++); ?></td>
							<td> <?php echo e($ven->venuename); ?> </td>
							<td> <?php echo e($ven->websitename); ?> </td>
							<td> <a href="<?php echo e(url('/venueadmin/venuepricing/'.$ven->id.'/add')); ?>" class="btn-primary btn" title="Pricing"><i class="ti ti-book action_icon"></i>
               Pricing </a> </td>
							<td><a href="<?php echo e(url('/venueadmin/venuebooking/'.$ven->id.'/add')); ?>" class="btn-success btn" title="Booking"><i class="ti ti-bookmark action_icon"></i>
               Booking </a>  </td>
							<td> <a href="<?php echo e(url('/venueadmin/themebuilder/'.$ven->id.'/edit')); ?>" class="btn-info btn" title="Theme"><i class="ti ti-wand action_icon"></i>
                Theme </a></td>
							<td>  
							<a href="<?php echo e(url('/venueadmin/venue/'.$ven->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="ti ti-pencil action_icon"></i> Edit
                </a>
				
				</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>                                     
							No Records Found
					<?php endif; ?>
				  </tbody>

	   </table>
	</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/venueuser/list.blade.php ENDPATH**/ ?>