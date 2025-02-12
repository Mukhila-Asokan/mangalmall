
 
 
 <section id="features" class="feature-tab-section shadow-sm" style="background-color: rgba(255, 236, 219, 0.7);">
 <div class="container">
	<div class="row p-4">
		
        <div class="mb-3 col-md-6 col-6">         
			<select id="venuetypeid" name="venuetypeid"  placeholder="Enter the Venue Type" class=" has-value border-width-5">
					<option>Select Venue Type</option>
				@foreach($venuetypes as $venuetype)
					<option> {{ $venuetype->venuetype_name }}</option>
				@endforeach
			</select>

			<input type="text" id="citySearch" class="form-control" placeholder="Enter City Name">	
        </div>

        <div class="mb-3 col-md-4 col-4">
          
            <select id="venuearea" name="venuearea"  placeholder="Enter the Area name" class=" has-value border-width-5"></select>
        </div>
		<div class="mb-3 col-md-2 col-2">
			<div class="action-btns">
				<button href="#" class="btn primary-solid-btn mr-2" id="searchbutton" type = "button" >Search</button>
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
