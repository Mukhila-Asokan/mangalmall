
 <section id="features" class="feature-tab-section shadow-sm p-4" style="background-color: rgba(255, 236, 219, 0.7);">
 <div class="container">
 <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row g-3 align-items-end">
                
                <!-- Venue Type Dropdown -->
                <div class="col-md-5">
                    <label for="venuetypeid" class="form-label fw-bold">Venue Type</label>
                    <select id="venuetypeid" name="venuetypeid" class="form-select">
                        <option>Select Venue Type</option>
                        <?php $__currentLoopData = $venuetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venuetype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option><?php echo e($venuetype->venuetype_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- City Search Input -->
                <div class="col-md-5">
                    <label for="citySearch" class="form-label fw-bold">City</label>
                    <input type="text" id="citySearch" name="venuearea" class="form-control" placeholder="Enter City Name">
                </div>

                <!-- Search Button -->
                <div class="col-md-2 text-end">
                    <button id="searchbutton" type="button" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
 
 </section>
<!--feature section start-->
<section class="feature-section search-section ptb-100 gray-light-bg" id = "searchdisplay" style="display: none;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 col-lg-8">
				<div class="section-heading text-center mb-5">
					<h2>Venue Details</h2>
				   
				</div>
			</div>
		</div>
		<div class="row venuedetailslist">
		   
		</div>

	</div>
</section>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/layouts/search.blade.php ENDPATH**/ ?>