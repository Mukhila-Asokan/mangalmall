<?php $__env->startSection('content'); ?>
 <div class="col-12">
 
  <div class="card">
	<div class="card-body p-4">
		<div class="col-12 text-end">
			<a href ="<?php echo e(route('venueadmin/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
				<span class="tf-icon mdi mdi-plus me-1"></span><i class="bi bi-plus"></i> Add Venue
			</a>
		</div>
	  <div class="table-responsive mb-4 border rounded-1">
        <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
				  <tr>
						<th>#</th>
						<th>Venue Name</th>
						<th>Website Link</th>						
						<th>Venue Pricing</th>
						<th>Venue Booking</th>
						<!-- <th>Theme Builder</th> -->
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
							<td>
								<a href="javascript:void(0);" class="btn-primary btn" title="Pricing" data-bs-toggle="modal" data-bs-target="#pricingModal<?php echo e($ven->id); ?>">
									<i class="ti ti-book action_icon"></i> Pricing
								</a>
								<!-- Modal -->

								<?php
								$pricingDetails = DB::table('venuePricing')->where('venue_id', $ven->id)
								->where('delete_status','0')->where('status','Active')->get();
								?>
								<div class="modal fade" id="pricingModal<?php echo e($ven->id); ?>" tabindex="-1" aria-labelledby="pricingModalLabel<?php echo e($ven->id); ?>" aria-hidden="true">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="pricingModalLabel<?php echo e($ven->id); ?>">Venue Pricing Details</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
											
											<div class="pricing-details">
    <p><strong>Pricing details for <?php echo e($ven->venuename); ?> - Price: $<?php echo e($ven->bookingprice); ?></strong></p>

    <?php if($pricingDetails->isNotEmpty()): ?>
        <?php $__currentLoopData = $pricingDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pricing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pricing-type-section">
                <h5>Pricing Type: <?php echo e($pricing->pricing_type); ?></h5>

                <table class="table pricing-table">
                    <thead>
                        <tr>
                            <th>Peak Rate</th>
                            <th>Deposit Amount</th>
                            <th>Base Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$<?php echo e($pricing->peak_rate); ?></td>
                            <td>$<?php echo e($pricing->deposit_amount); ?></td>
                            <td>$<?php echo e($pricing->base_price); ?></td>
                        </tr>
                    </tbody>
                </table>

                <?php
                    $bookingAddons = Modules\VenueAdmin\Models\VenuePricingAddon::where('venuepricingid', $pricing->id)->with('addon')->get();
                ?>

                <?php if($bookingAddons->isNotEmpty()): ?>
                    <p><strong>Extras:</strong></p>
                    <ul class="extras-list">
                        <?php $__currentLoopData = $bookingAddons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookingAddon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($bookingAddon->addon->addonname); ?>: $<?php echo e($bookingAddon->addon->price); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if(!$loop->last): ?>
                <hr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p>No pricing details available.</p>
    <?php endif; ?>
</div>

											
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<a href="<?php echo e(url('/venueadmin/venuebooking/'.$ven->id.'/add')); ?>" class="btn-success btn" title="Booking">
									<i class="ti ti-bookmark action_icon"></i> Booking
								</a>
							</td>
               Booking </a>  </td>
							<!-- <td> <a href="<?php echo e(url('/venueadmin/themebuilder/'.$ven->id.'/edit')); ?>" class="btn-info btn" title="Theme"><i class="ti ti-wand action_icon"></i>
                Theme </a></td> -->
							<td>
                            <a href="<?php echo e(url('/venueadmin/viewvenue/'.$ven->id.'')); ?>" class="font-20 text-primary mleft-10"><i class="bi bi-eye"></i></a>
							<a href="<?php echo e(url('/venueadmin/editvenue/'.$ven->id.'')); ?>" class="font-20 text-warning mleft-10" title="Edit"><i class="bi bi-pencil-square"></i></a>
				
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