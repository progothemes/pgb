<?php

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since ProGo 0.4
 */
class ProGo_Customize {
	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 * 
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 *  javascript. See live_preview() for more.
	 *  
	 * @see add_action('customize_register',$func)
	 * @param \WP_Customize_Manager $wp_customize
	 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since ProGo 0.4
	 */
	public static function register ( $wp_customize ) {
		// Page Layout Settings
		$wp_customize->add_section( 'pgb_options[layout]', 
			array(
				'title' => 'ProGo Layout and Options',
				'priority' => 10,
				'description' => '',
			)
		);
		$wp_customize->add_setting( 'pgb_options[container_width]',
			array(
				//'default' => '1170',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_setting( 'pgb_options[bootstrap_theme]',
			array(
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_control( 'pgb_options[container_width]',
			array(
				'label'    => __( 'Page Container Width', 'pgb' ),
				'section'  => 'pgb_options[layout]',
				'settings' => 'pgb_options[container_width]',
				'type'     => 'select',
				'choices'  => array(
					'full' => 'Full Width (100%)',
					'1366' => '1366px',
					'1240' => '1240px',
					'1170' => '1170px',
					'1080' => '1080px',
					'960' => '960px',
				),
			)
		);
		$wp_customize->add_control( 'pgb_options[bootstrap_theme]',
			array(
				'label'    => __( 'Bootstrap Theme', 'pgb' ),
				'section'  => 'pgb_options[layout]',
				'settings' => 'pgb_options[bootstrap_theme]',
				'type'     => 'select',
				'choices'  => array(
					'default' => 'Default Bootstrap',
					'cerulean' => 'Cerulean',
					'cosmo' => 'Cosmo',
					'cyborg' => 'Cyborg',
					'darkly' => 'Darkly',
					'flatly' => 'Flatly',
					'journal' => 'Journal',
					'lumen' => 'Lumen',
					'paper' => 'Paper',
					'readable' => 'Readable',
					'sandstone' => 'Sandstone',
					'simplex' => 'Simplex',
					'slate' => 'Slate',
					'spacelab' => 'Spacelab',
					'superhero' => 'Superhero',
					'united' => 'United',
					'yeti' => 'Yeti',
				),
			)
		);
		// Logo Settings
		$wp_customize->add_section( 'pgb_options[logo]',
			array(
				'title' => 'Logos',
				'priority' => 30,
				'description' => '',
			)
		);
		$wp_customize->add_setting( 'pgb_options[logo_mobile]',
			array(
				//'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_setting( 'pgb_options[logo_desktop]',
			array(
				//'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( 
				$wp_customize, 
				'pgb_options[logo_mobile]',
				array(
					'label' => __( 'Navbar Icon', 'pgb' ),
					'section' => 'pgb_options[logo]',
					'settings' => 'pgb_options[logo_mobile]',
					'description' => 'Add your logo to the top navbar (Bootstrap <a href="http://getbootstrap.com/components/#navbar-brand-image" target="_blank">Brand Image</a>). This logo will also be used in place of the Desktop Logo on smaller screens.<br />Maximum height 40px.'
				)
			) 
		);
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( 
				$wp_customize, 
				'pgb_options[logo_desktop]',
				array(
					'label'      => __( 'Desktop Logo', 'pgb' ),
					'section'    => 'pgb_options[logo]',
					'settings'   => 'pgb_options[logo_desktop]',
					'description' => 'Desktop Logo is not currently implemented in ProGo Base.<br />However, you can use <code>pgb_get_logo()</code> to embed responsive logos.'
				)
			) 
		);
		// Nav Settings
		$wp_customize->add_setting( 'pgb_options[menu_align]',
			array(
				//'default' => 'right',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_setting( 'pgb_options[nav_position]',
			array(
				//'default' => 'static',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_setting( 'pgb_options[nav_search]',
			array(
				//'default' => '0',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_control( 'pgb_options[menu_align]', 
			array(
				'label'    => __( 'Menu Alignment', 'pgb' ),
				'section'  => 'nav',
				'settings' => 'pgb_options[menu_align]',
				'type'     => 'radio',
				'choices'  => array(
					'right' => 'Right',
					'left' => 'Left',
				),
			)
		);
		$wp_customize->add_control( 'pgb_options[nav_position]', 
			array(
				'label'    => __( 'Navbar Position', 'pgb' ),
				'section'  => 'nav',
				'settings' => 'pgb_options[nav_position]',
				'type'     => 'radio',
				'choices'  => array(
					'static' => 'Static',
					'fixed' => 'Fixed',
				),
			)
		);
		$wp_customize->add_control( 'pgb_options[nav_search]', 
			array(
				'label'    => __( 'Show Search in Navbar', 'pgb' ),
				'section'  => 'nav',
				'settings' => 'pgb_options[nav_search]',
				'type'     => 'checkbox',
				'value'    => 1,
				'description' => 'Adds search field to the far right of the navbar'
			)
		);
		// Footer Settings
		$wp_customize->add_section( 'pgb_options[footer]',
			array(
				'title' => 'Footer',
				'priority' => 130,
				'description' => ''
			)
		);
		$wp_customize->add_setting( 'pgb_options[footer_show]',
			array(
				//'default' => '1',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_setting( 'pgb_options[footer_columns]',
			array(
				//'default' => '3',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
			) 
		);
		$wp_customize->add_control( 'pgb_options[footer_show]', 
			array(
				'label'    => __( 'Show Footer Widgets', 'pgb' ),
				'section'  => 'pgb_options[footer]',
				'settings' => 'pgb_options[footer_show]',
				'type'     => 'checkbox',
				'value'    => '1',
			)
		);
		$wp_customize->add_control( 'pgb_options[footer_columns]', 
			array(
				'label'    => __( 'Number of Columns', 'pgb' ),
				'section'  => 'pgb_options[footer]',
				'settings' => 'pgb_options[footer_columns]',
				'type'     => 'select',
				'choices'  => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					),
			)
		);
	}

	/**
     * This will output the custom WordPress settings to the live theme's WP head.
     * 
     * Used by hook: 'wp_head'
     * 
     * @see add_action('wp_head',$func)
     * @since ProGo 0.5
     */
	/*
	public static function header_output() {
		?>
		<!--Customizer CSS--> 
		<style type="text/css">
		     <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
		     <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
		     <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
		</style> 
		<!--/Customizer CSS-->
		<?php
	}
	*/

	/**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings 
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     * 
     * Used by hook: 'customize_preview_init'
     *  
     * @see add_action('customize_preview_init',$func)
     * @since ProGo 1.0
     */
	public static function live_preview() {
		wp_enqueue_script( 
			'pgb-themecustomizer', // Give the script a unique ID
			get_template_directory_uri() . '/includes/js/theme-customizer.js', // Define the path to the JS file
			array(  'jquery', 'customize-preview' ), // Define dependencies
			'', // Define a version (optional) 
			true // Specify whether to put in footer (leave this true)
		);
	}

	/**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since ProGo 1.0
     */
	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'ProGo_Customize' , 'register' ) );

// Output custom CSS to live site
//add_action( 'wp_head' , array( 'ProGo_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'ProGo_Customize' , 'live_preview' ) );

