<?php
/**
 * Get/Define theme settings
 *
 */

$theme_version = '';
$pgbo_output = '';
	
if( is_child_theme() ) {
  $temp_obj = wp_get_theme();
  $theme_obj = wp_get_theme( $temp_obj->get('Template') );
} else {
  $theme_obj = wp_get_theme();    
}

$theme_version = $theme_obj->get('Version');
$theme_name = $theme_obj->get('Name');
$theme_uri = $theme_obj->get('ThemeURI');
$author_uri = $theme_obj->get('AuthorURI');

if( !defined('ADMIN_PATH') )
	define( 'ADMIN_PATH', get_template_directory() . '/includes/' );

if( !defined('ADMIN_DIR') )
	define( 'ADMIN_DIR', get_template_directory_uri() . '/includes/' );

define( 'ADMIN_IMAGES', ADMIN_DIR . 'admin/images/' );

define( 'THEMENAME', $theme_name );

/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

require_once( ADMIN_PATH . 'admin/pgb-filters.php' ); // Theme Filters
require_once( ADMIN_PATH . 'admin/pgb-functions.php' ); // Theme Functions

//require_once( ADMIN_PATH . 'admin/class.post_formats.php' ); // Post Formats Meta Boxes
require_once( ADMIN_PATH . 'admin/class.pgb_customizer.php' ); // Theme Customizer
require_once( ADMIN_PATH . 'admin/class.pgb_subtitles.php');
require_once( ADMIN_PATH . 'pgb-edit-wp-navwalker.php' ); // Nav Walker for Admin Nav Menus
require_once( ADMIN_PATH . 'admin/class.pgb_loginout.php' ); // Login / Log Out

//add_action('wp_ajax_pgb_ajax_post_action', 'pgb_ajax_callback');

add_filter( 'admin_init' , array( 'PGB_Rich_Snippet_Settings', 'register_fields' ) );
class PGB_Rich_Snippet_Settings {
	static function register_fields() {
		register_setting( 'general', 'rich_snippet_type', 'esc_attr' );
		add_settings_field('rich_snip_type', '<label for="rich_snippet_type">'.__('Rich Snippets @Type' , 'pgb' ).'</label>' , array('PGB_Rich_Snippet_Settings', 'fields_html') , 'general' );
	}
	static function fields_html() {
		$value = get_option( 'rich_snippet_type', '' );
		echo '<input type="text" id="rich_snippet_type" name="rich_snippet_type" value="' . $value . '" placeholder="WebSite" />';
		echo '<p class="description" id="rich_snippet_type_description">Enter your <a href="http://schema.org/docs/schemas.html" alt="schema.org">site schema type</a></p>';
	}
}
