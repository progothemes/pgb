<?php
// Section Display Settings
 $display_settings = array(
  'sections' => array(
    array(
      'id'    => 'display_settings',
      'title' => __( 'Display Settings', 'pgb' ),
      ),
    ),
  'settings' => array( //Bootstrap Theme selector
    array(
      'id'           => 'pgb_bootstrap_theme',
      'label'        => __( 'Default ProGo Theme', 'pgb' ),
      'desc'         => __( 'Select the Bootstrap theme from the available list of themes', 'pgb' ),
      'type'         => 'select',
      'section'      => 'display_settings',
      'rows'         => '',
      'post_type'    => '',
      'taxonomy'     => '',
      'min_max_step' => '',
      'class'        => '',
      'condition'    => '',
      'operator'     => 'and',
      'choices'      => array(
        array(
          'value' => 'default',
          'label' => __( 'Default', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 'cerulean',
          'label' => __( 'Cerulean', 'pgb' ),
          'src'   => '',
          ),
				array(
				  'value' => 'cosmo',
				  'label' => __( 'Cosmo', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'cyborg',
				  'label' => __( 'Cyborg', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'darkly',
				  'label' => __( 'Darkly', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'flatly',
				  'label' => __( 'Flatly', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'journal',
				  'label' => __( 'Journal', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'lumen',
				  'label' => __( 'Lumen', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'paper',
				  'label' => __( 'Paper', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'readable',
				  'label' => __( 'Readable', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'sandstone',
				  'label' => __( 'Sandstone', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'simplex',
				  'label' => __( 'Simplex', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'slate',
				  'label' => __( 'Slate', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'spacelab',
				  'label' => __( 'Spacelab', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'superhero',
				  'label' => __( 'Superhero', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'united',
				  'label' => __( 'United', 'pgb' ),
				  'src'   => '',
				  ),
				array(
				  'value' => 'yeti',
				  'label' => __( 'Yeti', 'pgb' ),
				  'src'   => '',
				  ),
        ),
      ),
    array(
      'id'      => 'pgb_container_width',
      'label'   => __('Page Container Width', 'pgb'),
      'desc'    => __( 'Set site­wide default container size', 'pgb' ),
      'type'    => 'select',
      'section' => 'display_settings',
      'choices' => array(
        array(
          'value' => 'default',
          'label' => __( 'Default', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 'full',
          'label' => __( 'Full Width (100%)', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1366px',
          'label' => __( '1366px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1240px',
          'label' => __( '1240px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1170px',
          'label' => __( '1170px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1080px',
          'label' => __( '1080px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '960px',
          'label' => __( '960px', 'pgb' ),
          'src'   => '',
          ),
        )
      ), // Header / menu settings
    // top menu settings start
    array(
      'id'        => 'pgb_menu_position_top',
      'label'     => __('Navbar Position', 'pgb'),
      'desc'      => __( 'Select navbar position <br/>fixed - remains visible regardless of scroll, <br/>static - remains at top of content area so can be hidden on scroll', 'pgb' ),
      'type'      => 'select',
      'section'   => 'display_settings',
      'condition' => '',
      'choices'   => array(
        array(
          'value' => 'static',
          'label' => __( 'Static', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 'fixed',
          'label' => __( 'Fixed', 'pgb' ),
          'src'   => '',
          ),
        ),
      ),
    array(
      'id'        => 'pgb_menu_width_top',
      'label'     => __('Navbar Width', 'pgb'),
      'desc'      => __( 'Set navbar width. By default navbar width inherits page container width', 'pgb' ),
      'type'      => 'select',
      'section'   => 'display_settings',
      'condition' => '',
      'choices'   => array(
        array(
          'value' => 'default',
          'label' => __( 'Default', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 'full',
          'label' => __( 'Full Width (100%)', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1366px',
          'label' => __( '1366px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1240px',
          'label' => __( '1240px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1170px',
          'label' => __( '1170px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '1080px',
          'label' => __( '1080px', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => '960px',
          'label' => __( '960px', 'pgb' ),
          'src'   => '',
          ),
        ),
      ),
		array(
		  'id' 		    => 'pgb_menu_align_top',
		  'label' 	  => __( 'Menu Align', 'pgb'),
		  'desc' 	    =>	__( 'Select whether the menu will be left aligned or right aligned. Default : Left', 'pgb'),
		  'type' 	    => 'radio',
		  'section' 	=> 'display_settings',
		  'condition' => '',
		  'choices'   => array(
				array(
					'value' => 'left',
					'label' => __( 'Left', 'pgb'),
				  ),
				array(
					'value' => 'right',
					'label' => __( 'Right', 'pgb'),
				  ),
        ),
			),
    // Search
    array(
      'id' 		    => 'pgb_search_top',
      'label' 	  => __( 'Search', 'pgb' ),
      'desc' 	    => __( 'Displays the search field', 'pgb' ),
      'type' 	    => 'on-off',
      'section' 	=> 'display_settings',
      'condition' => '',
      ),
    array(
			'id' 		    => 'pgb_search_field_type_top',
			'label' 	  => __( 'Search Field Type', 'pgb'),
			'desc' 	    =>	__( 'Select whether the full search field will be displayed or just the icon (open search field on click).', 'pgb'),
			'type' 	    => 'radio',
			'section' 	=> 'display_settings',
			'condition' => 'pgb_search_top:is(on)',
			'operator'  => 'and',
			'choices'   => array(
				array(
					'value' => 'full',
					'label' => __( 'Full Field', 'pgb'),
				  ),
	     array(
					'value' => 'icon',
					'label' => __( 'Icon', 'pgb'),
				  ),
				),
	    ),
    // logo uploader
		array(
			'id' 	    => 'pgb_upload_logo_desktop',
		  'label'   => __( 'Desktop Logo', 'pgb' ),
		  'desc'    => __( 'Upload the website logo for desktop view. (supports PNG, JPEG, GIF).', 'pgb' ),
		  'type'    => 'upload',
		  'section' => 'display_settings',
		  'class'   => '',
		  ),
		array(
			'id' 	    => 'pgb_upload_logo_tablet',
			'label'   => __( 'Tablet Logo', 'pgb' ),
			'desc'    => __( 'Upload the website logo for tablet view. (supports PNG, JPEG, GIF).', 'pgb' ),
			'type'    => 'upload',
			'section' => 'display_settings',
			'class'   => '',
		  ),
		array(
			'id' 	    => 'pgb_upload_logo_mobile',
			'label'   => __( 'Mobile Logo', 'pgb' ),
			'desc'    => __( 'Upload the website logo for mobile view. (supports PNG, JPEG, GIF).', 'pgb' ),
			'type'    => 'upload',
			'section' => 'display_settings',
			'class'   => '',
		  ),
    // Footer settings
    array(
      'id' 		  => 'pgb_footer',
      'label' 	=> __( 'Footer Section', 'pgb' ),
      'desc' 	  => __( 'Select whether to display footer or not.', 'pgb' ),
      'type' 	  => 'on-off',
      'section' => 'display_settings',
      ),
    array(
      'id' 		    => 'pgb_footer_column',
      'label' 	  => __( 'Footer Column', 'pgb' ),
      'desc' 	    => __( 'Select the number of footer columns to display. <br/> Default : 3', 'pgb' ),
      'type' 	    => 'select',
      'section' 	=> 'display_settings',
      'condition' => 'pgb_footer:is(on)',
      'choices'	  => array(
        array(
          'value' => 'default',
          'label' => __( 'Default', 'pgb' ),
          ),
        array(
          'value' => 1,
          'label' => __( '1', 'pgb' ),
          ),
        array(
          'value' => 2,
          'label' => __( '2', 'pgb' ),
          ),
        array(
          'value' => 3,
          'label' => __( '3', 'pgb' ),
          ),
        array(
          'value' => 4,
          'label' => __( '4', 'pgb' ),
          ),
        ),
      ),
    ), //setting
);
// End Section Display Settings