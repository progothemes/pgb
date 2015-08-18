<?php

/**
 * Contains methods for customizing login functionality.
 * 
 * @since ProGo 0.7.0
 * @description
 */

/* Actions */
add_action( 'after_setup_theme', array( 'PGB_Login_Out', 'init' ) );
//add_action( 'init', array( 'PGB_Login_Out', 'pgb_redirect_login_page' ) ); // redirect all attempts to access wp-login.php to custom login page (see Warning below)
add_action( 'wp_login_failed', array( 'PGB_Login_Out', 'pgb_login_failed' ) );
add_action( 'wp_logout', array( 'PGB_Login_Out', 'pgb_logout_redirect' ) );
add_action( 'login_enqueue_scripts', array( 'PGB_Login_Out', 'pgb_login_logo' ) );
/* Filters */
add_filter( 'authenticate', array( 'PGB_Login_Out', 'pgb_verify_username_password' ), 1, 3 );
add_filter( 'login_redirect', array( 'PGB_Login_Out', 'pgb_login_redirect' ), 10, 3 );
add_filter( 'wp_nav_menu_items', array( 'PGB_Login_Out', 'pgb_add_loginout_link' ), 10, 2 );

class PGB_Login_Out {

	public static $login_url = false;
	public static $redirect_url = false;

	public static function init() {
		self::$login_url = self::pgb_get_login_page_url();
	}

	/**
	 * Get Login Page
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @uses pgb_get_option()
	 * @uses get_post()
	 * @return object or false
	 */
	public static function pgb_get_login_page() {
		$login_page_id = pgb_get_option( 'login_link_page', 0 );
		if ( ! $login_page_id ) return false;
		$page = get_post( $login_page_id );
		return $page;
	}
	/**
	 * Get Login Page URL
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @uses pgb_get_login_page()
	 * @uses get_permalink()
	 * @return permalink or false
	 */
	public static function pgb_get_login_page_url() {
		$page = self::pgb_get_login_page();
		if ( ! $page ) return false;
		return get_permalink( $page->ID );
	}
	/**
	 * Get Login Redirect Page URL
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @uses pgb_get_login_page()
	 * @uses get_permalink()
	 * @return object or false
	 */
	public static function pgb_get_redirect_page_url() {
		$redirect_page_id = pgb_get_option( 'login_redirect_page', get_option('page_on_front') );
		if ( ! $redirect_page_id ) return false;
		return get_permalink( $redirect_page_id );
	}

	/**
	 * Redirect login page (wp-login.php) to custom page
	 *
	 * WARNING: if this is active, and there is no login form on the set login page, no one (including admin's) will be able to log into WordPress!
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @return URL
	 */
	public static function pgb_redirect_login_page() {
		if ( self::$login_url ) {
			$page_viewed = basename($_SERVER['REQUEST_URI']);
			if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET' ) {
				wp_redirect( self::$login_url );
				exit;
			}
		}
	}

	/**
	 * Login failed redirect to self
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @return URL with Query string
	 */
	public static function pgb_login_failed() {
		if ( self::$login_url ) {
			$page_viewed = basename($_SERVER['REQUEST_URI']);
			if( $page_viewed == "wp-login.php" ) {
				wp_redirect( self::$login_url . '?login=failed' );
				exit;
			}
		}
	}

	/**
	 * Login verify redirect to self with params
	 *
	 * @since ProGo 0.7.0
	 * @param string $user wp object
	 * @param string $username from form
	 * @param string $password from form
	 * @return URL with Query string
	 */
	public static function pgb_verify_username_password( $user, $username, $password ) {
		if ( self::$login_url ) {
			$page_viewed = basename($_SERVER['REQUEST_URI']);
			if( $page_viewed == "wp-login.php" && ( $username == "" || $password == "" ) ) {
				wp_redirect( self::$login_url . "?login=empty" );
				exit;
			}
		}
	}

	/**
	 * Redirect user after successful login/logout.
	 *
	 * @since ProGo 0.7.0
	 * @param string $redirect_to URL to redirect to.
	 * @param string $request URL the user is coming from.
	 * @param object $user Logged user's data.
	 * @return string $redirect_to
	 */
	public static function pgb_login_redirect( $redirect_to, $request, $user ) {
		//is there a user to check?
		global $user;
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			//check for admins
			if ( in_array( 'administrator', $user->roles ) ) {
				// redirect admins to the default place
				return admin_url();
			} else {
				$redirect_to = ( self::pgb_get_redirect_page_url() ? self::pgb_get_redirect_page_url() : home_url() );
				return $redirect_to . '?auth=true'; // redirect everyone else to...
			}
		}
		return $redirect_to;
	}

	/**
	 * Redirect on logout to Log In page with message
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @return URL
	 */
	public static function pgb_logout_redirect(){
		if ( self::$login_url ) {
			wp_redirect( self::$login_url . "?login=false" );
			exit;
		}
	}

	/**
	 * Add LoginOut in Top Menu
	 *
	 * @since ProGo 0.7.0
	 * @param $items nav menu items
	 * @param $args nav menu args
	 * @return string new menu item
	 */
	public static function pgb_add_loginout_link( $items, $args ) {

		if( ! pgb_get_option( 'login_link_nav_position' ) ) return $items;

		$theme_locations = pgb_get_option( 'login_link_nav_position' );

		$login_link = ( self::$login_url ? self::$login_url : wp_login_url() );

		if ( in_array( $args->theme_location, $theme_locations ) ) {
			$link = false;
			if ( is_user_logged_in() ) {
				$link = '<a title="Log Out" href="' . wp_logout_url( $login_link ) . '">Log out</a>';
			}
			else {
				$link = '<a title="Login" href="' . $login_link . '">Login</a>';
			}
			$item = sprintf( '<li id="menu-item-login-out" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-login-out">%s</li>', $link );
			$items .= $item;
		}

		return $items;
	}

	/**
	 * Login Out Error Messages
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @return string html error string
	 */
	public static function pgb_login_out_messages() {

		$login  = (isset($_GET['login']) ) ? $_GET['login'] : false;

		if ( ! $login ) return;

		switch ($login) {
			case 'failed':
				$alert = 'alert-danger';
				$message = '<p class="login-msg"><strong>Error:</strong> Invalid username and/or password.</p>';
				break;
			case 'empty':
				$alert = 'alert-danger';
				$message = '<p class="login-msg"><strong>Error:</strong> Username and/or Password is empty.</p>';
				break;
			case 'false':
				$alert = 'alert-success';
				$message = '<p class="login-msg">You are logged out.</p>';
				break;
			default:
				return;
				break;
		}

		return sprintf('<div class="alert %s" role="alert">%s</div>', $alert, $message);
	}

	/**
	 * Custom login logo
	 *
	 * @since ProGo 0.7.0
	 * @param none
	 * @return CSS replaces logo image on login
	 */
	public static function pgb_login_logo() { 
		$logo_url = pgb_get_logo(false); ?>
		<style type="text/css">
		.login h1 a {
			background-image: url(<?php echo $logo_url; ?>);
			padding-bottom: 30px;
		}
		</style>
	<?php }

}

	
