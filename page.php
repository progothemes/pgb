<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 *
 * @package pgb
 */

$template = pgb_default_template();

switch ( $template ) {
	case 'full':
		locate_template( 'page-nosidebar.php', true );
		break;
	case 'left':
		locate_template( 'page-sidebarleft.php', true );
		break;
	case 'right':
	default:
		locate_template( 'page-sidebarright.php', true );
		break;
}
