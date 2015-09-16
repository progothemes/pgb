/**
 * Admin JavaScripts
 */
jQuery.noConflict();

var pgbCustomNavs;

(function($){

	/**
	 * ProGo Custom Nav Menus JS
	 */

	var nav;

	nav = pgbCustomNavs = {

		// Pre Define Login Link Elements
		login : {
			div : undefined,
			field : {
				checkbox : undefined,
				select   : undefined,
				submit   : undefined,
				url      : undefined,
			},
		},

		init : function() {

			// Set Login Link Elements
			nav.login.div = $('#pgb-login-link');
			nav.login.field.checkbox = nav.login.div.find('input.menu-item-checkbox');
			nav.login.field.select   = nav.login.div.find('select.menu-item-url-select');
			nav.login.field.submit   = nav.login.div.find('input.submit-add-to-menu');
			nav.login.field.url      = nav.login.div.find('input.menu-item-url');
			// Do Login Link Actions
			this.loginCheckedListener();
			this.loginSelectListener();

		},

		loginCheckedListener : function() {
			nav.login.field.checkbox.bind('change', function(e) {
				var checkedState = e.target.checked;
				nav.loginCheckedUpdate( checkedState );
			});
		},

		loginSelectListener : function() {
			nav.login.field.select.bind('change', function(e) {
				var linkURL = e.target.value;
				nav.loginSelectUpdate( linkURL );
			});
		},

		loginCheckedUpdate : function( checkedState ) {
			//console.log( checkedState );
		},

		loginSelectUpdate : function( linkURL ) {
			nav.login.field.url.val( linkURL );
			//console.log( linkURL );
		},

	}

	//$(document).ready(function(){ pgbCustomNavs.init(); });

})(jQuery);