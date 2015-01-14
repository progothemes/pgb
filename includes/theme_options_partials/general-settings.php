<?php
// Section General Settings
    $general_settings = array(
      'sections' => array(
        array(
          'id'          => 'general_settings',
          'title'       => __( 'General Settings', 'pgb' ),
          ),
        ),
      'settings' => array(
        array(
          'id'          => 'pgb_activation_code',
          'label'       => __('Activation Key', 'pgb'),
          'desc'        => __( 'Enter the theme activation key', 'pgb' ),
          'type'        => 'text',
          'section'     => 'general_settings',
          ),
        ),
      );
// End Section General Settings