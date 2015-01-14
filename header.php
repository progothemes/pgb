<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package pgb
 */
?><!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php tha_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php tha_head_bottom(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<?php 
	$header_menu = ot_get_option( 'pgb_headermenu' );
	 if ( !empty( $header_menu ) && ( 'left' == $header_menu || 'topleft' == $header_menu) ) {  ?>
	<div id="wrapper" class="clearfix">
	<?php }  ?>

	<?php tha_body_top(); ?>
	<?php tha_header_before(); ?>
	<?php do_action( 'before' ); ?>
	

	<?php if ( !empty( $header_menu ) && 'topleft' == $header_menu ) { ?>

		<?php get_template_part('partials/block', 'menutopleft'); ?><div id="page-content-wrapper" class="page-content-wrapper-topleft">

	<?php } else {  ?>

		<?php get_template_part('partials/block', 'menu'); ?><div id="page-content-wrapper" class="page-content-wrapper-left">

	<?php } ?>

	<?php get_template_part('partials/block', 'header'); ?>		

	<?php tha_header_after();  ?>
	
	<?php tha_content_before(); ?>
	<div class="main-content">
		<div class="container">
			<div class="row">
				<div id="content" class="main-content-inner col-sm-12 col-md-8">
					<?php tha_content_top(); ?>

