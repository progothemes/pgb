<?php 

if ( ! function_exists( 'pgb_set_container_width' ) ) {
	function pgb_set_container_width( $data, $classname ) {
		$custom_css = '';
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
}

function pgb_get_header_classes_array() {
	global $pgbo_options;
	
	foreach ($pgbo_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}

function pgb_get_logo () {
    $options = pgb_get_options();
    $desktoplogo = $options['logo_image'];
    $mobilelogo  = $options['mobile_logo'];
    $title       = get_bloginfo( 'name' );   

    $logo = null;

    if ( empty( $desktoplogo ) ) {

            if ( empty( $mobilelogo ) ) {

               $logo .= sprintf( __( '%s', 'pgb' ), $title ); 

            } else { // for all three

                $logo .= '<div class="desktoplogo">
                            <img src="'.  esc_attr( $mobilelogo ) .'" alt="">
                        </div>';

                $logo .= '<div class="mobilelogo">
                            <img src="'.  esc_attr( $mobilelogo ) .'" alt="">
                        </div>';
            }

   } else {

        $logo .= '<div class="desktoplogo">
                    <img src="'.  esc_attr( $desktoplogo ). '" alt="">
                </div>';

        if ( empty( $mobilelogo ) ) {

            $logo .= '<div class="mobilelogo">
                        <img src="'.  esc_attr( $desktoplogo ). '" alt="">
                    </div>';   
        } else {

            $logo .= '<div class="mobilelogo">
                        <img src="'.  esc_attr( $mobilelogo ). '" alt="">
                    </div>';
        }

    }

    return $logo;
}

if ( ! function_exists('is_blog_page') ) :
function is_blog_page() {
    if ( is_front_page() && is_home() ) {
        // Default homepage
        return true;
    } elseif ( is_front_page() ) {
        // static homepage
        return false;
    } elseif ( is_home() ) {
        // blog page
        return true;
    } else {
        //everything else
        return false;
    }
}
endif;


function pgb_get_options($key = null, $data = null) {
	global $pgbo_data;

	do_action('pgb_get_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	if ($key != null) { // Get one specific value
		$data = get_theme_mod($key, $data);
	} else { // Get all values
		$data = get_theme_mods();	
	}
	$data = apply_filters('pgb_options_after_load', $data);
	if ($key == null) {
		$smof_data = $data;
	} else {
		$smof_data[$key] = $data;
	}
	do_action('pgb_option_setup_before', array(
		'key'=>$key, 'data'=>$data
	));
	return $data;

}

function pgb_save_options($data, $key = null) {
	global $pgbo_data;
    if (empty($data))
        return;	
    do_action('pgb_save_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	$data = apply_filters('pgb_options_before_save', $data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($data['pgbo_init']); // Don't want to change this.
		}
		set_theme_mod($key, $data);
	} else { // Update all values in $data
		foreach ( $data as $k=>$v ) {
			if (!isset($pgbo_data[$k]) || $pgbo_data[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
	  	}
	}
    do_action('pgbo_save_options_after', array(
		'key'=>$key, 'data'=>$data
	));

}

$data = pgb_get_options();
if (!isset($pgbo_details))
	$pgbo_details = array();
