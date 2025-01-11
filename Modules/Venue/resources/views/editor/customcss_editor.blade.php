
<div class="mt_sidebar_editor" id="customcss_editor">
					<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></span>
						<div class="mt_heading_editor">
							<p>Add Custom CSS/JS</p>
						</div>
						<div class="mt_detail_editor mt_css_js">
							<div class="mt_select_editor mt_edit_text">
								<p>Add Custom CSS</p>
								<textarea  placeholder="Add CSS Here" id="mt_custom_css" name = "custom_css">{{ $template->custom_css ?? '' }}</textarea>
							</div>
							<div class="mt_select_editor mt_edit_text">
								<p>Add Custom JS</p>
								<textarea  placeholder="Add JS Here" id="mt_custom_js" name = "custom_js">{{ $template->custom_js ?? '' }}</textarea>
							</div>
							<div class="mt_next_prev_btn mt_cssjs_btn">
								<ul>
									<li><a href="javascript:;" class="mt_btn">reset</a></li>
									<li><a href="javascript:;" class="mt_btn save_css_js">Save</a></li>
								</ul>
							</div>
						</div>
					</div>