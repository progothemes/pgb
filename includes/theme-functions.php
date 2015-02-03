<?php
/**
 * Helper function to get sitetagline for the left menu
 *
 * @return    void
 *
 */
function pgb_get_sitetagline_leftmenu( $left_menu_sitetagline_position ) {
    $desktoplogo = ot_get_option( 'pgb_upload_logo_desktop' );
    $tabletlogo  = ot_get_option( 'pgb_upload_logo_tablet' );
    $mobilelogo  = ot_get_option( 'pgb_upload_logo_mobile' );

    if ( !empty( $desktoplogo  ) || !empty( $tabletlogo ) || !empty( $mobilelogo ) ) {

        if( !empty( $left_menu_sitetagline_position ) ) {

            $desc = get_bloginfo( 'description' );

            if( 'left' == $left_menu_sitetagline_position ) {

                echo '<h4 class="site-description logoleft l-padding" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';

            } elseif( 'center' == $left_menu_sitetagline_position ) {

                echo '<h4 class="site-description logocenter" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';
            }

        }

    }

} // end function pgb_get_sitetagline_leftmenu()


/**
 * Helper function to generate css for the container width
 * ( for theme option for changing width of the container ).
 *
 * @param     string    $data value of the theme option.
 * @param     boolean   $classname class name to generate.
 * @return    string
 *
 */
function pgb_set_container_width( $data, $classname ) {

	if ( !empty( $data )) {
    	if ( 'full' == $data ) {
            $custom_css = $classname ." { width: 100%; max-width: 100%; }";
        } elseif ( 'default' == $data ) {
    	} else {    		
    		$custom_css = $classname ." { width: 100%; max-width: ". $data . "; }";
    	}
    }
    return $custom_css;
}


/**
 * Helper function to dislay logo.
 *
 * @param     string    $place alignment of logo.
 * @return    string
 *
 */
function pgb_get_logo ( $place = 'logoleft' ) {
    $logo = '';
    $desktoplogo = ot_get_option( 'pgb_upload_logo_desktop' );
    $tabletlogo  = ot_get_option( 'pgb_upload_logo_tablet' );
    $mobilelogo  = ot_get_option( 'pgb_upload_logo_mobile' );
    $title       = get_bloginfo( 'name' );   

   if ( empty( $desktoplogo ) ) {

        if( empty( $tabletlogo ) ) {

            if ( empty( $mobilelogo ) ) {

               $logo .= sprintf( __( '%s', 'pgb' ), $title ); 

            } else { // for all three

                $logo .= '<div class="desktoplogo '. $place .'">
                            <img src="'.  esc_attr( $mobilelogo ) .'" alt="">
                        </div>';

                $logo .= '<div class="tabletlogo '. $place .'">
                            <img src="'.  esc_attr( $mobilelogo ) .'" alt="">
                        </div>';

                $logo .= '<div class="mobilelogo '. $place .'">
                            <img src="'.  esc_attr( $mobilelogo ) .'" alt="">
                        </div>';
            }

        } else { // Tablet !empty

            $logo .= '<div class="desktoplogo '. $place .'">
                        <img src="'.  esc_attr( $tabletlogo ) .'" alt="">
                    </div>';

            $logo .= '<div class="tabletlogo '. $place .'">
                        <img src="'.  esc_attr( $tabletlogo ) .'" alt="">
                    </div>';

            if ( empty( $mobilelogo ) ) {

               $logo .= '<div class="mobilelogo '. $place .'">
                        <img src="'.  esc_attr( $tabletlogo ) .'" alt="">
                    </div>';

            } else {

                $logo .= '<div class="mobilelogo '. $place .'">
                            <img src="'.  esc_attr( $mobilelogo ) .'" alt="">
                        </div>';
            }

        }

   } else {

        $logo .= '<div class="desktoplogo '. $place .'">
                    <img src="'.  esc_attr( $desktoplogo ). '" alt="">
                </div>';

        if( empty( $tabletlogo ) ) {

            $logo .= '<div class="tabletlogo '. $place .'">
                        <img src="'.  esc_attr( $desktoplogo ). '" alt="">
                    </div>';

            if ( empty( $mobilelogo ) ) {

                $logo .= '<div class="mobilelogo '. $place .'">
                            <img src="'.  esc_attr( $desktoplogo ). '" alt="">
                        </div>';   
            } else {

                $logo .= '<div class="mobilelogo '. $place .'">
                            <img src="'.  esc_attr( $mobilelogo ). '" alt="">
                        </div>';
            }

        } else {

            $logo .= '<div class="tabletlogo '. $place .'">
                        <img src="'.  esc_attr( $tabletlogo ) .'" alt="">
                    </div>';

            if ( empty( $mobilelogo ) ) {

                $logo .= '<div class="mobilelogo '. $place .'">
                            <img src="'.  esc_attr( $tabletlogo ). '" alt="">
                        </div>';   
            } else {

                $logo .= '<div class="mobilelogo '. $place .'">
                            <img src="'.  esc_attr( $mobilelogo ). '" alt="">
                        </div>';
            }

        }

    }

    return $logo;
}


/**
 * Helper function to add custom theme to the theme options' theme list
 *
 * @return    array
 *
 */
function pgb_add_custom_theme() {
    $themeFolder     = wp_upload_dir();
    $themeFolder_dir = $themeFolder['basedir'];
    $themeFolder_dir = $themeFolder_dir . '/bootstrapthemes';
    $dirs            = glob($themeFolder_dir . '/*' , GLOB_ONLYDIR);
    $themenames      = array();

    if ( !empty($dirs) ) {
        $themenames[0]['value'] = 'optgroup';
        $themenames[0]['label'] = '--Custom Themes--';
        $i = 1;
        foreach ($dirs as $dir) {
            $themeName               = explode('bootstrapthemes/', $dir);
            $themenames[$i]['value'] = $themeName[1];
            $themenames[$i]['label'] = ucfirst($themeName[1]);
            $i++;
        }
        $themenames[$i]['value'] = 'optgroupclose';
        $themenames[$i]['label'] = '';
    }
    return $themenames;
}
