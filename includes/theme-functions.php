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



/**
 * Helper function and shortcodes to render login forms
 *
 * @return    array
 *
 */
function pgb_show_login_form( $classes = '', $labels = false, $remember = false, $pclass = '' ) {
    if ( ! is_user_logged_in() ) { ?>
        <form action="<?php echo get_bloginfo('url'); ?>/wp-login.php" method="post" class="<?php echo $classes; ?>" >
            <div class="form-group">
                <label <?php echo ( ! $labels ) ? 'class="sr-only"' : ''; ?> for="log"><?php _e('Username', 'pgb'); ?></label>
                <input type="text" name="log" id="log" class="form-control" size="10" placeholder="Username" />
            </div>
            <div class="form-group">
                <label <?php echo ( ! $labels ) ? 'class="sr-only"' : ''; ?> for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" class="form-control" size="10" placeholder="Password" />
            </div>
            <?php if ( $remember ) { ?>
            <div class="checkbox">
                <label for="rememberme">
                    <input type="checkbox" name="rememberme" id="rememberme" value="forever" /> Remember me
                </label>
            </div>
            <?php } ?>
            <div class="btn-group" role="group" aria-label="..">
                <button type="submit" name="submit" class="btn btn-default">Login</button>
                <button type="button" class="btn btn-default" onClick="location.href='<?php echo get_bloginfo('url'); ?>/wp-login.php?action=lostpassword'" data-toggle="tooltip" data-placement="bottom" title="Forgot Password?">
                    <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                </button>
            </div>
            <input type="hidden" name="redirect_to" value="<?php echo get_permalink(); ?>" />
        </form>
    <?php } else { ?>
        <p class="<?php echo $pclass; ?>">
            <a href="<?php echo wp_logout_url( get_permalink() ); ?>">logout</a>
        </p>
    <?php }
}
function pgb_show_login_modal( $classes = '', $labels = true, $remember = true, $pclass = '' ) {
    if ( ! is_user_logged_in() ) { ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary <?php echo $classes; ?>" data-toggle="modal" data-target="#pgbLoginModal">Login</button>
        <!-- Modal -->
        <div class="modal fade" id="pgbLoginModal" tabindex="-1" role="dialog" aria-labelledby="pgbLoginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo get_bloginfo('url'); ?>/wp-login.php" method="post" class="form-horizontal" >
                            <div class="form-group">
                                <label class="col-sm-2 control-label <?php echo ( ! $labels ) ? 'sr-only' : ''; ?>" for="log"><?php _e('Username', 'pgb'); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="log" id="log" class="form-control" size="10" placeholder="Username" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label <?php echo ( ! $labels ) ? 'sr-only' : ''; ?>" for="pwd"><?php _e('Password', 'pgb'); ?></label>
                                <div class="col-sm-10">
                                    <input type="password" name="pwd" id="pwd" class="form-control" size="10" placeholder="Password" />
                                </div>
                            </div>
                            <?php if ( $remember ) { ?>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label for="rememberme">
                                            <input type="checkbox" name="rememberme" id="rememberme" value="forever" /> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="hidden" name="redirect_to" value="<?php echo get_permalink(); ?>" />
                                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo get_bloginfo('url'); ?>/wp-login.php?action=lostpassword">Forgot password?</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p class="<?php echo $pclass; ?>">
            <a href="<?php echo wp_logout_url( get_permalink() ); ?>">logout</a>
        </p>
    <?php }
}
// the shortcodes...
add_filter('widget_text', 'do_shortcode');
// [pgb_login class="foo bar" style="inline|horizontal|basic" labels="false|true" remember="false|true" pclass="bar tag"]
function pgb_login_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'class' => '',
        'style' => 'inline',
        'labels' => 'false',
        'remember' => 'false',
        'pclass' => ''
    ), $atts );
    switch ($a['style']) {
        case 'basic':
            $classes = '';
            break;
        case 'horizontal':
            $classes = 'form-horizontal ';
            break;
        case 'inline':
        default:
            $classes = 'form-inline ';
            break;
    }
    $classes .= esc_attr( $a['class'] );
    switch ($a['labels']) {
        case 'true':
            $labels = true;
            break;
        default:
            $labels = false;
            break;
    }
    switch ($a['remember']) {
        case 'true':
            $remember = true;
            break;
        default:
            $remember = false;
            break;
    }
    $pclass = esc_attr( $a['pclass'] );
    return pgb_show_login_form( $classes, $labels, $remember, $pclass );
}
add_shortcode( 'pgb_login', 'pgb_login_shortcode' );
// [pgb_login_modal class="foo bar" labels="true|false" remember="true|false" pclass="bar tag"]
function pgb_login_modal_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'class' => '',
        'labels' => 'true',
        'remember' => 'true',
        'pclass' => ''
    ), $atts );
    $classes .= esc_attr( $a['class'] );
    switch ($a['labels']) {
        case 'true':
            $labels = true;
            break;
        default:
            $labels = false;
            break;
    }
    switch ($a['remember']) {
        case 'true':
            $remember = true;
            break;
        default:
            $remember = false;
            break;
    }
    $pclass = esc_attr( $a['pclass'] );
    return pgb_show_login_modal( $classes, $labels, $remember, $pclass );
}
add_shortcode( 'pgb_login_modal', 'pgb_login_modal_shortcode' );
