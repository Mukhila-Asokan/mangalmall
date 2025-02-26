<div class="mt_sidebar_editor" id="text_editor">
						<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></span>
						<div class="mt_heading_editor">
							<p>Text Settings</p>
						</div>
						<div class="mt_detail_editor">
						    <div class="mt_md_input mt_select_editor md_textoptions_btnlink">
									<p>Button Link</p>
									<input type="text" class="textoptions_btnlink" placeholder="http://example.com/">
									<button class="textoptions_linkupdate mt_btn">Update</button>
							</div> 
							<div class="mt_editor_flex">
							    	<div class="mt_select_editor">
							    <div class="mt_select_box mt_select_editor mt_for_txt">
								<p>Font Family</p>
								<select class="wide" id="textoptions_font_family">
								  <option value="default" data-fonttype="" selected>Default</option>
								  <option value="montserrat" data-fonttype="sans-serif">Montserrat</option>
								  <option value="lato" data-fonttype="sans-serif">Lato</option>
								  <option value="poppins" data-fonttype="sans-serif">Poppins</option>
								  <option value="satisfy" data-fonttype="cursive">Satisfy</option>
								  <option value="cardo" data-fonttype="serif">Cardo</option>
								  <option value="roboto" data-fonttype="sans-serif">Roboto</option>
								  <option value="raleway" data-fonttype="sans-serif">Raleway</option>
								  <option value="ubuntu" data-fonttype="sans-serif">Ubuntu</option>
								  <option value="droid" data-fonttype="sans-serif">Droid</option>
								  <option value="hind" data-fonttype="sans-serif">Hind</option> 
								  <option value="oxygen" data-fonttype="sans-serif">Oxygen</option> 
								  <option value="oswald" data-fonttype="sans-serif">Oswald</option> 
								</select>
							</div>
							</div>
							</div>
								<div class="mt_select_editor mt_edit_text mt_for_txt">
								<p>edit your text</p>
								<textarea  class="textoptions_textarea"></textarea>
							</div>
							<div class="mt_select_editor mt_md_input mt_hide">
								<p>edit your link</p>
								<input type="text" class="textoptions_href" placeholder="http://example.com/">
							</div>
							<div class="range-slider asas">
								<p>Font size</p>
								<input class="range-slider__range" id="textoptions_font_size" type="range" value="0" min="14" max="60" step="1">
								<span class="range-slider__value">0</span>
							</div>
							<div class="mt_editor_flex mt_for_txt">
								<div class="mt_select_box mt_select_editor mt_for_txt">
									<p>Font Weight</p>
									<select class="wide select_font_weight" id="textoptions_font_weight">
									  <option value="100">100 Thin (Hairline)</option>
									  <option value="200">200 Extra Light (Ultra Light)</option>
									  <option value="300">300 Light</option>
									  <option value="400">400 Normal (Regular)</option>
									  <option value="500">500 Medium</option>
									  <option value="600">600 Semi Bold (Demi Bold)</option>
									  <option value="700">700 Bold</option>
									  <option value="800">800 Extra Bold (Ultra Bold)</option>
									  <option value="900">900 Black (Heavy)</option>
									</select>
								</div>
							</div>
							<div class="mt_editor_flex">
								<div class="mt_select_editor mt_color_picker mt_for_txt">
									<p>Text color</p>
									<div class="mt_picker mt_picker1">
										
									   <input data-css="color" data-element=".headline" id="textoptions_color" name="textoptions_color" type="text" value="#039be5">
									</div>
								</div>
								<div class="mt_select_editor mt_color_picker">
									<p>Background color</p>
									<div class="mt_picker mt_picker1">
										
									   <input data-css="color" data-element=".headline" id="textoptions_bgcolor" name="textoptions_bgcolor" type="text" value="#039be5">
									</div>
								</div>
								
							</div>
							<div class="mt_editor_flex">
								<div class="mt_select_editor mt_color_picker mt_for_txt">
									<p>Hover text color</p>
									<div class="mt_picker mt_picker1">
										
									   <input data-css="color" data-element=".headline" id="textoptions_color_hv" name="textoptions_color_hv" type="text" value="#039be5">
									</div>
								</div>
								<div class="mt_select_editor mt_color_picker">
									<p>Hover Bg color</p>
									<div class="mt_picker mt_picker1">
										
									   <input data-css="color" data-element=".headline" id="textoptions_bgcolor_hv" name="textoptions_bgcolor_hv" type="text" value="#039be5">
									</div>
								</div>
								
							</div>
							<div class="range-slider">
								<p>Opacity</p>
								<input class="range-slider__range" id="textoptions_opacity" type="range" value="0" min="0" max="1" step="0.01">
								<span class="range-slider__value">0</span>
							</div>
							
							<div class="mt_editcenter_box mt_for_txt">
								<ul class="textoptions_top">
									<li data-type="italic" class="italic">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14">
									  <path d="M3.368,0.006 L2.929,2.091 L6.192,2.091 L3.670,11.844 L0.442,11.844 L0.005,14.001 L8.766,14.001 L9.204,11.844 L5.862,11.844 L8.375,2.091 L11.561,2.091 L12.001,0.006 L3.368,0.006 Z" class="cls-1"/>
									</svg>
									</li>
									<li  data-type="underline" class="underline"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16">
									  <path d="M-0.007,16.007 L-0.007,13.798 L12.006,13.798 L12.006,16.007 L-0.007,16.007 ZM6.000,12.559 C3.142,12.559 0.816,10.129 0.816,7.144 L0.816,0.005 L3.357,0.005 L3.357,7.144 C3.357,8.675 4.542,9.919 6.000,9.919 C7.457,9.919 8.643,8.675 8.643,7.144 L8.643,0.005 L11.182,0.005 L11.182,7.144 C11.182,10.129 8.857,12.559 6.000,12.559 Z" class="cls-1"/>
									</svg>
									</li>
									<li data-type="line-through" class="line-through">
									<svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15">
									  <path d="M13.335,8.996 C13.397,9.106 13.449,9.216 13.496,9.331 C13.689,9.806 13.789,10.347 13.789,10.947 C13.789,11.588 13.675,12.158 13.434,12.663 C13.194,13.169 12.858,13.589 12.424,13.934 C11.989,14.274 11.461,14.540 10.847,14.725 C10.233,14.910 9.543,15.000 8.788,15.000 C8.334,15.000 7.876,14.960 7.423,14.875 C6.965,14.795 6.535,14.665 6.120,14.490 C5.704,14.319 5.322,14.099 4.967,13.839 C4.613,13.579 4.301,13.274 4.042,12.918 C3.782,12.563 3.574,12.158 3.428,11.708 C3.282,11.257 3.206,10.677 3.206,10.127 L6.016,10.127 C6.016,10.567 6.124,11.027 6.257,11.332 C6.389,11.638 6.573,11.888 6.809,12.078 C7.045,12.268 7.329,12.408 7.664,12.493 C7.999,12.578 8.372,12.623 8.783,12.623 C9.151,12.623 9.468,12.583 9.742,12.498 C10.011,12.413 10.237,12.298 10.412,12.153 C10.587,12.008 10.719,11.833 10.804,11.628 C10.889,11.428 10.932,11.207 10.932,10.972 C10.932,10.722 10.899,10.492 10.828,10.287 C10.757,10.087 10.625,9.896 10.426,9.721 C10.228,9.551 9.954,9.376 9.605,9.211 C9.463,9.146 9.255,9.076 9.085,9.006 L-0.005,9.006 L-0.005,7.005 L16.995,7.005 L16.995,8.996 L13.335,8.996 ZM10.804,3.667 C10.714,3.402 10.573,3.177 10.384,2.992 C10.195,2.807 9.959,2.657 9.675,2.557 C9.392,2.452 9.057,2.402 8.670,2.402 C8.297,2.402 7.975,2.447 7.697,2.532 C7.423,2.617 7.196,2.737 7.017,2.892 C6.837,3.047 6.700,3.227 6.611,3.432 C6.521,3.637 6.474,3.862 6.474,4.093 C6.474,4.573 6.705,4.978 7.168,5.303 C7.522,5.549 7.890,5.784 8.495,6.004 L4.141,6.004 C4.094,5.919 4.042,5.839 3.995,5.749 C3.754,5.273 3.631,4.718 3.631,4.083 C3.631,3.472 3.754,2.917 4.004,2.412 C4.254,1.906 4.604,1.476 5.057,1.121 C5.510,0.765 6.044,0.490 6.667,0.295 C7.291,0.100 7.971,-0.000 8.717,-0.000 C9.482,-0.000 10.176,0.110 10.799,0.335 C11.423,0.560 11.956,0.871 12.400,1.276 C12.844,1.676 13.184,2.151 13.425,2.707 C13.666,3.257 13.784,3.863 13.784,4.518 L10.941,4.518 C10.941,4.213 10.894,3.928 10.804,3.667 Z" class="cls-1"/>
									</svg>
									</li>
									<li data-type="left" class="left">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
										  <path d="M14.913,2.506 C14.666,2.510 14.418,2.511 14.172,2.511 C13.987,2.511 13.803,2.511 13.618,2.510 L1.275,2.507 C1.121,2.507 0.940,2.498 0.766,2.436 C0.271,2.261 -0.050,1.682 0.019,1.090 C0.088,0.498 0.529,0.031 1.044,0.005 C1.251,-0.006 1.460,-0.005 1.668,-0.001 L1.941,0.002 L14.716,0.002 C14.865,0.003 15.014,0.002 15.160,0.042 C15.694,0.192 16.049,0.775 15.985,1.399 C15.922,2.019 15.461,2.496 14.913,2.506 ZM1.170,6.240 C1.172,6.240 1.173,6.240 1.176,6.240 C1.983,6.242 2.788,6.241 3.593,6.241 L6.977,6.242 C7.563,6.242 8.038,6.708 8.105,7.349 C8.169,7.978 7.794,8.579 7.250,8.717 C7.124,8.749 6.995,8.748 6.896,8.748 L5.146,8.749 C4.615,8.749 4.083,8.750 3.552,8.750 C2.754,8.750 1.957,8.749 1.160,8.748 C0.753,8.746 0.385,8.525 0.177,8.153 C-0.020,7.803 -0.046,7.382 0.106,7.000 C0.303,6.502 0.672,6.240 1.170,6.240 ZM1.135,12.483 C2.624,12.479 4.110,12.480 5.602,12.480 L14.820,12.482 C15.269,12.483 15.658,12.730 15.863,13.143 C16.051,13.523 16.042,13.979 15.840,14.365 C15.622,14.782 15.275,14.993 14.811,14.993 C14.810,14.993 14.808,14.993 14.805,14.993 L1.299,14.988 C1.129,14.985 1.008,14.988 0.891,14.961 C0.336,14.831 -0.040,14.249 0.017,13.607 C0.074,12.958 0.545,12.484 1.135,12.483 Z" class="cls-1"/>
										</svg>
									</li>
									<li data-type="center" class="center"><svg xmlns="http://www.w3.org/2000/svg" width="15.97" height="15" viewBox="0 0 15.97 15">
										  <path d="M15.226,2.436 C15.052,2.498 14.871,2.507 14.717,2.507 L2.363,2.510 C2.179,2.511 1.994,2.511 1.809,2.511 C1.563,2.511 1.315,2.510 1.067,2.506 C0.519,2.496 0.057,2.019 -0.006,1.399 C-0.070,0.775 0.286,0.192 0.821,0.042 C0.966,0.002 1.116,0.003 1.264,0.002 L14.050,0.002 L14.324,-0.001 C14.531,-0.005 14.741,-0.006 14.948,0.005 C15.463,0.031 15.905,0.498 15.973,1.090 C16.043,1.682 15.721,2.261 15.226,2.436 ZM11.036,8.748 C10.239,8.749 9.440,8.750 8.642,8.750 C8.111,8.750 7.578,8.749 7.046,8.749 L5.295,8.748 C5.196,8.748 5.067,8.749 4.941,8.717 C4.396,8.579 4.021,7.978 4.086,7.349 C4.152,6.708 4.627,6.242 5.214,6.242 L8.601,6.241 C9.407,6.241 10.213,6.242 11.020,6.240 C11.022,6.240 11.023,6.240 11.026,6.240 C11.525,6.240 11.894,6.502 12.091,7.000 C12.243,7.382 12.217,7.803 12.020,8.153 C11.812,8.525 11.443,8.746 11.036,8.748 ZM1.161,12.482 L10.386,12.480 C11.879,12.480 13.367,12.479 14.857,12.483 C15.448,12.484 15.918,12.958 15.976,13.607 C16.033,14.249 15.657,14.831 15.101,14.961 C14.984,14.988 14.863,14.985 14.693,14.988 L1.175,14.993 C1.173,14.993 1.171,14.993 1.170,14.993 C0.704,14.993 0.358,14.782 0.139,14.365 C-0.062,13.979 -0.071,13.523 0.117,13.143 C0.322,12.730 0.711,12.483 1.161,12.482 Z" class="cls-1"/>
										</svg>
									</li>
									<li data-type="right" class="right"><svg xmlns="http://www.w3.org/2000/svg" width="15.97" height="15" viewBox="0 0 15.97 15">
										  <path d="M15.213,2.436 C15.040,2.498 14.859,2.507 14.704,2.507 L2.361,2.510 C2.177,2.511 1.992,2.511 1.807,2.511 C1.561,2.511 1.314,2.510 1.066,2.506 C0.518,2.496 0.057,2.019 -0.006,1.399 C-0.070,0.775 0.285,0.192 0.820,0.042 C0.965,0.002 1.115,0.003 1.263,0.002 L14.038,0.002 L14.312,-0.001 C14.519,-0.005 14.728,-0.006 14.935,0.005 C15.450,0.031 15.891,0.498 15.960,1.090 C16.030,1.682 15.708,2.261 15.213,2.436 ZM14.819,8.748 C14.023,8.749 13.225,8.750 12.427,8.750 C11.896,8.750 11.364,8.749 10.833,8.749 L9.083,8.748 C8.984,8.748 8.856,8.749 8.730,8.717 C8.185,8.579 7.811,7.978 7.875,7.349 C7.941,6.708 8.416,6.242 9.002,6.242 L12.387,6.241 C13.191,6.241 13.997,6.242 14.803,6.240 C14.806,6.240 14.807,6.240 14.809,6.240 C15.307,6.240 15.676,6.502 15.873,7.000 C16.025,7.382 15.999,7.803 15.802,8.153 C15.594,8.525 15.226,8.746 14.819,8.748 ZM1.159,12.482 L10.378,12.480 C11.869,12.480 13.356,12.479 14.844,12.483 C15.435,12.484 15.905,12.958 15.962,13.607 C16.020,14.249 15.644,14.831 15.088,14.961 C14.971,14.988 14.851,14.985 14.681,14.988 L1.174,14.993 C1.172,14.993 1.170,14.993 1.168,14.993 C0.704,14.993 0.357,14.782 0.139,14.365 C-0.062,13.979 -0.071,13.523 0.117,13.143 C0.321,12.730 0.711,12.483 1.159,12.482 Z" class="cls-1"/>
										</svg>
									</li>
								</ul>
							</div>
						
							
						</div>
					</div>