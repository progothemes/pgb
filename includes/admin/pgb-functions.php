<?php 

/**
 * Get page container width CSS from customizer settings
 * @since ProGo 0.5
 * @param $data 
 * @param $classname 
 * @return css
 */
if ( ! function_exists( 'pgb_set_container_width' ) ) :
function pgb_set_container_width() {

	$default_width = '1170';
	$classname = '.container';

	$width = '100%';
	$max_width = ( pgb_get_option( 'container_width', $default_width ) === "full" ? '100%' : pgb_get_option( 'container_width', $default_width ) . 'px' );
		
	$override_width = get_post_meta( get_the_ID(), 'metabox_page_layout_option', true );
	$custom_width = get_post_meta( get_the_ID(), 'custom_container_width', true );
			
	if ( $override_width === "yes" ) :

		if ( empty( $custom_width ) || $custom_width === "default" ) {
			// do nothing...
		}
		elseif ( $custom_width === "full" ) {
			$max_width = '100%';
		}
		else {
			$max_width = $custom_width . 'px';
		}
				
	endif;

	$custom_css = sprintf( '%1$s { width: %2$s; max-width: %3$s; }', $classname, $width, $max_width );

	return $custom_css;
}
endif;


/**
 * Returns available theme logos as responsive HTML blocks
 * @since ProGo 0.3
 * @return html
 */
function pgb_get_logo () {

	$desktoplogo	= pgb_get_option( 'logo_desktop' );
	$mobilelogo		= pgb_get_option( 'logo_mobile' );
	$title			= get_bloginfo( 'name' );
	$logo			= null;

	if ( empty( $desktoplogo ) && ! empty( $mobilelogo ) ) { // Mobile logo only
		$desktoplogo = $mobilelogo;
	} 
	elseif ( empty( $mobilelogo ) && ! empty( $desktoplogo ) ) { // Desktop logo only
		$mobilelogo = $desktoplogo;
	}
	else {
		// Both logos
	}

	$logo .= '<div class="desktoplogo">
				<img src="'.  esc_attr( $desktoplogo ) .'" alt="">
			</div>';
	$logo .= '<div class="mobilelogo">
				<img src="'.  esc_attr( $mobilelogo ) .'" alt="">
			</div>';

	if ( empty( $desktoplogo ) && empty( $mobilelogo ) ) { // No logo is set
		$logo = sprintf( __( '%s', 'pgb' ), $title );
	}

	return $logo;
}

/**
 * Returns mobile logo only - non-responsive, always visible
 * @since ProGo 0.4
 * @return html
 */
function pgb_get_mobile_logo () {

	$mobilelogo	= pgb_get_option( 'logo_mobile' );
	$title		= get_bloginfo( 'name' );   
	$logo		= null;

	if ( $mobilelogo ) {
		$logo = '<div class="mobilelogo show">
				<img src="'.  esc_attr( $mobilelogo ) .'" alt="">
			</div>';
	}
	else {
		$logo = sprintf( __( '%s', 'pgb' ), $title ); 
	}

	return $logo;
}

/**
 * Checks if current page is a blog page
 * @since ProGo 0.3
 * @return boolean
 */
if ( ! function_exists('is_blog_page') ) :
function is_blog_page() {
	if ( is_front_page() && is_home() ) {
		// Default homepage
		return true;
	} elseif ( is_front_page() ) {
		// static homepage
		return false;
	} elseif ( is_home() ) {
		// blog page
		return true;
	} else {
		//everything else
		return false;
	}
}
endif;



/**
 * Returns a single option for ProGo
 * @since ProGo 0.5
 * @return param
 */
function pgb_get_option( $name, $default = false ) {
	$options = get_theme_mod( 'pgb_options', null );
	// return the option if it exists
	if ( isset( $options[ $name ] ) ) {
		return apply_filters( "pgb_options_{$name}", $options[ $name ] );
	}
	// return default if nothing else
	return apply_filters( "pgb_options_{$name}", $default );
}

/**
 * Returns the options array for ProGo
 * @since ProGo 0.5
 * @return array
 */
function pgb_get_options() {
	$options = get_theme_mod( 'pgb_options', null );
	return $options;
}



/**
 * Remove theme editor from Admin Menu for security
 *
 * @return null
 */
add_action('admin_init', 'pgb_remove_menu_elements', 102);
function pgb_remove_menu_elements() {
	remove_submenu_page( 'themes.php', 'theme-editor.php' );		// remove theme editor
	remove_submenu_page( 'plugins.php', 'plugin-editor.php' );		// remove plugins editor
}


/**
 * Load PGB Template Parts
 *
 * Uses locate_template() to get hightest priority template file for easy child theming
 *
 * remove_action() to remove template blocks
 * add_action() to append new template blocks
 *
 * @return template part
 */

/**
 * Load Header block - pgb_block_header()
 */
function pgb_block_header() {
	do_action( 'pgb_block_header' );
}
/* callback */
function pgb_load_block_header() {
	locate_template( 'block-header.php', true );
}
add_action( 'pgb_block_header', 'pgb_load_block_header', 10 );

/**
 * Load Top Nav block - pgb_block_navtop()
 */
function pgb_block_navtop() {
	do_action( 'pgb_block_navtop' );
}
/* callback */
function pgb_load_block_navtop() {
	locate_template( 'block-navtop.php', true );
}
add_action( 'pgb_block_navtop', 'pgb_load_block_navtop', 10 );

/**
 * Load Footer Widget Area block - pgb_block_footerwidgets()
 */
function pgb_block_footerwidgets() {
	do_action( 'pgb_block_footerwidgets' );
}
/* callback */
function pgb_load_block_footerwidgets() {
	locate_template( 'block-footerwidgets.php', true );
}
add_action( 'pgb_block_footerwidgets', 'pgb_load_block_footerwidgets', 10 );

/**
 * Load Header block - pgb_block_header()
 */
function pgb_block_linkpages() {
	do_action( 'pgb_block_linkpages' );
}
/* callback */
function pgb_load_block_linkpages() {
	locate_template( 'block-linkpages.php', true );
}
add_action( 'pgb_block_linkpages', 'pgb_load_block_linkpages', 10 );

