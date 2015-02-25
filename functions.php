<?php
/**
 * Loads OptionTree
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Progo Base Theme version
 */
define( 'OT_THEME_VERSION', '1.0' );

/**
 * pgb functions and definitions
 *
 * @package pgb
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'pgb_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function pgb_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		*/
		// add_theme_support( 'custom-background', apply_filters( 'pgb_custom_background_args', array(
		// 	'default-color' => 'ffffff',
		// 	'default-image' => '',
		// ) ) );

	}

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on pgb, use a find and replace
	 * to change 'pgb' to the name of your theme in all the template files
	*/
	load_theme_textdomain( 'pgb', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  	 => __( 'Header main menu', 'pgb' ),
		'secondary'  => __( 'Header secondary menu', 'pgb' ),
	) );

}
endif; // pgb_setup
add_action( 'after_setup_theme', 'pgb_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function pgb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pgb' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Secondary Header sidebar 
	register_sidebar( array(
		'name'          => __( 'Secondary Header sidebar', 'pgb' ),
		'id'            => 'header-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// top Header sidebar (TOP + LEFT VIEW)
	register_sidebar( array(
		'name'          => __( 'Top Header area', 'pgb' ),
		'id'            => 'top-header-area',
		'description'	=> 'For Top + Left header-menu view',
		'before_widget' => '<div id="%1$s" class="topleft-header-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer widget area
	register_sidebars(4,array(
        'name' 			=> 'Footer Widget %d',
        'id' 			=> 'footer-widget',
        'description' 	=> 'Footer Widget Area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' 	=> '</div>',
        'before_title' 	=> '<h3 class="widget-title">',
        'after_title' 	=> '</h3>',
    ));
	
}
add_action( 'widgets_init', 'pgb_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function pgb_scripts() {

	$bootswatchdir   = trailingslashit( get_template_directory().'/includes/bootswatch');
	$bootswatchdirs  = glob($bootswatchdir . '/*' , GLOB_ONLYDIR);
	$bootstrap_theme = ot_get_option( 'pgb_bootstrap_theme' );

	foreach ($bootswatchdirs as $bootswatchdir) {
		$themeName = explode('//', $bootswatchdir);
		if ( $bootstrap_theme 	== $themeName[1] ) {
			wp_enqueue_style( 'pgb-bootstrap', get_template_directory_uri() . '/includes/bootswatch/'. $bootstrap_theme .'/bootstrap.min.css' );	
		}
	}

	$themeFolder 	 = wp_upload_dir();
	$themeFolder_dir = $themeFolder['basedir'];
	$themeFolder_url = $themeFolder['baseurl'];
	$themeFolder_dir = $themeFolder_dir . '/bootstrapthemes';
	$uploaddirs 	 = glob($themeFolder_dir . '/*' , GLOB_ONLYDIR);

	foreach ($uploaddirs as $uploaddir) {
		$customThemeName = explode('/bootstrapthemes/', $uploaddir);
		if ( $bootstrap_theme == $customThemeName[1] ) {
				$customThemeName[1] = preg_replace("/[^a-zA-Z]+/", "", $customThemeName[1]);
				wp_enqueue_style( $customThemeName[1].'bootstrap', $themeFolder_url.'/bootstrapthemes/'.$customThemeName[1].'/css/bootstrap.min.css' );
				wp_enqueue_style( $customThemeName[1].'bootstrap-theme', $themeFolder_url.'/bootstrapthemes/'.$customThemeName[1].'/css/bootstrap-theme.min.css' );	
		}
	}


	if( ('default' == $bootstrap_theme) ) {		
		// Default bootstrap theme
		wp_enqueue_style( 'pgb-bootstrap', get_template_directory_uri() . '/includes/css/bootstrap.css' );
	}
	
	// load pgb styles
	wp_enqueue_style( 'pgb-style', get_stylesheet_uri() );

	// Load rtl style
	// wp_enqueue_style( 'pgb-rtl', get_template_directory_uri() . '/rtl.css' );

	// load the font icons
	wp_enqueue_style('pgb-fontawesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css');

	// load google fonts
	wp_enqueue_style( 'pgb-google-font', 'http://fonts.googleapis.com/css?family=Questrial|Droid+Sans:400,700|Lato:400,700,900,400italic,700italic|Arvo:400,700,400italic|PT+Sans:400,700,400italic,700italic|Quicksand:400,700|Gloria+Hallelujah|Roboto:900,400,700,300italic,500,500italic,700italic|Montserrat:700,400|Open+Sans:400italic,700,600,800,400');

	if ( !is_admin() ) {
		$custom_css = "";

		$container_width = ot_get_option( 'pgb_container_width' );
		if ( !empty( $container_width )) {
			$metabox_custom_page_layout = get_post_meta(get_the_ID(), 'pgb_metabox_page_layout_option', true );
			if ( $metabox_custom_page_layout === "yes" ) {
				$metabox_custom_page_width  = get_post_meta( get_the_ID(), 'pgb_custom_container_width', true );
				$custom_css .= pgb_set_container_width( $metabox_custom_page_width, '.container' );
			} else {
				$custom_css .= pgb_set_container_width( $container_width, '.container, .jumbotron .container' );
			}
		}
		$menu_width = ot_get_option( 'pgb_menu_width_top' );
		if ( !empty( $menu_width )) {    
			$custom_css .= pgb_set_container_width( ot_get_option( 'pgb_menu_width_top' ), '.menu-container-width' );
		}

		$custom_css .= " @media (max-width: 599px) { .navbar-fixed-top.top-nav-menu{ z-index: 499; } }";

		wp_add_inline_style( 'pgb-style', $custom_css );
	}

	/**
	 * Fix for Visual Composer not loading CSS file(s)
	 */
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		wp_enqueue_style('js-composer', plugins_url() . '/js_composer/assets/css/js_composer.css');
	}

	// SCRIPTS

	// load bootstrap js
	wp_enqueue_script('pgb-bootstrapjs', get_template_directory_uri().'/includes/js/bootstrap.js', array('jquery') );


	// load bootstrap wp js
	wp_enqueue_script( 'pgb-bootstrapwpjs', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( 'pgb-customthemejs', get_template_directory_uri() . '/includes/js/custom-theme.js', array('jquery') );

	wp_enqueue_script( 'pgb-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20140924', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'pgb-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20140924' );
	}

}

add_action( 'wp_enqueue_scripts', 'pgb_scripts' );

/**
 * Theme Mode
 */
/**
 * Activates Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_true' );
// add_filter( 'ot_theme_mode', '__return_false' );

/**
 * Child Theme Mode
 */
add_filter( 'ot_child_theme_mode', '__return_false' );

/**
 * Show Settings Pages
 */
add_filter( 'ot_show_pages', '__return_false' ); //,...

/**
 * Show Theme Options UI Builder
 */
add_filter( 'ot_show_options_ui', '__return_true' ); //

/**
 * Show Settings Import
 */
add_filter( 'ot_show_settings_import', '__return_true' ); //

/**
 * Show Settings Export
 */
add_filter( 'ot_show_settings_export', '__return_true' ); //

/**
 * Show New Layout
 */
add_filter( 'ot_show_new_layout', '__return_true' ); //

/**
 * Show Documentation
 */
add_filter( 'ot_show_docs', '__return_true' ); //

/**
 * Custom Theme Option page
 */
add_filter( 'ot_use_theme_options', '__return_true' );

/**
 * Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );

/**
 * Allow Unfiltered HTML in textareas options
 */
add_filter( 'ot_allow_unfiltered_html', '__return_false' );

/**
 * Loads the meta boxes for post formats
 */
add_filter( 'ot_post_formats', '__return_true' );

/**
 * OptionTree in Theme Mode
 */
# require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );

/**
 * Meta Boxes
 */
require( trailingslashit( get_template_directory() ) . 'includes/theme-meta-boxes.php' );

/**
 * Theme Customizer
 */
// require( trailingslashit( get_template_directory() ) . 'includes/customizer.php' );

/**
 * Demo Functions (for demonstration purposes only!)
 */
require( trailingslashit( get_template_directory() ) . 'includes/theme-functions.php' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker-collapse.php';


/**
 * TGM pluging activation for visual composer
 */
// require get_template_directory() . '/plugin/plugin-activation.php';


/**
 * Theme Updates 
 */
require get_template_directory() .'/includes/theme-updates/theme-update-checker.php';
// $MyThemeUpdateChecker = new ThemeUpdateChecker(
// 'progobase-master', //Theme slug. Usually the same as the name of its directory.
// 'http://example.com/wp-update-server/?action=get_metadata&slug=theme-directory-name' //Metadata URL.
// );

/**
 * Theme Hooks Alliance
 */
require get_template_directory() . '/includes/tha-theme-hooks.php';

/**
 * Functions for uploading custom theme
 */
require( trailingslashit( get_template_directory() ) . '/upload-theme.php' );

/**
 * Functions for showing news
 */
require( trailingslashit( get_template_directory() ) . '/progo-dashboard.php' );

function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/admin-style.css' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );



?>