
 <section id="features" class="feature-tab-section shadow-sm p-4" style="background-color: rgba(255, 236, 219, 0.7);">
 <div class="container">
 <div class="row justify-content-center">
 <div class="col-md-8 mx-auto">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0 text-white">Venue Search</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">

                    <!-- Venue Type Dropdown -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="venuetypeid" class="form-label fw-bold">Venue Type</label>
                            <select id="venuetypeid" name="venuetypeid" class="form-select">
                                <option value="">Select Venue Type</option>
                                <?php $__currentLoopData = $venuetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venuetype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($venuetype->id); ?>"><?php echo e($venuetype->venuetype_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <!-- City Search Input -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="citySearch" class="form-label fw-bold">City</label>
                            <input type="text" id="citySearch" name="venuearea" class="form-control" placeholder="Enter City Name">
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-12 text-center">
                        <button id="searchbutton" type="button" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

    </div>
</div>
 
 </section>
<!--feature section start-->
<section class="feature-section search-section ptb-50 gray-light-bg" style="background-color: rgba(255, 236, 219, 0.7);display: none;" id = "searchdisplay">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 col-lg-8">
				<div class="section-heading text-center mb-3">
					<h2>Venue Details</h2>
				   
				</div>
			</div>
		</div>
		<div class="row venuedetailslist">
		   
		</div>

	</div>
</section>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/layouts/search.blade.php ENDPATH**/ ?>