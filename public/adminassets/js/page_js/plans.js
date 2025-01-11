jQuery(document).ready(function($) {
    "use strict";

    $(document).on( 'click', '.show_plans_template', function(e){
        let plan_id = $(this).data('plan-id')
        browseTemplates(0, $(this).data('plan-id'))
            .then( function(resp){
                $('#pxg_temp_plan_model').modal('show')
                $('.load_more_temp_btn').attr('data-plan-id', plan_id)
            })
    })

    function browseTemplates(offset, plan_id, limit = 8){
        return new Promise(function(resolve, reject) {
            let obj = new FormData();
            obj.append( 'offset', offset )
            obj.append( 'limit' , limit )
            obj.append( 'plan_id', plan_id )
            initiateAjaxRequest('Ajax/loadTemplatesOfPlan', obj, (resp) => {
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
        browseTemplates( $(this).data('offset'), $(this).data('plan-id') )
            .then( function(response){
                _this.text(prev_txt_)
            })
    })

})