(function ($) {
	
	// If Search Field empty, focus on submit
	$(document).on('click', 'form[role="search"] button[type="submit"]', function(event) {
		event.preventDefault();
		var searchform = $(this).closest('form'),
			searchinput = searchform.find('input');
		if ( ! searchinput.val() ) {
			searchinput.focus();
		}
		else {
			searchform.submit();
		};
	});

	$(window).load(function(){

		// Vertically center nav-bar logo image (mobile logo)
		if ( $('.navbar-brand img').is(':visible') ) {
			var brandimgh = $('.navbar-brand img').height(),
				mainnavh = $('#main-nav').height(),
				offset = Math.min( ( mainnavh - brandimgh ) / 2, 10 );
			$('.navbar-brand').css({
				"padding-top": offset + "px",
				"padding-bottom": offset + "px"
			}); 
		}

	});
}(jQuery));