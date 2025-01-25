
	 <!--feature section tab style start-->
        <section id="features" class="feature-tab-section ptb-100 white-bg shadow-sm mt-md-4 mt-lg-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="feature-content-wrap">
                            <ul class="nav nav-tabs feature-tab border-bottom-0 mb-5" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gray-light-bg active" href="#tab6-1" data-toggle="tab">
                                        <img src="{{ asset('frontassets/img/weddinghall.jpg'); }}" width="35" alt="Wedding Hall" class="mr-2" />
                                        <h6 class="mb-0"> Venue</h6>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gray-light-bg" href="#tab6-2" data-toggle="tab">
                                        <img src="{{ asset('frontassets/img/36.png'); }}" width="35" alt="Invitation" class="mr-2" />
                                        <h6 class="mb-0">Invitation</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gray-light-bg" href="#tab6-3" data-toggle="tab">
                                        <img src="{{ asset('frontassets/img/vendor.jpg'); }}" width="35" alt="wp hosting" class="mr-2" />
                                        <h6 class="mb-0">Vendor</h6>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content feature-tab-content">
                                <div class="tab-pane active" id="tab6-1">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-3 col-12 order-lg-last align-self-center">
                                            <div class="image-box fadein text-xl-right text-center">
                                                <img src="{{ asset('frontassets/img/weddinghall.jpg'); }}" alt="Wedding Hall" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-9 col-12 order-xl-first">
                                            <form class="submit-request-form">
												<div class="row pt-2">
													<div class="col-12">
														 <div class="form-group">
                                                            <select id="venuearea" name="venuearea"  placeholder="Enter the Area name" class="form-control has-value"></select>
														</div>

														<div class="form-group">															
															<select id="venuetypeid" class="form-control has-value">
																<option value="">Select Venue Type</option>		 @foreach($venuetypes as $type)
                                <option value = "{{ $type->id }}">{{ $type->venuetype_name }}</option>
                                @endforeach								
															</select>
														</div>
														<div class="form-group">															
															<select id="venuesubtypeid" class="form-control has-value">
																<option value="">Select Venue subtype</option>							
															</select>
														</div>
													</div>
													
													<div class="col-md-6 col-12">
														<div class="action-btns mt-4">
															<button href="#" class="btn primary-solid-btn mr-2" id="searchbutton" type = "button" >Search</button>
														</div>
													</div>
												</div>
												
											</form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab6-2">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-3 col-12 order-lg-last align-self-center">
                                            <div class="image-box fadein text-xl-right text-center">
                                                <img src="{{ asset('frontassets/img/36.png'); }}" alt="wp-hosting" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-9 col-12 order-xl-first">
                                           
                                            <div class="row pt-2">
                                                <div class="col-12">
													<div class="form-group">															
															<select id="select1" class="form-control has-value">
																<option>Occasion Type</option>
																<option value="1">Chennai</option>
																<option value="2">Madurai</option>
																<option value="3">Coimbatore</option>
																<option value="4">Sivakasi</option>
															</select>
													</div>
                                                </div>
                                                
                                            </div>
                                            <div class="action-btns mt-4">
                                                <a href="#" class="btn primary-solid-btn mr-2">Search</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab6-3">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-3 col-12 order-lg-last align-self-center">
                                            <div class="image-box fadein text-xl-right text-center">
                                                <img src="{{ asset('frontassets/img/vendor.jpg'); }}" alt="Vendor" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-9 col-12 order-xl-first">
                                            
                                            <div class="row pt-2">
                                                <div class="col-12">
												<div class="form-group">	
                                                    <select id="select1" class="form-control has-value">
													<option>Select Vendor</option>
													<option value="1">Make Up</option>
													<option value="2">Catering</option>
													<option value="3">Event Planner</option>
													<option value="4">Bridal Shop</option>
												</select>
                                                </div>
												</div>
												<div class="col-12">
												<div class="form-group">	
												<select id="select1" class="form-control has-value">
													<option>Select City</option>
													<option value="1">Chennai</option>
													<option value="2">Madurai</option>
													<option value="3">Coimbatore</option>
													<option value="4">Sivakasi</option>
												</select>
												</div>
												</div>
												
												
                                               
                                            </div>
                                            <div class="action-btns mt-4">
                                                <a href="#" class="btn primary-solid-btn mr-2">Search</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--feature section tab style end-->



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
