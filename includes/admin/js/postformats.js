/**
 * Admin Scripts
 */
(function($){

	/**
	 * Post Formats
	 */
	$(document).ready( function(){

		var curPostFormat 			= $('#post-formats-select input:checked').val(),
			curPostFormatCheckbox 	= $('.metabox-prefs label[for="postformats_'+curPostFormat+'_meta_box-hide"]'),
			curPostFormatMetaBox 	= $('#postformats_'+curPostFormat+'_meta_box');

		if ( curPostFormatCheckbox.length > 0 ) {
			curPostFormatCheckbox.siblings('label[for^="postformats_"]').each( function(){
				$(this).hide();
				$(this).find('input').prop('checked', false);
			});
			curPostFormatMetaBox.siblings('div[id^="postformats_"]').hide();

			curPostFormatCheckbox.show();
			curPostFormatMetaBox.removeClass('closed').show();
		}
		else {
			$('.metabox-prefs label[for^="postformats_"]').each( function(){
				$(this).hide();
				$(this).find('input').prop('checked', false);
			});
			$('div[id^="postformats_"]').hide();
		}


		$('#post-formats-select input:radio').change( function(){
			var postFormat 			= $(this).attr('id').split("-format-").pop(),
				postFormatCheckbox 	= $('.metabox-prefs label[for="postformats_'+postFormat+'_meta_box-hide"]'),
				postFormatMetaBox 	= $('#postformats_'+postFormat+'_meta_box');
			
			if ( postFormatCheckbox.length > 0 ) {
				postFormatCheckbox.siblings('label[for^="postformats_"]').each( function(){
					$(this).hide();
					$(this).find('input').prop('checked', false);
				});
				postFormatMetaBox.siblings('div[id^="postformats_"]').hide();

				postFormatCheckbox.show();
				postFormatCheckbox.find('input').prop('checked', true);
				postFormatMetaBox.removeClass('closed').show();

			}
			else {
				$('.metabox-prefs label[for^="postformats_"]').each( function(){
					$(this).hide();
					$(this).find('input').prop('checked', false);
				});
				$('div[id^="postformats_"]').hide();
			}
		});
	});

})(jQuery);