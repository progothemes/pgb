<?php 

function progobaseframework_admin_init() {
	// Rev up the Options Machine
	global $pgbo_options, $progobase_options, $pgbo_data, $pgbo_details;
	if ( !isset( $progobase_options ) ) {
		$progobase_options = new ProGoBase_Options($pgbo_options);
  }
	
	if ( empty( $pgbo_data['pgbo_init'] ) ) {
    // Let's set the values if the theme's already been active
		pgb_save_options( $progobase_options->Defaults );
		pgb_save_options( date('r'), 'pgbo_init');
		$pgbo_data = pgb_get_options();
		$progobase_options = new ProGoBase_Options( $pgbo_options );
	}
}

function progobaseframework_add_admin() {
	$pgb_page = add_menu_page( THEMENAME, "ProGo", "manage_options", "progobase-theme-options", 'progobaseframework_options_page', get_template_directory_uri() . '/includes/admin/images/favicon.ico', 3 );
	
	$pgb_page = add_submenu_page( 'progobase-theme-options', 'ProGo Theme Options', 'Theme Options', 'edit_theme_options', 'progobase-theme-options', 'progobaseframework_options_page' );
	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$pgb_page", 'pgb_load_only');
	add_action("admin_print_styles-$pgb_page",'pgb_style_only');
  
  	// "Upload Theme" for uploading a custom Bootstrap theme, but not quite yet
	//$pgb_page = add_submenu_page( 'progobase-theme-options', 'Upload Theme', 'Upload Theme', 'manage_options', 'upload_theme', 'upload_theme_page' );
}
function progobaseframework_add_adminbar_menu() {

	global $wp_admin_bar;

	$all_toolbar_nodes = $wp_admin_bar->get_nodes();

	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_admin_bar->add_node( array(
			//'parent' => 'appearance',
			'id'     => 'progobase-theme-options',
			'title'  => '<span class="" aria-hidden="true"><img class="alignnone" src="' . get_template_directory_uri() . '/includes/admin/images/favicon.ico" />&nbsp;</span>' . __( 'ProGo Options' ),
			'href'   => admin_url( 'admin.php?page=progobase-theme-options' ),
		) );
	}
	foreach ( $all_toolbar_nodes as $node ) {
		$args = $node;
		$wp_admin_bar->add_node( $args );
	}
}
add_action( 'admin_bar_menu', 'progobaseframework_add_adminbar_menu', 999 );

function progobaseframework_options_page(){
	global $progobase_options;	
	include_once( ADMIN_PATH . 'admin/admin-options.php' );
}

function pgb_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'admin/css/pgb-interface-style.css');
	//wp_enqueue_style('color-picker', ADMIN_DIR . 'assets/css/colorpicker.css');
	wp_enqueue_style('jquery-ui-custom-admin', ADMIN_DIR .'admin/css/jquery-ui-custom.css');

	if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style( 'wp-color-picker', ADMIN_DIR . 'admin/css/color-picker.min.css' );
	}
	wp_enqueue_style( 'wp-color-picker' );
	do_action('pgb_style_only_after');
}	

function pgb_load_only() {
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'admin/js/jquery.tipsy.js', array( 'jquery' ));
	//wp_enqueue_script('color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('cookie', ADMIN_DIR . 'admin/js/cookie.js', 'jquery');
	wp_enqueue_script('pgb', ADMIN_DIR .'admin/js/pgb.js', array( 'jquery' ));

	// Enqueue colorpicker scripts for versions below 3.5 for compatibility
	if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
		wp_register_script( 'iris', ADMIN_DIR .'admin/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_register_script( 'wp-color-picker', ADMIN_DIR .'admin/js/color-picker.min.js', array( 'jquery', 'iris' ) );
	}
	wp_enqueue_script( 'wp-color-picker' );
	
	/**
	 * Enqueue scripts for file uploader
	 */
	
	if ( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
  }
  
	do_action('pgb_load_only_after');
}

function pgb_ajax_callback() {
	global $progobase_options, $pgbo_options;

	$nonce = $_POST['security'];
	
	if ( !wp_verify_nonce( $nonce, 'pgb_ajax_nonce' ) ) {
    die('-1'); 
  }
	
	//get options array from db
	$all = pgb_get_options();
	
	$save_type = $_POST['type'];
	
	//Uploads
	if($save_type == 'upload') {
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
    $filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
    $upload_tracking[] = $clickedID;
      
    //update $options array w/ image URL			  
    $upload_image = $all; //preserve current data
    
    $upload_image[$clickedID] = $uploaded_file['url'];
    
    pgb_save_options($upload_image);
    
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	} elseif($save_type == 'image_reset') {
    $id = $_POST['data']; // Acts as the name
    
    $delete_image = $all; //preserve rest of data
    $delete_image[$id] = ''; //update array key with empty value	 
    pgb_save_options($delete_image ) ;
	
	} elseif($save_type == 'backup_options') {
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		pgb_save_options($backup, BACKUPS) ;
		die('1'); 
	} elseif($save_type == 'restore_options') {
		$pgbo_data = pgb_get_options(BACKUPS);

		pgb_save_options($pgbo_data);
		
		die('1'); 
	} elseif($save_type == 'import_options') {
		$pgbo_data = unserialize(base64_decode($_POST['data'])); //100% safe - ignore theme check nag
		pgb_save_options($pgbo_data);

		
		die('1'); 
	} elseif ($save_type == 'save') {
		wp_parse_str(stripslashes($_POST['data']), $pgbo_data);
		unset($pgbo_data['security']);
		unset($pgbo_data['pgb_save']);
		pgb_save_options($pgbo_data);
		
		die('1');
	} elseif ($save_type == 'reset') {
		pgb_save_options($progobase_options->Defaults);
		
    die('1'); //options reset
	}

  die();
}
