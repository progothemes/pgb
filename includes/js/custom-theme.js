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
			var brandimgh = jQuery('.navbar-brand img').height(),
				mainnavh = jQuery('#main-nav').height(),
				offset = ( mainnavh - brandimgh ) / 2;
			jQuery('.navbar-brand').css({
				"padding-top": offset + "px",
				"padding-bottom": offset + "px"
			}); 
		}

	});
})(jQuery);