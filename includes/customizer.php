<?php
/**
 * pgb Theme Customizer
 *
 * @package pgb
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pgb_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	 /**
	   * Remove built-in options
	 */	  
	  $wp_customize->remove_section( 'colors' );
	  $wp_customize->remove_section( 'header_image' );
	  $wp_customize->remove_section( 'nav' );
}
add_action( 'customize_register', 'pgb_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pgb_customize_preview_js() {
	wp_enqueue_script( 'pgb_customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pgb_customize_preview_js' );
