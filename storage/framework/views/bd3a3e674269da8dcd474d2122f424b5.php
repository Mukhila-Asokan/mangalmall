
<?php $__env->startSection('content'); ?>
 <div class="col-12">
    <div class="card">

        <div class="card-body p-4">
        <div class="row mt-4">
                <div class="text-end">   
                        <a href="<?php echo e(route('venuepricing.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-plus"></i>Add Pricing
                        </a>
                </div>
        </div>
        <h3 class="text-center mt-2 mb-2">Venue Pricing List</h3>
            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>Venue Name</th>
                            <th>Pricing Type</th>
                            <th>Base Price</th>
                            <th>Peak Price</th>
                            <th>Deposit Amount</th>
                            <th>Addons</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = ($pricing->currentPage() - 1) * $pricing->perPage() + 1;
                        ?>
                        <?php if(count($pricing) > 0): ?>
                            <?php $__currentLoopData = $pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pricing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($pricing->venue->venuename); ?></td>
                                    <td><?php echo e($pricing->pricing_type); ?></td>
                                    <td><?php echo e($pricing->venue->bookingprice); ?></td>
                                    <td><?php echo e($pricing->peak_rate); ?></td>
                                    <td><?php echo e($pricing->deposit_amount); ?></td>
                                    <td>
                                    <?php
                                            $bookingaddons = Modules\VenueAdmin\Models\VenuePricingAddon::where('venuepricingid', $pricing->id)->with('addon')->get();
                                            ?>

                                            <?php $__currentLoopData = $bookingaddons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookingad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div><?php echo e($bookingad->addon->addonname); ?>: <?php echo e($bookingad->addon->price); ?></div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </td>
                                    <td>
                                        <?php if($pricing->status == 'Active'): ?>
                                        <button type="button" class="btn-warning btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($pricing->id); ?>" title="Active Status">
                                                <i class="bi bi-check-circle-fill"></i> 
                                            </button>
                                        <?php else: ?>
                                        <button type="button" class="btn btn-danger statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($pricing->id); ?>" title="Inactive Status">
                                                <i class="bi bi-x-circle-fill"></i> 
                                        </button>
                                        <?php endif; ?>                                       

                                        <a href="<?php echo e(url('/venueadmin/venuepricing/'.$pricing->id.'/edit')); ?>" class="btn btn-info" title="Edit">
                                            <i class="bi bi-pencil-fill"></i> 
                                        </a>
                                        
                                        <button type="button" class="btn btn-danger deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($pricing->id); ?>" title="Delete">
                                            <i class="bi bi-trash2-fill"></i> 
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="">
                                    <div class="d-flex justify-content-center"> 
                            
                                    </div>
                                </td>
                            </tr>
                          
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No Records Found</td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="8" class="text-center">
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
              
                
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/venueadmin/venuepricing/')); ?>">  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/venuepricing/index.blade.php ENDPATH**/ ?>