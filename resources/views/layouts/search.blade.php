
 
 
 <section id="features" class="feature-tab-section shadow-sm" style="background-color: rgba(255, 236, 219, 0.7);">
 <div class="container">
	<div class="row p-4">
		
        <div class="mb-3 col-md-6 col-6">         
            <div class="dropdown col-12">
                <button class="btn outline-btn dropdown-toggle border dropdown-toggle_cat" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tags"></i> Select Category
                </button>
                <ul class="dropdown-menu dropdown-toggle_catmenu" aria-labelledby="dropdownMenuButton">                    
					<li><a class="dropdown-item" href="#" data-value="14705"><i class="fas fa-map-marker-alt"></i> Wedding Venues</a></li>
					<li><a class="dropdown-item" href="#" data-value="14705"><i class="fas fa-map-marker-alt"></i> Invitation Design</a></li>
                    <li><a class="dropdown-item" href="#" data-value="15190"><i class="fas fa-camera"></i> Wedding Photographers</a></li>
                    <li><a class="dropdown-item" href="#" data-value="15005"><i class="fas fa-brush"></i> Makeup Artists</a></li>                    
                    <li><a class="dropdown-item" href="#" data-value="15241"><i class="fas fa-calendar-alt"></i> Wedding Planners</a></li>
                    <li><a class="dropdown-item" href="#" data-value="61618"><i class="fas fa-user"></i> Stylists</a></li>
                </ul>
                <input type="hidden" name="category" id="selectedCategory">
            </div>
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
