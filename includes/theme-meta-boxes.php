<?php

function pgb_add_meta_box()
{
	add_meta_box(
        'pgb-meta-box',
        __( 'ProGo Theme Page Options' ),
        'pgb_page_opttions_cb',
        'page',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'pgb_add_meta_box' );

function pgb_page_opttions_cb( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'pgb_meta_box', 'pgb_meta_box_nonce' );

	$page_layout = get_post_meta( $post->ID, 'metabox_page_layout_option', true );
	echo '<label for="page_layout">';
	_e( 'Override Default Page Width', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<select id="page_layout" name="page_layout">';
	echo '<option value="no" '.($page_layout=='no'?'selected="selected"':'').'>No</option>';
	echo '<option value="yes" '.($page_layout=='yes'?'selected="selected"':'').'>Yes</option>';
	echo '</select><br>';

	$custom_width = get_post_meta( $post->ID, 'custom_container_width', true );
	echo '<label for="custom_width">';
	_e( 'Custom Page Width', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<select id="custom_width" name="custom_width">';
	$cw_options = array('default' 	=> 'Default',
						'full' 		=> 'Full Width (100%)',
						'1366px'	=> '1366px',
						'1240px'	=> '1240px',
						'1170px'	=> '1170px',
						'1080px'	=> '1080px',
						'960px'		=> '960px');
	foreach($cw_options as $k => $cw_option)
	{
		$sel = $custom_width == $k ? 'selected="selected"':'';
		echo '<option value="'.$k.'" '.$sel.'>'.$cw_option.'</option>';
	}
	echo '</select><br><br>';

	$page_footer = get_post_meta( $post->ID, 'metabox_page_footer_option', true );
	echo '<label for="page_footer">';
	_e( 'Use Custom Footer', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<select id="page_footer" name="page_footer">';
	echo '<option value="default" '.($page_footer=='default'?'selected="selected"':'').'>Use Theme Default</option>';
	echo '<option value="custom" '.($page_footer=='custom'?'selected="selected"':'').'>Use Custom Footer on This Page</option>';
	echo '<option value="hide" '.($page_footer=='hide'?'selected="selected"':'').'>Hide Footer on This Page</option>';
	echo '</select><br>';

	$custom_footer = get_post_meta( $post->ID, 'custom_footer_layout', true );
	echo '<label for="custom_footer">';
	_e( 'Custom Footer Layout', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<select id="custom_footer" name="custom_footer">';
	$cw_options = array(1 	=> 'One',
						2	=> 'Two',
						3	=> 'Three',
						4	=> 'Four');
	foreach($cw_options as $k => $cw_option)
	{
		$sel = $custom_footer == $k ? 'selected="selected"':'';
		echo '<option value="'.$k.'">'.$cw_option.'</option>';
	}
	echo '</select><br><br>';

}

function pgb_save_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['pgb_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['pgb_meta_box_nonce'], 'pgb_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Make sure that it is set.
	if ( ! isset( $_POST['page_layout'] ) ) {
		return;
	}
	if ( ! isset( $_POST['custom_width'] ) ) {
		return;
	}
	if ( ! isset( $_POST['page_footer'] ) ) {
		return;
	}
	if ( ! isset( $_POST['custom_footer'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['page_layout'] );
	$my_data2 = sanitize_text_field( $_POST['custom_width'] );
	$my_data3 = sanitize_text_field( $_POST['page_footer'] );
	$my_data4 = sanitize_text_field( $_POST['custom_footer'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'metabox_page_layout_option', $my_data );
	update_post_meta( $post_id, 'custom_container_width', $my_data2 );
	update_post_meta( $post_id, 'metabox_page_footer_option', $my_data3 );
	update_post_meta( $post_id, 'custom_footer_layout', $my_data4 );
}
add_action( 'save_post', 'pgb_save_meta_box_data' );

?>