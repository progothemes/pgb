<?php
/**
 * ProGo Base Theme version
 */
define( 'PGB_THEME_VERSION', '1.1.0' );



/**
 * Load ProGo Base Theme Options
 */
locate_template( '/includes/theme-settings.php', true );
locate_template( '/includes/tha-theme-hooks.php', true );
locate_template( '/includes/bootstrap-wp-navwalker.php', true );
locate_template( '/includes/bootstrap-wp-navwalker-collapse.php', true );
locate_template( '/includes/template-tags.php', true );
locate_template( '/includes/theme-meta-boxes.php', true );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

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

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails on posts and pages
		add_theme_support( 'post-thumbnails' );

		// Enable support for various Post Formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'link', 'quote', 'video' ) );

		// Enable support for Title Tag
		add_theme_support( 'title-tag' );

		// Enable Custom Header Image theme support
		add_theme_support( 'custom-header' );

		// Enable Custom Background Image theme support
		add_theme_support( 'custom-background' );
	}

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'	=> __( 'Main Menu', 'pgb' ),
		'secondary'	=> __( 'Top Menu', 'pgb' ),
		'footer'	=> __( 'Footer Menu', 'pgb' ),
	) );

	/**
	 * Add WooCommerce Support
	 */
	add_theme_support( 'woocommerce' );

}
endif; // pgb_setup
add_action( 'after_setup_theme', 'pgb_setup' );

/**
 * Get title
 */
function pgb_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( 'Page %s' , max( $paged, $page ) );

	return $title;
}
//add_filter( 'wp_title', 'pgb_wp_title', 10, 2 );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function pgb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pgb' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget col-xs-12 col-sm-6 col-md-12 %2$s"><div class="col-lg-12">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer widget areas
	register_sidebars( 4, array(
		'name' 			=> 'Footer Widget %d',
		'id' 			=> 'footer-widget',
		'description' 	=> 'Footer Widget Area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );

	// Footer copyright areas
	register_sidebar( array(
		'name'          => __( 'Footer Copyright (left)', 'pgb' ),
		'id'            => 'footer-copyright-left',
		'before_widget' => '<div id="%1$s" class="col-xs-12 col-sm-12 col-md-6 pull-left">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Copyright (right)', 'pgb' ),
		'id'            => 'footer-copyright-right',
		'before_widget' => '<div id="%1$s" class="col-xs-12 col-sm-12 col-md-6 pull-right text-right">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'pgb_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function pgb_scripts() {

	$bootstrap_theme = pgb_get_option('bootstrap_theme', 'default');

	if ( ! $bootstrap_theme || $bootstrap_theme == 'default' ) {
		wp_enqueue_style( 'pgb-bootstrap', get_template_directory_uri() . '/includes/css/bootstrap.css' );
	} else {
		wp_enqueue_style( 'pgb-bootstrap', get_template_directory_uri() . '/includes/bootswatch/'. $bootstrap_theme .'/bootstrap.min.css' );
	}

	// load pgb styles
	wp_enqueue_style( 'pgb-style', get_stylesheet_uri() );

	// Load rtl style
	// wp_enqueue_style( 'pgb-rtl', get_template_directory_uri() . '/rtl.css' );

	// load the font icons
	wp_enqueue_style('pgb-fontawesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css');

	// load google fonts
	wp_enqueue_style( 'pgb-google-font', '//fonts.googleapis.com/css?family=Questrial|Droid+Sans:400,700|Lato:400,700,900,400italic,700italic|Arvo:400,700,400italic|PT+Sans:400,700,400italic,700italic|Quicksand:400,700|Gloria+Hallelujah|Roboto:900,400,700,300italic,500,500italic,700italic|Montserrat:700,400|Open+Sans:400italic,700,600,800,400');


	// ProGo Container Width
	if ( !is_admin() ) {
		
		$custom_css = pgb_set_container_width();

		$custom_css .= " @media (max-width: 599px) { .navbar-fixed-top.top-nav-menu{ z-index: 499; } }";

		wp_add_inline_style( 'pgb-style', $custom_css );
	}


	// Fix for Visual Composer not loading CSS file(s)
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		if ( file_exists(plugins_url() . '/js_composer/assets/css/js_composer.min.css') ) {
			wp_enqueue_style('js-composer', plugins_url() . '/js_composer/assets/css/js_composer.min.css');
		}
		elseif ( file_exists(plugins_url() . '/js_composer/assets/css/js_composer.css') ) {
			wp_enqueue_style('js-composer', plugins_url() . '/js_composer/assets/css/js_composer.css');
		}
	}

	// SCRIPTS

	// load bootstrap js
	wp_enqueue_script('pgb-bootstrapjs', get_template_directory_uri().'/includes/js/bootstrap.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( 'pgb-bootstrapwpjs', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( 'jquery.validate', get_template_directory_uri() . '/includes/js/jquery.validate.js', array('jquery') );

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

function pgb_load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', ADMIN_DIR . 'admin/css/admin-style.css' );
        wp_enqueue_style( 'custom_wp_admin_css' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker-script', get_template_directory_uri() . '/includes/js/color-picker.js', array( 'wp-color-picker' ), false, true );
        wp_enqueue_script( 'postformats-js', ADMIN_DIR .'admin/js/postformats.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'pgb-js', ADMIN_DIR .'admin/js/pgb.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'pgb_load_custom_wp_admin_style' );

function pgb_body_classes( $classes ) {
	$classes[] = 'progo-base';
	$classes[] = 'pgb-theme-' . pgb_get_option('bootstrap_theme', 'default');
	return $classes;
}
add_filter('body_class','pgb_body_classes');


?>
