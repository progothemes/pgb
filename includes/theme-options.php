<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );


/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.3.0
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  $custom_settings = array(
    'contextual_help' => null,
    );
// Section Display Settings
    require_once "theme_options_partials/display-settings.php";
// End Section Display Settings

// Section General Settings
    require_once "theme_options_partials/general-settings.php";
// End Section General Settings

$display_settings['settings'][0]['choices'] = array_merge($display_settings['settings'][0]['choices'], pgb_add_custom_theme());
    
    //$custom_settings['contextual_help'] = $custom_settings1['contextual_help'];//array_merge($custom_settings1['contextual_help'], $custom_settings2['contextual_help']);
    $custom_settings['sections'] = array_merge(
                                      $display_settings['sections']
                                    , $general_settings['sections']
                                );
    $custom_settings['settings'] = array_merge(
                                      $display_settings['settings']
                                    , $general_settings['settings']
                                );

   // echo "<pre>"; print_r($display_settings['settings'][0]['choices']); echo "</pre>";
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;

  
}



function pgb_defaults () {
  $options = get_option( ot_options_id() ); 
  if( empty( $options ) ) {
    $default_options = array(
                         'pgb_bootstrap_theme'                      => 'default',
                         'pgb_container_width'                      => 'default',
                         'pgb_headermenu'                           => 'top',
                         'pgb_menu_position_top'                    => 'static',
                         'pgb_menu_width_top'                       => 'default',
                         'pgb_menu_align_top'                       => 'right',
//                         'pgb_secondary_menu_area_top'              => 'off',
                         'pgb_secondary_menu_area_mobile'           => '',
                         'pgb_secondary_header_menu_position_top'   => 'left',
                         'pgb_secondary_header_widget_position_top' => 'left',
                         'pgb_search_top'                           => 'off',
                         'pgb_menu_display_left'                    => 'open',
                         'pgb_menu_toggle_style_left'               => 'slideontop',
                         'pgb_menu_width_unit_left_permanent'       => 'default',
                         'pgb_menu_percentwidth_left_permanent'     => '17',
                         'pgb_menu_width_unit_left'                 => 'default',
                         'pgb_menu_pxwidth_left'                    => '260',
                         'pgb_menu_percentwidth_left'               => '17',
                         'pgb_logo_positon_left'                    => 'topleft',
                         'pgb_sitetagline_left'                     => 'off',
                         'pgb_sitetagline_position_left'            => 'left',
                         'pgb_search_left'                          => 'off',
                         'pgb_searchfield_position_left'            => 'top',
                         'pgb_menu_width_unit_topleft'              => 'default',
                         'pgb_menu_percentwidth_topleft'            => '17',
                         'pgb_menu_display_topleft'                 => 'open',
                         'pgb_menu_toggle_style_topleft'            => 'slideontop',
                         'pgb_logo_postion_topleft'                 => 'inheader',
                         'pgb_logo_headeralign_topleft'             => 'left',
                         'pgb_logo_leftmenualign_topleft'           => 'topleft',
                         'pgb_sitetagline_topleft'                  => 'off',
                         'pgb_sitetagline_postion_topleft'          => 'inheader',
                         'pgb_sitetagline_headeralign_topleft'      => 'left',
                         'pgb_sitetagline_leftmenualign_topleft'    => 'topleft',
                         'pgb_search_topleft'                       => 'off',
                         'pgb_search_position_topleft'              => 'inheader',
                         'pgb_searchfield_headerstyle_topleft'      => 'full',
                         'pgb_searchfield_leftmenustyle_topleft'    => 'top',
                         'pgb_upload_logo_desktop'                  => '',
                         'pgb_upload_logo_tablet'                   => '',
                         'pgb_upload_logo_mobile'                   => '',
                         'pgb_footer'                               => 'off',
                         'pgb_footer_column'                        => 'default',
                         'pgb_activation_code'                      => '',
        );
    $options_array = array_merge( $options, $default_options );
    return update_option(ot_options_id(), $options_array);
  }   
  
}
add_action('load-themes.php', 'pgb_defaults');

function deactivate_theme_function() {
  delete_option( 'option_tree' );
  delete_option( 'option_tree_settings' );
}

add_action("switch_theme", "deactivate_theme_function", 10 , 2);