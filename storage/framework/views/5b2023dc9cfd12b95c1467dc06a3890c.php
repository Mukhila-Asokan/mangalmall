<div class="mt_sidebar_editor test" id="background_editor">
	<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg></span>
	<div class="mt_heading_editor">
		<p>Background</p>
	</div>
	<div class="mt_detail_editor">
		<div class="mt_editor_tabs">
			<ul class="nav nav-tabs" id="backgroundsetting" role="tablist">
				<li class="nav-item">
					<a class="nav-link bgsetcolortbclk active" data-toggle="tab" href="#bgsetcolortb" role="tab" aria-controls="bgsetcolortb" aria-selected="true">color</a>
				</li>
				<li class="nav-item">
					<a class="nav-link bgsetimgtbclk" data-toggle="tab" href="#bgsetimgtb" role="tab" aria-controls="bgsetimgtb" aria-selected="false">image</a>
				</li>
				<li class="nav-item">
					<a class="nav-link hideShoSection" data-toggle="tab" href="#hideShoSecTb" role="tab" aria-controls="hideShoSecTb" aria-selected="false">other</a>
				</li>
			</ul>
			<div class="tab-content tab_content2" id="Popbg">
				<div class="tab-pane fade show active" id="bgsetcolortb" role="tabpanel" aria-labelledby="bgsetcolortb-tab">
					<div class="mt_editor_flex mt_tabs_flex">

						<div class="mt_select_editor mt_color_picker">
							<p>Background color</p>
							<div class="mt_picker mt_picker1">
								<input data-css="color" data-element=".headline" id="popbgoptions_bgcolor" name="popbgoptions_bgcolor" type="text" value="#039be5">
							</div>
						</div>

						<div class="mt_select_box mt_select_editor">
							<p>opacity</p>
							<select class="wide select_font_weight" id="popbgoptions_opacity">
								<option value="1">1</option>
								<option value="0.9">0.9</option>
								<option value="0.8">0.8</option>
								<option value="0.7">0.7</option>
								<option value="0.6">0.6</option>
								<option value="0.5">0.5</option>
								<option value="0.4">0.4</option>
								<option value="0.3">0.3</option>
								<option value="0.2">0.2</option>
								<option value="0.1">0.1</option>
								<option value="0">0</option>
							</select>
						</div>
					</div>
					<div class="mt_detail_editor mt_select_editor mt_editor_radiomain mt_background_type">
						<p>background type</p>
						<div class="mt_editor_radio">
							<input type="radio" name="popbackground_type" value="mt_popup_full_wd" id="mt_popup_full_wd" checked>
							<label for="mt_popup_full_wd">Full Width</label>
						</div>
						<div class="mt_editor_radio">
							<input type="radio" name="popbackground_type" value="mt_popup_left_wd" id="mt_popup_left_wd">
							<label for="mt_popup_left_wd">Half Width Left</label>
						</div>
						<div class="mt_editor_radio">
							<input type="radio" name="popbackground_type" value="mt_popup_right_wd" id="mt_popup_right_wd">
							<label for="mt_popup_right_wd">Half Width Right</label>
						</div>
					</div>

					<div class="mt_detail_editor mt_select_editor mt_editor_radiomain mt_photocontestimg_setting mt_hide">
						<p>Contest Images Setting</p>
						<div class="mt_editor_radio mt_checkbox2">
							<input type="checkbox" name="mt_image_slide_1_chk" id="mt_image_slide_1_chk" class="mt_image_slide_chk">
							<label for="mt_image_slide_1_chk">Image 1</label>
						</div>
						<div class="mt_editor_radio mt_checkbox2">
							<input type="checkbox" name="mt_image_slide_2_chk" id="mt_image_slide_2_chk" class="mt_image_slide_chk">
							<label for="mt_image_slide_2_chk">Image 2</label>
						</div>
						<div class="mt_editor_radio mt_checkbox2">
							<input type="checkbox" name="mt_image_slide_3_chk" id="mt_image_slide_3_chk" class="mt_image_slide_chk">
							<label for="mt_image_slide_3_chk">Image 3</label>
						</div>

					</div>
					<div class="mt_photo_gallery mt_select_editor ">
						<p>Overlay Images</p>
						<ul class="mt_overlay_image_container">
							<?php
							for ($i = 0; $i <= 10; $i++) {
								echo '<li><a href="javascript:;"><img src="' . url('/') . '/template_assets/overlay/' . $i . '.png" alt="" class="mt_use_img" data-type="image_bg"></a></li>';
							}
							?>
						</ul>
					</div>
				</div>
				<div class="tab-pane fade" id="bgsetimgtb" role="tabpanel" aria-labelledby="bgsetimgtb-tab">
					<div class="mt_dropzon_section mt_dropzon_img2">
						<div class="mt_select_editor">
							<p>Upload Image</p>
							<div class="mt_dropzon">
								<form action="/file-upload" class="dropzone" id="imgbackgroundupload"></form>
							</div>
						</div>
					</div>
					<div class="mt_editor_tabs">
						<ul class="nav nav-tabs" id="BgImgcontainer" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="bgimglibrary" data-toggle="tab" href="#bgimglibrarytab" role="tab" aria-controls="bgimglibrarytab" aria-selected="true">Library</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="bgpixabaylibrary" data-toggle="tab" href="#bgpixabaylibrarytab" role="tab" aria-controls="bgpixabaylibrarytab" aria-selected="false">Pixabay</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="bgunsplashlibrary" data-toggle="tab" href="#bgunsplashlibrarytab" role="tab" aria-controls="bgunsplashlibrarytab" aria-selected="false">Unsplash</a>
							</li>
						</ul>
						<div class="tab-content" id="BgImgLibcontainerContent">
							<div class="tab-pane fade show active" id="bgimglibrarytab" role="tabpanel" aria-labelledby="bgimglibrarytab-tab">
								<div class="mt_tabs_pixabay mt_photo_gallery_container">
									<div class="mt_search_box">
										<input type="text" placeholder="Search..." class="search_images_lib" data-type="image_bg">
										<span><i class="fa fa-search" aria-hidden="true"></i></span>
									</div>
									<div class="mt_photo_gallery">
										<ul class="mt_media_library_container editore_img_gallery_wrapper" id="image_bg">

										</ul>
										<a href="javascript:;" class="mt_btn loadMoreMediaLibraryImage" data-attr="0">Load more</a>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="bgpixabaylibrarytab" role="tabpanel" aria-labelledby="bgpixabaylibrarytab-tab">
								<div class="mt_tabs_pixabay">
									<div class="mt_search_box">
										<input type="text" placeholder="Search..." class="search_images_from_api" data-api="pixabay" data-type="piximage_bg">
										<span><i class="fa fa-search" aria-hidden="true"></i></span>
									</div>
									<div class="mt_photo_gallery">
										<ul class="mt_media_library_container editore_img_gallery_wrapper" id="piximage_bg">
											<li>Please enter keyword to search images</li>
										</ul>
										<a href="javascript:;" class="mt_btn loadPixabayImage mt_hide" data-attr="1">Load more</a>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="bgunsplashlibrarytab" role="tabpanel" aria-labelledby="bgunsplashlibrarytab-tab">
								<div class="mt_tabs_pixabay">
									<div class="mt_search_box">
										<input type="text" placeholder="Search..." class="search_images_from_api" data-api="unsplash" data-type="unsimage_bg">
										<span><i class="fa fa-search" aria-hidden="true"></i></span>
									</div>
									<div class="mt_photo_gallery">
										<ul class="mt_media_library_container editore_img_gallery_wrapper" id="unsimage_bg">
											<li>Please enter keyword to search images</li>
										</ul>
										<a href="javascript:;" class="mt_btn loadPixabayImage mt_hide" data-attr="1">Load more</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="hideShoSecTb" role="tabpanel" aria-labelledby="hideShoSecTb-tab">
					<div class="flex-hideShow-copy">
						<div class="mt-switch-wrapper">
							<p class="mt-switch-lable">Show/Hide Section</p>
							<label class="mt-switch-toggle">
								<input type="checkbox" class="switch-inpt hideSection" name="pro_show_hide">
								<span class="switch-slider"></span>
							</label>
						</div>
						<div class="mt-copy-section">
							<p class="mt-copy-lable">Copy Section</p>
							<button class="sectionCopy_btn" id="copyEditable" edit_type="background"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_665_2)">
										<path d="M21.5625 0H10.3125C8.32872 0 6.5625 1.8197 6.5625 3.75002L5.47875 3.77533C3.49593 3.77533 1.87499 5.56968 1.87499 7.5V26.25C1.87499 28.1803 3.64125 30 5.62501 30H19.6875C21.6712 30 23.4375 28.1803 23.4375 26.25H24.375C26.3588 26.25 28.125 24.4304 28.125 22.5V7.52252L21.5625 0ZM19.6875 28.1251H5.62501C4.64063 28.1251 3.75002 27.2054 3.75002 26.25V7.5C3.75002 6.5447 4.55159 5.65594 5.53597 5.65594L6.5625 5.62501V22.5C6.5625 24.4304 8.32872 26.25 10.3125 26.25H21.5625C21.5625 27.2054 20.6718 28.1251 19.6875 28.1251ZM26.25 22.5C26.25 23.4553 25.3594 24.375 24.375 24.375H10.3125C9.32811 24.375 8.43749 23.4553 8.43749 22.5V3.75002C8.43749 2.79473 9.32811 1.87503 10.3125 1.87503H19.6875C19.6725 4.0341 19.6875 5.64847 19.6875 5.64847C19.6875 7.59659 21.4406 9.37503 23.4375 9.37503H26.25V22.5ZM23.4375 7.5C22.4391 7.5 21.5625 5.68596 21.5625 4.71282V1.90218L26.25 7.5H23.4375ZM21.5625 13.1419H13.125C12.6075 13.1419 12.1875 13.561 12.1875 14.0785C12.1875 14.596 12.6075 15.015 13.125 15.015H21.5625C22.08 15.015 22.5 14.5959 22.5 14.0785C22.5 13.561 22.08 13.1419 21.5625 13.1419ZM21.5625 17.8247H13.125C12.6075 17.8247 12.1875 18.2438 12.1875 18.7612C12.1875 19.2788 12.6075 19.6978 13.125 19.6978H21.5625C22.08 19.6978 22.5 19.2788 22.5 18.7612C22.5 18.2438 22.08 17.8247 21.5625 17.8247Z" fill="white" />
									</g>
									<defs>
										<clipPath id="clip0_665_2">
											<rect width="30" height="30" fill="white" />
										</clipPath>
									</defs>
								</svg>copy
							</button>
						</div>
						<p class="mt-noteSlide"><span>Note:-</span> Once saved changes can't be revert</p>
						<p class="mt-noteSlide"><span>Note:-</span> In case of slider don't forget to save the template after copy the slider.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/editor/background_editor.blade.php ENDPATH**/ ?>