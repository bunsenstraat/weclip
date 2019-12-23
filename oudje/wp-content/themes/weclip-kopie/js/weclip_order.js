if (typeof WECLIP == 'undefined') { var WECLIP = {}; }
WECLIP.order = {
	step:0,
	photos: {},
	init: function() {
		switch(WECLIP.order.step) {
			case 0:
			case 1:
				jQuery('form#signup_form').submit(function(e) {
					if (jQuery('input[name=BASIC]').is(':checked') == false && jQuery('input[name=COMPLEX]').is(':checked') == false && jQuery('input[name=MEDIUM]').is(':checked') == false) {
						alert ('Selecteer ten minste 1 categorie.');
						return false;
					}
				});
				jQuery(document).ready(function() {
					jQuery('#BASIC').on('click', function(event) {
						var bg_url = jQuery('#BASIC').css('background-image');
						if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")') {
							jQuery('#BASIC').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
						}
						if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")') {
							jQuery('#BASIC').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');
						}
						jQuery('.box1').trigger('click');
					});
					jQuery('.box1').on('change', function(event) {
						var checkbox = jQuery(event.target);
					});
				
					jQuery('#COMPLEX').on('click', function(event) {
						var bg_url = jQuery('#COMPLEX').css('background-image');
						if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")') {
							jQuery('#COMPLEX').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
						}
						if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")') {
							jQuery('#COMPLEX').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');
						}
						jQuery('.box3').trigger('click');
					});
					jQuery('.box3').on('change', function(event) {
						var checkbox = jQuery(event.target);
					});
					jQuery('#MEDIUM').on('click', function(event) {
						var bg_url = jQuery('#MEDIUM').css('background-image');
						if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")') {
							jQuery('#MEDIUM').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
						}
						if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")') {
							jQuery('#MEDIUM').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');
						}
						jQuery('.box2').trigger('click');
					});
					jQuery('.box2').on('change', function(event) {
						var checkbox = jQuery(event.target);
					});
				});
				this.gto.one();
			break;
			case 2:
				jQuery('form#signup_form input.next').click(function(e) {
					return WECLIP.order.formverify.step2();
				});
				jQuery(document).ready(function() {
					jQuery('#stp_f_0').on('click', function(event) {

					var bg_url = jQuery('#download_now_f_0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_f_0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_f_0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}

					jQuery('.stp_f1_0').trigger('click');
					});
					jQuery('.stp_f1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
			
					jQuery('#stp_s_0').on('click', function(event) {
					var bg_url = jQuery('#download_now_0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_s1_0').trigger('click');
					});
					jQuery('.stp_s1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_t_0').on('click', function(event) {
					var bg_url = jQuery('#download_now_t_0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_t_0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_t_0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_t1_0').trigger('click');
					});
					jQuery('.stp_t1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
				
					jQuery('#stp_fo_0').on('click', function(event) {
					var bg_url = jQuery('#download_now_fo_0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_fo_0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_fo_0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_fo1_0').trigger('click');
					});
					jQuery('.stp_fo1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
				
					jQuery('#stp_fi_0').on('click', function(event) {
					var bg_url = jQuery('#download_now_fi_0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_fi_0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_fi_0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_fi1_0').trigger('click');
					});
					jQuery('.stp_fi1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
				
					jQuery('#stp_si_0').on('click', function(event) {
					var bg_url = jQuery('#download_now_si_0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_si_0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_si_0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_si1_0').trigger('click');
					});
					jQuery('.stp_si1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
				
					jQuery('#stp_f_1').on('click', function(event) {
					var bg_url = jQuery('#download_now_f_1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_f_1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_f_1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_f1_1').trigger('click');
					});
					jQuery('.stp_f1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
				
					jQuery('#stp_s_1').on('click', function(event) {
					var bg_url = jQuery('#download_now_1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_s1_1').trigger('click');
					});
					jQuery('.stp_s1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_t_1').on('click', function(event) {
					var bg_url = jQuery('#download_now_t_1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_t_1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_t_1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_t1_1').trigger('click');
					});
					jQuery('.stp_t1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_fo_1').on('click', function(event) {
					var bg_url = jQuery('#download_now_fo_1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_fo_1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_fo_1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_fo1_1').trigger('click');
					});
					jQuery('.stp_fo1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_fi_1').on('click', function(event) {
					var bg_url = jQuery('#download_now_fi_1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_fi_1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_fi_1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_fi1_1').trigger('click');
					});
					jQuery('.stp_fi1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_si_1').on('click', function(event) {
					var bg_url = jQuery('#download_now_si_1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_si_1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_si_1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_si1_1').trigger('click');
					});
					jQuery('.stp_si1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_f_2').on('click', function(event) {
					var bg_url = jQuery('#download_now_f_2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_f_2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_f_2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_f1_2').trigger('click');
					});
					jQuery('.stp_f1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_s_2').on('click', function(event) {
					var bg_url = jQuery('#download_now_2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_s1_2').trigger('click');
					});
					jQuery('.stp_s1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_t_2').on('click', function(event) {
					var bg_url = jQuery('#download_now_t_2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_t_2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_t_2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_t1_2').trigger('click');
					});
					jQuery('.stp_t1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_fo_2').on('click', function(event) {
					var bg_url = jQuery('#download_now_fo_2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_fo_2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_fo_2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_fo1_2').trigger('click');
					});
					jQuery('.stp_fo1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_fi_2').on('click', function(event) {
					var bg_url = jQuery('#download_now_fi_2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_fi_2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_fi_2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_fi1_2').trigger('click');
					});
					jQuery('.stp_fi1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#stp_si_2').on('click', function(event) {
					var bg_url = jQuery('#download_now_si_2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#download_now_si_2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#download_now_si_2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.stp_si1_2').trigger('click');
					});
					jQuery('.stp_si1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#jpg0').on('click', function(event) {
						
					var bg_url = jQuery('#jpg0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#jpg0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#jpg0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.jpg1_0').trigger('click');
					});
					jQuery('.jpg1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#png0').on('click', function(event) {
					var bg_url = jQuery('#png0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#png0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#png0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.png1_0').trigger('click');
					});
					jQuery('.png1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#psd0').on('click', function(event) {
					var bg_url = jQuery('#psd0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#psd0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#psd0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.psd1_0').trigger('click');
					});
					jQuery('.psd1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#tiff0').on('click', function(event) {
					var bg_url = jQuery('#tiff0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#tiff0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#tiff0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.tiff1_0').trigger('click');
					});
					jQuery('.tiff1_0').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#jpg1').on('click', function(event) {
					var bg_url = jQuery('#jpg1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#jpg1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#jpg1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.jpg1_1').trigger('click');
					});
					jQuery('.jpg1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#png1').on('click', function(event) {
					var bg_url = jQuery('#png1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#png1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#png1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.png1_1').trigger('click');
					});
					jQuery('.png1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#psd1').on('click', function(event) {
					var bg_url = jQuery('#psd1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#psd1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#psd1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.psd1_1').trigger('click');
					});
					jQuery('.psd1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#tiff1').on('click', function(event) {
					var bg_url = jQuery('#tiff1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#tiff1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#tiff1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.tiff1_1').trigger('click');
					});
					jQuery('.tiff1_1').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#jpg2').on('click', function(event) {
					var bg_url = jQuery('#jpg2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#jpg2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#jpg2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.jpg1_2').trigger('click');
					});
					jQuery('.jpg1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#png2').on('click', function(event) {
					var bg_url = jQuery('#png2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#png2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#png2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.png1_2').trigger('click');
					});
					jQuery('.png1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#psd2').on('click', function(event) {
					var bg_url = jQuery('#psd2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#psd2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#psd2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.psd1_2').trigger('click');
					});
					jQuery('.psd1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#tiff2').on('click', function(event) {
					var bg_url = jQuery('#tiff2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#tiff2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#tiff2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.tiff1_2').trigger('click');
					});
					jQuery('.tiff1_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#jpg3').on('click', function(event) {
					jQuery('.jpg1_3').trigger('click');
					});
					jQuery('.jpg1_3').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#png3').on('click', function(event) {
					jQuery('.png1_3').trigger('click');
					});
					jQuery('.png1_3').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#psd3').on('click', function(event) {
					jQuery('.psd1_3').trigger('click');
					});
					jQuery('.psd1_3').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#tiff3').on('click', function(event) {
					jQuery('.tiff1_3').trigger('click');
					});
					jQuery('.tiff1_3').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#anntaaa0').on('click', function(event) {
					var bg_url = jQuery('#anntaaa0').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#anntaaa0').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#anntaaa0').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.anntaaa10').trigger('click');
					});
					jQuery('.anntaaa10').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#anntaaa1').on('click', function(event) {
					var bg_url = jQuery('#anntaaa1').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#anntaaa1').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#anntaaa1').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.anntaaa11').trigger('click');
					});
					jQuery('.anntaaa11').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});
					
					jQuery('#anntaaa2').on('click', function(event) {
					var bg_url = jQuery('#anntaaa2').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
					{
					jQuery('#anntaaa2').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
					}
					if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
					{
					jQuery('#anntaaa2').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

					}
					jQuery('.anntaaa12').trigger('click');
					});
					jQuery('.anntaaa12').on('change', function(event) {
					var checkbox = jQuery(event.target);
					});

					jQuery("#download_now_0").tooltip({ effect: 'slide'});
					jQuery("#download_now_1").tooltip({ effect: 'slide'});
					jQuery("#download_now_2").tooltip({ effect: 'slide'});

					jQuery("#download_now_f_0").tooltip({ effect: 'slide'});
					jQuery("#download_now_f_1").tooltip({ effect: 'slide'});
					jQuery("#download_now_f_2").tooltip({ effect: 'slide'});

					jQuery("#download_now_t_0").tooltip({ effect: 'slide'});
					jQuery("#download_now_t_1").tooltip({ effect: 'slide'});
					jQuery("#download_now_t_2").tooltip({ effect: 'slide'});

					jQuery("#download_now_fo_0").tooltip({ effect: 'slide'});
					jQuery("#download_now_fo_1").tooltip({ effect: 'slide'});
					jQuery("#download_now_fo_2").tooltip({ effect: 'slide'});

					jQuery("#download_now_fi_0").tooltip({ effect: 'slide'});
					jQuery("#download_now_fi_1").tooltip({ effect: 'slide'});
					jQuery("#download_now_fi_2").tooltip({ effect: 'slide'});

					jQuery("#download_now_si_0").tooltip({ effect: 'slide'});
					jQuery("#download_now_si_1").tooltip({ effect: 'slide'});
					jQuery("#download_now_si_2").tooltip({ effect: 'slide'});
					
					
				});
				this.gto.two();
			break;
			case 3:
			
				for (fc = 0; fc <= 3; fc++) {
					jQuery('#optb'+fc).change(function() {
						if (jQuery(this).is(':checked')) {
							var fc = jQuery(this).attr('id').replace('optb','');
							jQuery('#datea'+fc).hide();
							jQuery('#dateb'+fc).show();
						}
					});
					jQuery('#opta'+fc).change(function() {
						if (jQuery(this).is(':checked')) {
							var fc = jQuery(this).attr('id').replace('opta','');
							jQuery('#datea'+fc).show();
							jQuery('#dateb'+fc).hide();
						}
					});
					
					jQuery('#opb'+fc).on('click', function(event) {
						var fc = jQuery(this).attr('id').replace('opb','');
							
						var bg_url = jQuery('#opb'+fc).css('background-image');				 
						if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/redio_no_select.png")') {
							jQuery('#opb'+fc).css('background-image','url(../wp-content/themes/weclip/images/radio_select.png)');
							jQuery('#opa'+fc).css('background-image','url(../wp-content/themes/weclip/images/redio_no_select.png)');
						}
						jQuery('#optb'+fc).trigger('click');
						var done = jQuery('#dateb'+fc).css('display');
						if(done == 'none') {
							jQuery('#dateb'+fc).css('display','inline-block');
							jQuery('#datea'+fc).css('display','none');
						}
						var done1 = jQuery('#datea'+fc).css('display');
					});
					jQuery('#optb'+fc).on('change', function(event) {
						var checkbox = jQuery(event.target);
					});

					jQuery('#opa'+fc).on('click', function(event) {
						var fc = jQuery(this).attr('id').replace('opa','');
						var bg_url = jQuery('#opa'+fc).css('background-image');
						var done = jQuery('#datea'+fc).css('display');					 
						if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/redio_no_select.png")') {
							jQuery('#opa'+fc).css('background-image','url(../wp-content/themes/weclip/images/radio_select.png)');
							jQuery('#opb'+fc).css('background-image','url(../wp-content/themes/weclip/images/redio_no_select.png)');
						}
						jQuery('#opta'+fc).trigger('click');
						if(done == 'none') {
							jQuery('#dateb'+fc).css('display','none');
							jQuery('#datea'+fc).css('display','block');
						}	
						if(done == 'block') {
							jQuery('#dateb'+fc).css('display','block');
							jQuery('#datea'+fc).css('display','none');
						}	
					});
					jQuery('#opta'+fc).on('change', function(event) {
						var checkbox = jQuery(event.target);
					});
				}
			
				WECLIP.order.photoupload.init();

				jQuery('form#signup_form input.next').click(function(e) {
					return WECLIP.order.formverify.step3();
				});
				
				this.gto.three();
			break;
			case 4:

				jQuery('#day5').on('click', function(event) {
					var bg_url = jQuery('#day5').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/redio_no_select.png")') {
						jQuery('#day5').css('background-image','url(../wp-content/themes/weclip/images/radio_select.png)');
						jQuery('#hr24').css('background-image','url(../wp-content/themes/weclip/images/redio_no_select.png)');
					}
					jQuery('.ra5').trigger('click');
				});
				jQuery('.ra5').on('change', function(event) {
					var checkbox = jQuery(event.target);
				});
			
				jQuery('#hr24').on('click', function(event) {
					var bg_url = jQuery('#hr24').css('background-image');
					if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/redio_no_select.png")') {
						jQuery('#hr24').css('background-image','url(../wp-content/themes/weclip/images/radio_select.png)');
						jQuery('#day5').css('background-image','url(../wp-content/themes/weclip/images/redio_no_select.png)');
					}
					jQuery('.ra24').trigger('click');
				});
				jQuery('.ra24').on('change', function(event) {
					var checkbox = jQuery(event.target);
				});
				
				jQuery('form#signup_form input.next').click(function(e) {
					return WECLIP.order.formverify.step4();
				});

				this.gto.four();
			break;
			case 5:
			
				jQuery('#register_12').on('click', function(event) {
				var bg_url = jQuery('#register_12').css('background-image');
				if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
				{
				jQuery('#register_12').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
				}
				if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
				{
				jQuery('#register_12').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

				}
				jQuery('.register_1').trigger('click');
				});
				jQuery('.register_1').on('change', function(event) {
				var checkbox = jQuery(event.target);
				});			

				jQuery('#register_22').on('click', function(event) {
				var bg_url = jQuery('#register_22').css('background-image');
				if(bg_url =='url("http://www.weclip.nl/wp-content/themes/weclip/images/NON_SELECTED.png")')
				{
				jQuery('#register_22').css('background-image','url(../wp-content/themes/weclip/images/SELECTED.png)');
				}
				if(bg_url == 'url("http://www.weclip.nl/wp-content/themes/weclip/images/SELECTED.png")')
				{
				jQuery('#register_22').css('background-image','url(../wp-content/themes/weclip/images/NON_SELECTED.png)');

				}
				jQuery('.register_2').trigger('click');
				});
				jQuery('.register_2').on('change', function(event) {
					var checkbox = jQuery(event.target);
				});
				
				jQuery('form#signup_form input.next').click(function(e) {
					return WECLIP.order.formverify.step5();
				});
			
				this.gto.five();
			break;
		}
	},
	gto: {
		one: function() {
			jQuery('#bar li#first').addClass('active');
		},
		two: function() {
			jQuery('#bar li#first').addClass('active');
			jQuery('#bar li#second').addClass('active');
		},
		three: function() {
			jQuery('#bar li#first').addClass('active');
			jQuery('#bar li#second').addClass('active');
			jQuery('#bar li#third').addClass('active');
		},
		four: function() {
			jQuery('#bar li#first').addClass('active');
			jQuery('#bar li#second').addClass('active');
			jQuery('#bar li#third').addClass('active');
			jQuery('#bar li#forth').addClass('active');
		},
		five: function() {
			jQuery('#bar li#first').addClass('active');
			jQuery('#bar li#second').addClass('active');
			jQuery('#bar li#third').addClass('active');
			jQuery('#bar li#forth').addClass('active');
			jQuery('#bar li#five').addClass('active');
			jQuery('#progress div#progress-bg').addClass('active');
			if ( (document.signup_form && document.signup_form.dtype && document.signup_form.dtype[0].checked == false ) && ( document.signup_form.dtype[1].checked == false) ) {
				alert ('Kies hoe snel u de bestanden geleverd wilt hebben.');
				return false;
			}
		}
		/*function gto1_1(id){
			jQuery('#status li#second').removeClass('active2');
			jQuery('#status li#first').addClass('active1');
		}

		function gto2_2(id){
			jQuery('#status li#third').removeClass('active3');
			jQuery('#status li#second').addClass('active2');
		}

		function gto3_3(id){
			jQuery('#status li#forth').removeClass('active4');
			jQuery('#status li#third').addClass('active3');
		}

		function gto4_4(id){
			jQuery('#status li#five').removeClass('active5');
			jQuery('#status li#forth').addClass('active4');
		}*/

	},
	formverify: {
		step2: function() {
			var a = WECLIP.order.session.a;
			var m = WECLIP.order.session.m;
			var c = WECLIP.order.session.c;
			jQuery('#status li#second').addClass('active2');
			jQuery('#status li#third').addClass('active3');
			if(a!='' && jQuery('#annta_BASIC').length > 0) {
				var anntal_basic = jQuery('#annta_BASIC').val();
				var isANumber = isNaN(anntal_basic) === false;
				if (anntal_basic == null || anntal_basic == '') {
					alert('Categorie Basic : Geef het aantal beelden op (alleen cijfers zijn toegestaan).');
					jQuery('#annta_BASIC').focus();
					return false;
				}
				if(isNaN(anntal_basic))
				{
					alert('Categorie Basic : Geef het aantal beelden op (alleen cijfers zijn toegestaan).');
					jQuery('#annta_BASIC').focus();
					return false;
				}
			}
			if(m!='' && jQuery('#annta_MEDIUM').length > 0) {
				var anntal_medium = jQuery('#annta_MEDIUM').val();
				var isANumber = isNaN(anntal_medium) === false;
				if (anntal_medium == null || anntal_medium == '') {
					alert('Categorie Medium: Geef het aantal beelden op (alleen cijfers zijn toegestaan).');
					jQuery('#annta_MEDIUM').focus();
					return false;
				}
				if(isNaN(anntal_medium)) {
					alert('Categorie Medium: Geef het aantal beelden op (alleen cijfers zijn toegestaan).');
					jQuery('#annta_MEDIUM').focus();
					return false;
				}
			}

			if(c!='' && jQuery('#annta_COMPLEX').length > 0) {
				var anntal_complex = jQuery('#annta_COMPLEX').val();
				var isANumber = isNaN(anntal_complex) === false;
				if (anntal_complex == null || anntal_complex == '')
				{
					alert('Categorie Complex : Geef het aantal beelden op (alleen cijfers zijn toegestaan).');
					jQuery('#annta_COMPLEX').focus();
					return false;
				}
				if(isNaN(anntal_complex))
				{
					alert('Categorie Complex : Geef het aantal beelden op (alleen cijfers zijn toegestaan).');
					jQuery('#annta_COMPLEX').focus();
					return false;
				}
			}

			if (jQuery('input[name=jpg0]') && jQuery('input[name=jpg0]').is(':checked') == false && jQuery('input[name=png0]').is(':checked') == false && jQuery('input[name=psd0]').is(':checked') == false && jQuery('input[name=tiff0]').is(':checked') == false) {
				var c1 = a;
				var c3 = m;
				var c2 = c;
				if(c1!='') {
					alert ('Categorie Basic: Selecteer ten minste 1 bestandsformaat.');
					return false;
				} else if(c2!='') {
					alert ('Categorie Complex: Selecteer ten minste 1 bestandsformaat.');
					return false;
				} else {
					alert ('Categorie Medium: Selecteer ten minste 1 bestandsformaat.');
					return false;
				}				
			}
		},
		step3: function() {
			var node_list = jQuery('#signup_form input');
			var name = WECLIP.order.session.name;
			var a = WECLIP.order.session.a;
			var m = WECLIP.order.session.m;
			var c = WECLIP.order.session.c;
			
			var submit = false;
			
			for (fc = 0; fc <= 3; fc++) {
				if (!name[fc]) { continue; }
				switch(name[fc]) {
					case "BASIC":
						//if (a!='') {
						if (
							jQuery('#optb'+fc).is(':checked') == false
							&& jQuery('#opta'+fc).is(':checked') == false
						) {
							alert ("Categorie Basic: Kies hoe u de bestanden wilt aanleveren.");
							return false;
						}
						if (
							jQuery('#optb'+fc).is(':checked') == true
						) {
							// UPLOAD
							var uploader = jQuery('#photouploader'+fc).plupload('getUploader');

							// Files in queue upload them first
							if (uploader.files.length > 0) {
								if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
									submit = true;
								} else {
									// When all files are uploaded submit form
									uploader.bind('StateChanged', function() {
										if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
											setTimeout(function() {
												WECLIP.order.formverify.step3();
											},2000);
										}
									});
									uploader.start();
									return false;
								}
							} else if (WECLIP.order.photos[fc] > 0) {
								submit = true;
							} else {
								alert('U dient minimaal 1 foto te uploaden.');
								return false;
							}
						}
					break;
					case "MEDIUM":
						//if (m!='') {
						if (
							jQuery('#optb'+fc).is(':checked') == false
							&& jQuery('#opta'+fc).is(':checked') == false
						) {
							alert ('Categorie Medium: Kies hoe u de bestanden wilt aanleveren.');
							return false;
						}

						if (jQuery('#optb'+fc).is(':checked') == true) {
							// UPLOAD
							var uploader = jQuery('#photouploader'+fc).plupload('getUploader');

							// Files in queue upload them first
							if (uploader.files.length > 0) {
								if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
									submit = true;
								} else {
									// When all files are uploaded submit form
									uploader.bind('StateChanged', function() {
										if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
											setTimeout(function() {
												WECLIP.order.formverify.step3();
											},2000);
											//jQuery('form#signup_form')[0].append('<input type="hidden" name="b_pg3" value="1">');
											//jQuery('form#signup_form')[0].submit();
										}
									});
									uploader.start();
									return false;
								}
							} else if (WECLIP.order.photos[fc] > 0) {
								submit = true;
							} else {
								alert('U dient minimaal 1 foto te uploaden.');
								return false;
							}
						}
					break;
					case "COMPLEX":
						//if (c!='') {
						if (
							jQuery('#optb'+fc).is(':checked') == false
							&& jQuery('#opta'+fc).is(':checked') == false
						) {
							alert ('Categorie Complex: Kies hoe u de bestanden wilt aanleveren.');
							return false;
						}

						if (jQuery('#optb'+fc).is(':checked') == true) {
							// UPLOAD
							var uploader = jQuery('#photouploader'+fc).plupload('getUploader');

							// Files in queue upload them first
							if (uploader.files.length > 0) {
								if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
									submit = true;
								} else {
									// When all files are uploaded submit form
									uploader.bind('StateChanged', function() {
										if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
											setTimeout(function() {
												WECLIP.order.formverify.step3();
											},2000);
											//jQuery('form#signup_form')[0].append('<input type="hidden" name="b_pg3" value="1">');
											//jQuery('form#signup_form')[0].submit();
										}
									});
									uploader.start();
									return false;
								}
							} else if (WECLIP.order.photos[fc] > 0) {
								submit = true;
							} else {
								alert('U dient minimaal 1 foto te uploaden.');
								return false;
							}
						}
					break;
				}
			}
			if (submit) {
				jQuery('form#signup_form').append('<input type="hidden" name="b_pg3" value="1">');
				jQuery('form#signup_form').submit();
			}
		},
		step4: function() {
			var sel = false;
			$.each(jQuery('form#signup_form input[name=dtype]'),function(i,el) {
				if (jQuery(el).is(':checked')) {
					sel = true;
				}
			});
			if (!sel) {
				alert('Selecteer de gewenste oplevertermijn.');
				return false;
			}
		}
	},
	photoupload: {
		init: function() {
		
			for (fc = 0; fc <= 3; fc++) {
				if (jQuery('#photouploader'+fc).length == 0) { continue; }
				jQuery('#photouploader'+fc).plupload({
					// General settings
					runtimes : 'gears,flash,silverlight,html5',
					url : WECLIP.templateuri + '/order-upload.php?fc='+fc,
					max_file_size : '128mb',
					chunk_size : '1mb',
					//unique_names : true,

					// Resize images on clientside if we can
					//resize : {width : 320, height : 240, quality : 90},

					// Specify what files to browse for
					filters : [
						{
							title : "Image files", 
							extensions : "jpg,gif,png"
						}
					],

					// Flash settings
					flash_swf_url : WECLIP.templateuri + '/js/Moxie.swf',

					// Silverlight settings
					silverlight_xap_url : WECLIP.templateuri + '/js/Moxie.xap'
				});
			}
		}
	}
};
jQuery(function() { WECLIP.order.init(); });