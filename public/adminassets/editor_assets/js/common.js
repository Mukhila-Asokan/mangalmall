$(document).ready(function() {
    if ($('.mt_login_vector').length > 0) {
        const inputs = document.querySelectorAll(".validate");

        function addcl() {
            let parent = this.parentNode.parentNode;
            parent.classList.add("focus");
        }

        function remcl() {
            let parent = this.parentNode.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }
        inputs.forEach(input => {
            input.addEventListener("focus", addcl);
            input.addEventListener("blur", remcl);
        });
    }
    /*Nice Select*/
    if ($('select').length > 0) {
        $('select').niceSelect();
    }
    /*Nice Select*/

    // profile toggle js
    $(".mt_st_toggle").on('click', function(e) {
        e.stopPropagation();
        $(".mt_profile_open").toggleClass("open_drop");
    });

    $('.mt_profile_open').click(function(e) {
        e.stopPropagation();
    });

    $('body,html').click(function(e) {
        $('.mt_profile_open').removeClass('open_drop');
    });
    // profile toggle js

});


function showNotifications(type, msg, action = '') {
    $('#notificationBox').attr('class', '');
    $('#notificationBox').attr('class', 'mt_' + type + '_msg');
    $('.mt_notify_img').attr('src', websitelink + 'assets/images/' + (type == 'error'? 'oops' : 'success')  + '.png');
    // let messageText = msg.split('|');
    $('.mt_yeah').html('<h4>' + (type == 'success' ? 'Yeah!' : 'Oops!') + '</h4><p>' + msg + '</p>');
    setTimeout(function() {
        if (action == 'reload')
            location.reload();
        else if (action != '')
            window.location.href = action;

        $('#notificationBox').attr('class', '');
        $('#notificationBox').attr('class', 'mt_hide');
    }, 3000);
}


function submitData(_this) {
    var postUrl = $(_this).closest('form').data('action');
    var err = 0;
    let formdata = {};
    $(_this).closest('form').find('.validate').each(function() {
        let inputValue = $.trim($(this).val());
        if (err == 0) {
            if ($(this).data('shouldbe') !== undefined) {
                if (inputValue == '') {
                    showNotifications('error', 'Oops!!|Please, enter the ' + $(this).data('shouldbe') + '.');
                    err++;
                }
            }
        }
        if (err == 0) {
            if ($(this).data('type') !== undefined) {
                if ($(this).data('type') == 'email') {
                    let regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if (!regex.test(inputValue)) {
                        showNotifications('error', 'Oops!!|Please, enter valid email address.');
                        err++;
                    }
                }
                if ($(this).data('type') == 'checkbox') {
                    inputValue = $('#rememberme').is(':checked') ? 1 : 0;
                }
            }
        }
        formdata[$(this).attr('id')] = inputValue;
    });
    if (err == 0) {

        var day = new Date();
        var timezonOffset = day.getTimezoneOffset();
        formdata['timezonOffset'] = timezonOffset;
        $.ajax({
            url: postUrl,
            type: "POST",
            data: formdata,
            success: function(e) {
                var obj = JSON.parse(e);
                showNotifications(obj.status, obj.msg, obj.action);
                return false;
            }
        });
    }
}