(function($) {

    $(document).ready(function ($) {
    	
    	/* Add next add */
    	
		$("body").on("click", "a.alk_adcart", function(e){
			e.preventDefault();
			var widget_holder = $(this).closest('.widget-inside');
			var cloner = widget_holder.find('.mks_ads_clone');
			
			widget_holder.find('.mks_ads_container').append('<li style="margin-bottom: 15px;">'+cloner.html()+'</li>');
			
		});
		
		
		$(document).on("click", ".upload_image_button", function() {

	        jQuery.data(document.body, 'prevElement', $(this).prev());

	        window.send_to_editor = function(html) {
	            var imgurl = jQuery(html).attr('src');
	            var inputText = jQuery.data(document.body, 'prevElement');
	            if(inputText != undefined && inputText != '')
	            {
	                jQuery(inputText[0]).val(imgurl);
	            }

	            tb_remove();
	        };

	        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	        return false;
	    });

	});

})(jQuery);