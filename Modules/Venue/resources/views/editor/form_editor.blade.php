

<div class="mt_sidebar_editor" id="form_editor">
					<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></span>
						<div class="mt_heading_editor">
							<p>edit form</p>
						</div>
						<div class="mt_editor_tabs mt_form_tab2">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="Content-tab" data-toggle="tab" href="#Content" role="tab" aria-controls="Content" aria-selected="true">Content</a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="appearance-tab" data-toggle="tab" href="#appearance" role="tab" aria-controls="appearance" aria-selected="false">appearance</a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">settings</a>
							  </li>
							</ul>
							<div class="tab-content tab_content2" id="myTabContent">
							  <div class="tab-pane fade show active" id="Content" role="tabpanel" aria-labelledby="Content-tab">
								<div class="mt_detail_editor mt_detail_editorform mt_detail_formfields">
									<div class="mt_select_editor">
										<h5>Add/Remove Text Field<span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_input_edit_section">
									   <span class="mt_hide mt_editSvg">Edit </span>
									   <span class="mt_hide mt_deleteSvg">Delete</span>
										<div class="mt_right_form_fields">
											
										</div>
										
										
										<div class="mt_addnew_textbtn">
											<a href="javascript:" class="mt_btn mt_add_new_fields">
											
											Add New Field</a>
										</div>
									</div>
									
									<div class="mt_select_editor mt_button_text_setting">
										<h5>Button Text<span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_input_field">
										<input type="text" placeholder="Button Text"  id="formbtntxtfields_keyup">
									</div>
									
								</div>
								
								
								<div class="mt_detail_editor mt_textfiled_editor mt_add_fields mt_hide"> 
									<div class="mt_select_editor">
										<h5 class="add_fields_title">Add New Field</h5>
										<input type="hidden" id="targetinputdiv" value="">
									</div>
									<div class="mt_addfield_flex">
										<div class="mt_input_field">
											<label>Text Field Label</label>
											<input type="text" placeholder=""  id="fields_label" class="fields_keyup" />
										</div>
										<div class="mt_switch">
											<div class="tgl-group">
												<input class="tgl tgl-light fields_checked" id="fields_label_show" type="checkbox" checked >
												<label class="tgl-btn" for="fields_label_show"></label>
											</div>
										</div>
									</div>
									<div class="mt_addfield_flex">
										<div class="mt_input_field">
											<label>Placeholder Text</label>
											<input type="text" id="fields_placeholder" class="fields_keyup" />
										</div>
										
									</div>
									<div class="mt_select_box mt_select_editor mt_fields_type">
										<p>Text Field Type</p>
										<select class="wide fields_checked" id ="fields_type" >
										  <option value="text">Text</option>
										  <option value="email">Email</option>
										  
										</select>
									</div>
									<div class="mt_select_editor mt_edit_text mt_edit_error">
										<p>Error Message</p>
										<textarea  id="fields_error_msg" class="fields_keyup"></textarea>
										<div class="mt_checkbox2">
										  <input type="checkbox" id="fields_mandatory" class="fields_checked">
										  <label for="fields_mandatory">Mandatory Field</label>
										</div>
									</div>
									<div class="mt_next_prev_btn mt_field2_btn">
										<ul>
											<li><a href="javascript:;" class="mt_btn mt_add_fields_done">Back</a></li>
											<li><a href="javascript:;" class="mt_btn mt_add_fields_done">Done</a></li>
										</ul>
									</div>
								</div>
								
								
								
								
							  </div>
							  <div class="tab-pane fade" id="appearance" role="tabpanel" aria-labelledby="appearance-tab">
								<div class="mt_detail_editor mt_textfiled_editor">
									<div class="mt_select_editor">
										<h5>Text Fields<span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_editor_flex mt_editor_appear">
										
										<div class="mt_select_editor mt_color_picker">
											<p>Border Color</p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="forminputbordercolor" name="forminputbordercolor" type="text" value="#039be5">
											</div>
										</div>
										<div class="mt_select_editor mt_color_picker">
											<p>Background Color</p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="forminputbgcolor" name="forminputbgcolor" type="text" value="#039be5">
											</div>
										</div>
										
										
										
										
									</div>
									<div class="mt_editor_flex mt_editor_appear mt_editor_appbc">
										<div class="mt_select_editor mt_color_picker">
											<p>Label Text Color</p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="formlabelcolor" name="formlabelcolor" type="text" value="#039be5">
											</div>
										</div>
									</div>
									<div class="mt_select_editor mt_select_appear">
										<h5>Button<span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_editor_flex mt_editor_appear">
										
										<div class="mt_select_editor mt_color_picker">
											<p>Background Color</p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="formbtnbgcolor" name="formbtnbgcolor" type="text" value="#039be5">
											</div>
										</div>
										
										<div class="mt_select_editor mt_color_picker">
											<p>Text Color</p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="formbtncolor" name="formbtncolor" type="text" value="#039be5">
											</div>
										</div>
																				
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
								<div class="mt_detail_editor mt_detail_editorform">
									/* ********************* */
									<div class="mt_editor_flex mt_tabs_flex mt_tabs_setting mt_tabs_setting2">
										<div class="mt_select_editor mt_color_picker">
											<h5>Autoresponder</h5>
										</div>
										<div class="mt_switch">
											<div class="tgl-group">
												<input class="tgl tgl-light ar_switch" id="switch_autoresponder" type="checkbox" name="autoresponder_visible" >
												<label class="tgl-btn" for="switch_autoresponder"></label>
											</div>
										</div>
									</div>
								
									
								</div>
							  </div>

							  
							</div>
						</div>
					</div>