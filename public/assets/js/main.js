
jQuery(document).ready(function($) {
"use strict";

    var $isotope_container = $('.ed_template_grid').length > 0 ? $('.ed_template_grid') : '';
	var ajaxurl = $('#base_url').val();
	var template_reach = 12;
	/* key code */
	jQuery(document).on('keydown',function(e) {
		if(e.keyCode == 13){
			if($('#ed_login').length){ $('#ed_login').trigger('click'); }
			if($('#ed_forgot_password').length){ $('#ed_forgot_password').trigger('click'); }
			if($('#ed_signup').length){ $('#ed_signup').trigger('click'); }
		}
	});
	if($('#ed_search_template_nm').length){
		jQuery('#ed_search_template_nm').on('keydown',function(e) {
			if(e.keyCode == 13){
				var q = $(this).val();
				search_template(ajaxurl,q);
			}
		});
	}
	/* key code */
	if($('.pg-selected-category-title').length){
		var rta = $('#redirect_bundle option:selected').text();
		$('.pg-selected-category-title').text(rta);		
	}
	/* custom scroll bar start */
	if($(".pg-custom-scrollbar").length){
		$(".pg-custom-scrollbar").mCustomScrollbar({
			scrollInertia:200,
		});
	}
	if($(".pg-custom-scrollbar_x").length){
		$(".pg-custom-scrollbar_x").mCustomScrollbar({
			scrollInertia:200,
			axis:"x"
		});
	} 
	/* custom scroll bar end */
	/* popup start */
	if($('.pg-popup-link').length){
		$(document).on('click', '.pg-popup-link', function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			if(href == undefined){
				href = $(this).data('mfp-src');
			}
			var campaign_id = $(this).attr('data-campaign_id');
			var campaign_name = $(this).attr('data-campaign_name');
			var sub_user_id = $(this).attr('data-sub_user_id');
			if(campaign_id != undefined){
				$(href).find('#campaign_id').val(campaign_id);
				$(href).find('#campaign_rename').val(campaign_name);
				if(sub_user_id != undefined) $(href).find('#sub_user_id').val(sub_user_id);
			}
			var template_id = $(this).attr('data-template_id');
			var template_name = $(this).attr('data-template_name');
			if(template_id != undefined){
				$(href).find('#template_id').val(template_id);
				$(href).find('#template_rename').val(template_name);
			}
			var template_userID = $(this).attr('data-template_userID');
			var get_template_id = $(this).attr('data-get_template_id');
			if(template_userID != undefined){
				$('#user-prebuild-existing-template .custom_html_size').html('');
				$(href).find('#template_userID').val(template_userID);
				$(href).find('#get_template_id').val(get_template_id);
			}
			$.magnificPopup.open({
				items: {
					src: $(href)
				},
				type: 'inline',
				callbacks:{
					elementParse: function(item) {
					},
				}
			});
		});
	}

    if($('.ed_open_image').length){
		$(document).on('click', '.ed_open_image', function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			if(href == undefined){
				href = $(this).data('mfp-src');
			}
			$.magnificPopup.open({
				items: {
					src: href
				},
				type: 'image'
			}, 0);
		});
	}
	/* popup end */
	/* login */
	$(document).on('click', '#ed_login', function(e){
		e.preventDefault();
		var email = $('#ed_email').val();
		var password = $('#ed_password').val();
		var remeber = $('#ed_remember').prop('checked') ? 1 : 0;
		if(!(email !='' && password != '')){
			$.toaster('All fields are required.', 'Error', 'danger');
			return false;
		}
		if(!emailValidate(email)){
			$.toaster('You have entered an invalid email address!', 'Error', 'danger');
			return false;
		}
		var data = { 'email':email, 'password':password, 'remeber':remeber };
		$.ajax({
			type:'post',
			url: ajaxurl + 'authentication/login',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					setTimeout(function(){window.location = result.url}, 300);
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});
	/* login */
	
	
	
	/* forgot password */
	$(document).on('click', '#ed_forgot_password', function(e){
		e.preventDefault();
		var email = $('#ed_email').val();
		if(!(email !='')){
			$.toaster('Email is required.', 'Error', 'danger');
			return false;
		}
		if(!emailValidate(email)){
			$.toaster('You have entered an invalid email address!', 'Error', 'danger');
			return false;
		}
		var data = { 'email':email };
		$.ajax({
			type:'post',
			url: ajaxurl + 'authentication/forgot_password',
			data:data,
			success:function(data){
				console.log(data);
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	}); 
	/* forgot password */
	/* reset password */
	$(document).on('click', '#ed_reset_password', function(e){
		e.preventDefault();
		var newp = $('#ed_new_password').val();
		var conp = $('#ed_confirm_password').val();
		var id = $('#ed_user_id').val();
		var code = $('#ed_email_code').val();
		if(!(newp !='' && conp != '')){
			$.toaster('All fields are required.', 'Error', 'danger');
			return false;
		}
		if(newp != conp){
			$.toaster('New Password and confirm password doesn\'t match.', 'Error', 'danger');
			return false;
		}
		var data = { 'password':newp, 'user_id':id, 'code':code };
		$.ajax({
			type:'post',
			url: ajaxurl + 'authentication/reset',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					setTimeout(function(){window.location = result.url}, 300);
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});
	/* reset password */
	/* signup */
	$(document).on('click', '#ed_signup', function(e){
		e.preventDefault();
		var name = $('#ed_name').val();
		var email = $('#ed_email').val();
		var newp = $('#ed_new_password').val();
		var conp = $('#ed_confirm_password').val();
		if(!(newp !='' && conp != '' && name != '' && email != '')){
			$.toaster('All fields are required.', 'Error', 'danger');
			return false;
		}
		if(!emailValidate(email)){
			$.toaster('You have entered an invalid email address!', 'Error', 'danger');
			return false;
		}
		if(newp != conp){
			$.toaster('New Password and confirm password doesn\'t match.', 'Error', 'danger');
			return false;
		}
		var data = { 'name' : name, 'email' : email, 'password' : newp };
		$.ajax({
			type:'post',
			url: ajaxurl + 'authentication/register',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					setTimeout(function(){window.location = result.url}, 300);
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});



	});
	/* signup */
	
	/**
	 * Social Share
	 */
	$(document).on('click','.pxg-img-share-btn',function(e){
		e.preventDefault();
		let share_uri = $(this).attr('data-shareuri');
		let share_title = $(this).attr('data-sharename');
		$('.share_post_images').attr('template_url',share_uri);
		$('.share_post_images').attr('title',share_title);
		
		$(".pxg_share_facebook").attr('href', 'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(share_uri));
		$(".pxg_share_twitter").attr('href', 'https://twitter.com/intent/tweet?text='+share_title+'&amp;url='+encodeURIComponent(share_uri)+'&amp;via=Miraculous');
		$(".pxg_share_whatsapp").attr('href', 'https://api.whatsapp.com/send?text='+encodeURIComponent(share_uri));
		$(".pxg_share_linkedin").attr('href', 'https://www.linkedin.com/cws/share?url='+encodeURIComponent(share_uri));
	 });  
	
	/* campaign action */
	$(document).on('click', '.campaign_action', function(e){
		e.preventDefault();
		var action = $(this).data('action');
		var campaign_id = $(this).data('campaign_id');
		var sub_user_id = $(this).data('sub_user_id') != undefined ? $(this).data('sub_user_id') : '';
		var data = { 'action' : action, 'campaign_id' : campaign_id, 'sub_user_id' : sub_user_id };
		if(action == 'delete'){
			if(!confirm('Are you sure?')){
				return false;
			}
		}
		if(action == 'rename'){
			data['campaign_rename'] = $('#campaign_rename').val();
			data.campaign_id = $('#campaign_id').val();
			data.sub_user_id = $('#sub_user_id').val();
		}
		var obj = $(this);
		$.ajax({
			type:'post',
			url: ajaxurl + 'campaign/action',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					if(action == 'delete'){
						var remove = obj.parents('.pg-remove-campaigns').parent().prev().find('.campaign_count');
						remove.text( parseInt( remove.text() ) - 1 );
						obj.parents('.pg-remove-campaigns').remove();
					}
					if(action == 'rename'){
						$('.mfp-close').trigger('click');
						setTimeout(function(){ location.reload(); },300);
					}
					//window.location = result.url;
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});
	/* campaign action */
	/* template action */
	$(document).on('click', '.template_action', function(e){
		e.preventDefault();
		var action = $(this).data('action');
		var template_id = $(this).data('template_id');
		var sub_user_id = $('#sub_user_id').val();
		var data = { 'action' : action, 'template_id' : template_id, 'sub_user_id' : sub_user_id };
		if(action == 'delete'){
			if(!confirm('Are you sure?')){
				return false;
			}
		}
		if(action == 'rename'){
			data['template_rename'] = $('#template_rename').val();
			data.template_id = $('#template_id').val();
			data.sub_user_id = $('#sub_user_id').val();
		}
			var obj = $(this);
			$.ajax({
				type:'post',
				url: ajaxurl + 'images/action',
				data:data,
				success:function(data){
					var result = jQuery.parseJSON(data);
					if(result.status){
						if(action == 'copy'){
							setTimeout(function(){ location.reload(); },300);						
						}
						if(action == 'rename'){
							$('.mfp-close').trigger('click');
							setTimeout(function(){ location.reload(); },300);
						}
						if(action == 'delete'){
							var remove = obj.parents('.ed_template_remove').parent().prev().find('.template_count');
							remove.text( parseInt( remove.text() ) - 1 );
							obj.parents('.ed_template_remove').remove();
							$isotope_container.isotope( 'reloadItems' ).isotope();
						}
						$.toaster(result.msg, 'Success', 'success');
					}else{
						$.toaster(result.msg, 'Error', 'danger');
					}
				}
			});
	});	
	/* template action */
	/* create campaign */
	$(document).on('click', '.ed_campaign_create', function(e){
		e.preventDefault();
		var campaign_name = $('#campaign_name').val();
		var obj = $(this);
		var data = { 'campaign_name' : campaign_name };
		if(campaign_name == ''){
			$.toaster('Campaign name is required.', 'Error', 'danger');
			return false;
		}
		$.ajax({
			type:'post',
			url: ajaxurl + 'dashboard/create_campaign',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					$('.mfp-close').trigger('click');
					var n = $('.campaign_count').text();
					n = parseInt(n) + 1;
					$('.campaign_count').text(n);
					if($('.pg-empty-campain-wrap').length){ 
						$('.pg-empty-campain-wrap').hide();
						location.reload();
					}else{
						location.reload();
					}
					$('#campaign_name').val('');
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});	
	/* create campaign */
	/* create template */
	$(document).on('click', '.ed_template_create', function(e){
		e.preventDefault();
		var template_name = $('#template_name').val();
		var campaign_id = $('#campaign_id').val();
		var sub_user_id = $('#sub_user_id').val();
		var template_size = $('input[name=canvas_size]:checked').val();
		var obj = $(this);
		var data = { 'template_name' : template_name, 'campaign_id' : campaign_id, 'sub_user_id' : sub_user_id, 'template_size' : template_size };
		if(template_name == '' || campaign_id == ''){
			$.toaster('Template name is required.', 'Error', 'danger');
			return false;
		}
		$.ajax({
			type:'post',
			url: ajaxurl + 'campaign/add_template',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					setTimeout(function(){window.location = result.url}, 300);
					$('#template_name').val('');
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});	
	/* create template */
	/* Profile update check */
	$('#ed_profile_update_form').on('submit',function(e){
		var pass = $('#ed_password').val();
		var confirm = $('#ed_confirm_password').val();
		if(pass != '' && pass == confirm){
			return true;
		}else if(pass == ''){
			return true;
		}
		$.toaster("Password doesn\'t match.", 'Error', 'danger');
		return false;
	});
	/* Profile update check */
    if(typeof profile_update !== 'undefined'){
		if(profile_update == 1){
			$.toaster( 'Profile updated successfuly', 'Success', 'success' );
		}
	}
	$('.pg-remove-profile-img').on('click',function(e){
		e.preventDefault();
		$(this).parent('.pg-profile-image').find('img').attr('src','');
		$(this).parent('.pg-profile-image').find('input[type=hidden]').val(1);
	});
	/* create sub user */
	$('.ed_user_type').on('change',function(e){
		e.preventDefault();
		if($(this).val() == 'new'){
			$('.ed_new_user').show();
		}else{
			$('.ed_new_user').hide();
		}
	});
	
	$('.ed_manage_user_create').on('click',function(e){
		e.preventDefault();
		var data = {'action':'adduser'}, name='', value='', type='';
		var bool = false, flag = false;
		data['user_type'] = $('input[name="user_type"]:checked').val();
		$('.ed_manage_user').each(function(index){
			type = $(this).attr('type');
			name = $(this).attr('name');
			value = $(this).val();
			if(type == 'email'){
				bool = emailValidate(value);
			}
			if(type == 'checkbox' && $(this).prop('checked')){
				value = 1;
			}else if(type == 'checkbox'){
				value = 0;
			}
			if(value == ''){
				flag = true;
			}
			data[name] = value;
		});
		if(data.user_type == 'new'){
			if(flag == true){
				$.toaster('All field are mandatory.', 'Error', 'danger');
				return false;
			}	
		}
		if(bool == false){
			$.toaster('Please enter valid email address.', 'Error', 'danger');
			return false;
		}
		$.ajax({
			type:'post',
			url: ajaxurl + 'manage_user/add_sub_user',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					setTimeout(function(){window.location = result.url}, 300);
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});
	/* create sub user */
	
	/* facebook disconnect button */
	$('.ed_facebook_disconnect').on('click',function(e){
		if(confirm('Are you sure?')){
			return true;
		}else{
			return false;
		}
	});

	/* facebook disconnect button */
	/* Delete sub user */
	$('.ed_sub_user_delete').on('click',function(e){
		e.preventDefault();
		var sub_user = $(this).data('sub_user');
		var parent_id = $('#user_id').val();
		if(confirm('Are you sure?')){
			$.ajax({
				type:'post',
				url: ajaxurl + 'manage_user/delete_sub_user',
				data:{'parent_id':parent_id, 'sub_user':sub_user},
				success:function(data){
					var result = jQuery.parseJSON(data);
					if(result.status){
						$.toaster(result.msg, 'Success', 'success');
						setTimeout(function(){window.location = result.url}, 300);
					}else{
						$.toaster(result.msg, 'Error', 'danger');
					}
				}
			});
		}
	});
	/* Delete sub user */
	$('.ed_campaign_select_chng').on('change',function(e){
		e.preventDefault();
		if($(this).val() == ''){
			$(this).next().show();
			$(this).next().next().show();
		}else{
			$(this).next().hide();
			$(this).next().next().hide();
		}
	});

	$('#ed_create_template').on('click',function(e){
		e.preventDefault();
		var campaign_name = '', campaign_id = '';
		if($('#campaign_id').length){
			var campaign_id = $('#campaign_id').val();
			if(campaign_id == ''){
				var campaign_name = $('#campaign_name').val();
			}
		}else{
			var campaign_name = $('#campaign_name').val();
		}
		var template_name = $('#template_name').val();
		var get_template_id = $('#get_template_id').val();
		var template_userID = $('#template_userID').val();
		var template_size = $('#m_template_size').val();
		
		if($('#img_height').length && $('#img_width').length){
			var w = $('#img_width').val();
			var h = $('#img_height').val();
			if(w == '' || h == ''){
				$.toaster('Image width & height is required.', 'Error', 'danger');
				return false;
			}
			template_size = w+'x'+h;
			get_template_id = '';
			template_userID = '';
		}
		
		$.ajax({
			type:'post',
			url: ajaxurl + 'images/campaign_template',
			data:{'campaign_id':campaign_id, 'campaign_name':campaign_name, 'template_name':template_name, 'template_userID':template_userID, 'get_template_id':get_template_id,'template_size':template_size},
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					setTimeout(function(){window.location = result.url}, 300);
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});

	$('.ed_facebook_connect').on('click',function(e){
		e.preventDefault();
		var app_id = $('#fb_app_id').val();
		var app_secret = $('#fb_app_secret').val();
		if(app_id == '' || app_secret == ''){
			$.toaster('Facebook APP ID & APP SECRET is required.', 'Error', 'danger');
			return false;
		}
		$.ajax({
			type:'post',
			url: ajaxurl + 'profile/fb_details',
			data:{ 'app_id':app_id, 'app_secret':app_secret },
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					$.toaster(result.msg, 'Success', 'success');
					setTimeout(function(){window.location = result.url}, 300);
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});
	/* load More */
	$('.get_template_sub_cat').on('change',function(e){
		e.preventDefault();
		$('.pg-preloader-wrap').css('display','flex');
		var size = $('.pg-load-more-btn').data('size');
		var use = $('.pg-load-more-btn').data('use');
		var val = $(this).val();
		var q = $('#ed_search_template_nm').val();
		var data = {'reach':0,'size':size, 'use':use, 'sub_cat_id':val, 'q':q};
		$.ajax({
			type:'post',
			url: ajaxurl + 'images/get_more_template',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					template_reach = result.reach;
					$('.pg-append-template-row').html('');
					var html = '';
					for( var i =0; i < result.data.length; i++ ){
						html = add_predefind_template(result.data[i], ajaxurl, use);
						$('.pg-append-template-row').append(html);
					}					
					$('.pg-preloader-wrap').hide();
					if(result.hide){
						$('.pg-load-more-btn').hide();
					}else{
						$('.pg-load-more-btn').show();
					}
					if(!result.data.length){
						html = '<div class="pg-empty-campain"> <h3>Hey there! It seems there\'s nothing to display here.</h3></div>';
						$('.pg-append-template-row').append(html);
					}
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});

    
	$('.pg-load-more-btn').on('click',function(e){
		e.preventDefault();
		var start = template_reach;
		var size = $(this).data('size');
		var use = $(this).data('use');
		var sub_cat_id = $('.get_template_sub_cat').val();
		var q = $('#ed_search_template_nm').val();
		var data = { 'reach':template_reach, 'size':size, 'use':use, 'sub_cat_id':sub_cat_id, 'q':q };
		var obj = $(this);
		$('.pg-preloader-wrap').css('display','none');
		$.ajax({
			type:'post',
			url: ajaxurl + 'images/get_more_template',
			data:data,
			success:function(data){
				var result = jQuery.parseJSON(data);
				if(result.status){
					console.log(result);
					template_reach = result.reach;
					var html = '';
					for( var i =0; i < result.data.length; i++ ){
						html = add_predefind_template(result.data[i], ajaxurl, use);
						$('.pg-append-template-row').append(html);
					}					
					if(result.hide){
						obj.hide();
					}
					$('.pg-preloader-wrap').hide();
					if(!result.data.length){
					}
				}else{
					$.toaster(result.msg, 'Error', 'danger');
				}
			}
		});
	});

	/* load More */
	$(document).on('click', '.ad_details_popup', function(e){
		e.preventDefault();
		$.magnificPopup.open({
			items: {
				src: $(this).attr('href')
			},
			type: 'ajax',
			callbacks: {
				ajaxContentAdded: function(){
				}
			}
		});
	});
	$(document).on('keyup', '.fb_get_cities', function(e){
		e.preventDefault();
		if($(this).val().length >= 3){
			$.ajax({
				type:'post',
				url: ajaxurl + 'ad/get_cities',
				data:{'city':$(this).val()},
				success:function(data){
					var result = jQuery.parseJSON(data);
					if(result.status){
						$('#ad_city_keys option').remove();
						var html = '';
						for( var i =0; i < result.data.length; i++ ){
							$('#ad_city_keys').append('<option value="'+result.data[i].key+'">'+result.data[i].name+' --- '+result.data[i].region+' --- '+result.data[i].country_name+'</option>');
						}					
					}else{
						$.toaster(result.msg, 'Error', 'danger');
					}
				}
			});
		}
	});

	$('#redirect_bundle').on('change',function(e){
		e.preventDefault();
		if($(this).val() != 'custom'){
			var url = ajaxurl + 'images/size/' + $(this).val();
			window.location = url;
		}else{
			var html = '';
			html += '<div class="pg-input-holder m_custom_img">';
				html += '<label>Image Width</label>';
				html += '<input type="text"  value="" id="img_width">';
			html += '</div>';
			html += '<div class="pg-input-holder m_custom_img">';
				html += '<label>Image Height</label>';
				html += '<input type="text"  value="" id="img_height">';
			html += '</div>';
			$('#user-prebuild-existing-template .custom_html_size').html(html);
			$.magnificPopup.open({
				items: {
					src: $('#user-prebuild-existing-template')
				},
				type: 'inline',
				callbacks:{
					elementParse: function(item) {
						// Will fire when this exact popup is opened
						// this - is Magnific Popup object
					},
				}
			});
		}
	});

	// User Toggle Sript 

	$('.pg-user-info').on("click", function() {
		$('.pg-user-useful-links').toggleClass('active');
		$(this).toggleClass('active');
	});
	$(".pg-user-useful-links, .pg-user-info").on('click', function(e) {
		e.stopPropagation();
	});
	$('body').on("click", function() {
		$('.pg-user-useful-links').removeClass('active');
		$(".pg-user-info").removeClass('active');
	});

	// Responsive Togggle 

	$('.pg-menu-toggle').on("click", function() {
		$('body').toggleClass('pg-sidebar-showshow');
	});

	$(".pg-menu-toggle").on('click', function(e) {
		e.stopPropagation();
	});

	$('body').on("click", function() {
		$('body').removeClass('pg-sidebar-showshow');
	});

    /**
	 * Subscription List
	 */
	let page_user = 0;
	if($('.server_datatable').length){
		var dataTableObj = $('.server_datatable').DataTable({
			searching: true,
			processing: true,
			dom: 'lf<"table-responsive" t >ip',
			language: {
				paginate: {
					previous: `<svg class="bx--pagination__button-icon" width="7" height="12" viewBox="0 0 7 12">
									<path fill-rule="nonzero" d="M1.45 6.002L7 11.27l-.685.726L0 6.003 6.315 0 7 .726z"></path>
								</svg>`,
					next: `<svg class="bx--pagination__button-icon" width="7" height="12" viewBox="0 0 7 12">
								<path fill-rule="nonzero" d="M5.569 5.994L0 .726.687 0l6.336 5.994-6.335 6.002L0 11.27z"></path>
							</svg>`,
				},
				emptyTable: 'No data available',
				search: 'Search' + ':',
	
			},
			pageLength: 10,
			lengthMenu: [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			responsive: true,
			serverSide: { "regex": true },
			columnDefs: [{
				targets: "_all",
				orderable: false
			}],
			ajax: {
				"url": ajaxurl + $('.server_datatable').attr('data-url')+page_user,
				"type": "POST"
			} 
		});		
	}   
	// if($('#subscription_table_list_user').length){
	// 	$('#subscription_table_list_user').DataTable({
	// 		"processing": true,
	// 		"serverSide": true,
	// 		"ajax": ajaxurl + 'dashboard/subscription_view/' + page_user
	// 	});
	// } 
    
	if(!window.jQuery){
		window.location.href = ajaxurl+'/welcome';
	}
	// input Animation Script 
	if($('.pg-input-wrap').length > 0){
		$(document).on('focus', '.pg-input-wrap input', function(){
			$(this).parent().parent().addClass('pg-input-value');
		});
		$('.pg-input-wrap input').blur(function(){
			var val = $(this).val();
			if(val.length == 0){
				$(this).parent().parent().removeClass('pg-input-value');
			}
		});
		$(document).on('click', '.pg-input-wrap label', function(){
			$(this).siblings('input').focus();	
		});
	};
	$('input').each(function(){
		if ($(this).val()){
		$(this).parent().parent().addClass("pg-input-value");
		}
	});

}); 

/**
 * Load function
 */
$(window).on('load', function(){
	$('body').addClass('pg-site-loaded');
	if($('#fb_page_id').length){
		$('#fb_page_id').change();
	}
});
$(window).scroll(function() {   
	if($(window).scrollTop() + $(window).height() == $(document).height()) {
		$('.pg-load-more-btn').click();
	}
});

function add_predefind_template(template, ajaxurl, use){
	var template_name = template.template_name == '' ? 'Unnamed' : template.template_name;
	var html = '';
	html += '<div class="pg-template-box">';
		html += '<div class="pg-template-box-inner">';
			html += '<div class="pg-template-thumb">';
				html += '<img src="'+(template.thumb !=  '' ? ajaxurl + template.thumb : ajaxurl + 'assets/images/'+(template.template_size == '628x628' ? 'empty_campaign.jpg' : 'empty_campaign_long.jpg'))+'" alt="">';
				if(!use){
					html += '<a href="" class="pg-template-status" title="'+template_name+'">';
						html += '<span class="pg-template-status-center">';
							html += '<span class="pg-btn ed_open_image" data-mfp-src="'+(template.thumb !=  '' ? ajaxurl + template.thumb : ajaxurl + 'assets/images/'+(template.template_size == '628x628' ? 'empty_campaign.jpg' : 'empty_campaign_long.jpg'))+'">View Template</span>';
							html += '<span data-mfp-src="#user-prebuild-existing-template" class="pg-btn pg-popup-link" data-template_userID="'+template.user_id+'" data-get_template_id="'+template.template_id+'">Use this template</span>';
						html += '</span>';
					html += '</a>';
				}else{
					html += '<a href="'+ajaxurl+'campaign/use_template/'+template.user_id+'/'+template.template_id+'" class="pg-template-status">';
						html += '<span class="pg-template-status-center">';
							html += '<span class="pg-btn use_temp_btn">Use this template</span>';
						html += '</span>';
					html += '</a>';
				}
			html += '</div>';
			html += '<div class="pg-camp-content">';
				html += '<h3>'+template_name+'</h3>';
				html += '<p>Created at - '+template.datetime+'</p>';
			html += '</div>';
		html += '</div>';
	html += '</div>';
	return html;
}
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function checkCookie(cname) {
	var user = getCookie(cname);
	if (user != "") {
		return true;
	} else {
		return false;
	}
}
function add_template(template, t_id){
	var url = $('#base_url').val();
	var template_name = template.template_name == '' ? 'Unnamed' : template.template_name;
	var html = '';
	html += '<div class="pg-template-box ed_template_remove">';
		html += '<div class="pg-template-box-inner">';
			html += '<div class="pg-template-thumb">';
				html += '<img style="background-image:url('+url+'/'+template.thumb+')" src="'+url+'assets/images/empty.png" alt="">';
				html += '<a href="<?php echo base_url(); ?>editor/edit/'+t_id+'" class="pg-template-status">';
					html += '<span class="pg-template-status-center">';
						html += '<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 469.331 469.331" style="enable-background:new 0 0 469.331 469.331;" xml:space="preserve" width="512px" height="512px"><g><path d="M438.931,30.403c-40.4-40.5-106.1-40.5-146.5,0l-268.6,268.5c-2.1,2.1-3.4,4.8-3.8,7.7l-19.9,147.4 c-0.6,4.2,0.9,8.4,3.8,11.3c2.5,2.5,6,4,9.5,4c0.6,0,1.2,0,1.8-0.1l88.8-12c7.4-1,12.6-7.8,11.6-15.2c-1-7.4-7.8-12.6-15.2-11.6 l-71.2,9.6l13.9-102.8l108.2,108.2c2.5,2.5,6,4,9.5,4s7-1.4,9.5-4l268.6-268.5c19.6-19.6,30.4-45.6,30.4-73.3 S458.531,49.903,438.931,30.403z M297.631,63.403l45.1,45.1l-245.1,245.1l-45.1-45.1L297.631,63.403z M160.931,416.803l-44.1-44.1 l245.1-245.1l44.1,44.1L160.931,416.803z M424.831,152.403l-107.9-107.9c13.7-11.3,30.8-17.5,48.8-17.5c20.5,0,39.7,8,54.2,22.4 s22.4,33.7,22.4,54.2C442.331,121.703,436.131,138.703,424.831,152.403z" fill="#FFFFFF"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>';
					html += '</span>';
				html += '</a>';
				html += '<div class="pg-camp-options">';
					html += '<ul>';
						html += '<li><a href="" title="Share"><img src="'+url+'/'+'assets/images/icon/share.svg" alt=""><span>Share</span></a></li>';
						html += '<li><a href="" title="Duplicate" class="template_action" data-action="copy" data-template_id="'+t_id+'" ><img src="'+url+'/'+'assets/images/icon/duplicate.svg" alt=""><span>Duplicate</span></a></li>';
						html += '<li><a href="" title="Rename" data-template_id="'+t_id+'" data-template_name="'+template_name+'" ><img src="'+url+'/'+'assets/images/icon/rename.svg" alt=""><span>Rename</span></a></li>';
						html += '<li><a href="#" class="template_action" title="Delete" data-action="delete" data-template_id="'+t_id+'" ><img src="'+url+'/'+'assets/images/icon/delete.svg" alt=""><span>Delete</span></a></li>';
					html += '</ul>';
				html += '</div>';
			html += '</div>';
			html += '<div class="pg-camp-content">';
				html += '<h3>'+template_name+'</h3>';
				html += '<p>Created at - '+template.datetime+'</p>';
			html += '</div>';
		html += '</div>';
	html += '</div>';
	return html;
}
function add_campaign(campaign){
	var url = $('#base_url').val();
	var html = '';
	html += '<div class="pg-template-box pg-remove-campaigns">';
		html += '<div class="pg-template-box-inner">';
			html += '<div class="pg-template-thumb">';
				html += '<img src="'+url+'assets/images/empty_campaign.jpg" alt="">';
				html += '<a href="'+url+'campaign/i/'+campaign.insert_id+'" class="pg-template-status">';
					html += '<span class="pg-template-status-center">';
						html += '<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 469.331 469.331" style="enable-background:new 0 0 469.331 469.331;" xml:space="preserve" width="512px" height="512px"><g><path d="M438.931,30.403c-40.4-40.5-106.1-40.5-146.5,0l-268.6,268.5c-2.1,2.1-3.4,4.8-3.8,7.7l-19.9,147.4 c-0.6,4.2,0.9,8.4,3.8,11.3c2.5,2.5,6,4,9.5,4c0.6,0,1.2,0,1.8-0.1l88.8-12c7.4-1,12.6-7.8,11.6-15.2c-1-7.4-7.8-12.6-15.2-11.6 l-71.2,9.6l13.9-102.8l108.2,108.2c2.5,2.5,6,4,9.5,4s7-1.4,9.5-4l268.6-268.5c19.6-19.6,30.4-45.6,30.4-73.3 S458.531,49.903,438.931,30.403z M297.631,63.403l45.1,45.1l-245.1,245.1l-45.1-45.1L297.631,63.403z M160.931,416.803l-44.1-44.1 l245.1-245.1l44.1,44.1L160.931,416.803z M424.831,152.403l-107.9-107.9c13.7-11.3,30.8-17.5,48.8-17.5c20.5,0,39.7,8,54.2,22.4 s22.4,33.7,22.4,54.2C442.331,121.703,436.131,138.703,424.831,152.403z" fill="#FFFFFF"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>';
					html += '</span>';
				html += '</a>';
				html += '<div class="pg-camp-options">';
					html += '<ul>';
						html += '<li><a href="#ed_campaign_rename" title="Rename" class="pg-popup-link" data-campaign_id="'+campaign.insert_id+'" data-campaign_name="'+campaign.name+'"><img src="'+url+'/'+'assets/images/icon/rename.svg" alt=""><span>Rename</span></a></li>';
						html += '<li><a href="" title="Delete" class="campaign_action" data-action="delete" data-campaign_id="'+campaign.insert_id+'"><img src="'+url+'/'+'assets/images/icon/delete.svg" alt=""><span>Delete</span></a></li>';
					html += '</ul>';
				html += '</div>';
			html += '</div>';
			html += '<div class="pg-camp-content">';
				html += '<h3>'+campaign.name+'</h3>';
				html += '<p>Created at - '+campaign.datetime+'</p>';
			html += '</div>';
		html += '</div>';
	html += '</div>';
	return html;
}

function ValidURL(str) {
	regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
	if (regexp.test(str)){
	return true;
	}else{
	return false;
	}
}
function emailValidate( mail ){
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( mail )) {
		return true;
	}
	return false;
}
function search_template(ajaxurl, q){
	$('.pg-preloader-wrap').css('display','flex');
	var size = $('.pg-load-more-btn').data('size');
	var use = $('.pg-load-more-btn').data('use');
	var sub_cat_id = $('.get_template_sub_cat').val();
	var data = {'reach':0,'size':size, 'use':use, 'q':q, 'sub_cat_id':sub_cat_id};
	$.ajax({
		type:'post',
		url: ajaxurl + 'images/get_more_template',
		data:data,
		success:function(data){
			var result = jQuery.parseJSON(data);
			if(result.status){
				template_reach = result.reach;
				$('.pg-append-template-row').html('');
				var html = '';
				for( var i =0; i < result.data.length; i++ ){
					html = add_predefind_template(result.data[i], ajaxurl, use);
					$('.pg-append-template-row').append(html);
				}					
				$('.pg-preloader-wrap').hide();
				if(result.hide){
					$('.pg-load-more-btn').hide();
				}else{
					$('.pg-load-more-btn').show();
				}
				if(!result.data.length){
					html = '<div class="pg-empty-campain"> <h3>Hey there! It seems there\'s nothing to display here.</h3></div>';
						$('.pg-append-template-row').append(html);
				}
			}else{
				$.toaster(result.msg, 'Error', 'danger');
			}
		}
	});
}
