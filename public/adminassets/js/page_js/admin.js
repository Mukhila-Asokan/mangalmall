/*--------------------- Copyright (c) 2023 -----------------------
[Admin Javascript]
Project: PixelPages 
Version: 1.0.0
-------------------------------------------------------------------*/
jQuery(document).ready(function($) {
    "use strict";

    /* delete user */
    $(document).on('click', '.ppa_delete_user', function(e){
        confirm_popup_function('Delete User', 'Are you sure you want to delete User ? This action cannot be undone.', 'remove_it(\'AdminAjax/deleteUserById\', '+$(this).data('uniq_id')+')' , true)
    })

    /* edit user */
    $(document).on('click', '.ppa_edit_user', function(e){
        // reset modal
        resetModal('#createupdateuser_form')
        let obj = new FormData()
        obj.append('user_id', $(this).data('uniq_id'))
        initiateAjaxRequest('AdminAjax/getUserInfoById', obj, (resp) => {
            $('.ppa_userAddUpdateModal').text('Update User')
            $('[name="pps_email"]').attr('readonly', true)
            $('.ppa_password_input').removeClass('require')
        });
    })

    /* add user */
    $(document).on('click', '.ppa_add_user', function(e){
        // reset modal
        resetModal('#createupdateuser_form')
        $('.ppa_userAddUpdateModal').text('Add User')
        $('[name="pps_email"]').attr('readonly', false)
        $('.ppa_password_input').addClass('require')
    })

    /* active or inactive user status */
    $(document).on('click', '.ppa_active_inactive_user', function(e){
        setTimeout(() => {
            let input = $(this).siblings('input').is(':checked')
            let obj = new FormData
            obj.append('user_id', $(this).data('uniq_id'))
            obj.append('user_status', input)
            initiateAjaxRequest('AdminAjax/updateUserActiveStatus', obj)
        }, 500);
    })

    /* Edit Profile */
    $(document).on('click', '.ppa_editProfileBtn', function(e){
        $('.ppa_saveProfileBtn').removeClass('d-none')
        $('.editable').attr('disabled', false)
        $("#ppa_profileCountrySelect2").select2({disabled: false});
    })

    $(document).on('click', '.ppa_edit_template', function(e){
        let template_id = $(this).data('unique_id');
        let obj = new FormData
        obj.append('template_id', template_id)
        initiateAjaxRequest('AdminAjax/getTemplateById', obj)
    })


    /* Plans Page js starts */

    // Add plan
    $(document).on('click', '.ppa_add_plan', function(e){
        // reset modal
        resetModal('#createupdateplan_form')
        resetTemplateBrowseField()
        $('#plan_currency').val('').trigger('change')
        $('#plan_interval').val('7').trigger('change')
        upgrade_modal( '#pxg_create_update_plan_model', 'Add Plan', 'Create Plan', true )
    })

    // edit plan 
    $(document).on('click', '.ppa_edit_plan', function(e){
        // reset modal
        resetTemplateBrowseField()
        upgrade_modal( '#pxg_create_update_plan_model', 'Update Plan', 'Save Changes' )
        let obj = new FormData()
        obj.append('plan_id', $(this).data('uniq_id'))
        initiateAjaxRequest('AdminAjax/getPlanInfoById', obj, (resp) => {
            resp = JSON.parse(resp)
            if( resp.status == 'success' ){
                
                $(resp.data.elm_).text(resp.data.txt_)
            }
        });
    })

    // active or inactive plan status 
    $(document).on('click', '.ppa_active_inactive_plan', function(e){
        setTimeout(() => {
            let input = $(this).siblings('input').is(':checked')
            let obj = new FormData
            obj.append('plan_id', $(this).data('uniq_id'))
            obj.append('plan_status', input)
            initiateAjaxRequest('AdminAjax/updatePlanActiveStatus', obj)
        }, 500);
    })

    // delete plan 
    $(document).on('click', '.ppa_delete_plan', function(e){
        confirm_popup_function('Delete Plan', 'Are you sure you want to delete this Plan ?', 'remove_it(\'AdminAjax/deletePlanById\', '+$(this).data('uniq_id')+')' , true)
    })


    /* Plans Page js ends  */

    /* Admin editor Page js starts  */
    $(document).on('click', '.pxg_save_admin_template', function(e){
        let template_id = $(this).data('temp-id');
        let obj = new FormData
        obj.append('template_id', template_id)
        obj.append('html', $('.mt_edit_template_container').html().replaceAll( atob( $('.mt_edit_template_container').data('replace-path') ) , '' ) )
        initiateAjaxRequest('venue/updatetheme_venue', obj) 
    })
    /* Admin editor Page js ends  */

    function resetTemplateBrowseField(){
        $('#search_temp_for_plan').val(''); 
        $('#filter_plan_templates').val(0).trigger('change');
        $('#selected_templates_num').text( 'Selected Templates - 0' )
    }

    if( $('[data-page="admin_plans"]').length ){
        $("#select_template").select2({
            placeholder: '',
            width: '100%',
            dropdownParent: $("#select_template").parent(),
            minimumInputLength: 3,
            tags: false,
            ajax: {
                url: baseurl+'AdminAjax/getTemplateByKeyword',
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                data: function (params) {
                    var query = {
                        term: params.term,
                        _type: params._type,
                        csrf_pixelpages:$('#csrf_token').val()
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (obj) {
                            return { id: obj.id, text: obj.template_name };
                        })
                    };
                }
            }
        });

        $(document).on( 'change', '#filter_plan_templates', function(e){
            if( $('#pxg_temp_plan_model').hasClass('show') )
                browseTemplates(0)
        })
        
        $(document).on( 'click', '.select_templates_field', function(e){
            // if( $('[name="plan_id"]').val().trim() != '' )
            //     $('#filter_plan_templates').val(1).trigger('change')
            browseTemplates(0)
            $('#pxg_temp_plan_model').modal('show')
        })

        /* $(document).on('click', '#checkbox-id', function(e){
            var selected = [];
            $('#plan_t_select').find("option").each(function(i,e){
                selected[selected.length]=$(e).attr("value");
            });
            $('#plan_t_select').val(selected).trigger('change');
        }) */
        
        function browseTemplates(offset, limit = 8){
            return new Promise(function(resolve, reject) {
                let obj = new FormData();
                obj.append( 'offset', offset )
                obj.append( 'limit' , limit )
                obj.append( 'search' , $('#search_temp_for_plan').val() )
                obj.append( 'filter' , $('#filter_plan_templates').val() )
                obj.append( 'plan_id', $('[name="plan_id"]').val().trim() )
                obj.append( 'selected', $('#plan_t_select').val() )
                initiateAjaxRequest('AdminAjax/loadTemplatesForPlanAdd', obj, (resp) => {
                    $('.nothing_found_elem_').addClass('d-none')
                    resp = JSON.parse(resp);
                    resolve()
                    if( resp.status === 'success' ){
                        if( resp.count > 0 ){
                            // render content
                            if( offset == 0 )
                                $('.selct_temp_for_plan_container').html( resp.html )
                            else
                                $('.selct_temp_for_plan_container').append( resp.html )
                            
                            // benchmark offset
                            $('.load_more_temp_btn').data('offset', resp.offset)
                        }else{
                            // if nothing found
                            if( offset == 0  ){
                                $('.nothing_found_elem_').removeClass('d-none')
                                $('.selct_temp_for_plan_container').empty()
                            }
                        }

                        // for load more button
                        if( resp.count >= limit  )
                            $('.load_more_temp_btn').removeClass('d-none')
                        else
                            $('.load_more_temp_btn').addClass('d-none')
                    }
                })
            })
        }

        $(document).on('click', '.load_more_temp_btn', function(e){
            let _this = $(this)
            let prev_txt_ = _this.text()
            _this.text('Loading...')
            browseTemplates( $(this).data('offset'), 8 )
                .then( function(response){
                    _this.text(prev_txt_)
                })
        })

        /* $(document).on('keydown', '#search_temp_for_plan', function(e){
            if (e.which == 13 && $(this).val().trim() != '' ) {
                browseTemplates(0)
            } 
        }) */

        $(document).on('click', '.search_temp_in_popup', function(e){
            browseTemplates(0)
        })

        $(document).on('click', '.tempid_for_plan', function(e){
            let item_ids = $('#plan_t_select').val();
            
            $('.tempid_for_plan:checked').each(function(i, obj) {
                item_ids.push( String($(this).data('id')));
            });
            if( !$(this).prop('checked') ){
                item_ids = removeFrmArr(item_ids, String($(this).data('id')))
            }
            $('#plan_t_select').val(item_ids).trigger('change');
            $('#selected_templates_num').text( 'Selected Templates - '+ $('#plan_t_select').select2('data').length )
        })

        function removeFrmArr(array, element) {
            return array.filter(e => e !== element);
        };


    }

    if( $('[data-page="admin_templates"]').length ){

        
        $(document).on('keypress', '.search_q', function(e){
            if (e.which == 13 && $(this).val().trim() != '' ) {
                let Query = 'search='+$(this).val()
                window.location.href= baseurl+ 'admin/templates?'+Query;
            }
        })

        let ControlRequest = true;
        $(window).scroll(function(){
            if($(window).scrollTop()  + $(window).height() > $(document).height()-200 && ControlRequest){
                loadMoreFiles()
            }
        })
    
        function loadMoreFiles(){
            let o_set = $('.pxg_d_template_container').data('offset')
            let limit = 15;
            let obj = new FormData()
            obj.append('offset', o_set)
            obj.append('limit', limit)
            obj.append('search', $('.search_q').val())
            initiateAjaxRequest('Ajax/loadDfyTemplates', obj, (resp) => {
                resp = JSON.parse(resp)
                if( resp.status == 'success' && resp.html != '' ){
                    $('.pxg_d_template_container').data('offset', resp.offset)
                    $('.pxg_d_template_container').append(resp.html)
                    if( resp.count >= limit )
                        ControlRequest = true;
                    else
                        ControlRequest = false;
                }else
                    ControlRequest = false;
            })
        }
    
    
    
    }

});
