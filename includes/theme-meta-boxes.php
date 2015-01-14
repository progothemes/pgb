<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', 'custom_meta_boxes' );

function custom_meta_boxes() {

  $my_meta_box = array(
    'id'       => 'pgb_meta_box',
    'title'    => 'ProGo Theme Page Options',
    'desc'     => '',
    'pages'    => array( 'page' ),
    'context'  => 'side',
    'priority' => 'default',
    'fields'   => array(
      array(
        'id'      => 'pgb_metabox_page_layout_option',
        'label'   => __( 'Override Default Page Width', 'pgb' ),
        'desc'    => __( '', 'pgb' ),
        'std'     => '',
        'type'    => 'select',
        'section' => '',
        'choices' => array(
          array(
            'value' => 'no',
            'label' => __( 'No', 'pgb' ),
            'src'   => ''
            ),
          array(
            'value' => 'yes',
            'label' => __( 'Yes', 'pgb' ),
            'src'   => ''
            ),
          ),
        ),
      array(
        'id'        => 'pgb_custom_container_width',
        'label'     => __('', 'pgb'),
        'desc'      => __( '', 'pgb' ),
        'std'       => '',
        'type'      => 'select',
        'section'   => '',
        'condition' => 'pgb_metabox_page_layout_option:is(yes)',
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
		  'id'      => 'pgb_metabox_page_footer_option',
		  'label'   => __( 'Use Custom Footer', 'pgb' ),
		  'desc'    => __( '', 'pgb' ),
		  'std'     => '',
		  'type'    => 'select',
		  'section' => '',
		  'choices' => array(
        array(
          'value' => 'default',
          'label' => __( 'Use Theme Default', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 'custom',
          'label' => __( 'Use Custom Footer on This Page', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 'hide',
          'label' => __( 'Hide Footer on This Page', 'pgb' ),
          'src'   => '',
          ),
        ),
      ),
		array(
      'id'        => 'pgb_custom_footer_layout',
      'label'     => __('', 'pgb'),
      'desc'      => __( '', 'pgb' ),
      'std'       => '',
      'type'      => 'select',
      'section'   => '',
      'condition' => 'pgb_metabox_page_footer_option:is(custom)',
      'choices'   => array(
        array(
          'value' => 1,
          'label' => __( 'One', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 2,
          'label' => __( 'Two', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 3,
          'label' => __( 'Three', 'pgb' ),
          'src'   => '',
          ),
        array(
          'value' => 4,
          'label' => __( 'Four', 'pgb' ),
          'src'   => '',
          ),
        ),
      ),
    ),
  );

  ot_register_meta_box( $my_meta_box );

}
