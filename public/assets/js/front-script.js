
jQuery(document).ready(function($) {
"use strict";
	
	/** Loader on button click **/
	jQuery(".pg-preloader-wrap").fadeOut(); 
	jQuery(".pg-preloader").delay(200).fadeOut("slow");	

	$('[open-modal]').on('click', function(){
		$('body').addClass("modal-open");
		var id = $(this).attr('open-modal');
		$('.custom-modal#'+id).addClass('active');
	});
	$('[close-modal]').on('click', function(){
		$('body').removeClass("modal-open");
		$(this).parents('.custom-modal').removeClass('active');
	});
	$('.custom-modal').on('click', function(e) {
		if(e.target !== this){return};
		$(this).removeClass('active');
		$('body').removeClass("modal-open");
	});

	/**
	 * Stripe Button Disabled Code
	 */
    $(document).on('change', '.pg-changes-user ,.pg-changes-pass', function(e){
        let us_name = $(this).val();
		if(us_name != ''){
			$(document).on('change', '.pg-changes-pass', function(e){
				let us_pass = $(this).val();
				if(us_pass != ''){
				  $('.pg-btn-wrapper').removeClass("pg-btn-disabled");
				}
		   });
	    }
	});
	$('.pg-btn-wrapper').addClass("pg-btn-disabled");
	/**
	 * Verify Coupon Code
	 */
	$(document).on('click', '.apply_coupon_code', function(e){
		e.preventDefault();
		let coupon_id = $(this).data('coupon_id');
		let coupon_code = $("#"+coupon_id).val();
		if(coupon_code == ''){
			$.toaster('Enter Coupon Code', 'Error', 'danger');
		}else{
			let ajax_url = $('#base_url').data('ajax_url');
			var data = {'coupon_code' : coupon_code, 'action' : 'verify' }
			$.ajax({
				type:'post',
				url: ajax_url + 'authentication/verify_coupon_code',
				data:data,
				success:function(data){
					var result = jQuery.parseJSON(data);
					if(result.status){
						$.toaster(result.msg, 'Success', 'success');
					}else{
						$.toaster(result.msg, 'Error', 'danger');
					}
					
				}
			});
	    }
	});
        
});