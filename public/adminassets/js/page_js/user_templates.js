/* Javascript : Users templates */

jQuery(document).ready(function($) {
    "use strict";

    $(document).on('click', '.ppd_add_to_templates', function () { 
        let obj = new FormData()
        obj.append('dfy_temp_id', $(this).data('dfy-id'))
        initiateAjaxRequest('ajax/addDfyTemplateDataToMyTemplates', obj);
    })
    
    
    $(document).on('click', '.ppd_edit_template', function () { 
        let obj = new FormData()
        obj.append('template_id', $(this).data('uniq_id'))
        initiateAjaxRequest('ajax/getMyTemplateById', obj, (resp) => {
            resp = JSON.parse(resp)
            if( resp.status == 'success' ){
                let name = $('#hosting_name').val() ? $('#hosting_name').val() : 'my-site';
                $('#site_url_name_text').text( name );
                let favicon = $('#old_ppd_template_favicon').val() ? $('#old_ppd_template_favicon').val() : '';
                $("#favicon_preview").attr("src", favicon);
                $(".pxg_upload p").text('file name');
            }
        });
    })
    
    $(document).on('click', '.ppd_clone_template', function () { 
        let obj = new FormData()
        obj.append('usr_temp_id', $(this).data('uniq_id'))
        initiateAjaxRequest('ajax/cloneUserTemplate', obj);
    })
    
    $(document).on('keyup', '#hosting_name', function(e){
        $('#site_url_name_text').text( $(this).val() )
    })
    
    /* delete template */
    $(document).on('click', '.ppd_delete_template', function(e){
        confirm_popup_function('Delete', 'Are you sure you want to delete this template ? It will remove all its related data', 'remove_it(\'ajax/deleteMyTemplate\', '+$(this).data('uniq_id')+')' , true)
    })



    if( $('[data-page="u_dfytemplates"]').length || $('[data-page="u_sites"]').length ){ 

        let url = $('[data-page="u_dfytemplates"]').length ? 'dfy-templates' : 'my-sites';
        let api = $('[data-page="u_dfytemplates"]').length ? 'loadDfyTemplates' : 'loadMyTemplates';
        
        function createQuery(){
            let _s = $('.search_q').val().trim();
            let _t = ( $('#dfy_type_selct').length ) ? $('#dfy_type_selct').val(): '';
            let _q = (( _s != '' || _t != '' ) ? '?' : '' ) + (( _s != '' ) ? 'search='+_s : '' ) + (( _s != '' && _t != '' ) ? '&' : '' ) + (( _t != '' ) ? 'type='+btoa(_t) : '' );
            return _q;
        }

        $(document).on('keypress', '.search_q', function(e){
            if (e.which == 13 && $(this).val().trim() != '' ) {
                // let Query = 'search='+$(this).val()
                window.location.href= baseurl+url+createQuery();
            }
        })

        $(document).on('change', '#dfy_type_selct', function(e){
            window.location.href= baseurl+url+createQuery();
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
            if( $('#dfy_type_selct').length )
                obj.append('type', $('#dfy_type_selct').val())
            initiateAjaxRequest('Ajax/'+api, obj, (resp) => {
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

    if( $('[data-page="u_sites"]').length ){
        let site_html = ''
        $(document).on('click', '.download_site', function(e){
            let obj = new FormData()
            obj.append('site_id', $(this).data('site-id'))
            initiateAjaxRequest('ajax/downloadMySiteTemplate', obj, (resp) => {
                resp = JSON.parse(resp)
                if( resp.status == 'success' ){
                    processStatus( true ) 
                    let f = resp.meta.folder_structure;
                    var zip = new JSZip();
                    site_html = resp.meta.site_html.replaceAll( resp.meta.replace_path, '' ) ;
                    if( resp.meta.upload_images.length > 0 ){
                        $.each(resp.meta.upload_images, function (i, v) { 
                             let f_name = basename(v)
                             site_html = site_html.replaceAll(v,'assets/images/'+f_name)
                             f.assets.images.files.push(v)
                        });
                    }

                    var obj = getFoldersData(zip, f, resp.meta.site_name)
                    obj.generateAsync({type:"blob"})
                    .then(function(content) {
                        // see FileSaver.js
                        saveAs(content, resp.meta.site_name+'.zip');
                        processStatus( false ) 
                        showNotifications("success", "Started downloading");
                    }).catch(function (err) {
                        setTimeout(() => {
                            processStatus( false ) 
                            showNotifications("error", err);
                        }, 500);
                    });
                }
            });
        })

        function getFoldersData(folder_obj, folder_data, path){
            
            $.each(folder_data, function (i, v) {
                if( i != 'files' ){
                    let new_path = path+'/'+ i;
                    folder_obj.folder( new_path );
                    getFoldersData(folder_obj, v, new_path)
                }
                if( i == 'files' ){
                    $.each(v, function (i, v2) {
                        let filename = basename(v2);
                        if( filename == 'index.html' ){
                            folder_obj.file(path+'/'+filename, site_html);
                        }else{
                            let file_data = fetchFileData( v2 )
                            folder_obj.file(path+'/'+filename, file_data , {base64: true});
                        }
                    })
                }
            });
            
            return folder_obj;
        }

        function basename(path) {
            return path.split('/').reverse()[0];
        }

        let fetchFileData = (file) => fetch(file).then((res) => res.blob());
    
    }

    if( $('[data-page="u_sites_response"]').length ){
        let q_url = 'sites-response';

        $(document).on('change', '#select_site', function(e){
            let site_id   = $('#select_site').val();
            let form_type = $('#select_form_type').val();
            let keyword   = '';
            let q = ( keyword != ''? '&search='+keyword : '' ) ;
            q += '&site_id=' + site_id;
            q += '&form_type=' + form_type;
            
            window.location.href= baseurl+ q_url + '?q=true'+q;
        })
        $(document).on('change', '#select_form_type', function(e){
            let site_id   = $('#select_site').val();
            let form_type = $('#select_form_type').val();
            let keyword   = '';
            let q = ( keyword != ''? '&search='+keyword : '' ) ;
            q += '&site_id=' + site_id;
            q += '&form_type=' + form_type;
            
            window.location.href= baseurl+ q_url + '?q=true'+q;
        })
        
        $(document).on('keypress', '#search_hosted_sites', function(e){
            if (e.which == 13 && $(this).val().trim() != '' ) {
                let site_id   = $('#select_site').val();
                let form_type = $('#select_form_type').val();
                let keyword   = $('#search_hosted_sites').val().trim();
                let q = ( keyword != ''? '&search='+keyword : '' ) ;
                q += '&site_id=' + site_id;
                q += '&form_type=' + form_type;
                
                window.location.href= baseurl+ q_url + '?q=true'+q;
            }
        })

        $(document).on('click', '.aiw_add_lead_to_ar', function(e){
            let id = $(this).data('id');
            $('#rec_ids').val( btoa(id) );
            $('#pxg_add_lead_ar_model').modal('show');
        })

        $(document).on('click', '.aiw_view_lead_response', function(e){
            let resp = atob( $(this).data('resp') );
            resp = JSON.parse( resp );
            let html = ''
            $.each(resp, function (i, v) { 
                if( i != 'auth_code' ){
                    html += `<div class="pxg_main_input">
                                <input class="pxg_custom_input" readonly value="${v}" autocomplete="off">
                            </div>`
                }
            });
            $('.resp_container').html(html)
            $('#pxg_response_view_model').modal('show')
        })

        $(document).on('click', '.aiw_delete_record', function(e){
            let id = $(this).data('id');
            let site_id = $(this).data('site-id');
            confirm_popup_function(
                'Are you sure?',
                'You want to remove this record.',
                `remove_it('Ajax/deleteSiteResponse', '${id}', '${site_id}')`,
                true
            );
        })

        $(document).on("change", ".fe_autoresponder_select", function() {
            var autoresponder = $(this).val();

            let obj = new FormData()
            obj.append( 'responser', true )
            initiateAjaxRequest( 'Ajax/getListOfResponder/'+autoresponder, obj, (resp) => {
                var listData = JSON.parse(resp);
                var html = '<option value="">Select List</option>';
                for (var i = 0; i < listData.data.length; i++) {
                    html += "<option value='" + listData.data[i].list_value + "'> " + listData.data[i].list_name + "</option>";
                }
                $('.fe_autoresponderlist_select').html(html).select2("destroy").select2({
                    placeholder: $(this).attr("data-placeholder"),
                    disabled: $(this).attr("data-disabled") != undefined ? $(this).attr("data-disabled"): false,
                    width: '100%',
                    dropdownParent: $(this).parent(),
                });
            } )
        })

        $(document).on('click', '.aiw_select-all', function (e) { 
            var oTable = $('#userTable').DataTable();
            if ($(this).prop('checked')) {
                $('.chkLeads').removeClass('d-none');
                oTable.$("input[type='checkbox']").prop('checked', true);
                // $($(this).data('checkfields')).prop('checked', true)
            }
            else {
                oTable.$("input[type='checkbox']").prop('checked', false);
                $('.chkLeads').addClass('d-none');
                // $($(this).data('checkfields')).prop('checked', false)
            }
        })

        $(document).on('click', '.chkLeads', function(e) {
            let item_ids = '';
            $('.leads_chk_box:checked').each(function(i, obj) {
                item_ids += $(this).data('id') + ',';
            });
            if (item_ids != '') {
                // item_ids = btoa(item_ids);
                $('#rec_ids').val( btoa(item_ids) );
                $('#pxg_add_lead_ar_model').modal('show');
            } else {
                showNotifications('error', 'Please select the files to remove!');
            }
        
        })

        $(document).on('click', '.leads_chk_box', function(e){
            if($('.leads_chk_box:checked').length){
                $('.chkLeads').removeClass('d-none');
            }else{
                $('.chkLeads').addClass('d-none');
            }
        })
    }
    
});

