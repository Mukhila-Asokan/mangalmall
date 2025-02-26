/*--------------------- Copyright (c) 2020 -----------------------
[Master Javascript]
Project: Myeditor
-------------------------------------------------------------------*/
(function($) {
    "use strict";
    var Myeditor = {
        initialised: false,
        version: 1.0,
        mobile: false,
        init: function() {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-------------- Myeditor Design Functions Calling-------------------*/

            this.Sidebar_toggle();
            this.list_radio();
            this.mt_admin_toggle();
            this.Quantity_no();
            this.PriceRange();
            this.check_image();
            this.open_editor_toggle();
            this.mt_checkbox_toggle();
            this.mt_contest_toggle();
            this.editor_sidebar_fixed();
            this.loader_main();
        },

        /*-------------- Myeditor Design Functions Calling ------------------------*/

        // loader js		
        loader_main: function() {
            $(window).on('load', function () {
				$(".pxg_preloader").delay(100).fadeOut("slow").addClass('loaderout');
			});
        },
        // loader js


        // sidebar Fixed
        editor_sidebar_fixed: function() {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();

                if (scroll >= 100) {
                    $(".mt_sidebar_editor").addClass("sb_fixed");
                } else {
                    $(".mt_sidebar_editor").removeClass("sb_fixed");
                }
            });
        },
        // sidebar Fixed   


        // open editor toggle js
        open_editor_toggle: function() {
            $(".mt_editor_toggle").on('click', function(e) {
                e.stopPropagation();
                $(".mt_sidebar_editor").addClass("open_editor");
            });
            $(".close_editor").on('click', function() {
                $(".mt_sidebar_editor").removeClass("open_editor");
            });
        },
        // open editor toggle js




        // Range Slider start
        PriceRange: function() {
            if ($('.mt_range_slider').length > 0) {
                $(function() {
                    $("#slider-range").slider({
                        range: true,
                        min: 0,
                        max: 100,
                        values: [0, 80],
                        slide: function(event, ui) {
                            $("#amount").text(ui.values[1] + "%");
                        }
                    });
                    $("#amount").text($("#slider-range").slider("values", 1) + "%");
                });
            }
        },
        // Range Slider End

        // Sidebar Toggle 
        Sidebar_toggle: function() {
            $(".mt_sidebar_manu").hover(function() {
                $(".mt_sidebar_main").toggleClass('open_menu');
            });
        },
        // Sidebar Toggle 




        // admin toggle js
        mt_admin_toggle: function() {
            $(".toggle-btn").on('click', function(e) {
                e.stopPropagation();
                $(".mt_sidebar_main").toggleClass("admin_open");
            });

            $('.mt_sidebar_main').click(function(e) {
                e.stopPropagation();
            });

            $('body,html').click(function(e) {
                $('.mt_sidebar_main').removeClass('admin_open');
            });
        },
        // admin toggle js

        // Audio Radio js
        list_radio: function() {
            $('.mt_user_radio').on('click', function() {
                $('.active2').removeClass('active2');
                $(this).addClass('active2').find('input').prop('checked', true)
            });
            $('.mt_radio_user2').on('click', function() {
                $('.active_three').removeClass('active_three');
                $(this).addClass('active_three').find('input').prop('checked', true)
            });

        },
        // Audio Radio js

        // check img js
        check_image: function() {
            $('.mt_user_check').on('click', function() {
                $('.active_inout').removeClass('active_inout');
                $(this).addClass('active_inout').find('input').prop('checked', true)
            });
            $('.mt_check_user2').on('click', function() {
                $('.active_check').removeClass('active_check');
                $(this).addClass('active_check').find('input').prop('checked', true)
            });

        },
        // check img js


        // Quantity js start
        Quantity_no: function() {
            var quantity = 0;
            $('.quantity_plus').on('click', function(e) {
                e.preventDefault();
                var quantity = parseInt($(this).siblings('.quantity').val());
                $(this).siblings('.quantity').val(quantity + 1);

            });
            $('.quantity_minus').on('click', function(e) {
                e.preventDefault();
                var quantity = parseInt($(this).siblings('.quantity').val());
                if (quantity > 0) {
                    $(this).siblings('.quantity').val(quantity - 1);
                }
            });
        },
        // Quantity js End		


        // checkbox toggle js
        mt_checkbox_toggle: function() {
            $("input:checkbox").on('click', function() {
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

        // contest_toggle js 
        mt_contest_toggle: function() {
            $(document).on('click', '.mt_dubbledots', function() {
                $(".mt_dubbledots").not($(this)).removeClass('contest_toggle_open');
                $(this).toggleClass('contest_toggle_open');
            });
        },
        // contest_toggle js


    };
    Myeditor.init();
}(jQuery));

var rangeSlider = function(){
    var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');
      
    slider.each(function(){
  
      value.each(function(){
        var value = $(this).prev().attr('value');
        $(this).html(value);
      });
  
      range.on('input', function(){
        $(this).next(value).html(this.value);
      });
    });
  };
  
  rangeSlider();

function addContest() {
    let c_name = $.trim($('input[name="c_name"]').val());
    let c_type = $('input[name="c_type"]:checked').val();
    if (c_name != '') {
        document.cookie = "c_name=" + c_name + "; path=/";
        document.cookie = "c_type=" + c_type + "; path=/";

        if (get_cookies('c_type'))
            window.location.href = websitelink + 'user/choose_template/' + c_type;

    } else
        showNotifications('error', 'Please, enter contest name.');
}

// get cookies
function get_cookies(ckName) {
    var ckValue = null,
        setcookies = document.cookie,
        splitArr = setcookies.split(";");
    for (var i = 0; i < splitArr.length; i++) {
        var t = splitArr[i].split("=");
        if (t.length && t.length >= 2) {
            var k = t[0].trim(),
                v = t[1].trim();
            ckName == k && (ckValue = v)
        }
    }
    return ckValue
}



$(document).on("click", ".camp_template", function() {
    var template_id = $(this).attr("data-id");
    $.ajax({
        method: "POST",
        url: websitelink + "user/addContest",
        data: { template_id: template_id },
    }).done(function(response) {
        if (response != 0) {
            document.cookie = "c_name=;expires=" + new Date(0).toUTCString();
            document.cookie = "c_type=;expires=" + new Date(0).toUTCString();
            window.location.href = websitelink + 'user/editor/' + response;
        } else {
            window.location.href = websitelink + "user/contests"
        }

    });

})

if ($('.mt_picker').length > 0) {
    $(document).ready(function() {
        $(".color").trigger("click");
    });
    $(document).on("click", ".color", function() {
        // Inputs
        const valueInput = this.nextElementSibling;
        const colorInput = this;


        // Sync the color from the picker
        const syncColorFromPicker = () => {
            valueInput.value = colorInput.value;
        };

        // Sync the color from the field
        const syncColorFromText = () => {
            colorInput.value = valueInput.value;
        };

        // Bind events to callbacks
        colorInput.addEventListener("input", syncColorFromPicker, false);
        valueInput.addEventListener("input", syncColorFromText, false);

        // Optional: Trigger the picker when the text field is focused
        valueInput.addEventListener("focus", () => colorInput.click(), false);

        // Refresh the text field
        syncColorFromPicker();
    })

}

$(document).on("change", ".contest_status", function() {
    var status = $(this).val();
    var c_id = $(this).attr('data-id');
    var this_ = $(this);
    if (status == 1)
        var update_status = 0;
    else if (status == 0)
        var update_status = 1

    $.ajax({
        method: "POST",
        url: websitelink + "user/contestStatusUpdate",
        data: { c_id: c_id, status: update_status },
    }).done(function(msg) {

        this_.closest(".mt_contest_details").toggleClass('mt_unchecked');

    });
})


$(document).on("click", ".contest_delete", function() {
    var contest_id = $(this).attr("data-id");
    $(".mt_confirm_delete").attr('data-code', contest_id);
    $('#delete_contest').modal('show');

})

$(".mt_confirm_delete").on("click", function() {
    var _this = $(this);
    $(_this).attr('disabled', true);
    $.ajax({
        url: websitelink + "user/delete_contest",
        type: 'POST',
        data: { 'code': $(this).attr('data-code') }
    }).done(function(res) {
        var response = JSON.parse(res);
        if (response.status == 'success') {
            showNotifications('success', 'Yahh!!|' + response.message);
            window.location.reload();
        } else {
            showNotifications('error', '' + response.message);
            $(_this).attr('disabled', false);
        }
    });

});


$('#adduser').on('hidden.bs.modal', function(e) {
    $(this)
        .find("input,textarea,select")
        .val('')
        .end()
})

if ($('.datepicker').length > 0) {
    /* date picker */
    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

}

/*
 ********** Delivery type select ***************************************
 */

/*
 ********** POINT SYSTEM (WINNER SELECTION) ***************************************
 */
$('.mt_points_wrapper > ul > li > input').on('change', function() {
    if (!this.checked) {
        $(this).parent('li').find('input').prop('checked', false);
        $(this).parent('li').find('input').val("");
    }
});
$('.mt_list_item > input').on('change', function() {
    if (this.checked) {
        var a = ($(this).attr('id')).split('_');
        $(this).parents('.mt_list').next().find('input').val(a[1]);
        $(this).parents('li').children('input').prop('checked', true);
    }
});

$('.mt_custom_input > input').on('keyup', function() {

    $(this).parents('li').children('input').prop('checked', true);
    if ($(this).val() == '') {
        $(this).parents('li').children('input').prop('checked', false);
    }

    let points = ['5', '10', '15', '20', '25'];
    if (points.indexOf($(this).val()) > -1) {
        console.log($(this).val());
        let num = $(this).val();
        let n = $(this).attr('data-name');
        $("#" + n + '_' + num).prop('checked', true)
    } else {
        $(this).parents('li').children('.mt_list').find('input').prop('checked', false);
    }
});


// load more ajax
if ($('#ajax_table').length > 0) {
    $(document).ready(function() {
        getContest(0);

        $("#load_more").click(function(e) {
            e.preventDefault();
            var page = $(this).data('val');
            getContest(page);

        });

    });

    var getContest = function(page) {
        $("#loader").show();
        var searchData = $(".search_contest").val();
        $.ajax({
            url: websitelink + "user/getContest",
            type: 'POST',
            data: { page: page, searchData: searchData }
        }).done(function(response) {
            $("#ajax_table").append(response);
            $("#loader").hide();
            $('#load_more').data('val', ($('#load_more').data('val') + 1));
            scroll();
            if ($("#no_contests").length > 0) {
                $('#load_more').hide();
            }
        });
    };

    var scroll = function() {
        $('html, body').animate({
            scrollTop: $('#load_more').offset().top
        }, 1000);
    };


    $(document).on("input", ".search_contest", function() {
        var searchData = $(this).val();
        var page = 0;
        $("#loader").show();
        $.ajax({
            url: websitelink + "user/getContest",
            type: 'POST',
            data: { searchData: searchData.trim(), page: page }
        }).done(function(response) {
            $("#ajax_table").html(response);
            $("#loader").hide();
        });
    })
}

if ($('#settings').length > 0) {
    $(document).on("change", ".fe_autoresponder_select", function() {
        var autoresponder = $(this).val();
        $.ajax({
            url: websitelink + "ajax/getListOfResponder/" + autoresponder,
            type: 'POST',
            data: { responser: true, 'csrf_pixelpages' : $('#csrf_token').val() }
        }).done(function(response) {
            var listData = JSON.parse(response);
            var html = '<option value="">Select List</option>';

            for (var i = 0; i < listData.data.length; i++) {
                html += "<option value='" + listData.data[i].list_value + "'> " + listData.data[i].list_name + "</option>";
            }
            $('.fe_autoresponderlist_select').html(html);

            $('.fe_autoresponderlist_select').niceSelect('update');
        });
    })

    $(document).on("change", "#switch_autoresponder", function() {
        if ($(this).prop('checked') === true) {
            $(".ar_box").show();
        } else if ($(this).prop('checked') === false) {
            $(".ar_box").hide();
        }
    })

    $(document).on("click", ".email_details_btn", function() {
        var err = 0;

        if ($("#switch_autoresponder").prop('checked') === true && $(".fe_autoresponder_select").val() == '') {
            $(".rp_tab_list ul>li> a:last").click();
            showNotifications('error', 'Please select autoresponder.');
            err++;
        } else if ($("#switch_autoresponder").prop('checked') === true && $(".fe_autoresponderlist_select").val() == '') {
            $(".rp_tab_list ul>li> a:last").click();

            showNotifications('error', 'Please select autoresponder list.');
            $(".fe_autoresponderlist_select").focus();
            err++;
        }

        if (err == 0) {
            var email_confirmation = ($('#switch_email_confirmation').is(':checked') === true) ? 1 : '';
            var welcome_email = ($('#switch_welcome_email').is(':checked') === true) ? 1 : '';
            var autoresponder = ($('#switch_autoresponder').is(':checked') === true) ? 1 : '';
            var autoresponder_name = $('.fe_autoresponder_select').val();
            var autoresponder_list_id = $('.fe_autoresponderlist_select').val();
            var campId = $("#campId").val();
            var dataArr = {
                'email_confirmation': email_confirmation,
                'welcome_email': welcome_email,
                'autoresponder': autoresponder,
                'autoresponder_name': autoresponder_name,
                'autoresponder_list_id': autoresponder_list_id,
                'campId': campId,
                'csrf_pixelpages' : $('#csrf_token').val()
            }

            $.ajax({
                url: websitelink + "ajax/email_settings",
                type: 'POST',
                data: dataArr
            }).done(function(response) {
                showNotifications('success', 'Email Settings Updated Successfully.');
            });
        }

    })

}

if ($('#customcss_editor').length > 0) {
    $(document).on("click", ".save_css_js", function() {
        var css = $("#mt_custom_css").val();
        var js = $("#mt_custom_js").val();
        var campId = $("#campId").val();
        var dataArr = { 'css': css, 'js': js, 'campId': campId, 'csrf_pixelpages' : $('#csrf_token').val() };
        $.ajax({
            url: websitelink + "ajax/custom_css_js",
            type: 'POST',
            data: dataArr
        }).done(function(response) {
            showNotifications('success', 'Custom Css and Js Updated Successfully.');
        });
    })
}



if ($('.template_preview').length > 0) {
    $(document).on("click", ".template_preview", function() {
        var tempId = $(this).attr("data-id");

        var dataArr = { 'tempId': tempId };
        $.ajax({
            url: websitelink + "user_ajax/get_templateById",
            type: 'POST',
            data: dataArr
        }).done(function(response) {
            var dataResponse = JSON.parse(response);

            $("#showmodel").modal('show');
            $("#showmodel img").attr("src", websitelink + "template_assets/" + dataResponse[0].t_preview_img)
        });

    })
}

if ($('.leadsDataTable').length) {
    $('.leadsDataTable').dataTable({
        "bLengthChange": false,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excel',
            text: 'Export'
        }, ]
    });

    $("#user_campaigns").on("change", function() {
        window.location.href = base_url + 'user/leads_list/' + $(this).val();
    });

}

$(document).on("click", ".winner_btn", function() {
    var contest_type = $(this).attr("data-type");
    var contest_code = $(this).attr("data-id");
    $.ajax({
        url: websitelink + "user/winner",
        type: 'POST',
        data: { 'code': contest_code, 'type': contest_type }
    }).done(function(res) {
        var response = JSON.parse(res);
        var data = response.data;
        if (response.status == 'success') {
            var html = '';
            html += '<tr>';
            html += '<td>1</td>';
            html += '<td>' + data[0].email + '</td>';
            html += '<td>' + data[0].prize + '</td>';
            html += '</tr>';

            $('#winner_modal').modal('show');
            $("#winner_list").html(html);
            $('#winner_campaign_name').text(data[0].campaign_name);
        } else {
            showNotifications('error', '' + response.message);
        }
    });
})

$(document).on("click", ".use_dfy_btn", function() {
    var auth_code = $(this).attr('data-id');
    $("#add_campaign").modal("show");
    $("#dfy_auth_code").val(auth_code);
})

function addCamapignDfy() {
    var auth_code = $("#dfy_auth_code").val();
    var camp_name = $("#dfy_camp_name").val();
    console.log(camp_name, auth_code)
    if (camp_name != '') {
        $.ajax({
            url: websitelink + "user/add_campaign_dfy",
            type: 'POST',
            data: { 'auth_code': auth_code, 'camp_name': camp_name }
        }).done(function(res) {
            var response = JSON.parse(res);
            if (response.status == 'success') {
                window.location.href = base_url + 'user/editor/' + response.data;
            } else {
                showNotifications('error', '' + response.message);
            }
        });

    } else
        showNotifications('error', 'Please, enter contest name.');
}

// Admin js start

if ($('.userDataTable').length) {
    $('.userDataTable').dataTable({
        "bLengthChange": false,
    });
}

$("#dt_user").on('click', '.remove_user', function() {
    if ($(this).hasClass('remove_user')) {
        $(".rp_confirm_delete").attr('data-code', $(this).attr('data-authcode'));
        $('#delete_popup').modal('show');
    }
});

$(".rp_confirm_delete").on("click", function() {
    var _this = $(this);
    $(_this).attr('disabled', true);
    $.ajax({
        url: websitelink + "admin/delete_user",
        type: 'POST',
        data: { 'code': $(this).attr('data-code') }
    }).done(function(res) {
        var response = JSON.parse(res);
        if (response.status == 'success') {
            showNotifications('success', 'Yahh!!|' + response.message);
            window.location.reload();
        } else {
            showNotifications('error', '' + response.message);
            $(_this).attr('disabled', false);
        }
    });

});

$(".rp_create_user").on("click", function() {

    $(".rp_popup_heading_text").html('Create New User');
    $(".rp_popup_button_text").html('Save');
    $("#auth_code").val("");
    $("#user_name").val("");
    $("#email").val("");
    $("#u_pwd").val("");

    $('#userModal').modal('show');
});


$("#dt_user").on("click", 'a.user_edit', function() {
    let authCode = $(this).attr('data-authcode');
    $('input[name=auth_code]').val(authCode);

    $.ajax({
        url: websitelink + "admin/edit_user",
        type: 'POST',
        data: { 'auth_code': authCode }
    }).done(function(res) {
        var response = JSON.parse(res);
        if (response.status == 'success') {

            $(".rp_popup_heading_text").html('Update User');
            $(".rp_popup_button_text").html('Update');

            $("#auth_code").val(response.data.u_id);
            $("#user_name").val(response.data.u_name);
            $("#email").val(response.data.u_email);
            $("#u_pwd").val("");

            $("#email").attr("readonly", "true");


            if (response.data.is_fe == 1)
                $('#userModal input[name="is_fe"]').prop("checked", true);

            if (response.data.is_oto1 == 1)
                $('#userModal input[name="is_oto1"]').prop("checked", true);

            if (response.data.is_oto2 == 1)
                $('#userModal input[name="is_oto2"]').prop("checked", true);

            if (response.data.is_oto3 == 1)
                $('#userModal input[name="is_oto3"]').prop("checked", true);

            if (response.data.is_oto4 == 1)
                $('#userModal input[name="is_oto4"]').prop("checked", true);




            $('#userModal').modal('show');

        } else {
            showNotifications('error', '' + response.message);
        }
    })


});




$("#userForm").on("click", ".update_user", function() {
    _this = $(this);
    var is_validate = true;
    // User Name
    if ($("#user_name").length > 0) {
        if ($("#user_name").val().trim() == '') {
            is_validate = false;
            $("#user_name").focus();
            showNotifications('error', 'Please enter user name.');
            return false;
        }
    }

    if ($("#auth_code").val() == '') {
        if ($("#u_pwd").val().trim() == '') {
            is_validate = false;
            $("#u_pwd").focus();
            showNotifications('error', 'Please enter password.');
            return false;
        }
    }

    // Email validate
    if ($("#email").length > 0) {
        var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
        if (!emRegex.test($("#email").val())) {
            is_validate = false;
            $("#email").focus();
            showNotifications('error', 'Please enter correct email.');
            return false;
        }
    }


    if (is_validate === true) {

        let formData = $("#userForm").serializeArray();

        $.ajax({
            url: websitelink + "admin/add_and_update_user",
            type: 'POST',
            data: formData,
        }).done(function(res) {

            var response = JSON.parse(res);
            if (response.status == 'success') {
                showNotifications('success', 'Yahh!!|' + response.message);
                $('#userModal').modal('hide');
            } else {
                showNotifications('error', '' + response.message);
                $('#userModal').modal('hide');
            }
        });
    }
});


// Admin js end