/**
 * Custom JavaScript for PGB Frontend
 *
 */
var brandImage;

(function($) {
	
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

	// Vertically center nav-bar logo image (mobile logo)
	var brand;
	brand = brandImage = {

		h      : undefined, // Brand image height
		navh   : undefined, // Main navbar height
		img    : undefined, // Brand image element
		a      : undefined, // Brand image wrapper
		offset : undefined, // Brand image calculated offset

		init : function() {
			brand.a = $('.navbar-brand');
			brand.img = brand.a.find('img').filter(':visible');
			brand.h = brand.img.height();
			brand.navh = $('#main-nav').height();
			brand.offset = Math.min( ( brand.navh - brand.h ) / 2, 10 );
			brand.setImageOffset( brand.offset );
		},

		setImageOffset : function( offset ) {
			brand.a.css({
				"padding-top": offset + "px",
				"padding-bottom": offset + "px"
			});
		}

	}

	$(function() { brandImage.init(); });

}(jQuery));