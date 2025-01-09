<?php
if(!empty($cData)){
	$email_settings = json_decode($cData[0]["email_setting"],true);
}
?>

<div class="mt_sidebar_editor" id="form_editor">
					<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></span>
						<div class="mt_heading_editor">
							<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_1')); ?></p>
						</div>
						<div class="mt_editor_tabs mt_form_tab2">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="Content-tab" data-toggle="tab" href="#Content" role="tab" aria-controls="Content" aria-selected="true"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_2')); ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="appearance-tab" data-toggle="tab" href="#appearance" role="tab" aria-controls="appearance" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_3')); ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_4')); ?></a>
							  </li>
							</ul>
							<div class="tab-content tab_content2" id="myTabContent">
							  <div class="tab-pane fade show active" id="Content" role="tabpanel" aria-labelledby="Content-tab">
								<div class="mt_detail_editor mt_detail_editorform mt_detail_formfields">
									<div class="mt_select_editor">
										<h5><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_5')); ?><span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_input_edit_section">
									   <span class="mt_hide mt_editSvg"><?= $this->common_icon->editSvg;?></span>
									   <span class="mt_hide mt_deleteSvg"><?= $this->common_icon->deleteSvg;?></span>
										<div class="mt_right_form_fields">
											
										</div>
										
										
										<div class="mt_addnew_textbtn">
											<a href="javascript:" class="mt_btn mt_add_new_fields">
											<?= $this->common_icon->plusSvg;?>
											<?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_6')); ?></a>
										</div>
									</div>
									
									<div class="mt_select_editor mt_button_text_setting">
										<h5><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_7')); ?> <span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_input_field">
										<input type="text" placeholder="Button Text"  id="formbtntxtfields_keyup">
									</div>
									
								</div>
								
								
								<div class="mt_detail_editor mt_textfiled_editor mt_add_fields mt_hide"> 
									<div class="mt_select_editor">
										<h5 class="add_fields_title"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_8')); ?></h5>
										<input type="hidden" id="targetinputdiv" value="">
									</div>
									<div class="mt_addfield_flex">
										<div class="mt_input_field">
											<label><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_9')); ?></label>
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
											<label><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_10')); ?></label>
											<input type="text" id="fields_placeholder" class="fields_keyup" />
										</div>
										
									</div>
									<div class="mt_select_box mt_select_editor mt_fields_type">
										<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_11')); ?></p>
										<select class="wide fields_checked" id ="fields_type" >
										  <option value="text"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_12')); ?></option>
										  <option value="email"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_13')); ?></option>
										  
										</select>
									</div>
									<div class="mt_select_editor mt_edit_text mt_edit_error">
										<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_14')); ?></p>
										<textarea  id="fields_error_msg" class="fields_keyup"></textarea>
										<div class="mt_checkbox2">
										  <input type="checkbox" id="fields_mandatory" class="fields_checked">
										  <label for="fields_mandatory"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_15')); ?></label>
										</div>
									</div>
									<div class="mt_next_prev_btn mt_field2_btn">
										<ul>
											<li><a href="javascript:;" class="mt_btn mt_add_fields_done"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_16')); ?></a></li>
											<li><a href="javascript:;" class="mt_btn mt_add_fields_done"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_17')); ?></a></li>
										</ul>
									</div>
								</div>
								
								
								
								
							  </div>
							  <div class="tab-pane fade" id="appearance" role="tabpanel" aria-labelledby="appearance-tab">
								<div class="mt_detail_editor mt_textfiled_editor">
									<div class="mt_select_editor">
										<h5><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_18')); ?> <span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_editor_flex mt_editor_appear">
										
										<div class="mt_select_editor mt_color_picker">
											<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_19')); ?></p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="forminputbordercolor" name="forminputbordercolor" type="text" value="#039be5">
											</div>
										</div>
										<div class="mt_select_editor mt_color_picker">
											<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_20')); ?></p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="forminputbgcolor" name="forminputbgcolor" type="text" value="#039be5">
											</div>
										</div>
										
										
										
										
									</div>
									<div class="mt_editor_flex mt_editor_appear mt_editor_appbc">
										<div class="mt_select_editor mt_color_picker">
											<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_21')); ?></p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="formlabelcolor" name="formlabelcolor" type="text" value="#039be5">
											</div>
										</div>
									</div>
									<div class="mt_select_editor mt_select_appear">
										<h5><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_22')); ?> <span><i class="fa fa-angle-down" aria-hidden="true"></i></span></h5>
									</div>
									<div class="mt_editor_flex mt_editor_appear">
										
										<div class="mt_select_editor mt_color_picker">
											<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_23')); ?></p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="formbtnbgcolor" name="formbtnbgcolor" type="text" value="#039be5">
											</div>
										</div>
										
										<div class="mt_select_editor mt_color_picker">
											<p><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_24')); ?></p>
											<div class="mt_picker mt_picker1">
											   <input data-css="color" data-element=".headline" id="formbtncolor" name="formbtncolor" type="text" value="#039be5">
											</div>
										</div>
																				
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
								<div class="mt_detail_editor mt_detail_editorform">
									<?php if($cData[0]["campaign_type"] !=1){ ?>  
									
									
									
									<?php } ?>
									<div class="mt_editor_flex mt_tabs_flex mt_tabs_setting mt_tabs_setting2">
										<div class="mt_select_editor mt_color_picker">
											<h5><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_25')); ?></h5>
										</div>
										<div class="mt_switch">
											<div class="tgl-group">
												<input class="tgl tgl-light ar_switch" id="switch_autoresponder" type="checkbox" name="autoresponder_visible" <?=($email_settings["autoresponder"]["visible"] == "YES") ? "checked": ''?> >
												<label class="tgl-btn" for="switch_autoresponder"></label>
											</div>
										</div>
									</div>
									<?php
										if($email_settings["autoresponder"]["visible"] == 'YES' && !empty($email_settings["autoresponder"]["name"])){
											$autores_selVal = $email_settings["autoresponder"]["name"];
											$autores_list_selVal = $email_settings['autoresponder']['list'];
										}else{
											$autores_selVal='';
											$autores_list_selVal='';
										}
									?>
									<div class="ar_box" <?= ( $email_settings["autoresponder"]["visible"] == 'YES' && !empty($email_settings["autoresponder"]["name"]) )? '': 'style="display:none"' ?> >
										<div class="mt_select_box mt_select_editor">
											<select class="wide fe_autoresponder_select" name="autoresponder_name">
											
											<option value=""><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_26')); ?></option>
											<?php if(!empty($connectedArList)){ 
												foreach($connectedArList['connect_autoresponder'] as $soloconnectedAr){	  
											?>
											<option value="<?=$soloconnectedAr?>" <?=($soloconnectedAr == $autores_selVal) ? "selected" : ""?>  > <?=$soloconnectedAr?></option>
											<?php }} ?>
											</select>
										</div>
										
										<div class="mt_select_box mt_select_editor">
											<select class="wide fe_autoresponderlist_select" name="autoresponder_list">
											<option value="">Select List</option>
											<?php if(!empty($autores_list_selVal)){ 
												$get_lists = $this->common->getListofResponder($autores_selVal);
												$lists = json_decode($get_lists,true)["data"];
												foreach($lists as $soloData){  ?>
												<option value="<?=$soloData['list_value']?>" <?=($soloData['list_value']==$autores_list_selVal) ? "selected": ""?>  > <?=$soloData['list_name']?> </option>
											<?php } } ?>
											</select>
										</div>
									</div>
									<button class="email_details_btn mt_btn"><?php echo html_escape($this->lang->line('ltr_common_form_editor_txt_27')); ?></button>
								</div>
							  </div>

							  
							</div>
						</div>
					</div>