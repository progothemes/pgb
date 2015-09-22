<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 *
 * @package pgb
 */

$template = false;
if ( function_exists('pgb_get_option') )
	$template = pgb_get_option( 'default_page_template', 'right' );

if ( 'full' === $template ) :

	locate_template( 'page-nosidebar.php', true );

elseif ( 'left' === $template ) :

	locate_template( 'page-sidebarleft.php', true );

else :

	locate_template( 'page-sidebarright.php', true );

endif;