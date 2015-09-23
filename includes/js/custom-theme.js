/**
 * Custom JavaScript for PGB Frontend
 *
 */
var navbarBrandImages;

(function($) {
	
	// If Search Field empty, focus on submit
	$('form[role="search"]').submit(function(event) {
		event.preventDefault();
		var searchform = $(this),
			searchinput = searchform.find('input');
		if ( ! searchinput.val() ) {
			searchinput.focus();
		}
		else {
			searchform.submit();
		};
	});

	// Vertically center nav-bar logo image (mobile logo)
	var brand;
	brand = navbarBrandImages = {

		a	: undefined, // Brand image wrapper

		init : function() {
			brand.a = $('.navbar-brand');
			brand.setImageOffset( brand.a );
		},

		setImageOffset : function( a ) {
			a.each(function(){
				var h1 = $(this).find('img').filter(':visible').height(),
					h2 = $(this).closest('nav').height(),
					offset = Math.min( ( h2 - h1 ) / 2, 15 );
				$(this).css({
					"padding-top": offset + "px",
					"padding-bottom": offset + "px"
				});
			});
		}

	}

	$(function() { navbarBrandImages.init(); });

}(jQuery));