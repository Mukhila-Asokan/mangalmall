
jQuery(document).ready(function($) {
    "use strict";

    $(document).on('click', '.ppd_edit_template', function () { 
        let obj = new FormData()
        obj.append('template_id', $(this).data('uniq_id'))
        initiateAjaxRequest('ajax/getTemplateZipById', obj, (resp) => {
            $('.ppa_userAddUpdateModal').text('Update Template')
        });
    })

    $(document).on('click', '.ppa_add_template', function () { 
        resetModal('#createupdatetemp_form')
        $('.ppa_userAddUpdateModal').text('Add Template Zip')
    })

    /* delete template */
    $(document).on('click', '.ppd_delete_template', function(e){
        confirm_popup_function('Delete', 'Are you sure you want to delete this template ? This action cannot be undone.', 'remove_it(\'ajax/deleteTemplate\', '+$(this).data('uniq_id')+')' , true)
    })

    /* active or inactive template status */
    $(document).on('click', '.ppd_active_inactive_template', function(e){
        setTimeout(() => {
            let input = $(this).siblings('input').is(':checked')
            let obj = new FormData
            obj.append('template_id', $(this).data('uniq_id'))
            obj.append('template_status', input)
        }, 500);
    })

});