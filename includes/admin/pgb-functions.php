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

	$default_width = apply_filters( 'pgb_default_page_width', '1170px' );
	$classname = apply_filters( 'pgb_page_width_class', '.container' );

	$width = '100%';
  $max_width = $default_width;
  // load and set the overall option "container_width"
  $set_width = pgb_get_option( 'container_width', $default_width );
  if ( !empty( $set_width ) && ( $set_width !== "default" ) ) {
    if ( $set_width === "full" ) {
      $max_width = "100%";
    } else {
      $max_width = ''. $set_width;
    }
  }
	// check override per page/post
  $post_id = get_the_ID();
	$override_width = get_post_meta( $post_id, 'metabox_page_layout_option', true );
	$custom_width = get_post_meta( $post_id, 'custom_container_width', true );
			
	if ( $override_width === "yes" ) {

		if ( !empty( $custom_width ) && ( $custom_width !== "default" ) ) {
      if ( $custom_width === "full" ) {
        $max_width = '100%';
      } else {
        // set to custom_width, which include 'px' at the end
        $max_width = $custom_width;
      }
    }
	}
  // make sure max_width ends in "px" if it doesnt end in ...0%
  $mend = substr( $max_width, -2 );
  if ( ( $mend != '0%' ) && ( $mend != 'px' ) ) {
    $max_width .= 'px';
  }
  // run through 1 more filter just in case
  $max_width = apply_filters( 'pgb_page_width', $max_width, $post_id );
  // sanitize again
  $classname = esc_attr( $classname );
  $max_width = wp_kses( $max_width, array() );
  // and output
	$custom_css = sprintf( '%1$s { width: %2$s; max-width: %3$s !important; }', $classname, $width, $max_width );

	return $custom_css;
}
endif;


/**
 * Returns available theme logos as responsive HTML blocks
 * @since ProGo 0.3
 * @param $wrap boolean
 * @return html
 */
function pgb_get_logo( $wrap = true ) {

	$desktoplogo	= pgb_get_option( 'logo_desktop' );
	$tabletlogo		= pgb_get_option( 'logo_tablet' );
	$mobilelogo		= pgb_get_option( 'logo_mobile' );
	$title			= get_bloginfo( 'name' );
	$logo			= ( $desktoplogo || $tabletlogo || $mobilelogo ) ? '' : sprintf( __( '%s', 'pgb' ), $title ); // if no logo exists, use text
	$logo_url		= ( $desktoplogo ? $desktoplogo : ( $tabletlogo ? $tabletlogo : ( $mobilelogo ? $mobilelogo : null ) ) ); // if param false, return just URL

	/**
	 * We can use the mobile or tablet logos on larger screens (up)
	 * but we cannot use the larger Desktop logo on smaller screens (down).
	 */
	if ( $mobilelogo ) :
		$logo .= sprintf( '<div class="mobilelogo"><img src="%s" alt=""></div>', esc_attr( $mobilelogo ) );
		if ( ! $tabletlogo ) {
			$tabletlogo = $mobilelogo;
		}
	endif;

	if ( $tabletlogo ) :
		$logo .= sprintf( '<div class="tabletlogo"><img src="%s" alt=""></div>', esc_attr( $tabletlogo ) );
		if ( ! $desktoplogo ) {
			$desktoplogo = $tabletlogo;
		}
	endif;

	if ( $desktoplogo ) :
		$logo .= sprintf( '<div class="desktoplogo"><img src="%s" alt=""></div>', esc_attr( $desktoplogo ) );
	endif;

	if ( $wrap ) {
		return $logo;
	}
	else {
		return $logo_url;
	}
}

/**
 * Returns mobile logo only - non-responsive, always visible
 * @since ProGo 0.4
 * @return html
 */
function pgb_get_mobile_logo () {

	$mobilelogo	= pgb_get_option( 'logo_mobile' );
	$title		= get_bloginfo( 'name' );   
	$logo		= sprintf( __( '%s', 'pgb' ), $title );

	if ( $mobilelogo ) {
		$logo = sprintf( '<div class="mobilelogo show"><img src="%s" alt=""></div>', esc_attr( $mobilelogo ) );
	}

	return $logo;
}

/**
 * Append Bootstrap responsive class to images added via Add Media button
 * @since ProGo 0.6.1
 * @return image HTML
 */
function pgb_filter_image_send_to_editor($html, $id, $caption, $title, $align, $url, $size, $alt) {
	$html = str_replace('class="', 'class="img-responsive ', $html);
	return $html;
}
add_filter('image_send_to_editor', 'pgb_filter_image_send_to_editor', 10, 8);


/**
 * Get first instance of image in post
 * @since ProGo 0.6
 * @return image URL
 */
function pgb_get_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_img ) )
		return $first_img;
	return false;
}

/**
 * Get first instance of audio in post
 * @since ProGo 0.6
 * @return audio SRC
 */
function pgb_get_audio() {
	global $post, $posts;
	$first_audio = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<a.+href=[\'"]([^\'"]+('.implode( '|', wp_get_audio_extensions() ).'))[\'"].*>/i', $post->post_content, $matches);
	$first_audio = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_audio ) )
		return $first_audio;
	$output = preg_match_all('/\[audio.+src=[\'"]([^\'"]+('.implode( '|', wp_get_audio_extensions() ).'))[\'"].*\]/i', $post->post_content, $matches);
	$first_audio = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_audio ) )
		return $first_audio;
	return false;
}

/**
 * Get first instance of video in post
 * @since ProGo 0.6
 * @return video SRC
 */
function pgb_get_video() {
	global $post, $posts;
	$first_video = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<a.+href=[\'"]([^\'"]+('.implode( '|', wp_get_video_extensions() ).'))[\'"].*>/i', $post->post_content, $matches);
	$first_video = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_video ) )
		return $first_video;
	$output = preg_match_all('/\[video.+src=[\'"]([^\'"]+('.implode( '|', wp_get_video_extensions() ).'))[\'"].*\]/i', $post->post_content, $matches);
	$first_video = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_video ) )
		return $first_video;
	return false;
}

/**
 * Get first instance of link in post
 * @since ProGo 0.6
 * @return link URL
 */
function pgb_get_link() {
	global $post, $posts;
	$first_link = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<a.+href=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_link = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_link ) )
		return $first_link;
	return false;
}

/**
 * Get first instance of blockquote in post
 * @since ProGo 0.6
 * @return blockquote
 */
function pgb_get_quote() {
	global $post, $posts;
	$first_quote = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<blockquote.*?>(.+?)<\/blockquote>/is', $post->post_content, $matches);
	$first_quote = isset( $matches[1][0] ) ? $matches[1][0] : false;
	if( ! empty( $first_quote ) )
		return $first_quote;
	return false;
}


/**
 * Checks if current page is a blog page
 * @since ProGo 0.3
 * @return boolean
 */
if ( ! function_exists('is_blog_page') ) :
function pgb_is_blog_page() {
	if ( is_front_page() && is_home() ) {
		// Default homepage (blog on homepage)
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
 * Output Blog Page ID
 * @since ProGo 0.9.0
 * @uses pgb_is_blog_page()
 * @return integer
 */
if ( ! function_exists('blog_page_id') ) :
function pgb_blog_page_id() {
	if ( pgb_is_blog_page() && get_option('page_for_posts') ) {
		$blog_page_id = get_option('page_for_posts');
	}
	return $blog_page_id;
}
endif;


/**
 * Output Blog Page title
 * @since ProGo 0.6.3
 * @uses pgb_blog_page_id()
 * @return string
 */
if ( ! function_exists('blog_page_title') ) :
function pgb_blog_page_title( $before = '<h1 class="page-title">', $after = '</h1>', $blog_page_id = 0, $echo = true ) {
	$blog_page_id = pgb_blog_page_id();
	$blog_page_title = get_the_title( $blog_page_id );

	if ( ! empty( $blog_page_id ) ) {
		$blog_page_title = $before . $blog_page_title . $after;
	}
	if ( ! $echo ) {
		return $blog_page_title;
	}
	echo $blog_page_title;
}
endif;


/**
 * Default Template
 * @since ProGo 0.1.1
 * @uses pgb_is_blog_page()
 * @return integer
 */
if ( ! function_exists('pgb_default_template') ) :
function pgb_default_template() {
	$template = false;
	if ( function_exists('pgb_get_option') )
		$template = pgb_get_option( 'default_page_template', 'right' );
	return $template;
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
	if ( isset( $options[$name] ) && ! empty( $options[$name] ) ) {
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
 * Get Pages as ID/Title array pair
 *
 * @param none
 * @uses get_pages()
 * @return array
 */
function pgb_get_pages_by_id() {
	$pages_by_id = array();
	$args = array(
		'sort_order' => 'asc',
		'sort_column' => 'post_title',
		'hierarchical' => 0,
		'exclude' => array(
			get_option('page_on_front'),
			get_option('page_for_posts')
			),
		'post_type' => 'page',
		'post_status' => 'publish'
		);
	$pages = get_pages( $args );
	foreach ($pages as $page) {
		$pages_by_id[$page->ID] = $page->post_title;
	}
	return $pages_by_id;
}
/**
 * Get registered Nav menus as array
 *
 * @param none
 * @uses get_registered_nav_menus()
 * @return array
 */
function pgb_get_menus() {
	$menus = get_registered_nav_menus();
	return $menus;
}
/**
 * Print registered Nav menus as (multi) select
 *
 * @param $multiple boolean
 * @uses pgb_get_menus()
 * @return HTML (multi) select form input
 */
function pgb_menus( $multiple = true ) {
	
	$menus = pgb_get_menus();
	if ( ! $menus ) return false;
	
	$options = '';
	foreach ( $menus as $location => $description ) {
		$options .= "<option value=\"{$location}\">{$description}</option>";
	}
	
	print( sprintf( "<select %s class=\"form-control\">%s</select>", ( $multiple ? 'multiple="multiple"' : '' ), $options) );
}


/**
 * Check if menu(s) item contains $key with $value
 *
 * @param $slug 			single menu slug or array of menu slugs
 * @param $key 				menu_item key
 * @param $value 			menu_item value
 * @uses get_nav_menu_locations()
 * @uses wp_get_nav_menu_object()
 * @uses wp_get_nav_menu_items()
 * @see https://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
 * @return array / false 	MenuID => ItemID or false if not exists
 */
function pgb_menu_item_exists( $slug = false, $key = false, $value = false ) {

	if ( ! $slug || ! $key || ! $value )
		return false;

	$items = array();

	$__ids = get_nav_menu_locations();

	if ( is_array( $slug ) || ! $slug ) {

		if ( is_array( $slug ) )
			$__ids = array_intersect_key( $__ids, array_flip( $slug ) );

		foreach ($__ids as $__id) {
			$__menu = wp_get_nav_menu_object( $__id );
			$__items = wp_get_nav_menu_items( $__menu->term_id );
			if ( ! $__items )
				continue; // Menu does not contain any items
			$pluck = wp_list_pluck( $__items, $key );
			if ( in_array( $value, $pluck ) ) {
				$items[$__menu->term_id] = array_search( $value, $pluck );
			}
		}
	}
	elseif ( array_key_exists( $slug, $__ids) ) {
		$__menu = wp_get_nav_menu_object( $__ids[$slug] );
		$__items = wp_get_nav_menu_items( $__menu->term_id );
		if ( ! $__items )
			continue; // Menu does not contain any items
		$pluck = wp_list_pluck( $__items, $key );
		if ( in_array( $value, $pluck ) )
			$items[$__menu->term_id] = array_search( $value, $pluck );
	}

	return ( empty($items) ? false : $items );
}

function pgb_modify_nav_menu_args( $args )
{
	//var_dump($args);
	return $args;
}

add_filter( 'wp_nav_menu_args', 'pgb_modify_nav_menu_args' );



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
 * Load Masthead block - pgb_block_masthead()
 */
function pgb_block_masthead() {
	do_action( 'pgb_block_masthead' );
}
/* callback */
function pgb_load_block_masthead() {
	locate_template( 'block-masthead.php', true );
}
add_action( 'pgb_block_masthead', 'pgb_load_block_masthead', 10 );

/**
 * Load Navbar block - pgb_block_navbar()
 */
function pgb_block_navbar() {
	do_action( 'pgb_block_navbar' );
}
/* callback */
function pgb_load_block_navbar() {
	locate_template( 'block-navbar.php', true );
}
add_action( 'pgb_block_navbar', 'pgb_load_block_navbar', 10 );

/**
 * Load Navtop block - pgb_block_navbartop()
 */
function pgb_block_navbartop() {
	do_action( 'pgb_block_navbartop' );
}
/* callback */
function pgb_load_block_navtop() {
	locate_template( 'block-navtop.php', true );
}
add_action( 'pgb_block_navbartop', 'pgb_load_block_navtop', 10 );

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
 * Load Footer Copyright Area block - pgb_block_footercopyright()
 */
function pgb_block_footercopyright() {
	do_action( 'pgb_block_footercopyright' );
}
/* callback */
function pgb_load_block_footercopyright() {
	locate_template( 'block-footercopyright.php', true );
}
add_action( 'pgb_block_footercopyright', 'pgb_load_block_footercopyright', 10 );

/**
 * Load Link pages block - pgb_block_linkpages()
 */
function pgb_block_linkpages() {
	do_action( 'pgb_block_linkpages' );
}
/* callback */
function pgb_load_block_linkpages() {
	locate_template( 'block-linkpages.php', true );
}
add_action( 'pgb_block_linkpages', 'pgb_load_block_linkpages', 10 );

/**
 * Load Page Title block - pgb_block_page_title()
 */
function pgb_block_page_title() {
	do_action( 'pgb_block_page_title' );
}
/* callback */
function pgb_load_block_page_title() {
	get_template_part( 'block', 'page_title' );
}
add_action( 'pgb_block_page_title', 'pgb_load_block_page_title', 10 );

/**
 * Load Page/Post Title block - pgb_block_post_title()
 *
 * @deprecated since v1.0
 */
function pgb_block_post_title() {
	do_action( 'pgb_block_post_title' );
}
/* callback */
function pgb_load_block_posts_title() {
	get_template_part( 'block', 'post_title' );
}
add_action( 'pgb_block_post_title', 'pgb_load_block_posts_title', 10 );

/**
 * Breadcrumbs - pgb_block_breadcrumbs()
 */
function pgb_block_breadcrumbs() {
	do_action( 'pgb_block_breadcrumbs' );
}
/* callback */
function pgb_load_block_breadcrumbs() { ?>
	<div id="breadcrumb-container" class="container">
		<?php pgb_breadcrumbs(); ?>
	</div>
<?php }
add_action( 'pgb_block_breadcrumbs', 'pgb_load_block_breadcrumbs', 10 );

