/*--------------------- Copyright (c) 2023 -----------------------
[Master Javascript]
Project: PixelPages 
Version: 1.0.0
-------------------------------------------------------------------*/

jQuery(document).ready(function () {
    "use strict";

	var autoResponderSelected = '';
    $(document).on('click', '.pxg_autoresponders', function() {

		$('#autoresponderModal').find('form').addClass('d-none');
        let autoResponderSelected = $(this).attr('id');
            $('.AR_name').html($(this).attr('value'));
            $('#autoresponderModal').modal('show');
            $('#' + $(this).attr('value')).removeClass('d-none')
	});
    $(document).on('click', '.pxg_disconnect_autoresponders', function() {        
		let autoResponderSelected = $(this).attr('value');
		confirm_popup_function(
			'Are you sure?',
			'you want to disconnect the app.',
			'remove_it(\'Ajax/disconnect_autoresponder/'+autoResponderSelected+'\')' ,
			true
		);
    });

	$(document).keydown(function(event) { 
		if (event.keyCode == 27) { 
		  $('.modal').modal('hide');
		}
	});

    $(document).on('click', '.pxg_paymentGateway,.pxg_email_settings,.pxg_frontend_settings', function() {
		console.log( 'fdfdf' )
        let targetModal = $(this).attr('data-target');
		$('#'+targetModal).modal('show');
	});

    $(document).on('click', '.pxg_disconnect_paymentGateway', function() {        
		let paymentGateway = $(this).attr('data-type');
		confirm_popup_function(
			'Are you sure?',
			'You want to disconnect the app.',
			'remove_it(\'Ajax/disconnect_paymentGateway/'+paymentGateway+'\')' ,
			true
		);
    });
    $(document).on('click', '.pxg_disconnect_emailsetting', function() {        
		let target = $(this).attr('data-type');
		confirm_popup_function(
			'Are you sure?',
			'You want to disconnect email setting.',
			'remove_it(\'AdminAjax/disconnectEmailSetting/'+target+'\')' ,
			true
		);
    });

	$('.searchTemplates').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".pxg_template_list > .pxg_template_content").filter(function() {
            $(this).toggle($(this).find('.pxg_template_title > p,h6').text().toLowerCase().indexOf(value) > -1)
        });
    });

	if (typeof WOW !== 'undefined') {

		var wow = new WOW(
				{
				boxClass:     'wow',      // default
				animateClass: 'animated', // default
				offset:       0,          // default
				mobile:       false,       // default
				live:         true        // default
			  }
		);
		wow.init();
	}
	
	// Class On Focus on inputsl
	
	$('.pxg_auth_input  input').focus(function () {
		$(this).parent().addClass('pxg_auth_input_focus');
	}).blur(function () {
		$(this).parent().removeClass('pxg_auth_input_focus');
	});

	$(".toggle-btn").click(function (e) {
		e.stopPropagation();
		$(".pxg_dashboard_section").toggleClass("sideber_open");
	});
	
	$(".pxg_dashboard_section").click(function (e) {
		e.stopPropagation();
	});
	
	$(document).on('click', "body,html",function (e) {
		$(".pxg_dashboard_section").removeClass("sideber_open");
	});
	
	$(document).on('click', ".pxg_setting_icn", function(e) {
		$('.pxg_setting_icn').not(this).next().removeClass('show');
		$(this).next().toggleClass('show');
	});
	
	$(document).on("click", 'body', function(e) {
		let dropdown = $(".pxg_template_wrapper");
		if(dropdown !== e.target && !dropdown.has(e.target).length){
			$('.pxg_setting_dropdown').removeClass('show');
		}
	});
	

});

const page = $('body').data('page');
$('.ppd_' + page).addClass('active')
let process_running = 0;



(function ($) {
	"use strict";
	var pixelpages = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {
			if (!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}
			this.loader();
			this.auth_eye();
			this.Select2();
			this.Datatable();
			this.chart();
		},
		/*-----------------------------------------------------
			Loader
		-----------------------------------------------------*/
		loader: function () {
			$(window).on('load', function () {
				$(".pxg_preloader").delay(100).fadeOut("slow").addClass('loaderout');
			});
		},
		auth_eye: function () {
            if ($('.pp_auth_eye').length > 0) {
                $(".pp_auth_eye").click(function () {
                    $(this).parent().toggleClass("active");
                    var input = $(this).parent().find("input");
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            }
        },
		Select2: function () {
			if ($('.wb_SelectBox').length > 0) {
				$('.wb_SelectBox').each(function () {
					$(this).select2({
						placeholder: $(this).attr("data-placeholder"),
						width: '100%',
						minimumResultsForSearch: -1,
						dropdownParent: $(this).parent(),
					});
				});
			}
			if ($('.js-select2').length > 0) {
				$('.js-select2').each(function () {
					$(this).select2({
						placeholder: $(this).attr("data-placeholder"),
						disabled: $(this).attr("data-disabled") != undefined ? $(this).attr("data-disabled"): false,
						width: '100%',
						dropdownParent: $(this).parent(),
					});
					if( $(this).hasClass('notCloseOnSelect') ){
						$(this).select2({
							placeholder: $(this).attr("data-placeholder"),
							disabled: $(this).attr("data-disabled") != undefined ? $(this).attr("data-disabled"): false,
							width: '100%',
							dropdownParent: $(this).parent(),
							closeOnSelect: false,
							templateResult: formatOption,
  							// templateSelection: formatOption
						})
					}
				});
				function formatOption(option) {
					if (!option.id) {
					  return option.text;
					}
				  
					return $('<span>'+option.text+' - </span><a class="option_link" target="_blank" href="'+baseurl+'admin/preview/'+option.id+'">Link</a>');
				  
				  }
				$(document).on('click', '.option_link', function (e) { e.stopPropagation(); })
			}
		},
		Datatable: function () {
			if ($('.pxg_table_wrapper').length > 0)
				$('.pxg_table_wrapper .pxg_custom_table').DataTable({
					responsive: true,
				});
		},
		chart: function () {
			if( $('#line_chart').length ){// Get a reference to the canvas element
				const lineChartCanvas = document.getElementById("line_chart").getContext("2d");
				let main_chart;
				try{
				   async function getData(site_id){
						let formData = new FormData();
						formData.append("site_id", site_id);
						formData.append("csrf_pixelpages", $('#csrf_token').val());
						
						const response = await fetch(baseurl+'ajax/showAnaylyticsGraph', {
							method: "POST",
							body: formData
						});
						const result = await response.json();
						
						 let data = {
							labels: result.last_visit,
							datasets: [
								{
								label: 'Views',
								data: result.site_visits, // Example data values
								backgroundColor: ["#ff6384", "#36a2eb", "#ffce56","#000000", "#ff0000", "#00ffff"], // Colors for each segment
								},
							],
						};

						// Define the chart configuration
						const config = {
							type: "line",
							data: data,
							options: {
								// Customize chart options here
								scales: {
									y: {
										ticks: {
											precision: 0
										}
									}
								}
							},
						};
						
				
						// Create a new Chart instance and render the chart
						main_chart = new Chart(lineChartCanvas, config);
				   }
				   
				   getData( $('.ppd_site_select').val() );

				   $(document).on('change', '.ppd_site_select', function(e){
						main_chart.destroy();
						getData( $(this).val() );
				   })

				}catch (error) {
					console.error("Error:", error);
				}
				
			}
		},

	};
	pixelpages.init();
})(jQuery);

function readURL(input) {
	if (input.files && input.files[0]) {
		var order = "";
		if ($(input).data("contenttype") === undefined) var contenttype = "img";
		else {
			var contenttype = $(input).data("contenttype");
			order = $(input).data("order");
		}

		var imgName = input.files[0].name;
		if ($(input).hasClass("sizevalidation")) {
			var imgSize = input.files[0].size;
			var maxSize = $(input).data("size") * 1000000;
			if (imgSize > parseInt(maxSize)) {
				$(input).addClass("error").focus();
				showNotifications(
					"error",
					"There is an upload limit. Please, try again."
				);
				return false;
			}
		}
		if (contenttype == "img") {
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			var extErrorMessage =
				"Please, upload image with JPG, JPEG or PNG extension.";
		} else if (contenttype == "video") {
			var allowedExtensions = /(\.mp4)$/i;
			var extErrorMessage =
				"Please, upload video file with MP4 extension.";
		} else if (contenttype == "audio") {
			var allowedExtensions = /(\.mp3)$/i;
			var extErrorMessage =
				"Please, upload audio file with MP3 extension.";
		} else if (contenttype == "zip") {
			var allowedExtensions = /(\.zip)$/i;
			var extErrorMessage =
				"Please, upload downloadable zip file with ZIP extension.";
		}

		if (!allowedExtensions.exec(input.files[0].name)) {
			$(input).addClass("error").focus();
			showNotifications("error", extErrorMessage);
			return false;
		}

		var reader = new FileReader();
		reader.onload = function (e) {
			let name = input.getAttribute("name");
			if (contenttype == "img") {
				$("#" + name + "_img").attr("src", e.target.result);
				if ($("#display_" + name).length > 0)
					$("#display_" + name).attr("src", e.target.result);
			} else {
				let randomNum = Math.floor(Math.random() * 1000000 + 1);
				let ext =
					contenttype == "video"
						? ".mp4"
						: contenttype == "audio"
							? ".mp3"
							: ".zip";
				$("." + contenttype + "Progress_" + order).removeClass(
					"d-none"
				);
				ProcessUpload(
					input.files[0],
					"user_data/" + contenttype + randomNum + ext,
					contenttype,
					order
				)
					.then(function (data) {
						$(
							'input[name="' +
							contenttype +
							"Content_s3_" +
							order +
							'"]'
						).val(data.Location);
						$("." + contenttype + "Progress_" + order).addClass("d-none");
						$('label[for="' + contenttype + 'Content_' + order + '"]').children(".mo_file_btn").addClass("uploadDone");
						$('label[for="' + contenttype + 'Content_' + order + '"]').children(".mo_file_btn").text("Uploaded");
						showNotifications("success", "Uploaded Successfully.");
					})
					.catch(function (err) {
						setTimeout(() => {
							showNotifications("error", err);
						}, 500);
					});
				$("#showname_" + name).text(imgName);
			}
		};
		reader.readAsDataURL(input.files[0]);
	}
}

$('.imgUploadSection').change(function() {
    let _this = $(this).find('input[type="file"]');
    let imgPreview = $(this).find('img');
    let getPreview = $(this).find('input[type="hidden"]').val();
    let originalImg = getPreview ? baseurl + getPreview : '';
    var allowedTypes = _this.data("img-types");
    var img = _this[0].files[0];
    if (getPreview!==undefined && getPreview.startsWith(baseurl)) {
        originalImg = getPreview.substring(baseurl.length);
    }
    if (_this[0].files && img) {
        if (img.size > _this.data("img-size") * 1024 * 1024) {
            showNotifications("error", "File size should not exceed " + _this.data("img-size") + " MB");
            _this.val('');
            _this.siblings('p').text('file name');
            imgPreview.attr('src', originalImg);
            return false;
        }
        if (allowedTypes.indexOf(img.type) === -1 || allowedTypes.indexOf(img.type) === 0) {
            const imageTypes = JSON.parse(allowedTypes.replace(/'/g, '"'));
            var typeError = imageTypes.map(function(type) {
                return type.replace('image/', '');
            }).join(', ');
            showNotifications("error", "File type not matched with " + typeError);
            _this.val('');
            _this.siblings('p').text('file name');
            imgPreview.attr('src', originalImg);
            return false;
        }
        var reader = new FileReader();
        var imgWidth = _this.data("img-width");
        var imgHeight = _this.data("img-height");
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                if (this.width > imgWidth && this.height > imgHeight) {
                    showNotifications('error', 'Image width & height should be ' + imgWidth + 'x' + imgHeight);
                    _this.val('');
                    _this.siblings('p').text('file name');
                    imgPreview.attr('src', originalImg);
                    return false;
                }
            };
        };
        reader.readAsDataURL(img);
    }
});

/* Reset Form */
let resetModal = function(form_class_or_id){
    $(form_class_or_id)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", false)
       .end()
	.find("select")
	   .val('').trigger('change')
	   .end();
}


$(document).on("click", '[data-action="submitMe"]', (e) => {
	e.preventDefault();
	let _this = $(e.target);
	let btntxt = _this.html();
	_this
		.html('<span class="sc_wait_pro">Processing...</span>')
		.prop("disabled", true);
	let myForm = $("#" + _this.data("form"));
	checkValidation(myForm)
		.then(() => {
			let dataForm = document.getElementById(myForm.attr("id"));
			let posturl  = myForm.data("posturl");
			var obj = new FormData(dataForm);
			myForm.data('fileurl') != undefined ? obj.append("mediaurl", myForm.data("fileurl")) : '';
			initiateAjaxRequest(posturl, obj, (resp) => {
				setTimeout(() => {
					_this.html(btntxt).prop("disabled", false);
				}, 3000);
			});
			return false;
		})
		.catch((message) => {
			_this.html(btntxt).prop("disabled", false);
			showNotifications("error", message);
		});
});

function checkValidation(form) {
	return new Promise((resolve, reject) => {
		$(".require").removeClass("error");
		form.find("input , textarea , select").each(function () {
			let _this = $(this);
			if (_this.hasClass("require") && $.trim(_this.val()) == "") {
				_this.addClass("error").focus();
				reject(
					_this.data("error")
						? _this.data("error")
						: "You have missed out some required fields"
				);
				return false;
			}
			if (_this.hasClass("numeric") && isNaN($.trim(_this.val()))) {
				_this.addClass("error").focus();
				reject(
					_this.data("error")
						? _this.data("error")
						: "Please, enter numeric value only."
				);
				return false;
			}
			if (_this.hasClass("notzero") && _this.val() == 0) {
				_this.addClass("error").focus();
				reject(
					_this.data("error")
						? _this.data("error")
						: "Please, enter value other than zero."
				);
				return false;
			}
			if (_this.hasClass("not_Same")) {
				if ($(_this.data('field1')).val() == $(_this.data('field2')).val()) {
					showNotifications('error', _this.data('error'))
					reject(
						_this.data("error")
							? _this.data("error")
							: "Fields cannot be same"
					);
					return false;
				}
			}
			if (_this.hasClass("is_minimum")) {
				if (_this.data('min_value') > _this.val()) {
					showNotifications('error', _this.data('error'))
					reject(
						_this.data("error")
							? _this.data("error")
							: "Fields cannot be same"
					);
					return false;
				}
			}
			if (_this.hasClass("m_length_w")) { /* Maximum/Minimum length Words Split */
				if (_this.data('max_l') < _this.val().split(' ').length) {
					showNotifications('error', 'The '+_this.data('fieldname')+' cannot be more than '+_this.data('max_l')+' characters')
					reject(
						'The '+_this.data('fieldname')+' cannot be more than '+_this.data('max_l')+' characters'
					);
					return false;
				}
				if (_this.data('min_l') >= _this.val().split(' ').length) {
					showNotifications('error', 'The '+_this.data('fieldname')+' cannot be less than '+_this.data('min_l')+' characters')
					reject(
						'The '+_this.data('fieldname')+' cannot be less than '+_this.data('min_l')+' characters'
					);
					return false;
				}
			}
			if (_this.hasClass("m_length_n")) {  /* Maximum/Minimum length numbers */
				if (_this.data('max_l') < _this.val().length) {
					showNotifications('error', 'The '+_this.data('fieldname')+' cannot be more than '+_this.data('max_l')+' characters')
					reject(
						'The '+_this.data('fieldname')+' cannot be more than '+_this.data('max_l')+' characters'
					);
					return false;
				}
				if (_this.data('min_l') > _this.val().length) {
					showNotifications('error', 'The '+_this.data('fieldname')+' cannot be less than '+_this.data('min_l')+' characters')
					reject(
						'The '+_this.data('fieldname')+' cannot be less than '+_this.data('min_l')+' characters'
					);
					return false;
				}
			}
			if (_this.hasClass("valid_email")) {
				if ( !isValidEmailAddress(_this.val()) ) {
					showNotifications('error', 'Please Enter a valid email address')
					reject(
						'Please Enter a valid email address'
					);
					return false;
				}
			}
			if (_this.hasClass("no_space")) {
				if ( hasWhiteSpace(_this.val()) ) {
					reject(
						'Please remove spaces from host name'
					);
					return false;
				}
			}
			if (_this.hasClass("valid") && $.trim(_this.val()) != "") {
				let email =
					/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
				let url =
					/(http|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
				let subdomain = /^[a-zA-Z0-9][a-zA-Z0-9.-]+[a-zA-Z0-9]$/;
				let valid = _this.attr("data-valid");
				if (valid !== undefined) {
					if (!eval(valid).test(_this.val().trim())) {
						_this.addClass("error").focus();
						reject(
							_this.data("error")
								? _this.data("error")
								: "Please enter a valid " + valid
						);
						return false;
					}
				}
			}
		});
		resolve();
	});
}

function hasWhiteSpace(s) {
	return /\s/g.test(s);
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

function initiateAjaxRequest(posturl, obj, cb = null) {
	if(process_running != 0){
		return false
	}
	    
// if( limitAccess(posturl) ){
// 	    alert('This will work after purchase')
// 	    if (cb) {
// 			cb({});
// 		}
// 	    return false;
// 	}
	
	obj.append('csrf_pixelpages', $('#csrf_token').val())
	processStatus(true)
	$.ajax({
		url: baseurl + posturl,
		type: "POST",
		data: obj,
		contentType: false,
		cache: false,
		processData: false,
		success: function (resp) {
			handleResponse(resp);
			if (cb) {
				cb(resp);
			}
		}
	});
}

// function limitAccess(url){
//     const urls = [ "AdminAjax/addSmtpSettings", "authenticate/verifyLogin", "ajax/addDfyTemplateDataToMyTemplates", "ajax/deleteMyTemplate", "ajax/getMyTemplateById", "ajax/cloneUserTemplate", "Ajax/loadDfyTemplates", "Ajax/loadMyTemplates", "ajax/addUpdateMyTemplate", "Ajax/loadTemplatesOfPlan", "AdminAjax/getPlanInfoById", "AdminAjax/createUpdatePlan", "AdminAjax/loadTemplatesForPlanAdd", "ajax/getTemplateZipById", "ajax/deleteTemplate", "AdminAjax/addPrivacyPolicy", "AdminAjax/addTermsConditions", "AdminAjax/addSiteSettings", "authenticate/verifySignUp", "ajax/addUpdateUserProfile", "AdminAjax/getUserInfoById", "AdminAjax/createUpdateUser"];
//     if( !urls.includes(url) )
//         return true;
//     return false;
// }

function handleResponse(resp) {
	let response = JSON.parse(resp);
	processStatus(false, response.redirect)
	if (response.message)
		showNotifications(response.status, response.message);

	if (response.html)
		$(response.targetElement).html(response.html);
	else if (response.singlevalue)
		$(response.targetElement).val(response.singlevalue);
	else if (response.bottext)
		showBotAnswers(response.bottext)
	else if (response.datatable) {
		var $lmTable = $("#" + response.datatable).dataTable({ bRetrieve: true });
		$lmTable.fnDraw();
		$('.modal').modal('hide');
	}
	else if (response.form) {
		let formDataArray = JSON.parse(response.formData);
		$(response.form).find("input , textarea , select").each(function () {
			let _this = $(this);
			if (_this.prop("nodeName") == "SELECT")
				_this
					.val(formDataArray[_this.attr("name")])
					.trigger("change");
			else {
				if (_this.prop("type") == "radio")
					_this.val(formDataArray[_this.attr("name")]);
				else if (_this.prop("type") == "checkbox")
					_this.prop('checked', parseInt(formDataArray[_this.attr("name")]));

				else _this.val(formDataArray[_this.attr("name")]);
			}
		});
		if (response.openModal)
			$(response.openModal).modal('show');

	} else if (response.resetCheckbox) {
		$(response.resetCheckbox).prop("checked", false);
		if (response.redirect == "close") $(".modal").modal("hide");
	} else {
		setTimeout(function () {
			if (response.redirect == "reload"){location.reload(); $(".modal").modal("hide"); } 
			else if (response.redirect == "close") $(".modal").modal("hide");
			else if (response.redirect.charAt(0) == "/") {
				window.location.href = baseurl + response.redirect.substring(1);
				if (response.redirect.search("#") > 0) location.reload();
			}
		}, 3000);
	}
}

function showNotifications(type, message) {
	$(".pxg_notification_icon").find('.'+type).removeClass('d-none').siblings().addClass('d-none');
	let alert = type == 'success'? 'Great Success!' : 'Oh no! Error';
	$('.pxg_notification_msg.msg').find('h4').text(alert).siblings('p').text(message)
	$(".pxg_notification").addClass(type);
	setTimeout(function () {
		$(".pxg_notification").removeClass(type);
	}, 4000);
}

function confirm_popup_function(text, subtext, functions, delete_ = false) {
	$('#conf_title').text(text);
	$('#conf_text').text(subtext);
	if (delete_ == true) 
		$('.confirm_del_icon').removeClass('d-none') 
	else
		$('.confirm_del_icon').addClass('d-none') 

	$('#conf_btn').show().attr('onclick', functions).text('Confirm');
	$('#pxg_confirm_model').modal('show');
}

$(document).on('click', '#conf_btn', function(e){
	$(this).text('Processing...').attr('onclick', '')
})

function upgrade_modal(modal_id_or_class, titletext, actiontext, show = false) {
	$(modal_id_or_class).find('.title_rename').text(titletext)
	$(modal_id_or_class).find('.action_rename').text(actiontext)
	if(show == true)
		$(modal_id_or_class).modal('show')
}

function remove_it(keey, id, metadata = '') {
	let formData = new FormData();
	formData.append('uniq_id', id);
	if (metadata != '')
		formData.append('meta_data', metadata)
	initiateAjaxRequest(keey, formData);
}

function change_modal_title_action(titleclass, actionclass, titletext, actiontext) {
	$(titleclass).text(titletext);
	$(actionclass).text(actiontext);
}

$(document).ready(function () {
	let active_class = $('.wb_get_active_sidebar').attr('data-active');
	$('.wb_' + active_class).addClass('active')
});

function validateImage(input, maxWidth, maxHeight) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var image = new Image();
			image.onload = function () {
				// check image dimensions
				if (image.width > maxWidth || image.height > maxHeight) {
					showNotifications("error", "Image dimensions should be within " + maxWidth + " x " + maxHeight);
					return;
				}
				readURL(input)
			};
			image.onerror = function () {
				showNotifications("error", "Image is invalid");
			};
			image.src = e.target.result;
		};
		reader.readAsDataURL(input.files[0]);
	}
}

$(document).on('click', '.wb_select-all', function (e) {
	if ($(this).prop('checked')) {
		$('.chkLeads').removeClass('d-none');
		$($(this).data('checkfields')).prop('checked', true)
	}
	else {
		$('.chkLeads').addClass('d-none');
		$($(this).data('checkfields')).prop('checked', false)
	}
})


// search for all tables containing class .pp_search_table
$(document).on('keyup', '.ad_datatableSearch', function () {
	var table = $(".pxg_table_wrapper .pxg_custom_table").DataTable();
	table.search($(this).val()).draw();
})

let toggle = localStorage.getItem('menu');
if(toggle == undefined)
	localStorage.setItem('menu', 'open')

if (toggle == 'open') {
	$('body').removeClass('menu_toggle')
}else{
	$('body').addClass('menu_toggle')
}

$(document).on('click', '.wb_toggle_btn', function(){
	let menu = localStorage.getItem('menu');
	if (menu == 'open')
		localStorage.setItem('menu', 'closed')
	else
		localStorage.setItem('menu', 'open')

})

function isEmpty( el ){
	return !$.trim(el.html())
}

function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}

$('#copyButton').click(function() {
    var inputValue = $('#inputField').val();
	var _this = this;
    navigator.clipboard.writeText(inputValue)
      .then(function() {
        $(_this).text('Copied');
		setTimeout(() => {
			$(_this).text('Copy')
		}, 2000)
      })
      .catch(function(error) {
        console.error('Unable to copy to clipboard:', error);
      });
  });

/* Edit Profile */
$(document).on('click', '.ppa_editProfileBtn', function(e){
    $('.ppa_saveProfileBtn, .profile_img_upload').removeClass('d-none')
    $('.editable').attr('disabled', false)
    $("#ppa_profileCountrySelect2").select2({disabled: false});
})

// =============================
	// Tab Script
// =============================
var tabLinks   = document.querySelectorAll(".tablinks");
var tabContent = document.querySelectorAll(".tabcontent");

tabLinks.forEach(function(el) {
	el.addEventListener("click", openTabs);
});

function openTabs(el) {
	var btnTarget = el.currentTarget;
	var country = btnTarget.dataset.country;

	tabContent.forEach(function(el) {
		el.classList.remove("active");
	});

	tabLinks.forEach(function(el) {
		el.classList.remove("active");
	});
	document.querySelector("#" + country).classList.add("active");
	
	btnTarget.classList.add("active");
}

function copyText1(inputValue){
	if (!navigator.clipboard) return
    navigator.clipboard.writeText(inputValue)
      .then(function() {
        showNotifications('success', 'Link Copied')
      })
      .catch(function(error) {
        console.error('Unable to copy to clipboard:', error);
      });
}


function processStatus( status, redirect = '' ){
	$('.loader_outter,.loader_inner').removeClass('d-none') 
	$(window).scroll(function(){
		$('.loader_outter,.loader_inner').addClass('d-none')
	})
	if( status == true ){ // stop api propogation
		process_running ++;
		$(".request_loader").removeClass('hidden_loader');
	}else{
		if( redirect != '' ){
			setTimeout(() => { process_running = 0 }, 3000)
		}else{
			process_running = 0;
		}
		$(".request_loader").delay(100).fadeOut("slow").addClass('hidden_loader');
	}
}

$(document).on("click", '.already_plan_purchased', function(e) {
	showNotifications("error", "Plan already purchased");
});

$(document).on("click", '.purchase_free_plan', function(e) {
	var user_id = $(this).attr('user-id');
	$.ajax({
        url: baseurl + "payment/purchase_free_plan/" + user_id,
        type: "GET",
        dataType: "JSON",
        processData: false,
        success: function(data) {
            showNotifications(data.status, data.message);
            if(data.redirect=='reload')
             setTimeout(function() { window.location.reload(); }, 2000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showNotifications("error", "Failed to purchased");
        }
    });
});