<?php

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since ProGo 0.4
 */


// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'PGB_Customize' , 'register' ) );
class PGB_Customize {

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
		
		/**
		 * SECTION
		 *
		 * Page Layout Settings
		 *
		 */
		$wp_customize->add_section( 'pgb_options[layout]', 
			array(
				'title' => 'Site Layout and Design',
				'priority' => 10,
				'description' => '',
			)
		);
		/**
		 * Container Width
		 */
		$wp_customize->add_setting( 'pgb_options[container_width]',
			array(
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_container_width' ),
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
		/**
		 * Bootstrap Theme
		 */
		$wp_customize->add_setting( 'pgb_options[bootstrap_theme]',
			array(
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_bootstrap_theme' ),
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
		/**
		 * Default Page Template
		 */
		$wp_customize->add_setting( 'pgb_options[default_page_template]',
			array(
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => '',
			) 
		);
		$wp_customize->add_control( 'pgb_options[default_page_template]',
			array(
				'label'    => __( 'Default Page Template', 'pgb' ),
				'section'  => 'pgb_options[layout]',
				'settings' => 'pgb_options[default_page_template]',
				'type'     => 'select',
				'choices'  => array(
					'right' => 'Right Sidebar',
					'left' => 'Left Sidebar',
					'full' => 'No Sidebar',
				),
			)
		);

		/**
		 * SECTION
		 *
		 * Site Identity ( WP Core 4.3 )
		 *
		 */
		/**
		 * Logo Mobile
		 */
		$wp_customize->add_setting( 'pgb_options[logo_mobile]',
			array(
				//'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_logo' ),
			) 
		);
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( 
				$wp_customize, 
				'pgb_options[logo_mobile]',
				array(
					'label' => __( 'Mobile Navbar Logo', 'pgb' ),
					'priority' => 60,
					'section' => 'title_tagline',
					'settings' => 'pgb_options[logo_mobile]',
					'description' => 'Add your logo to the Bootstrap <a href="http://getbootstrap.com/components/#navbar-brand-image" target="_blank">Brand Image</a> position. Displayed on screens under 768px wide.'
				)
			) 
		);
		/**
		 * Logo Tablet
		 */
		$wp_customize->add_setting( 'pgb_options[logo_tablet]',
			array(
				//'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_logo' ),
			) 
		);
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( 
				$wp_customize, 
				'pgb_options[logo_tablet]',
				array(
					'label'      => __( 'Tablet Navbar Logo', 'pgb' ),
					'priority' => 65,
					'section'    => 'title_tagline',
					'settings'   => 'pgb_options[logo_tablet]',
					'description' => 'Tablet logo is displayed on screens 768px to 1024px wide.'
				)
			) 
		);
		/**
		 * Logo Desktop
		 */
		$wp_customize->add_setting( 'pgb_options[logo_desktop]',
			array(
				//'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_logo' ),
			) 
		);
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( 
				$wp_customize, 
				'pgb_options[logo_desktop]',
				array(
					'label'      => __( 'Desktop Navbar Logo', 'pgb' ),
					'priority' => 70,
					'section'    => 'title_tagline',
					'settings'   => 'pgb_options[logo_desktop]',
					'description' => 'Desktop Logo is displayed on screen above 1024px wide.'
				)
			) 
		);


		/**
		 * SECTION
		 *
		 * Menu Locations ( WP Core 4.3 )
		 *
		 */
		/**
		 * Menu Alignment
		 */
		$wp_customize->add_setting( 'pgb_options[menu_align]',
			array(
				'default' => 'right',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_menu_align' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[menu_align]', 
			array(
				'label'    => __( 'Main Menu Alignment', 'pgb' ),
				'priority' => 20,
				'section'  => 'menu_locations',
				'settings' => 'pgb_options[menu_align]',
				'type'     => 'radio',
				'choices'  => array(
					'right' => 'Right',
					'left' => 'Left',
					//'center' => 'Center',
				),
			)
		);
		/**
		 * Top Menu Alignment
		 */
		$wp_customize->add_setting( 'pgb_options[topmenu_align]',
			array(
				'default' => 'right',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_menu_align' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[topmenu_align]', 
			array(
				'label'    => __( 'Top Menu Alignment', 'pgb' ),
				'priority' => 20,
				'section'  => 'menu_locations',
				'settings' => 'pgb_options[topmenu_align]',
				'type'     => 'radio',
				'choices'  => array(
					'right' => 'Right',
					'left' => 'Left',
					//'center' => 'Center',
				),
			)
		);


		/**
		 * SECTION
		 *
		 * Navbar
		 *
		 */
		$wp_customize->add_section( 
			'pgb_navigation', 
			array(
				'title' => 'Navbars',
				'priority' => 80,
				'description' => '',
			)
		);
		/**
		 * Navbar Position
		 */
		$wp_customize->add_setting( 'pgb_options[nav_position]',
			array(
				//'default' => 'static',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_nav_position' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[nav_position]', 
			array(
				'label'    => __( 'Main Navbar Position', 'pgb' ),
				'section'  => 'pgb_navigation',
				'settings' => 'pgb_options[nav_position]',
				'type'     => 'radio',
				'choices'  => array(
					'static' => 'Static',
					'fixed' => 'Fixed',
				),
			)
		);
		/**
		 * Top Navbar Position
		 */
		$wp_customize->add_setting( 'pgb_options[topnav_position]',
			array(
				'default' => 'static',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => '',
			) 
		);
		$wp_customize->add_control( 'pgb_options[topnav_position]', 
			array(
				'label'    => __( 'Top Navbar Position', 'pgb' ),
				'section'  => 'pgb_navigation',
				'settings' => 'pgb_options[topnav_position]',
				'type'     => 'radio',
				'choices'  => array(
					'static' => 'Static',
					'fixed' => 'Fixed',
				),
			)
		);
		/**
		 * Navbar Width
		 */
		$wp_customize->add_setting( 'pgb_options[navbar_width]',
			array(
					'default' => 'container',
					'type' => 'theme_mod',
					'capability' => 'edit_theme_options',
					'transport' => 'refresh',
					'sanitize_callback' => '',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pgb_options[navbar_width]', 
			array(
				'label' => __( 'Navbar Width', 'problogger' ),
				'priority' => 10,
				'section' => 'pgb_navigation',
				'settings' => 'pgb_options[navbar_width]',
				'description' => __( 'Default is Container Width. Other Options are Full Width with Container Width Content, or Full Width with Full Width Content.', 'problogger' ),
				'type' => 'select',
				'choices' => array(
					'container' => 'Container Width',
					'container-fluid' => 'Full Width + Container',
					'full' => 'Full Width'
					),
			)
		) );

		/**
		 * Top Navbar Width
		 */
		$wp_customize->add_setting( 'pgb_options[topnav_width]',
			array(
					'default' => 'container',
					'type' => 'theme_mod',
					'capability' => 'edit_theme_options',
					'transport' => 'refresh',
					'sanitize_callback' => '',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pgb_options[topnav_width]', 
			array(
				'label' => __( 'Top Navbar Width', 'problogger' ),
				'priority' => 10,
				'section' => 'pgb_navigation',
				'settings' => 'pgb_options[topnav_width]',
				'type' => 'select',
				'choices' => array(
					'container' => 'Container Width',
					'container-fluid' => 'Full Width + Container',
					'full' => 'Full Width'
					),
			)
		) );

		/**
		 * Description
		 */
		$wp_customize->add_control(
			new PGB_Customize_Misc_Control(
				$wp_customize,
				'pgb_navigation_search-description',
				array(
					'section' => 'pgb_navigation',
					'label' => __( 'Search', 'pgb' ),
				)
			)
		);
		/**
		 * Include Search in Navbar
		 */
		$wp_customize->add_setting( 'pgb_options[nav_search]',
			array(
				//'default' => '0',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_nav_search' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[nav_search]', 
			array(
				'label'    => __( 'Show Search in Top Navbar', 'pgb' ),
				'section'  => 'pgb_navigation',
				'settings' => 'pgb_options[nav_search]',
				'type'     => 'checkbox',
				'value'    => 1,
				'description' => 'Adds search field to the right of the top navbar'
			)
		);


		/**
		 * SECTION
		 *
		 * Header
		 */
		$wp_customize->add_section( 
			'pgb_header', 
			array(
				'title' => 'Header',
				'priority' => 210,
				'description' => '',
			)
		);
		/**
		 * Show Breadcrumbs
		 */
		$wp_customize->add_setting( 'pgb_options[show_breadcrumb]',
			array(
				'default' => '1',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_show_breadcrumb' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[show_breadcrumb]', 
			array(
				'label'    => __( 'Include Breadcrumbs', 'pgb' ),
				'section'  => 'pgb_header',
				'settings' => 'pgb_options[show_breadcrumb]',
				'type'     => 'checkbox',
				'value'    => 1,
			)
		);

		

		/**
		 * SECTION
		 *
		 * Footer Settings
		 *
		 */
		$wp_customize->add_section( 'pgb_footer',
			array(
				'title' => 'Footer',
				'priority' => 230,
				'description' => ''
			)
		);
		/**
		 * Description
		 */
		$wp_customize->add_control(
			new PGB_Customize_Misc_Control(
				$wp_customize,
				'pgb_footer_widgets-description',
				array(
					'section' => 'pgb_footer',
					'label' => __( 'Footer Widgets Block', 'pgb' ),
					'description' => __( 'Add footer widgets below page content', 'pgb' ),
				)
			)
		);
		/**
		 * Show Footer Widgets Area
		 */
		$wp_customize->add_setting( 'pgb_options[footer_show_widgets]',
			array(
				//'default' => '1',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_footer_show' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[footer_show_widgets]', 
			array(
				'label'    => __( 'Show Footer Widgets', 'pgb' ),
				'section'  => 'pgb_footer',
				'settings' => 'pgb_options[footer_show_widgets]',
				'type'     => 'checkbox',
				'value'    => '1',
			)
		);
		/**
		 * Number of Columns
		 */
		$wp_customize->add_setting( 'pgb_options[footer_widgets_columns]',
			array(
				'default' => '4',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_footer_widgets_columns' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[footer_widgets_columns]', 
			array(
				'label'    => __( 'Number of Columns', 'pgb' ),
				'section'  => 'pgb_footer',
				'settings' => 'pgb_options[footer_widgets_columns]',
				'type'     => 'select',
				'choices'  => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					),
			)
		);
		/**
		 * Linebreak
		 */
		$wp_customize->add_control(
			new PGB_Customize_LineBreak_Control(
				$wp_customize,
				'pgb_footer_widgets-description-linebreak',
				array(
					'section' => 'pgb_footer',
				)
			)
		);
		/**
		 * Description
		 */
		$wp_customize->add_control(
			new PGB_Customize_Misc_Control(
				$wp_customize,
				'pgb_footer_copyright-description',
				array(
					'section' => 'pgb_footer',
					'label' => __( 'Footer Copyright', 'pgb' ),
					'description' => __( 'Add copyright text to your blog', 'pgb' ),
				)
			)
		);
		/**
		 * Show Footer Copyright Area
		 */
		$wp_customize->add_setting( 'pgb_options[footer_show_copyright]',
			array(
				'default' => '1',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_footer_show' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[footer_show_copyright]', 
			array(
				'label'    => __( 'Show Copyright', 'pgb' ),
				'section'  => 'pgb_footer',
				'settings' => 'pgb_options[footer_show_copyright]',
				'type'     => 'checkbox',
				'value'    => '1',
			)
		);
		/**
		 * Footer Copyright Text
		 */
		$wp_customize->add_setting( 'pgb_options[footer_copyright_text]',
			array(
				'default' => 'Copyright &copy; ' . date( 'Y' ) . ' - ' . get_bloginfo( 'name' ),
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => array( 'PGB_Customize', 'sanitize_footer_show' ),
			) 
		);
		$wp_customize->add_control( 'pgb_options[footer_copyright_text]', 
			array(
				'label'    => __( 'Custom Copyright Text', 'pgb' ),
				'section'  => 'pgb_footer',
				'settings' => 'pgb_options[footer_copyright_text]',
				'type'     => 'text',
				'input_attrs' => array(
					'placeholder' => __( 'Copyright &copy; ' . date( 'Y' ) . ' - ' . get_bloginfo( 'name' ), 'pgb' ),
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

	/**
	 * Settings sanitizations
	 *
	 */
	public static function sanitize_container_width( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_bootstrap_theme( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_logo( $input ) {
		return esc_url( $input );
	}
	public static function sanitize_menu_align( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_nav_position( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_nav_search( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_show_breadcrumb( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_show_login_nav( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_footer_show( $input ) {
		return esc_attr( $input );
	}
	public static function sanitize_footer_widgets_columns( $input ) {
		return esc_attr( $input );
	}

	public static function sanitize_array( $input ) {
		$input = array_map('esc_attr', $input);
		return $input;
	}

}

// Output custom CSS to live site
//add_action( 'wp_head' , array( 'PGB_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'PGB_Customize' , 'live_preview' ) );





/**
 * Custom Controls Classes
 */
if ( class_exists('WP_Customize_Control') ) :
	/**
	 * Multiple select customize control class.
	 */
	class PGB_Customize_Multiple_Select_Control extends WP_Customize_Control {

		public $type = 'multiple-select';

		public function render_content() {

			if ( empty( $this->choices ) ) return;

			$options = false;
			foreach ( $this->choices as $value => $label ) {
				$selected = '';//( is_array( $this->value() ) && in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
				$options .= '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
			}

			$description = ( ! empty( $this->description ) ? '<span class="description customize-control-description">' . esc_attr( $this->description ) . '</span>' : '' );

			if ( $options ) { ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php echo $this->link(); ?> multiple="multiple" class="form-control">
						<?php echo $options; ?>
					</select>
					<?php echo $description; ?>
				</label>
			<?php }

			return;
		}
	}

	/**
	 * Arbitrary Misc Text control class
	 */
	class PGB_Customize_Misc_Control extends WP_Customize_Control {

		public $settings = 'blogname';
		public $description = '';
		public $type = 'misc';
		public $output = '';

		public function render_content() {

			if ( ! empty( $this->label ) )
				$this->output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';

			if ( ! empty( $this->description ) )
				$this->output .= '<p class="description">' . $this->description . '</p>';

			echo $this->output;

			return;
		}
	}

	/**
	 * Section Line Break control class
	 */
	class PGB_Customize_LineBreak_Control extends WP_Customize_Control {

		public $settings = 'blogname';

		public function render_content() { ?>
			<hr />
		<?php }
	}

endif;