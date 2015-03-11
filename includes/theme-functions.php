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
  $custom_css = '';
	if ( !empty( $data )) {
    if ( 'full' == $data ) {
      $custom_css = $classname ." { width: 100%; max-width: 100%; }";
    } elseif ( 'default' == $data ) {
      // something?
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
 * ProGo Login modal widget
 *
 * Adds PGB_Login_Widget widget.
 *
 * @package pgb
 * @return  content
 */
class PGB_Login_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'pgb_login_widget', // Base ID
            __( 'Login Button w/ Modal', 'pgb' ), // Name
            array( 'description' => __( 'Add a login button with Bootstrap modal login form.', 'pgb' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! is_user_logged_in() ) { ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary <?php echo $instance['classes']; ?>" data-toggle="modal" data-target="#pgbLoginModal">Login</button>
            <!-- Modal -->
            <div class="modal fade" id="pgbLoginModal" tabindex="-1" role="dialog" aria-labelledby="pgbLoginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                <?php
                                if ( ! empty( $instance['title'] ) ) {
                                    echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
                                }
                                ?>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo get_bloginfo('url'); ?>/wp-login.php" method="post" class="form-horizontal" >
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="log"><?php _e('Username', 'pgb'); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="log" id="log" class="form-control" size="10" placeholder="Username" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="pwd"><?php _e('Password', 'pgb'); ?></label>
                                    <div class="col-sm-10">
                                        <input type="password" name="pwd" id="pwd" class="form-control" size="10" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label for="rememberme">
                                                <input type="checkbox" name="rememberme" id="rememberme" value="forever" /> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
            <p class="navbar-text <?php echo $instance['outclass']; ?>">
                <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="navbar-link"><?php echo $instance['outlabel']; ?></a>
            </p>
        <?php }
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'pgb' );
        $buttonlabel = ! empty( $instance['buttonlabel'] ) ? $instance['buttonlabel'] : __( 'Login', 'pgb' );
        $outlabel = ! empty( $instance['outlabel'] ) ? $instance['outlabel'] : __( 'Logout', 'pgb' );
        $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
        $outclass = ! empty( $instance['outclass'] ) ? $instance['outclass'] : '';
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="Modal Title" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'classes' ); ?>"><?php _e( 'Additional CSS classes for Login button:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'classes' ); ?>" name="<?php echo $this->get_field_name( 'classes' ); ?>" type="text" value="<?php echo esc_attr( $classes ); ?>" placeholder="Ex: navbar-btn navbar-right" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'buttonlabel' ); ?>"><?php _e( 'Login button Label:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'buttonlabel' ); ?>" name="<?php echo $this->get_field_name( 'buttonlabel' ); ?>" type="text" value="<?php echo esc_attr( $buttonlabel ); ?>" placeholder="Login" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'outclass' ); ?>"><?php _e( 'Additional CSS classes for Logout link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'outclass' ); ?>" name="<?php echo $this->get_field_name( 'outclass' ); ?>" type="text" value="<?php echo esc_attr( $outclass ); ?>" placeholder="Ex: navbar-text navbar-right" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'outlabel' ); ?>"><?php _e( 'Logout link text:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'outlabel' ); ?>" name="<?php echo $this->get_field_name( 'outlabel' ); ?>" type="text" value="<?php echo esc_attr( $outlabel ); ?>" placeholder="Logout" />
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['classes'] = ( ! empty( $new_instance['classes'] ) ) ? strip_tags( $new_instance['classes'] ) : '';
        $instance['outclass'] = ( ! empty( $new_instance['outclass'] ) ) ? strip_tags( $new_instance['outclass'] ) : '';
        $instance['buttonlabel'] = ( ! empty( $new_instance['buttonlabel'] ) ) ? strip_tags( $new_instance['buttonlabel'] ) : 'Login';
        $instance['outlabel'] = ( ! empty( $new_instance['outlabel'] ) ) ? strip_tags( $new_instance['outlabel'] ) : 'Logout';

        return $instance;
    }

} // class pgb_login_widget


// register pgb_login_widget widget
function register_pgb_login_widget() {
    register_widget( 'PGB_Login_Widget' );
}
add_action( 'widgets_init', 'register_pgb_login_widget' );