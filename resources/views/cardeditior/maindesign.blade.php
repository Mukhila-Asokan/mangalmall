<body class="pg-editor-body">
	   
       <!-- Header Start  -->
       <div class="pg-header-wrapper pg-editor-header">
           <div class="pg-header-row">
               <div class="pg-header-col">
                   <div class="pg-logo-wrap">
                          <a href="{{ route('user.carddesign') }}" class="pg-logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Mangal Mall">
                          </a>
                   </div>
                   <div class="pg-menu-toggle">
                            <span></span><span></span><span></span>
                    </div>
                    <div class="pg_nav">
                        <!--ul>
                            <li><a href="{{ route('home') }}">Home</a></li>                       
                        </ul-->   
                       
                    </div>
                    
					<!--div class="pg_template_name" title="Template Name - {{ $template->templatename ?? 'Template' }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
						{{ $template->templatename ?? 'Template' }}
					</div-->
                 

               </div>
               <div class="pg-header-col">										
                    <div class="pg-header-options-wrap">
						<div class="pg-action-btns">
							<ul>
							<a href="javascript:void(0);" class="has-tooltip btn"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download">
								<i class="ti ti-download" data-bs-toggle="modal" data-bs-target="#templateDownloadModal" ></i>	
									</a>
								<li>
                                    <a href="javascript:void(0);" class="btn" id="saveCard">
                                        <i class="ti ti-save"></i>                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="btn" id="saveAsTemplate">
									<i class="ti ti-save-alt"></i>    
                                        <span> Save As Template </span>
                                    </a>
                                </li>
                            </ul>
                        </div>  
                    </div>
               </div>
              </div>
         </div>
         <!-- Header End  -->
            <!-- Sidebar Content Start  -->   
            @include('cardeditior.Sidebar')


            <!-- Sidebar Content End  -->  
            <!-- Main Content Start  -->
             <!-- main wrapper start -->
        <div class="pg-main-wrapper">
            <div class="pg-page-content">
		
				<!-- canvas start -->
				<div class="pg-canvas-wrapper">
					<div class="pg-canvas-holder">
						<div class="pg-canvas-control-wrap">
							<a class="ed_zoom_in" title="zoom_in">
								<svg width="17" height="17" viewBox="0 0 17 17" fill="none">
									<path d="M16 16L12.3809 12.3809M12.3809 12.3809C12.9999 11.7618 13.491 11.0269 13.826 10.218C14.1611 9.40917 14.3335 8.54225 14.3335 7.66676C14.3335 6.79127 14.1611 5.92435 13.826 5.1155C13.491 4.30665 12.9999 3.57172 12.3809 2.95265C11.7618 2.33358 11.0269 1.84251 10.218 1.50748C9.40917 1.17244 8.54225 1 7.66676 1C6.79127 1 5.92435 1.17244 5.1155 1.50748C4.30665 1.84251 3.57172 2.33358 2.95265 2.95265C1.70239 4.20291 1 5.89863 1 7.66676C1 9.4349 1.70239 11.1306 2.95265 12.3809C4.20291 13.6311 5.89863 14.3335 7.66676 14.3335C9.4349 14.3335 11.1306 13.6311 12.3809 12.3809ZM7.66676 5.16679V10.1667M5.16679 7.66676H10.1667" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<p class="ed_zoom_number">100%</p><input type="hidden" value="100" class="ed_zoom_value">
							<a class="ed_zoom_out" title="zoom_out">
								<svg width="17" height="17" viewBox="0 0 17 17" fill="none">
									<path d="M16 16L12.3809 12.3809M12.3809 12.3809C12.9999 11.7618 13.491 11.0269 13.826 10.218C14.1611 9.40917 14.3335 8.54225 14.3335 7.66676C14.3335 6.79127 14.1611 5.92435 13.826 5.1155C13.491 4.30665 12.9999 3.57172 12.3809 2.95265C11.7618 2.33358 11.0269 1.84251 10.218 1.50748C9.40917 1.17244 8.54225 1 7.66676 1C6.79127 1 5.92435 1.17244 5.1155 1.50748C4.30665 1.84251 3.57172 2.33358 2.95265 2.95265C1.70239 4.20291 1 5.89863 1 7.66676C1 9.4349 1.70239 11.1306 2.95265 12.3809C4.20291 13.6311 5.89863 14.3335 7.66676 14.3335C9.4349 14.3335 11.1306 13.6311 12.3809 12.3809ZM5.16679 7.66676H10.1667" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<a class="ed_zoom_reset" title="cached"><i class="material-icons">cached</i></a>
							<a class="ed_obj_undo" title="undo">
								<svg width="14" height="14" viewBox="0 0 14 14">
									<path d="M2.625 13.125V11.375H8.8375C9.75625 11.375 10.5548 11.0833 11.2332 10.5C11.9117 9.91667 12.2506 9.1875 12.25 8.3125C12.25 7.4375 11.9108 6.70833 11.2324 6.125C10.554 5.54167 9.75567 5.25 8.8375 5.25H3.325L5.6 7.525L4.375 8.75L0 4.375L4.375 0L5.6 1.225L3.325 3.5H8.8375C10.2521 3.5 11.4663 3.95937 12.4801 4.87812C13.494 5.79688 14.0006 6.94167 14 8.3125C14 9.68333 13.4931 10.8281 12.4792 11.7469C11.4654 12.6656 10.2515 13.125 8.8375 13.125H2.625Z"/>
								</svg>
							</a>

							<a class="ed_obj_redo" title="redo">										
								<svg width="14" height="14" viewBox="0 0 14 14">
									<path d="M11.375 13.125V11.375H5.1625C4.24375 11.375 3.44517 11.0833 2.76675 10.5C2.08833 9.91667 1.74942 9.1875 1.75 8.3125C1.75 7.4375 2.08921 6.70833 2.76762 6.125C3.44604 5.54167 4.24433 5.25 5.1625 5.25H10.675L8.4 7.525L9.625 8.75L14 4.375L9.625 0L8.4 1.225L10.675 3.5H5.1625C3.74792 3.5 2.53371 3.95937 1.51987 4.87812C0.506042 5.79688 -0.000583649 6.94167 0 8.3125C0 9.68333 0.506918 10.8281 1.52075 11.7469C2.53458 12.6656 3.7485 13.125 5.1625 13.125H11.375Z"/>
								</svg>
							</a>
                            <!-- Grid Toggle Button  -->
							<div class="pg-grid-tollge-btn">
								<input type="checkbox" class="pg_grid" name="pg_grid_system" id="pg_grid_system">
								<label for="pg_grid_system">
                                    <img src="{{ asset('assets/images/grid.png') }}" alt="" class="has-grid">
                                    <img src="{{ asset('assets/images/no-grid.png') }}" alt="" class="no-grid">
								</label>
							</div>
							<!-- Grid Toggle Button  -->
						</div>
						<canvas id="pg_canvas" width="600" height="600"></canvas>
					</div>
				</div>  
            </div>	
		</div>	

        <!-- Custom Layer Setion Start --> 
		
		<div class="px-layers-wrapper pxl-layers-style">
			<div class="px-layer-drawer">
				<span></span>
			</div>
			<div class="px-layers-heading">
				<span>Layers(<span class="px-layers-count">1</span>)</span>
				<span class="px-layers-close pxl-layers-close" title="Close">
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 492.004 492.004" ><g><path d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"/></g></svg>
				</span>
			</div>
			<div class="px-layers-list pxl-layers-list ui-sortable"><div class="px-layers-item path-group active " id="0-layer-drag">
				<div class="px-layers-dragger pxl-layers-dragger">
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 24 24" xml:space="preserve"><g><path d="M5 10.75A2.75 2.75 0 1 1 7.75 8 2.752 2.752 0 0 1 5 10.75zm0-4A1.25 1.25 0 1 0 6.25 8 1.252 1.252 0 0 0 5 6.75zm7 4A2.75 2.75 0 1 1 14.75 8 2.752 2.752 0 0 1 12 10.75zm0-4A1.25 1.25 0 1 0 13.25 8 1.252 1.252 0 0 0 12 6.75zm7 4A2.75 2.75 0 1 1 21.75 8 2.752 2.752 0 0 1 19 10.75zm0-4A1.25 1.25 0 1 0 20.25 8 1.252 1.252 0 0 0 19 6.75zm-14 12A2.75 2.75 0 1 1 7.75 16 2.752 2.752 0 0 1 5 18.75zm0-4A1.25 1.25 0 1 0 6.25 16 1.252 1.252 0 0 0 5 14.75zm7 4A2.75 2.75 0 1 1 14.75 16 2.752 2.752 0 0 1 12 18.75zm0-4A1.25 1.25 0 1 0 13.25 16 1.252 1.252 0 0 0 12 14.75zm7 4A2.75 2.75 0 1 1 21.75 16 2.752 2.752 0 0 1 19 18.75zm0-4A1.25 1.25 0 1 0 20.25 16 1.252 1.252 0 0 0 19 14.75z"/></g></svg>
				</div>
				<div class="px-layers-name pxl-layers-db-click">
					<p>Path-group</p>
					<div class="pxl-layers-select" data-index="0"></div>
				</div>
			<div class="px-layers-action">
				<div class="px-layers-action-btn pxl-layers-action-btn" title="Rename" data-action="rename">
				   <svg viewBox="0 0 14 14">
					<path d="M13.240,4.514 L8.642,9.191 C7.966,9.875 7.071,10.251 6.121,10.251 L4.597,10.251 C4.221,10.251 3.917,9.942 3.917,9.559 L3.917,8.010 C3.917,7.043 4.287,6.133 4.959,5.446 L9.563,0.764 C10.080,0.237 10.768,-0.015 11.451,0.001 C12.101,0.014 12.745,0.268 13.239,0.770 C14.253,1.802 14.253,3.483 13.240,4.514 ZM12.277,1.748 C11.793,1.255 11.004,1.254 10.519,1.748 L9.918,2.359 L11.677,4.147 L12.277,3.537 C12.762,3.044 12.762,2.241 12.277,1.748 ZM5.991,2.241 L2.040,2.241 C1.665,2.241 1.360,2.551 1.360,2.933 L1.360,11.925 C1.360,12.307 1.665,12.617 2.040,12.617 L9.521,12.617 C9.896,12.617 10.201,12.307 10.201,11.925 L10.201,9.752 C10.201,9.370 10.505,9.061 10.881,9.061 C11.257,9.061 11.561,9.370 11.561,9.752 L11.561,11.925 C11.561,13.070 10.646,14.000 9.521,14.000 L2.040,14.000 C0.915,14.000 -0.000,13.069 -0.000,11.925 L-0.000,2.933 C-0.000,1.789 0.915,0.858 2.040,0.858 L5.991,0.858 C6.367,0.858 6.672,1.167 6.672,1.549 C6.672,1.932 6.367,2.241 5.991,2.241 Z"></path>
				   </svg>
				</div>
				<div class="px-layers-action-btn pxl-layers-action-btn " title="Lock" data-action="lock">
				<svg version="1.1" x="0" y="0" viewBox="0 0 512 512"><g><path d="M437.333 192h-32v-42.667C405.333 66.99 338.344 0 256 0S106.667 66.99 106.667 149.333V192h-32A10.66 10.66 0 0 0 64 202.667v266.667C64 492.865 83.135 512 106.667 512h298.667C428.865 512 448 492.865 448 469.333V202.667A10.66 10.66 0 0 0 437.333 192zM287.938 414.823a10.67 10.67 0 0 1-10.604 11.844h-42.667a10.67 10.67 0 0 1-10.604-11.844l6.729-60.51c-10.927-7.948-17.458-20.521-17.458-34.313 0-23.531 19.135-42.667 42.667-42.667s42.667 19.135 42.667 42.667c0 13.792-6.531 26.365-17.458 34.313l6.728 60.51zM341.333 192H170.667v-42.667C170.667 102.281 208.948 64 256 64s85.333 38.281 85.333 85.333V192z" /></g></svg>
				</div>
				<div class="px-layers-action-btn pxl-layers-action-btn hide" title="Delete" data-action="delete">
				<svg version="1.1" x="0" y="0" viewBox="0 0 512 512"><g><path d="M424 64h-88V48c0-26.51-21.49-48-48-48h-64c-26.51 0-48 21.49-48 48v16H88c-22.091 0-40 17.909-40 40v32c0 8.837 7.163 16 16 16h384c8.837 0 16-7.163 16-16v-32c0-22.091-17.909-40-40-40zM208 48c0-8.82 7.18-16 16-16h64c8.82 0 16 7.18 16 16v16h-96zM78.364 184a5 5 0 0 0-4.994 5.238l13.2 277.042c1.22 25.64 22.28 45.72 47.94 45.72h242.98c25.66 0 46.72-20.08 47.94-45.72l13.2-277.042a5 5 0 0 0-4.994-5.238zM320 224c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16zm-80 0c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16zm-80 0c0-8.84 7.16-16 16-16s16 7.16 16 16v208c0 8.84-7.16 16-16 16s-16-7.16-16-16z"/></g></svg>
				</div>
				<div class="px-layers-action-btn pxl-layers-action-btn" title="Show/Hide" data-action="showhide">
				 <svg version="1.1" x="0" y="0" viewBox="0 0 488.85 488.85"><g><path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z" /></g></svg>
                </div>
			</div>
		   </div></div>
		</div>
		<!-- Custom Layer Section End -->

<!-- check ad popup start -->
<div id="check_ad_popup" class="pg-modal-wrapper mfp-hide">
			<div class="pg-modal-inner-row">
				<div class="pg-modal-body">
				</div>
			</div>
		</div>
		<!-- publish ad popup start -->
		<div id="publish_ad_popup" class="pg-modal-wrapper mfp-hide">
			<div class="pg-modal-inner-row">
				<div class="pg-modal-body">
					<div class="check_ad_wrapper perfect">
						<h3>Are you sure</h3>
						<p>You want to Publish this ad<br>Or click to Cancel for continue editing</p>
                        <a href="{{ url('ad/facebook') }}" class="pg-btn">Publish</a>
						<a class="pg-btn mfp-close">Cancel</a>
					</div>
				</div>
			</div>
		</div> 


		<!-- Modal -->
		<div class="modal fade" id="templateDownloadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="templateDownloadModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
					<div class="modal-body">
							<h5 class="modal-title" id="templateDownloadModalLabel">Select Image Formate  </h5>
							<div class="mangalmall-template-formate">
								<ul>
									<li>
										<a class="get_canvas_image" data-format="image/png">
											<span>
                                                <img src="{{ asset('assets/images/png.png') }}" alt="">
											</span>
											Download PNG Format
										</a>
									</li>
									<li>
										<a class="get_canvas_image" data-format="image/jpeg">
											<span>
                                                <img src="{{ asset('assets/images/jpg.png') }}" alt="">
											</span>
											Download JPG Format
										</a>
									</li>
								</ul>
							</div>

					</div>
				</div>
			</div>
		</div>
