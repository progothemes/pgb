<?php

/**
 * Contains methods for customizing login functionality.
 * 
 * @since ProGo 0.7.0
 * @description
 */

/* Actions */
add_action( 'wp_login_failed', array( 'PGB_Login_Out', 'pgb_login_failed' ) );
add_action( 'wp_logout', array( 'PGB_Login_Out', 'pgb_logout_redirect' ) );
add_action( 'login_enqueue_scripts', array( 'PGB_Login_Out', 'pgb_login_logo' ) );
/* Filters */
add_filter( 'authenticate', array( 'PGB_Login_Out', 'pgb_verify_username_password' ), 1, 3 );
add_filter( 'login_redirect', array( 'PGB_Login_Out', 'pgb_login_redirect' ), 10, 3 );



class PGB_Login_Out {

	public static $login_url = false;
	public static $redirect_url = false;

	public function __construct() {
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'pgb_add_custom_nav_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'pgb_update_custom_nav_fields'), 10, 3 );
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'pgb_edit_walker'), 10, 2 );
	}

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





	/**
	 * Custom login meta-box do
	 *
	 * @since ProGo 0.8.0
	 * @param none
	 * @return none
	 */
	public function add_login_nav_menu_meta_box() {
		add_meta_box( 'pgb_login_nav_link', __( 'Login / Logout', 'pgb' ), array( $this, 'render_login_nav_menu_meta_box' ), 'nav-menus', 'side', 'low' );
	}

	/**
	 * Custom login meta-box render
	 *
	 * NOTES: JavaScript requires '.tabs-panel-active .categorychecklist li input:checked' to return true.
	 *
	 * @since ProGo 0.8.0
	 * @param none
	 * @return HTML meta-box
	 */
	public function render_login_nav_menu_meta_box() { ?>
			<div id="pgb-login-link" class="posttypediv">
				<div id="tabs-panel-pgb-login" class="tabs-panel tabs-panel-active">
					<ul id ="pgb-login-checklist" class="categorychecklist form-no-clear">
						<li>
							<label class="menu-item-title">
								<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Login / Logout Link
							</label>
							<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
							<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Login">
							<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php echo wp_login_url(); ?>">
							<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="pgb-login-link">
						</li>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" class="menu-item-checkbox" name="menu-item[-2[menu-item-object-id]" value="-2"> Avatar
							</label>
							<input type="hidden" class="menu-item-type" name="menu-item[-2][menu-item-type]" value="custom">
							<input type="hidden" class="menu-item-title" name="menu-item[-2][menu-item-title]" value="Avatar">
							<input type="hidden" class="menu-item-url" name="menu-item[-2][menu-item-url]" value="<?php echo get_edit_user_link(); ?>">
							<input type="hidden" class="menu-item-classes" name="menu-item[-2][menu-item-classes]" value="pgb-avatar-link">
						</li>
					</ul>
				</div>
				<p class="button-controls">
					<span class="add-to-menu">
						<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-pgb-login-link">
						<span class="spinner"></span>
					</span>
				</p>
			</div>
	<?php }

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function pgb_add_custom_nav_fields( $menu_item ) {

		$menu_item->logoutpage = get_post_meta( $menu_item->ID, '_pgb_menu_item_logoutpage', true );
		$menu_item->logouttext = get_post_meta( $menu_item->ID, '_pgb_menu_item_logouttext', true );
		return $menu_item;

	}

	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function pgb_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		if ( isset($_REQUEST['menu-item-logoutpage']) && is_array( $_REQUEST['menu-item-logoutpage'] ) ) {
			if ( isset($_REQUEST['menu-item-logoutpage'][$menu_item_db_id]) ) {
				$logout_url_value = $_REQUEST['menu-item-logoutpage'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pgb_menu_item_logoutpage', $logout_url_value );
			}
		}
		if ( isset($_REQUEST['menu-item-logouttext']) && is_array( $_REQUEST['menu-item-logouttext'] ) ) {
			if ( isset($_REQUEST['menu-item-logouttext'][$menu_item_db_id]) ) {
				$logout_text_value = $_REQUEST['menu-item-logouttext'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pgb_menu_item_logouttext', $logout_text_value );
			}
		}

	}

	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function pgb_edit_walker($walker,$menu_id) {

		return 'PGB_Walker_Nav_Menu_Edit';

	}

}

$nav_link = new PGB_Login_Out();
add_action( 'admin_init', array( $nav_link, 'add_login_nav_menu_meta_box' ) );
