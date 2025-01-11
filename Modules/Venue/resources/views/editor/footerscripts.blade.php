<script>

	(function ($) {



	"use strict";

	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
   
	var PixelPages = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {
			if (!this.initialised) {
				this.initialised = true;
			}
			else {
				return;
			}
			/*-------------- PixelPages Design Functions Calling-------------------*/
			this.list_radio();
			this.Quantity_no();
			this.niceselect();
			this.PriceRange();
			this.check_image();
			this.mt_checkbox_toggle();
			this.editor_common_codes();
			// 105 drag and drop
			this.sortableSection();
		},

		/*-------------- PixelPages Design Functions Calling ------------------------*/

		// Range Slider start
		PriceRange: function () {
			if ($('.mt_range_slider').length > 0) {
				$(function () {
					$("#slider-range").slider({
						range: true,
						min: 0,
						max: 100,
						values: [0, 80],
						slide: function (event, ui) {
							$("#amount").text(ui.values[1] + "%");
						}
					});
					$("#amount").text($("#slider-range").slider("values", 1) + "%");
				});
			}
		},
		// Range Slider End

		// Sidebar Toggle 
		Sidebar_toggle: function () {
			$(document).on("hover", ".mt_sidebar_manu", function () {
				$(".mt_sidebar_main").toggleClass('open_menu');
			});
		},
		// Sidebar Toggle 






		// Audio Radio js
		list_radio: function () {
			$(document).on('click', '.mt_user_radio', function () {
				$('.active2').removeClass('active2');
				$(this).addClass('active2').find('input').prop('checked', true)
			});
			$(document).on('click', '.mt_radio_user2', function () {
				$('.active_three').removeClass('active_three');
				$(this).addClass('active_three').find('input').prop('checked', true)
			});

		},
		// Audio Radio js

		// check img js
		check_image: function () {
			$(document).on('click', '.mt_user_check', function () {
				$('.active_inout').removeClass('active_inout');
				$(this).addClass('active_inout').find('input').prop('checked', true)
			});
			$(document).on('click', '.mt_check_user2', function () {
				$('.active_check').removeClass('active_check');
				$(this).addClass('active_check').find('input').prop('checked', true)
			});

		},
		// check img js


		// Quantity js start
		Quantity_no: function () {
			var quantity = 0;
			$(document).on('click', '.quantity_plus', function (e) {
				e.preventDefault();
				var quantity = parseInt($(this).siblings('.quantity').val());
				$(this).siblings('.quantity').val(quantity + 1);

			});
			$(document).on('click', '.quantity_minus', function (e) {
				e.preventDefault();
				var quantity = parseInt($(this).siblings('.quantity').val());
				if (quantity > 0) {
					$(this).siblings('.quantity').val(quantity - 1);
				}
			});
		},
		// Quantity js End		


		// checkbox toggle js
		mt_checkbox_toggle: function () {
			$(document).on('click', "input:checkbox", function () {
				var $box = $(this);
				if ($box.is(":checked")) {
					var group = "input:checkbox[name='" + $box.attr("name") + "']";
					$(group).prop("checked", false);
					$box.prop("checked", true);
				} else {
					$box.prop("checked", false);
				}
			});
		},
		// checkbox toggle js
		niceselect: function () {
			/*Nice Select*/
			if ($('select').length > 0) {
				$('select').niceSelect();
			}
			/*Nice Select*/
		},
		// 105 drag and drop
		sortableSection: function () {
			$.each($(".mt_edit_template_container").children(), function () {
				if ($(this).attr('id') == undefined) {
					$(this).attr('id', generateRandom(16));
				}
			});
			$(".mt_edit_template_container").sortable().disableSelection();
		},
		editor_common_codes: function () {

			// Get the original color codes in element's attributes
			$('.editableElement').each(function (i, obj) {
				$(this)
					.attr('data-og-fg-color', $(this).css('color'))
					.attr('data-og-bg-color', $(this).css('background-color'))
					.attr('data-df-font', $(this).css('font-family'))

				$(this)
					.attr('onmouseover', "this.style.color=this.getAttribute('data-hfg-color'); this.style.backgroundColor =this.getAttribute('data-hbg-color');")
					.attr('onmouseout', "this.style.color=this.getAttribute('data-og-fg-color'); this.style.backgroundColor=this.getAttribute('data-og-bg-color')");
			});

			$(document).on("click", '.close_editor', function(){
				$(this).parent().removeClass("open_editor");
				$('.mt_main_structure').addClass('mt_hide_sidebar')
			});

			$(document).on("click", '.mt_editor_toggle', function(){
				$(".editorMenus").children("li").each(function () {
					if ($(this).hasClass("active"))
						$(this).children("a").trigger("click");
				});
			});

			$(document).on("click",'.editableElement',function(event){

				// 105 add random id attribute
				if (!$(this).attr('id')) {
					$(this).attr('id', generateRandom(16));
				}

				$('.mt_bgtempconatainer').removeClass("active");
				$('.mt_main_structure').removeClass('mt_hide_sidebar')
				event.stopPropagation(event)
				event.preventDefault();
				var elem = $(this).data('kindoff');

				if (elem == 'text') {
					checkTextSidebarOptions($(this))
					manage_text_editor($(this));
				}
				if (elem == 'form') {
					manage_form_editor($(this));
				}
				if (elem == 'div') {
					manage_div_editor($(this));
				}
				if (elem == 'image') {
					checkImageLink(this)
					load_media_library('image_src');
				}
				$('.editableElement').removeClass('editableElementActive');
				// 105 unchecked hide switch
				$('.hideSection').prop('checked', false);
				$(this).addClass('editableElementActive');


				$(".mt_sidebar_editor").addClass("mt_hide");
				$("#" + elem + "_editor").removeClass("mt_hide");
				$("#" + elem + "_editor").addClass("open_editor");
			});

			$(document).on("click", '.mt_photo_content_main input', function(event){
				event.stopPropagation(event)
				event.preventDefault();
				$('#form_editor #settings-tab').trigger('click');
				$('#form_editor #Content-tab').closest('.nav-item').addClass('mt_hide');
				$('#form_editor #appearance-tab').closest('.nav-item').addClass('mt_hide');

				$(".mt_sidebar_editor").addClass("mt_hide");
				$("#form_editor").removeClass("mt_hide").addClass("open_editor");



			});

			function checkImageLink(_this) {
				let check_anchor = $(_this).parent().is('a.editableElement[data-kindoff="text"]')
				if (check_anchor) {
					$('.mt_edit_image_link').removeClass('mt_hide')
					let select_anchor = $(_this).parent();
					$(document).on('keyup', '.imageoptions_href', function (e) {
						select_anchor.attr('href', $(this).val())
					})
				} else {
					$('.mt_edit_image_link').addClass('mt_hide')
				}
			}

			function checkTextSidebarOptions(_this) {
				var hasChild = _this.children().length > 0;

				if (hasChild && _this.attr("href") != undefined) {
					$('.mt_for_txt').addClass('mt_hide')
				} else {
					$('.mt_for_txt').removeClass('mt_hide')
				}

				if (_this.attr("href") != undefined) {
					var href = _this.attr("href");
					$('.textoptions_href').val(href)
					$('.textoptions_href').closest('.mt_select_editor').removeClass('mt_hide')

				} else {
					$('.textoptions_href').closest('.mt_select_editor').addClass('mt_hide')
				}

			}

			$(document).on('click', '.close_editor', function (e) {
				e.stopPropagation()
				$('.mt_sidebar_editor').addClass('mt_hide')
			})

			$(document).on("change", '#textoptions_font_family', function() {
			    var new_css = $(this).val();
			    var value = $(this).val();
			    var selected = $(this).find('option:selected');
			    var fonttype = selected.data('fonttype');
			    new_css = "'" + new_css + "' ," + fonttype;
			    new_css = new_css.replace("_", " ");
			    if (value == 'default') {
			        $('.editableElementActive').css('font-family', $('.editableElementActive').data('df-font'))
			    } else {
			        var get_ff_url = "https://fonts.googleapis.com/css?family=" + (value.substring(0, 1).toUpperCase() + value.substring(1)).replace(/ /g, '+');
			        if ($("link[href*='" + get_ff_url + "']").length === 0) {
			            var fontLink = $("<link>", {
			                rel: "stylesheet",
			                type: "text/css",
			                href: get_ff_url,
			            });
			            $(fontLink).insertAfter(".mt_edit_template_container title");
			        }
			        $('.editableElementActive').css('font-family', new_css);
			    }
			});

			$(document).on("change", '#textoptions_font_size', function(){
				$('.editableElementActive').css('font-size', $(this).val() + 'px');
				$(this).siblings('.range-slider__value').text($(this).val() + 'px')
			});
			$(document).on("change", '#textoptions_font_weight', function(){
				$('.editableElementActive').css('font-weight', $(this).val());
			});
			$(document).on("change", '#textoptions_opacity', function(){
				$('.editableElementActive').css('opacity', $(this).val());
			});
			$(document).on("keyup", 'textarea.textoptions_textarea', function(){
				$('.editableElementActive').html($(this).val().replace(/(?:\r\n|\r|\n)/g, "<br>"));
				let counter_attr = $('.editableElementActive').attr('data-to')
				if (typeof counter_attr !== 'undefined' && counter_attr !== false) {
					$('.editableElementActive').attr('data-to', $(this).val().replace(/(?:\r\n|\r|\n)/g, "<br>"))
				}
			});
			$(document).on("keyup", 'input.textoptions_href', function(){
				$('.editableElementActive').attr('href', $(this).val());
			});
			$(document).on("click", 'ul.textoptions_top li', function(){
				var top_type = $(this).data('type');
				if (top_type == 'underline' || top_type == 'line-through') {
					var textdecoration = $('.editableElementActive').css("text-decoration").trim();
					if ($(this).hasClass('active')) {
						$('ul.textoptions_top li.underline , ul.textoptions_top li.line-through').removeClass('active');
						$('.editableElementActive').css("text-decoration", 'none');
						$(this).removeClass('active');
					} else {
						$('ul.textoptions_top li.underline , ul.textoptions_top li.line-through').removeClass('active');
						$('.editableElementActive').css("text-decoration", top_type);
						$(this).addClass('active');
					}
				} else if (top_type == 'left' || top_type == 'right' || top_type == 'center') {
					var textalign = $('.editableElementActive').css("text-align").trim();
					if ($(this).hasClass('active')) {
						$('ul.textoptions_top li.left , ul.textoptions_top li.center , ul.textoptions_top li.right').removeClass('active');
						$('.editableElementActive').css("text-align", 'center');
						$(this).removeClass('active');
					} else {
						$('ul.textoptions_top li.left , ul.textoptions_top li.center , ul.textoptions_top li.right').removeClass('active');
						$('.editableElementActive').css("text-align", top_type);
						$(this).addClass('active');
					}
				} else if (top_type == 'italic') {

					var fontstyle = $('.editableElementActive').css("font-style").trim();
					if ($(this).hasClass('active')) {

						$('.editableElementActive').css("font-style", 'normal');
						$(this).removeClass('active');
					} else {

						$('.editableElementActive').css("font-style", top_type);
						$(this).addClass('active');
					}
				}
			});


			$(document).on("click", '.textoptions_linkupdate', function(){
				var links = $('input.textoptions_btnlink').val();

				var valid = /^(http|https):\/\/[^ "]+$/.test(links);
				if (valid) {
					$('.editableElementActive').attr('href', links);
					showNotifications('success', 'Yahh!!|Link updated successfully');
				} else {
					showNotifications('error', 'Oops|Please enter valid url with http/https');
				}


			});

		}

	};
	PixelPages.init();

	function manage_text_editor(thiss) {
		var text_element = thiss;
		$("textarea.textoptions_textarea").val(text_element.text().trim().replace(/\s+/g, ' '));
		let counter_attr = text_element.attr('data-to')
		if (typeof counter_attr !== 'undefined' && counter_attr !== false) {
			$("textarea.textoptions_textarea").val(counter_attr.trim().replace(/\s+/g, ' '))
		}
		if (text_element.css("font-family") != 'none') {
			var fontfamily = text_element.css("font-family").trim();
			fontfamily = fontfamily.replace(/,|'|sans-serif|"|cursive|monospace/g, '').trim();
			fontfamily = fontfamily.replace(" ", "_");
			fontfamily = fontfamily.replace("-", "_");
			fontfamily = fontfamily.toLowerCase();

			let serach = 0
			$("#textoptions_font_family > option").each(function () {
				if (fontfamily == this.value) {
					serach++;
				}
			});
			if (serach == 0) {
				text_element.data('df-font', fontfamily)
				fontfamily = 'default';
			}

			$('#textoptions_font_family').val(fontfamily).niceSelect('update');
		}
		if (text_element.css("font-size") != 'none') {
			var fontsize = text_element.css("font-size").trim();
			$('#textoptions_font_size').val(parseInt(fontsize)).siblings('.range-slider__value').text(fontsize);
		}
		if (text_element.css("font-weight") != 'none') {
			var fontweight = text_element.css("font-weight").trim();
			$('#textoptions_font_weight').val(fontweight).niceSelect('update');
		}
		if (text_element.css("opacity") != 'none') {
			var opacity = text_element.css("opacity");
			$('#textoptions_opacity').val(opacity).siblings('.range-slider__value').text(opacity);
		}
		if (text_element.css("color") != 'none') {

			var color = text_element.attr('data-og-fg-color');
			$('#textoptions_color').val(color);
			inilizecolorPicker('textoptions_color', 'txtcolor');
		}
		if (text_element.css("color") != 'none') {

			var color_hv = text_element.css("color");

			$('#textoptions_color_hv').val(color_hv);
			inilizecolorPicker('textoptions_color_hv', 'colorhv');
		}


		/* ------- */

		var background_color = text_element.attr("data-og-bg-color");

		$('#textoptions_bgcolor').val(background_color);
		inilizecolorPicker('textoptions_bgcolor', 'txtbgcolor');

		var background_color_hv = text_element.css("background-color");

		$('#textoptions_bgcolor_hv').val(background_color_hv);
		inilizecolorPicker('textoptions_bgcolor_hv', 'bgcolorhv');

		$('ul.textoptions_top li').removeClass('active');
		var fontstyle = text_element.css("font-style").trim();
		if (fontstyle == 'italic') {
			$('ul.textoptions_top li.italic').addClass('active');
		}
		var textdecoration = text_element.css("text-decoration").trim();
		var textdecorationArr = textdecoration.split(" ");
		if ($.inArray("underline", textdecorationArr) != -1) {
			$('ul.textoptions_top li.underline').addClass('active');
		}
		if ($.inArray("line-through", textdecorationArr) != -1) {
			$('ul.textoptions_top li.line-through').addClass('active');
		}

		var textalign = text_element.css("text-align").trim();
		$('ul.textoptions_top li.' + textalign).addClass('active');


		if (text_element.hasClass('data_btn')) {
			$('.textoptions_btnlink').val(text_element.attr('href'));
			$('.md_textoptions_btnlink').removeClass('mt_hide');
		} else {
			$('.md_textoptions_btnlink').addClass('mt_hide');
		}




	}

	function manage_div_editor(thiss) {
		var text_element = thiss;

	}

	function manage_form_editor(thiss) {
		var mt_editSvg = $('.mt_editSvg').html();
		var mt_deleteSvg = $('.mt_deleteSvg').html();
		var input_html = '';
		thiss.find('.mt_form_input').each(function () {
			var ids = $(this).attr('id');
			var placeholder = $(this).find('input , textarea').attr('placeholder');
			input_html += '<div class="mt_input_edit"><ul><li><input type="text" placeholder="' + placeholder + '"/></li><li><a href="javascript:;" class="edit_right_fields" data-id="' + ids + '">' + mt_editSvg + '</a></li><li><a href="javascript:;" class="delete_right_fields" data-id="' + ids + '">' + mt_deleteSvg + '</a></li></ul></div>';

		});

		$('.mt_right_form_fields').html(input_html);
		$('.mt_textfiled_editor.mt_add_fields').addClass('mt_hide');
		$('.mt_detail_formfields').removeClass('mt_hide');


		var forminputbordercolor = thiss.find('.mt_form_input').css('border-color');
		$('#forminputbordercolor').val(forminputbordercolor);
		inilizecolorPicker('forminputbordercolor', 'forminputbordercolor');
		var forminputbgcolor = thiss.find('.mt_form_input').css('background-color');
		$('#forminputbgcolor').val(forminputbgcolor);
		inilizecolorPicker('forminputbgcolor', 'forminputbgcolor');
		var formlabelcolor = thiss.find('.mt_form_input').find('label').css('color');
		$('#formlabelcolor').val(formlabelcolor);
		inilizecolorPicker('formlabelcolor', 'formlabelcolor');

		if ($(thiss).find('.mt_form_input').length > 0) {  // more than one field
			$('#Content').addClass('active show')
			$('#settings').removeClass('active show')
			// $('#settings-tab').removeClass('active').parent().addClass('d-none')
			$('#Content-tab').addClass('active').parent().removeClass('d-none')
			$('#appearance-tab').removeClass('active').parent().removeClass('d-none')
			// $('.mt_tabs_setting').not(".mt_tabs_setting2").addClass('d-none');

		} else {
			$('#Content').removeClass('active show')
			$('#settings').addClass('active show')
			$('#settings-tab').addClass('active').parent().removeClass('d-none')										// single field
			$('#Content-tab, #appearance-tab').removeClass('active').parent().addClass('d-none')
			$('.mt_tabs_setting').removeClass('d-none')
		}

		var formbtnbgcolor = $('.mtdefaultformbtn').css('background-color');


		$('#formbtnbgcolor').val(formbtnbgcolor);
		inilizecolorPicker('formbtnbgcolor', 'formbtnbgcolor');
		var formbtncolor = $('.mtdefaultformbtn').css('color');
		$('#formbtncolor').val(formbtncolor);
		inilizecolorPicker('formbtncolor', 'formbtncolor');

		setTimeout(() => {
			$('#formbtntxtfields_keyup').val($('.editableElementActive').find('.mtdefaultformbtn').text().trim());
		}, 500);

	}

	$(document).on('keyup', '#formbtntxtfields_keyup', function () {
		$('.editableElementActive .mtdefaultformbtn').text($(this).val())
	});

	function inilizecolorPicker(elementid, elementType) {
		$('#' + elementid).spectrum({
			appendTo: '.wrapper',
			preferredFormat: 'hex3',
			showButtons: !1,
			showPalette: !0,
			showInput: !0,
			showInitial: !1,
			showSelectionPalette: !1,
			palette: [
				["#ffebee", "#ffcdd2", "#ef9a9a", "#e57373", "#ef5350", "#f44336", "#e53935", "#d32f2f", "#c62828", "#b71c1c"],
				["#fce4ec", "#f8bbd0", "#f48fb1", "#f06292", "#ec407a", "#e91e63", "#d81b60", "#c2185b", "#ad1457", "#880e4f"],
				["#f3e5f5", "#e1bee7", "#ce93d8", "#ba68c8", "#ab47bc", "#9c27b0", "#8e24aa", "#7b1fa2", "#6a1b9a", "#4a148c"],
				["#ede7f6", "#d1c4e9", "#b39ddb", "#9575cd", "#7e57c2", "#673ab7", "#5e35b1", "#512da8", "#4527a0", "#311b92"],
				["#e8eaf6", "#c5cae9", "#9fa8da", "#7986cb", "#5c6bc0", "#3f51b5", "#3949ab", "#303f9f", "#283593", "#1a237e"],
				["#e3f2fd", "#bbdefb", "#90caf9", "#64b5f6", "#42a5f5", "#2196f3", "#1e88e5", "#1976d2", "#1565c0", "#0d47a1"],
				["#e1f5fe", "#b3e5fc", "#81d4fa", "#4fc3f7", "#29b6f6", "#03a9f4", "#039be5", "#0288d1", "#0277bd", "#01579b"],
				["#e0f7fa", "#b2ebf2", "#80deea", "#4dd0e1", "#26c6da", "#00bcd4", "#00acc1", "#0097a7", "#00838f", "#006064"],
				["#e0f2f1", "#b2dfdb", "#80cbc4", "#4db6ac", "#26a69a", "#009688", "#00897b", "#00796b", "#00695c", "#004d40"],
				["#e8f5e9", "#c8e6c9", "#a5d6a7", "#81c784", "#66bb6a", "#4caf50", "#43a047", "#388e3c", "#2e7d32", "#1b5e20"],
				["#f1f8e9", "#dcedc8", "#c5e1a5", "#aed581", "#9ccc65", "#8bc34a", "#7cb342", "#689f38", "#558b2f", "#33691e"],
				["#f9fbe7", "#f0f4c3", "#e6ee9c", "#dce775", "#d4e157", "#cddc39", "#c0ca33", "#afb42b", "#9e9d24", "#827717"],
				["#fffde7", "#fff9c4", "#fff59d", "#fff176", "#ffee58", "#ffeb3b", "#fdd835", "#fbc02d", "#f9a825", "#f57f17"],
				["#fff8e1", "#ffecb3", "#ffe082", "#ffd54f", "#ffca28", "#ffc107", "#ffb300", "#ffa000", "#ff8f00", "#ff6f00"],
				["#fff3e0", "#ffe0b2", "#ffcc80", "#ffb74d", "#ffa726", "#ff9800", "#fb8c00", "#f57c00", "#ef6c00", "#e65100"],
				["#fbe9e7", "#ffccbc", "#ffab91", "#ff8a65", "#ff7043", "#ff5722", "#f4511e", "#e64a19", "#d84315", "#bf360c"],
				["#efebe9", "#d7ccc8", "#bcaaa4", "#a1887f", "#8d6e63", "#795548", "#6d4c41", "#5d4037", "#4e342e", "#3e2723"],
				["#fafafa", "#f5f5f5", "#eeeeee", "#e0e0e0", "#bdbdbd", "#9e9e9e", "#757575", "#616161", "#424242", "#212121"],
				["#eceff1", "#cfd8dc", "#b0bec5", "#90a4ae", "#78909c", "#607d8b", "#546e7a", "#455a64", "#37474f", "#263238"],
				["#ffffff", "#dfdfdf", "#cccccc", "#bbbbbb", "#909090", "#7F7F7F", "#555555", "#333333", "#111111", "#000000"]
			],
			change: function (color) {
				console.log(color);
				if (elementType == 'txtcolor') {
					$('.editableElementActive')
						.css('color', color.toHexString())
						.attr('data-og-fg-color', color.toHexString())
				}
				else if (elementType == 'txtbgcolor') {
					$('.editableElementActive')
						.css('background-color', color.toHexString())
						.attr('data-og-bg-color', color.toHexString())

				} else if (elementType == 'colorhv' || elementType == 'bgcolorhv') {

					if (elementType == 'colorhv')
						$('.editableElementActive')
							.attr('data-hfg-color', color.toHexString())
					if (elementType == 'bgcolorhv')
						$('.editableElementActive')
							.attr('data-hbg-color', color.toHexString())

				} else if (elementType == 'forminputbordercolor') {
					$('.editableElementActive .mt_form_input input , .editableElementActive .mt_form_input textarea').css('border-color', color.toHexString());
				} else if (elementType == 'forminputbgcolor') {
					$('.editableElementActive .mt_form_input input , .editableElementActive .mt_form_input textarea').css('background-color', color.toHexString());
				} else if (elementType == 'formlabelcolor') {
					$('.editableElementActive .mt_form_input label').css('color', color.toHexString());
				} else if (elementType == 'formbtnbgcolor') {
					$('.mtdefaultformbtn').css('background-color', color.toHexString());
				} else if (elementType == 'formbtncolor') {
					$('.mtdefaultformbtn').css('color', color.toHexString());
				} else if (elementType == 'popbgoptions_bgcolor') {
					if ($('.mt_bgconatainer .mt_popup_bgground .mt_popup_bgground_inner').length) {
						$('.mt_bgconatainer .mt_popup_bgground .mt_popup_bgground_inner').css('background-color', color.toHexString());
					} else {
						$('.mt_bgtempconatainer.active').css('background-color', color.toHexString());
					}

				}
			},
			show: function (color) {
				var initialPalette = $('.sp-palette-row ').find('span[attr="title"]');
				if (color == initialPalette.val()) {
					initialPalette.addClass('sp-thumb-active')
				}
			}
		});
	}

	$(document).on("change", '#textoptions_font', function(){
		var selected = $(this).find('option:selected');
		var extra = selected.data('foo');
		console.log(extra);
	});

	$(document).on('click', '.mt_use_img', function () {
		var src = $(this).attr('src');
		var type = $(this).attr('data-type');
		useThisImage(src, type);

	});

	function useThisImage(src, type) {
		processStatus(true)
		if (type == 'image_src') {
			$('.editableElementActive').attr('src', src);
		} else if (type == 'image_bg') {
			if ($('.mt_bgconatainer').length) {
				$('.mt_bgconatainer .mt_popup_bgground .mt_popup_bgground_inner ').css('background-image', 'url(' + src + ')');
			} else {
				$('.mt_bgtempconatainer.active').css('background-image', 'url(' + src + ')');
			}
		}
		processStatus(false)

	}

	$(document).on("click",'.mt_bgconatainer , .mt_bgtempconatainer',function(e){
		$('.editableElement').removeClass('editableElementActive')
		$('.mt_main_structure').removeClass('mt_hide_sidebar')
		e.stopPropagation()
		if ($(this).hasClass('mt_bgconatainer')) {
			var targetDiv = $('.mt_popup_bgground .mt_popup_bgground_inner');
			var bgtypes = 'mt_bgconatainer';
		} else {
			var targetDiv = $(this);
			$('.mt_bgtempconatainer').removeClass('active');
			// 105 unchecked hide switch button
			$('.hideSection').prop('checked',false);
			// 105 hide show "other" tab of background editor
			if(targetDiv.parent().hasClass('mt_edit_template_container')){
				$('.hideShoSection').parent().removeClass('d-none');
				$('#hideShoSecTb').removeClass('d-none');
			}else{
				$('.hideShoSection').parent().addClass('d-none');
				$('#hideShoSecTb').addClass('d-none');
				if($('.hideShoSection, #hideShoSecTb').hasClass('active show') == true){
					$('.hideShoSection, #hideShoSecTb').removeClass('active show');
					$('.bgsetcolortbclk, #bgsetcolortb').addClass('active show');
				}
			}
			targetDiv.addClass('active');
			var bgtypes = 'mt_bgtempconatainer';

			// add random id attribute on main section if not present
			if(!targetDiv.attr('id')){
				targetDiv.attr('id',generateRandom(16) );
			}
		}
		// console.log(bgtypes)
		var bg_color = targetDiv.css('background-color');
		var bg_opacity = targetDiv.css('opacity');

		if (targetDiv.hasClass('mt_popup_full_wd')) {
			var background_type = 'mt_popup_full_wd';
		} else if (targetDiv.hasClass('mt_popup_left_wd')) {
			var background_type = 'mt_popup_left_wd';
		} else if (targetDiv.hasClass('mt_popup_right_wd')) {
			var background_type = 'mt_popup_right_wd';
		}
		if (bgtypes == 'mt_bgconatainer') {
			$("#" + background_type).prop("checked", true);
			$('.mt_background_type').removeClass('mt_hide');
		} else {
			$('.mt_background_type').addClass('mt_hide');
		}
		$(".mt_sidebar_editor").addClass("mt_hide");
		$("#background_editor").removeClass("mt_hide").addClass('open_editor');

		$('#popbgoptions_bgcolor').val(bg_color);
		inilizecolorPicker('popbgoptions_bgcolor', 'popbgoptions_bgcolor');

		if ($('.mt_photo_content_main  .mt_imagecontent').length) {
			var slide1Dis = $('.mt_photo_content_main  #mt_image_slide_1').css('display');
			var slide2Dis = $('.mt_photo_content_main  #mt_image_slide_2').css('display');
			var slide3Dis = $('.mt_photo_content_main  #mt_image_slide_3').css('display');

			$('.mt_photocontestimg_setting #mt_image_slide_1_chk').prop('checked', slide1Dis == 'none' ? false : true);
			$('.mt_photocontestimg_setting #mt_image_slide_2_chk').prop('checked', slide2Dis == 'none' ? false : true);
			$('.mt_photocontestimg_setting #mt_image_slide_3_chk').prop('checked', slide3Dis == 'none' ? false : true);
			$('.mt_photocontestimg_setting').removeClass('mt_hide');
		}
	})

	$(document).on("change", '#popbgoptions_opacity', function(){
		if ($('.mt_bgconatainer').length) {
			$('.mt_popup_bgground .mt_popup_bgground_inner').css('opacity', $(this).val());
		} else {
			$('.mt_bgtempconatainer.active').css('opacity', $(this).val());
		}

	});

	$(document).on("change", 'input[type=radio][name=popbackground_type]', function() {
		$('.mt_popup_bgground .mt_popup_bgground_inner').removeClass('mt_popup_full_wd mt_popup_left_wd mt_popup_right_wd');
		$('.mt_popup_bgground .mt_popup_bgground_inner').addClass(this.value);

	});

	$(document).on('click', 'ul#backgroundsetting li a.bgsetimgtbclk', function () {
		load_media_library('image_bg');
	});

	$(document).on('click', '.mt_photocontestimg_setting .mt_image_slide_chk', function () {
		var ids = $(this).attr('id');
		var targetImg = ids.replace("_chk", "");
		if (this.checked) {
			$('#' + targetImg).css('display', 'block')
		} else {
			$('#' + targetImg).css('display', 'none')
		}
	});

	if ($('.dropzone').length) {
		Dropzone.autoDiscover = false;
		initialisedDropzone('imgsrcupload', 'image_src');
		initialisedDropzone('imgbackgroundupload', 'image_bg');
	}

	function initialisedDropzone(elementid, type = 'image_src') {

		$("#" + elementid).dropzone({
			url: baseurl + "/admin/venue/theme/upload_image",
			uploadMultiple: false,
			createImageThumbnails: true,
			acceptedFiles: ".jpg,.jpeg,.png",
			maxFiles: 1,
			paramName: "upload_file",
			addRemoveLinks: true,
			timeout: 90000, /*milliseconds*/
			error: function (file, response) {
				showNotifications('error', 'Oops|' + response);
				$('.dz-remove').trigger('click');

			},
			success: function (file, response) {
				var res = JSON.parse(response);
				if (res.status == 1) {
					load_media_library(type);
					useThisImage(res.data, type);
				} else {
					showNotifications('error', res.msg)
				}
			},
			sending: function (file, xhr, formData) {
				formData.append('csrf_pixelpages', $('#csrf_token').val());
			}


		});



	}

	$(document).on("keypress", '.search_images_lib', function(event){
		var type = $(this).attr('data-type');
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			var searchTerm = $(this).val();
			load_media_library(type, false, 0, searchTerm);
		}
	});

	function load_media_library(img_container_id, appends = 'true', offset = 0, searchTerm = '') {
		
		var LoadData = { 'offset': offset, 'searchTerm': searchTerm, 'img_container_id': img_container_id, 'csrf_pixelpages':'{{ csrf_token() }}',  "_token": "{{ csrf_token() }}" };
		var targetElement = $('#' + img_container_id);
		console.log(baseurl + "/admin/venue/theme/load_media_library_img");
		console.log($('#csrf_token').val());
		$.ajax({
			method: 'post',			
			url: '{{ route("venue/theme/load_media_library_img") }}',
			contentType: "application/json",
			dataType: 'json',
			data: LoadData,
			headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
   			 },
			success: function (resp) {
				resp = JSON.parse(resp);
				if (resp['status'] == 1) {

					var load_more_button = targetElement.closest('.mt_photo_gallery_container').find('a.loadMoreMediaLibraryImage');
					if (appends == true) {
						targetElement.append(resp['data']);
					} else {
						targetElement.html(resp['data']);
					}

					if (resp['pagination'] == 1) {
						if (appends == true) {
							load_more_button.attr('data-attr', (parseInt(load_more_button.attr('data-attr')) + parseInt(1))).removeClass('mt_hide');
						} else {
							load_more_button.attr('data-attr', 1).removeClass('mt_hide');
						}

					} else {
						load_more_button.addClass('mt_hide');
					}

				} else {
					toastr.error('Something went wrong, please try again.')
				}
			},
			error: function () {
				if (loadType != 'filter') {
					_this.html(btnText).removeClass('adding');
				}
				toastr.error('Something went wrong, please try again.')
			}
		});
	}

	$(document).on('click', 'a.loadMoreMediaLibraryImage', function () {
		var searchTerm = $(this).closest('.mt_photo_gallery_container').find('.search_images_lib').val();
		var offset = $(this).attr('data-attr');
		var img_container_id = $(this).closest('.mt_photo_gallery_container').find('.mt_media_library_container').attr('id');
		load_media_library(img_container_id, true, offset, searchTerm)

	});


	$(document).on("keypress", '.search_images_from_api', function(event){
		var type = $(this).attr('data-type');
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			var searchTerm = $(this).val();
			load_api_img(type, false, 0, searchTerm, $(this).data('api'));
		}
	});

	function load_api_img(img_container_id, appends = 'true', offset = 0, searchTerm = '', api) {
		var LoadData = { 'offset': offset, 'searchTerm': searchTerm, 'img_container_id': img_container_id, 'api': api, 'csrf_pixelpages': $('#csrf_token').val() };
		var targetElement = $('#' + img_container_id);
		$.ajax({
			method: 'post',
			url: baseurl + '/admin/venue/theme/load_api_img',
			data: LoadData,
			success: function (resp) {
				resp = JSON.parse(resp);
				if (resp['status'] == 1) {

					var load_more_button = targetElement.closest('.mt_tabs_pixabay').find('a.loadPixabayImage');
					if (appends == true) {
						targetElement.append(resp['data']);
					} else {
						targetElement.html(resp['data']);
					}

					if (resp['pagination'] == 1) {
						load_more_button.removeClass('mt_hide');
						if (appends == true) {
							load_more_button.attr('data-attr', (parseInt(load_more_button.attr('data-attr')) + parseInt(1)));
						} else {
							load_more_button.attr('data-attr', 2);
						}

					} else {
						load_more_button.addClass('mt_hide');
					}

				} else {
					toastr.error('Something went wrong, please try again.')
				}
			},
			error: function () {

				toastr.error('Something went wrong, please try again.')
			}
		});

	}

	$(document).on('click', 'a.loadPixabayImage', function () {
		var searchTerm = $(this).closest('.mt_tabs_pixabay').find('.search_images_from_api').val();
		var api = $(this).closest('.mt_tabs_pixabay').find('.search_images_from_api').data('api');
		var offset = $(this).attr('data-attr');
		var img_container_id = $(this).closest('.mt_tabs_pixabay').find('.mt_media_library_container').attr('id');
		load_api_img(img_container_id, true, offset, searchTerm, api)

	});

	$(document).on('click', 'img.mt_upload_imgurl', function () {
		var LoadData = { 'imageUrl': $(this).attr('src'), 'csrf_pixelpages': $('#csrf_token').val() };
		var type = $(this).attr('data-type');
		processStatus(true)
		$.ajax({
			method: 'post',
			url: baseurl + 'ajax/uploadImageUrl',
			data: LoadData,
			success: function (resp) {
				resp = JSON.parse(resp);

				if (resp['status'] == 1) {
					useThisImage(resp.data, type);
					processStatus(false)
				} else {
					showNotifications('error', resp.msg)
					processStatus(false)
				}
			}
		});
	});

	$(document).on('click', '.edit_right_fields', function () {
		var ids = $(this).data('id');
		var targetDiv = $('#' + ids);
		var labletext = targetDiv.find('label').text();
		var lableDisplay = targetDiv.find('label').css('display');

		$('[for="fields_label_show"]').removeClass('d-none')
		if (lableDisplay == undefined)
			$('[for="fields_label_show"]').addClass('d-none')

		var labelShow = (lableDisplay == 'none' || lableDisplay == undefined) ? false : true;
		var targetInput = targetDiv.find('input');
		var fieldsType = targetInput.attr('type');
		if (fieldsType === undefined) {
			targetInput = targetDiv.find('textarea');
			$(".mt_add_fields .mt_fields_type").addClass('mt_hide');
		} else {
			$(".mt_add_fields .mt_fields_type").removeClass('mt_hide');
		}

		var placeholderText = targetInput.attr('placeholder');
		var errorMsg = targetInput.data('error');
		var fields_mandatory = targetInput.attr('data-required');
		var fields_mandatory = fields_mandatory == 'false' ? false : true;
		$('.mt_add_fields #fields_label').val(labletext);
		$('.mt_add_fields #fields_label_show').prop('checked', labelShow);
		$('.mt_add_fields #fields_placeholder').val(placeholderText);
		$('.mt_add_fields #fields_type').val(fieldsType).niceSelect('update');
		$('.mt_add_fields #fields_mandatory').prop('checked', fields_mandatory);
		$(".mt_add_fields #fields_error_msg").val(errorMsg);
		$(".mt_add_fields #targetinputdiv").val(ids);
		$(".mt_add_fields .add_fields_title").text('Edit Field');
		$(".mt_add_fields").removeClass('mt_hide');
		$(".mt_detail_formfields").addClass('mt_hide');

	});

	$(document).on('click', '.mt_add_new_fields', function () {
		var sourceDiv = $(".mt_popup_form_container .mt_form_input:first");
		var forminputbordercolor = sourceDiv.find('input').css('border-color');
		var forminputbgcolor = sourceDiv.find('input').css('background-color');

		var formlabelcolor = sourceDiv.find('label').css('color');
		var formlabeldisplay = sourceDiv.find('label').css('display');
		var randoms = generateRandom(5);
		var newDivid = 'mt_field' + randoms;

		var mt_form_DivCls = 'mt_form_input';
		var mt_form_inpCls = 'theme_input';
		if ($('.mt_popup_form_container .form-group').length) {
			mt_form_DivCls += ' form-group';
			mt_form_inpCls += ' form-control';

		}

		var newHtml = '<div class="' + mt_form_DivCls + '" id="' + newDivid + '">' + ((formlabeldisplay == undefined) ? '' : '<label style="display: ' + formlabeldisplay + '; color: ' + formlabelcolor + ';">label</label>') + '<input type="text"  name="field' + randoms + '" placeholder="Placeholder" data-required="false" style="border-color: ' + forminputbordercolor + '; background-color: ' + forminputbgcolor + ';" class="' + mt_form_inpCls + '"></span></div>';

		$('.mt_popup_form_container').parent('.editableElementActive').find('.mt_popup_form_container').append(newHtml);
		if ( $(".mtdefaultformbtn").parents(".mt_popup_form_container").length == 1 ) {
			$( ".mtdefaultformbtn" ).insertAfter( $( ".mt_popup_form_container" ) );
		}

		$('.mt_popup_form.editableElementActive').trigger('click');
		$('a.edit_right_fields[data-id="' + newDivid + '"]').trigger('click');
	});

	$(document).on('click', '.delete_right_fields', function () {
		var ids = $(this).data('id');
		var targetDiv = $('#' + ids);
		var targetInput = targetDiv.find('input,textarea');
		if (targetInput.hasClass('data-default')) {
			showNotifications('error', 'Oops|you can not delete this default field.');
			return false;
		}
		targetDiv.remove();
		$(this).closest('.mt_input_edit').remove();

	});



	$(document).on('keyup', '.mt_add_fields .fields_keyup', function () {
		var targetinputdiv = $(".mt_add_fields #targetinputdiv").val();
		var checkedids = $(this).attr('id');
		if (checkedids == 'fields_label') {
			$('.editableElement #' + targetinputdiv).find('label').text($(this).val());
		}
		if (checkedids == 'fields_placeholder') {
			$('.editableElement #' + targetinputdiv).find('input,textarea').attr('placeholder', $(this).val());
		}
		if (checkedids == 'fields_error_msg') {
			$('.editableElement #' + targetinputdiv).find('input,textarea').attr('data-error', $(this).val());
		}
	});

	$(document).on('change', '.mt_add_fields .fields_checked', function () {
		var targetinputdiv = $(".mt_add_fields #targetinputdiv").val();
		var checkedids = $(this).attr('id');

		if (checkedids == 'fields_label_show') {
			if ($(this).is(":checked")) {
				$('.editableElement #' + targetinputdiv).find('label').css('display', 'block');
			} else {
				$('.editableElement #' + targetinputdiv).find('label').css('display', 'none');
			}
		}
		if (checkedids == 'fields_mandatory') {
			if ($(this).is(":checked")) {
				$('.editableElement #' + targetinputdiv).find('input,textarea').attr('data-required', true);
			} else {
				$('.editableElement #' + targetinputdiv).find('input,textarea').attr('data-required', false);
			}
		}
		if (checkedids == 'fields_type') {
			$('.editableElement #' + targetinputdiv).find('input').attr('type', $(this).val());
		}
	});

	$(document).on('click', '.mt_add_fields .mt_add_fields_done', function () {
		$('.mt_popup_form.editableElementActive').trigger('click');
	});

	$(document).on('click', 'form [type=submit]', function (e) {
		e.preventDefault();
	});

	// 105 copy js for main section
	$(document).on("click", "#copyEditable", function(){
		var elem = $(this).attr('edit_type');
				
		if(elem=='background'){
			var selected = $('.mt_bgtempconatainer.active');
			selected.clone().attr('id',generateRandom(16)).insertAfter('#'+selected.attr('id'));
			var swipers = $('.mt_bgtempconatainer.active').find('.swiper-wrapper');
			if(swipers.length){
				$.each(swipers, function(i){
					$(this).attr('id','swiper-wrapper-'+generateRandom(16));
					
				});
			}
			$('.mt_bgtempconatainer.active').removeClass('active');
		}
	});

}(jQuery));
</script>