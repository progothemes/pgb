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
      'desc'    => __( 'Here, you can set site­wide default container size', 'pgb' ),
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
		array(
      'id'           => 'pgb_headermenu',
      'label'        => __( 'Header/ Menu Settings', 'pgb' ),
      'desc'         => __( 'Select the positioning of header and main menu area.', 'pgb' ),
      'type'         => 'radio',
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
          'value' => 'top',
          'label' => __( 'Top', 'pgb' ),
          'src'   => ''
          ),
        array(
          'value' => 'left',
          'label' => __( 'Left', 'pgb' ),
          'src'   => ''
          ),
        // array(
        //   'value' => 'topleft',
        //   'label' => __( 'Top + Left', 'pgb' ),
        //   'src'   => ''
        //   ),
        ),
      ), // top menu settings start
    array(
      'id'        => 'pgb_menu_position_top',
      'label'     => __('Menu Position', 'pgb'),
      'desc'      => __( 'Select the style for the menu <br/>fixed - remains visible regardless of scroll, <br/>static - remains at top of content area so can be hidden on scroll', 'pgb' ),
      'type'      => 'select',
      'section'   => 'display_settings',
      'condition' => 'pgb_headermenu:is(top)',
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
      'label'     => __('Main Menu Container Width', 'pgb'),
      'desc'      => __( 'Here, you can set width for the main menu. By default menu width inherits the container width', 'pgb' ),
      'type'      => 'select',
      'section'   => 'display_settings',
      'condition' => 'pgb_headermenu:is(top)',
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
		  'condition' => 'pgb_headermenu:is(top)',
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
    array(
      'id' 		    => 'pgb_secondary_menu_area_top',
      'label' 	  => __( 'Secondary Menu Area', 'pgb' ),
      'desc' 	    => __( 'Whether to display secondary menu area or not.', 'pgb' ),
      'type' 	    => 'on-off',
      'section' 	=> 'display_settings',
      'condition' => 'pgb_headermenu:is(top)',
      ),
    array(
      'id'        => 'pgb_secondary_menu_area_mobile',
      'label'     => __( 'Show secondary menu area in mobile view.', 'pgb' ),
      'desc'      => __( 'Tick mark to display the secondary menu area in the mobile view. ', 'pgb' ),
      'type'      => 'checkbox',
      'section'   => 'display_settings',
      'condition' => 'pgb_headermenu:is(top),pgb_secondary_menu_area_top:is(on)',
      'operator'  => 'and',
      'choices'   => array(
        array(
          'value'       => 'on',
          'label'       => __( 'Show secondary menu area in mobile view.', 'pgb' ),
          'src'         => '',
          ),
        ),
      ),
    array(
			'id' 		    => 'pgb_secondary_header_menu_position_top',
			'label' 	  => __( 'Secondary Header Menu Position', 'pgb'),
			'desc' 	    =>	__( 'Select whether to display Secondary Header Menu to left or right.', 'pgb'),
			'type' 	    => 'radio',
			'section' 	=> 'display_settings',
			'condition' => 'pgb_headermenu:is(top),pgb_secondary_menu_area_top:is(on)',
			'operator'  => 'and',
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
		array(
			'id' 		    => 'pgb_secondary_header_widget_position_top',
			'label' 	  => __( 'Secondary Header Widget Position', 'pgb'),
			'desc' 	    =>	__( 'Select whether to display Secondary Header Widget to left or right.', 'pgb'),
			'type' 	    => 'radio',
			'section' 	=> 'display_settings',
			'condition' => 'pgb_headermenu:is(top),pgb_secondary_menu_area_top:is(on)',
			'operator'  => 'and',
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
    array(
      'id' 		    => 'pgb_search_top',
      'label' 	  => __( 'Search', 'pgb' ),
      'desc' 	    => __( 'Displays the search field', 'pgb' ),
      'type' 	    => 'on-off',
      'section' 	=> 'display_settings',
      'condition' => 'pgb_headermenu:is(top)',
      ),
    array(
			'id' 		    => 'pgb_search_field_type_top',
			'label' 	  => __( 'Search Field Type', 'pgb'),
			'desc' 	    =>	__( 'Select whether the full search field will be displayed or just the icon (open search field on click).', 'pgb'),
			'type' 	    => 'radio',
			'section' 	=> 'display_settings',
			'condition' => 'pgb_headermenu:is(top),pgb_search_top:is(on)',
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
	    ), // left menu settings start
    array(
      'id'        => 'pgb_menu_display_left',
      'label'     => __( 'Main Menu Display Setting', 'pgb'),
      'desc'      => __( 'Select whether the menu will be permanently open or toggle.', 'pgb'),
      'type'      => 'radio',
      'section'   => 'display_settings',
      'condition' => 'pgb_headermenu:is(left)',
      'choices'   => array(
        array(
          'value' => 'open',
          'label' => __( 'Permanently Open', 'pgb'),
          ),
        array(
          'value' => 'toggle',
          'label' => __( 'Toggle (Open/Close)', 'pgb'),
          ),
        ),
      ),
    array(
      'id'        => 'pgb_menu_toggle_style_left',
      'label'     => __( 'Toggle Transition Style', 'pgb'),
      'desc'      => __( 'Select the transition style for the main menu.', 'pgb'),
      'type'      => 'radio',
      'section'   => 'display_settings',
      'condition' => 'pgb_headermenu:is(left),pgb_menu_display_left:is(toggle)',
      'operator'  => 'and',
      'choices'   => array(
        array(
          'value' => 'slideontop',
          'label' => __( 'Slide In On Top', 'pgb'),
          ),
        array(
          'value' => 'reveal',
          'label' => __( 'Reveal', 'pgb'),
          ),
        array(
          'value' => 'push',
          'label' => __( 'Push', 'pgb'),
          ),
        ),
      ),
    array(
      'id'        => 'pgb_menu_width_unit_left_permanent',
      'label'     => __('Menu Width Unit', 'pgb' ),
      'desc'      => __( 'Select unit for menu width.', 'pgb' ),
      'type'      => 'select',
      'section'   => 'display_settings',
      'condition' => 'pgb_headermenu:is(left),pgb_menu_display_left:is(open)',
      'operator'  => 'and',
      'choices'   =>  array(
        array(
          'value' => 'default',
          'label' => 'Default',
          ),
        array(
          'value' => '%',
          'label' => '%',
          ),
        ),
      ),
    array(
      'id'           => 'pgb_menu_percentwidth_left_permanent',
      'label'        => __( 'Menu Width Percentage(%)', 'pgb' ),
      'desc'         => __( 'Select the menu width.', 'pgb' ),
      'type'         => 'numeric-slider',
      'section'      => 'display_settings',
      'condition'    => 'pgb_headermenu:is(left),pgb_menu_width_unit_left_permanent:is(%),pgb_menu_display_left:is(open)',
      'operator'     => 'and',
      'min_max_step' => '0,50,1',
      ),
		array(
			 'id' 		   => 'pgb_menu_width_unit_left',
			 'label' 	   => __('Menu Width Unit', 'pgb' ),
			 'desc' 	   => __( 'Select unit for menu width.', 'pgb' ),
			 'type'  	   => 'select',
			 'section' 	 => 'display_settings',
			 'condition' => 'pgb_headermenu:is(left),pgb_menu_display_left:is(toggle)',
       'operator'  => 'and',
			 'choices' 	 =>  array(
			  array(
          'value' => 'default',
          'label' => 'Default',
			    ),
        array(
          'value' => 'px',
          'label' => 'px',
			    ),
			  array(
          'value' => '%',
          'label' => '%',
			    ),
			  ),
		  ),
		array(
			'id' 		 	     => 'pgb_menu_pxwidth_left',
			'label'	 	     => __( 'Menu Width', 'pgb' ),
			'desc'		 	   => __( 'Select the menu width.', 'pgb' ),
			'type'		 	   => 'numeric-slider',
			'section' 	 	 => 'display_settings',
			'condition' 	 => 'pgb_headermenu:is(left),pgb_menu_width_unit_left:is(px),pgb_menu_display_left:is(toggle)',
			'operator'  	 => 'and',
			'min_max_step' => '0,500,1',
		  ),
		array(
			'id' 		 	     => 'pgb_menu_percentwidth_left',
		  'label'	 	     => __( 'Menu Width Percentage', 'pgb' ),
		  'desc'		 	   => __( 'Select the menu width.', 'pgb' ),
		  'type'		 	   => 'numeric-slider',
		  'section' 	 	 => 'display_settings',
		  'condition' 	 => 'pgb_headermenu:is(left),pgb_menu_width_unit_left:is(%),pgb_menu_display_left:is(toggle)',
		  'operator'  	 => 'and',
		  'min_max_step' => '0,50,1',
		  ),
		array(
			'id' 		    => 'pgb_logo_positon_left',
			'label' 	  => __( 'Logo Position', 'pgb' ),
			'desc' 	    => __( 'Select the location to display logo.', 'pgb' ),
			'type' 	    => 'select',
			'section'   => 'display_settings',
			'condition' => 'pgb_headermenu:is(left)',
			'choices'   => array(
        array(
          'value' => 'topleft',
          'label' => __( 'Top Left', 'pgb'),
          ),
        array(
          'value' => 'topcenter',
          'label' => __( 'Top Center', 'pgb'),
          ),
        array(
          'value' => 'bottomleft',
          'label' => __( 'Bottom Left', 'pgb'),
          ),
        array(
          'value' => 'bottomcenter',
          'label' => __( 'Bottom Center', 'pgb'),
          ),
        ),
      ),
    array(
      'id'        => 'pgb_sitetagline_left',
      'label'     => __( 'Site Tagline', 'pgb' ),
      'desc'      => __( 'Whether to display Site Tagline under logo.', 'pgb' ),
      'type'      => 'on-off',
      'section' 	=> 'display_settings',
      'condition' => 'pgb_headermenu:is(left)',
      ),
    array(
			'id' 		    => 'pgb_sitetagline_position_left',
			'label'     => __( 'Site Tagline Position', 'pgb' ),
			'desc' 	    => __( 'Select sitetagline position.', 'pgb' ),
			'type' 	    => 'select',
			'section'   => 'display_settings',
			'condition' => 'pgb_headermenu:is(left),pgb_sitetagline_left:is(on)',
			'operator'  => 'and',
			'choices'   => array(
				array(
					'value' => 'left',
					'label' => __( 'Left', 'pgb'),
				  ),
				array(
					'value' => 'center',
					'label' => __( 'Center', 'pgb'),
				  ),
        ),
      ),
		array(
      'id' 		    => 'pgb_search_left',
      'label' 	  => __( 'Search', 'pgb' ),
      'desc' 	    => __( 'Displays the search field', 'pgb' ),
      'type' 	    => 'on-off',
      'section' 	=> 'display_settings',
      'condition' => 'pgb_headermenu:is(left)',
      ),
    array(
			'id' 		    => 'pgb_searchfield_position_left',
			'label' 	  => __( 'Search Field Position', 'pgb' ),
			'desc' 	    => __( 'Select search field position.', 'pgb' ),
			'type' 	    => 'select',
			'section'   => 'display_settings',
			'condition' => 'pgb_headermenu:is(left),pgb_search_left:is(on)',
			'operator'  => 'and',
			'choices'   => array(
				array(
					'value' => 'top',
					'label' => __( 'Top', 'pgb'),
				  ),
				array(
					'value' => 'bottom',
					'label' => __( 'Bottom', 'pgb'),
				  ),
			  ),
			),// top + Left menu settings start
		// array(
		// 	'id' 		    => 'pgb_menu_width_unit_topleft',
		// 	'label' 	  => __('Menu Width Unit', 'pgb' ),
		// 	'desc' 	    => __( 'Select unit for menu width.', 'pgb' ),
		// 	'type'  	  => 'select',
		// 	'section' 	=> 'display_settings',
		// 	'condition' => 'pgb_headermenu:is(topleft)',
		// 	'choices' 	=>  array(
		// 		array(
		// 			'value' => 'default',
		// 			'label' => 'Default',
		// 		  ),
		// 		array(
		// 			'value' => '%',
		// 			'label' => '%',
		// 		  ),
  //       ),
  //     ),
		// array(
		//   'id' 		 	     => 'pgb_menu_percentwidth_topleft',
		//   'label'	 	     => __( 'Menu Width', 'pgb' ),
		//   'desc'		 	   => __( 'Select the menu width.', 'pgb' ),
		//   'type'		 	   => 'numeric-slider',
		//   'section' 	 	 => 'display_settings',
		//   'condition' 	 => 'pgb_headermenu:is(topleft),pgb_menu_width_unit_topleft:is(%)',
		//   'operator'  	 => 'and',
		//   'min_max_step' => '0,50,1',
		// ),
	 // array(
		// 'id' 		    => 'pgb_menu_display_topleft',
		// 'label'     => __( 'Main Menu Display Setting', 'pgb'),
		// 'desc' 	    =>	__( 'Select whether the menu will be permanently open or toggle.', 'pgb'),
		// 'type' 	    => 'radio',
		// 'section' 	=> 'display_settings',
		// 'condition' => 'pgb_headermenu:is(topleft)',
		// 'choices'   => array(
		// 	array(
  //       'value' => 'open',
  //       'label' => __( 'Permanently Open', 'pgb'),
  //       ),
		// 	array(
		// 		'value' => 'toggle',
		// 		'label' => __( 'Toggle (Open/Close)', 'pgb'),
		// 		),
		// 	),
  //   ),
		// array(
		//   'id' 		    => 'pgb_menu_toggle_style_topleft',
		//   'label' 	  => __( 'Toggle Transition Style', 'pgb'),
		//   'desc' 	    =>	__( 'Select the transition style for the main menu.', 'pgb'),
		//   'type' 	    => 'radio',
		//   'section' 	=> 'display_settings',
		//   'condition' => 'pgb_headermenu:is(topleft),pgb_menu_display_topleft:is(toggle)',
		//   'operator'  => 'and',
		//   'choices'   => array(
		// 		array(
		// 			'value' => 'slideontop',
		// 			'label' => __( 'Slide In On Top', 'pgb'),
  //         ),
  //       array(
		// 			'value' => 'reveal',
		// 			'label' => __( 'Reveal', 'pgb'),
  //         ),
		// 		array(
		// 			'value' => 'push',
		// 			'label' => __( 'Push', 'pgb'),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_logo_postion_topleft',
  //     'label'     => __( 'Logo postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the Logo.', 'pgb' ),
  //     'type' 	    => 'radio',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft)',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'inheader',
  //         'label' => __( 'In header bar', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'inleftmenu',
  //         'label' => __( 'In left menu section ', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_logo_headeralign_topleft',
  //     'label' 	  => __( 'Logo In Header postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the Logo in Header section.', 'pgb' ),
  //     'type' 	    => 'select',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft),pgb_logo_postion_topleft:is(inheader)',
  //     'operator'  => 'and',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'left',
  //         'label' => __( 'Left', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'center',
  //         'label' => __( 'Center', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_logo_leftmenualign_topleft',
  //     'label' 	  => __( 'Logo In Left Menu postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the logo in left menu section.', 'pgb' ),
  //     'type' 	    => 'select',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft),pgb_logo_postion_topleft:is(inleftmenu)',
  //     'operator'  => 'and',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'topleft',
  //         'label' => __( 'Top Left', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'topcenter',
  //         'label' => __( 'Top Center', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'bottomleft',
  //         'label' => __( 'Bottom Left', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'bottomcenter',
  //         'label' => __( 'Bottom Center', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_sitetagline_topleft',
  //     'label' 	  => __( 'Site Tagline', 'pgb' ),
  //     'desc' 	    => __( 'Whether to display Site Tagline.', 'pgb' ),
  //     'type' 	    => 'on-off',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft)',
  //     ),
		// array(
  //     'id' 		    => 'pgb_sitetagline_postion_topleft',
  //     'label' 	  => __( 'Site Tagline postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the site tagline.', 'pgb' ),
  //     'type' 	    => 'radio',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft),pgb_sitetagline_topleft:is(on)',
  //     'operator'  => 'and',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'inheader',
  //         'label' => __( 'In header bar', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'inleftmenu',
  //         'label' => __( 'In left menu section ', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_sitetagline_headeralign_topleft',
  //     'label' 	  => __( 'Site Tagline In Header postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the site tagline.', 'pgb' ),
  //     'type' 	    => 'select',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft),pgb_sitetagline_topleft:is(on),pgb_sitetagline_postion_topleft:is(inheader)',
  //     'operator'  => 'and',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'left',
  //         'label' => __( 'Left', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'center',
  //         'label' => __( 'Center', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_sitetagline_leftmenualign_topleft',
  //     'label' 	  => __( 'Site Tagline In Left Menu postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the site tagline.', 'pgb' ),
  //     'type' 	    => 'select',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft),pgb_sitetagline_topleft:is(on),pgb_sitetagline_postion_topleft:is(inleftmenu)',
  //     'operator'  => 'and',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'topleft',
  //         'label' => __( 'Top Left', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'topcenter',
  //         'label' => __( 'Top Center', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'bottomleft',
  //         'label' => __( 'Bottom Left', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'bottomcenter',
  //         'label' => __( 'Bottom Center', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
  //     'id' 		    => 'pgb_search_topleft',
  //     'label' 	  => __( 'Search', 'pgb' ),
  //     'desc' 	    => __( 'Displays the search field', 'pgb' ),
  //     'type' 	    => 'on-off',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft)',
  //     ),
  //   array(
  //     'id' 		    => 'pgb_search_position_topleft',
  //     'label' 	  => __( 'Search Field postion', 'pgb' ),
  //     'desc' 	    => __( 'Position of the search field.', 'pgb' ),
  //     'type' 	    => 'radio',
  //     'section' 	=> 'display_settings',
  //     'condition' => 'pgb_headermenu:is(topleft),pgb_search_topleft:is(on)',
  //     'operator'  => 'and',
  //     'choices'	  => array(
  //       array(
  //         'value' => 'inheader',
  //         'label' => __( 'In header bar', 'pgb' ),
  //         ),
  //       array(
  //         'value' => 'inleftmenu',
  //         'label' => __( 'In left menu section ', 'pgb' ),
  //         ),
  //       ),
  //     ),
		// array(
		// 	'id' 		    => 'pgb_searchfield_headerstyle_topleft',
		// 	'label' 	  => __( 'Search Field Type', 'pgb'),
		// 	'desc' 	    =>	__( 'Select whether the full search field will be displayed or just the icon (open search field on click).', 'pgb'),
		// 	'type' 	    => 'radio',
		// 	'section' 	=> 'display_settings',
		// 	'condition' => 'pgb_headermenu:is(topleft),pgb_search_topleft:is(on),pgb_search_position_topleft:is(inheader)',
		// 	'operator'  => 'and',
		// 	'choices'   => array(
		// 		array(
  //         'value' => 'full',
  //         'label' => __( 'Full Field', 'pgb'),
  //         ),
		// 		array(
		// 			'value' => 'icon',
  //         'label' => __( 'Icon', 'pgb'),
  //         ),
  //       ),
  //     ),
		// array(
		//   'id' 		    => 'pgb_searchfield_leftmenustyle_topleft',
		//   'label' 	  => __( 'Search Position', 'pgb'),
		//   'desc' 	    =>	__( 'Position of the search field.', 'pgb'),
		//   'type' 	    => 'radio',
		//   'section' 	=> 'display_settings',
		//   'condition' => 'pgb_headermenu:is(topleft),pgb_search_topleft:is(on),pgb_search_position_topleft:is(inleftmenu)',
		//   'operator'  => 'and',
		//   'choices'   => array(
		// 		array(
		// 			'value' => 'top',
		// 			'label' => __( 'Top', 'pgb'),
		// 		  ),
		// 		array(
		// 			'value' => 'bottom',
		// 			'label' => __( 'Bottom', 'pgb'),
		// 		  ),
  //       ),
  //     ),
		array( // logo uploader
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
    array( // Footer settings
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