
                <div class="mt_sidebar_editor" id="image_editor">
					<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></span>
						<div class="mt_heading_editor">
							<p><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_1')); ?></p>
						</div>
						<div class="mt_detail_editor">
							<div class="mt_select_editor">
								<p><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_2')); ?></p>
								<div class="mt_dropzon mt_dropzon2">
									<form action="/file-upload"
									  class="dropzone"
									  id="imgsrcupload" name="imgsrcupload"></form> 
								</div>
							</div>
									<div class="mt_editor_tabs">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_3')); ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_4')); ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="unsplash-tab" data-toggle="tab" href="#unsplash" role="tab" aria-controls="unsplash" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_5')); ?></a>
							  </li>
							</ul>
							<div class="tab-content" id="myTabContent">
							  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="mt_tabs_pixabay mt_photo_gallery_container">
									<div class="mt_search_box">
										<input type="text" placeholder="Search..." class="search_images_lib" data-type="image_src">
										<span><i class="fa fa-search" aria-hidden="true"></i></span>
									</div>
									<div class="mt_photo_gallery">
										<ul class="mt_media_library_container editore_img_gallery_wrapper" id="image_src">
											
										</ul>
										<a href="javascript:;" class="mt_btn loadMoreMediaLibraryImage" data-attr="0"><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_6')); ?></a>
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="mt_tabs_pixabay mt_photo_gallery_container">
									<div class="mt_search_box">
										<input type="text" placeholder="Search..." class="search_images_from_api" data-api="pixabay" data-type="piximage_src" >
										<span><i class="fa fa-search" aria-hidden="true"></i></span>
									</div>
									<div class="mt_photo_gallery">
										<ul  class="mt_media_library_container editore_img_gallery_wrapper" id="piximage_src">
											<li><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_7')); ?></li> 
										</ul>
										<a href="javascript:;" class="mt_btn loadPixabayImage mt_hide" data-attr="1"><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_8')); ?></a>
										
										
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="unsplash" role="tabpanel" aria-labelledby="unsplash-tab">
								<div class="mt_tabs_pixabay mt_photo_gallery_container">
									<div class="mt_search_box">
										<input type="text" placeholder="Search..." class="search_images_from_api" data-api="unsplash" data-type="unsimage_src" >
										<span><i class="fa fa-search" aria-hidden="true"></i></span>
									</div>
									<div class="mt_photo_gallery">
										<ul  class="mt_media_library_container editore_img_gallery_wrapper" id="unsimage_src">
											<li><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_9')); ?></li> 
										</ul>
										<a href="javascript:;" class="mt_btn loadPixabayImage mt_hide" data-attr="1"><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_10')); ?></a>
										
										
									</div>
								</div>
							  </div>
							</div>
							<div class="mt_select_editor mt_md_input mt_edit_image_link">
								<p><?php echo html_escape($this->lang->line('ltr_common_image_editor_txt_11')); ?></p>
								<input type="text" class="imageoptions_href" placeholder="http://example.com/">
							</div>
						</div>
						</div>
					</div>