/* Hosted Template Js */

jQuery(document).ready(function($) {
    "use strict";

    if( localStorage.getItem('this_temp'+$('#temp_id').val() ) != '1' ){
        let obj = new FormData()
        obj.append('site_id', $('#temp_id').val() );
        sendAjaxRequest(baseurl+'response/addAnalytics', 'POST', obj)
                .then(function(response) {
                    let resp = JSON.parse(response)
                    if( resp.status == 'success' ){
                        localStorage.setItem('this_temp'+$('#temp_id').val(), '1')
                    }
                })
        
    }

    if( $('.pp-header-wrapper').hasClass('fixed-menu') ){
        $(window).scroll(function () {
            $('.pp-header-wrapper').removeClass('pp-header-fixed')
        })
    }

    $(document).on('click', '[type="submit"]', function(e){
        e.preventDefault();
        let _this = $(e.target);
        let btntxt = _this.html();
        _this
            .html('<span class="sc_wait_pro">Wait...</span>')
            .prop("disabled", true);
    
        let myForm = $(this).closest('form');
        checkValidation(myForm)
            .then(() => {
                let dataForm = myForm[0];
                var obj = new FormData(dataForm);
                obj.append( 'auth_code', $('#temp_id').val() )
                sendAjaxRequest(baseurl+'response/submitresponse', 'POST', obj)
                    .then(function(response) {
                        let resp = JSON.parse(response)
                        if( resp.status == 'success' ){
                            showMessage(_this, 'success', resp.message)
                            resetForm( myForm )
                        }
                        _this.html(btntxt).prop("disabled", false);
                    })
                    .catch(function(error) {
                        // Handle errors here
                        showMessage(_this, 'error', error)
                    });
            })
            .catch((message) => {
                _this.html(btntxt).prop("disabled", false);
                showMessage(_this, 'error', message)
            });
    })

    function checkValidation(form) {
        return new Promise((resolve, reject) => {
            form.find("input , textarea , select").each(function () {
                let _this = $(this);
                if (_this.attr("data-required") == "true" && $.trim(_this.val()) == "") {
                    _this.addClass("error").focus();
                    reject(
                        _this.data("error")
                            ? _this.data("error")
                            : "You have missed out some required fields"
                    );
                    return false;
                }
                let checkemail = wordInString( String(_this.attr('name')), ['email', 'pp_email']  );
                if ( checkemail.length ) {
                    if ( !isValidEmailAddress(_this.val()) ) {
                        reject(
                            'Please Enter a valid email address'
                        );
                        return false;
                    }
                }
            });
            resolve();
        });
    }
    
    function sendAjaxRequest(url, method, data ) {
        data.append('csrf_pixelpages', $('#csrf_token').val())
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                success: resolve, // Resolve the promise on success
                error: reject     // Reject the promise on error
            });
        });
    }
    
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };
    
    function wordInString(string, keywords) {
        return keywords.filter(function(x) { return this.includes(x) }, string.split(/\b/));
    }
    
    function showMessage(_this, type, message){
        if( message == '' )
            return false;
        $('#alertUser').remove();
    
        if( type == 'success' ){
            if( _this.closest('form').find('.mt_form_input').length > 1 )
                $('<p id="alertUser" style="color:green;">'+message+'</p>').insertBefore(_this);
            else
                _this.closest('form').append('<p id="alertUser" style="color:green;">'+message+'</p>');
        }else{
            if( _this.closest('form').find('.mt_form_input').length > 1 )
                $('<p id="alertUser" style="color:red;">'+message+'</p>').insertBefore(_this);
            else
            _this.closest('form').append('<p id="alertUser" style="color:red;">'+message+'</p>');
        }
        setTimeout(() => {
            $('#alertUser').remove();
        }, 3000);
    }

    /* Reset Form */
    let resetForm = function(_this){
        _this
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

});



