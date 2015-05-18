(function () {
	
	// If Search Field empty, focus on submit
	jQuery(document).on('click', 'form[role="search"] button[type="submit"]', function(event) {
		event.preventDefault();
		var searchform = jQuery(this).closest('form'),
			searchinput = searchform.find('input');
		if ( ! searchinput.val() ) {
			searchinput.focus();
		}
		else {
			searchform.submit();
		};
	});

	jQuery(document).ready(function(){

		// Vertically center nav-bar logo image (mobile logo)
		if ( jQuery('.navbar-brand img').is(':visible') ) {
			var brandimgh = jQuery('.navbar-brand img').height();
			jQuery('.navbar-brand img').css({
				"position": "absolute",
				"top": "50%",
				"margin-top": "-" + ( brandimgh / 2 ) + "px"
			}); 
		}

	});
	
})(jQuery);