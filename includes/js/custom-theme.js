jQuery(function () {
	
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



});

jQuery(document).ready(function(){
	var toggletype = jQuery('#menu-toggle').data("toggle");
	// console.log (toggletype);
	if( ('reveal' == toggletype) || ('push' == toggletype) ) {
		jQuery("#menu-toggle").click(function(e) {
			e.preventDefault();
			jQuery("#wrapper").toggleClass(toggletype);
		});
	} else if ('slideontop' == toggletype) {
		jQuery("#menu-toggle").click(function(e) {
			e.preventDefault();
			jQuery("#wrapper").toggleClass(toggletype);
		});
		jQuery(".sidebar-slide").click(function(e) {
			if( e.target !== this ) 
				return;
			jQuery("#wrapper").toggleClass(toggletype);
		});
	}

	if(jQuery('.navbar-brand img').is(':visible')){ 
		jQuery('.navbar-brand').addClass('rm-padding'); 
		jQuery('#topleft-side-nav').css({'top': jQuery('#topleft-top-nav').height()+33 });
	}

	jQuery(window).scroll(function() {
		if(jQuery(window).scrollTop()>2){
			jQuery(".navbar-fixed-top-left.top-nav-menu").css("position", "fixed");
			jQuery(".navbar-fixed-top.top-nav-menu").css("position", "fixed");
			jQuery(".site-navigation-left").css("position", "fixed");

			if (jQuery('#wpadminbar').length)
			{
				jQuery(".navbar-fixed-top-left.top-nav-menu").css("top", "32px");
				jQuery(".navbar-fixed-top.top-nav-menu").css("top", "32px");

				if(jQuery(document).width() < 601) {
					jQuery(".navbar-fixed-top-left.top-nav-menu").css("top", "0px");
					jQuery(".left-nav-menu.navbar-fixed-top").css({'top': jQuery('#topleft-top-nav').height()+1 }); //
					jQuery(".navbar-fixed-top.top-nav-menu").css("top", "0px");
					jQuery(".site-navigation-left").css("top", "0px");
				}
			}
		} else {
			jQuery(".navbar-fixed-top-left.top-nav-menu").css("position", "relative");
			jQuery(".navbar-fixed-top-left.top-nav-menu").css("top", "0px");
			jQuery(".navbar-fixed-top.top-nav-menu").css("position", "relative");
			jQuery(".navbar-fixed-top.top-nav-menu").css("top", "0px");
			if (jQuery('#wpadminbar').length) {
				if(jQuery(document).width() < 601) {
					jQuery(".left-nav-menu.navbar-fixed-top").css({'top': jQuery('#topleft-top-nav').height()+42 });
					jQuery(".site-navigation-left").css("position", "relative");
					jQuery(".site-navigation-left").css("top", "0px");
				}
			}
		}
	});

	if (jQuery('#wpadminbar').length){
		jQuery(".left-nav-menu.navbar-fixed-top").css({'top': jQuery('#topleft-top-nav').height()+33 });		
	} else {
		jQuery(".left-nav-menu.navbar-fixed-top").css({'top': jQuery('#topleft-top-nav').height()+1 });
	}

	if (jQuery('.left-nav-menu').length){
		jQuery("body").css("overflow-x", "hidden");
	}    

	if(jQuery(document).width() < 601) {
		jQuery(".search-form-icon form[role='search']").css("position", "relative").css("border", "0");
	}
});