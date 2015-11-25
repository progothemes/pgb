<?php

function pgb_add_meta_box()
{
	add_meta_box(
        'pgb-meta-box',
        __( 'ProGo Theme Page Options', 'pgb' ),
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
	_e( 'Override Default Page Width', 'pgb' );
	echo '</label> ';
	echo '<select id="page_layout" name="page_layout">';
	echo '<option value="no" '.($page_layout=='no'?'selected="selected"':'').'>No</option>';
	echo '<option value="yes" '.($page_layout=='yes'?'selected="selected"':'').'>Yes</option>';
	echo '</select><br>';

	$custom_width = get_post_meta( $post->ID, 'custom_container_width', true );
	echo '<label for="custom_width">';
	_e( 'Custom Page Width', 'pgb' );
	echo '</label> ';
	echo '<select id="custom_width" name="custom_width">';
	$cw_options = array(
		'default' 	=> 'Default',
		'full' 		=> 'Full Width (100%)',
		'1366px'	=> '1366px',
		'1240px'	=> '1240px',
		'1170px'	=> '1170px',
		'1080px'	=> '1080px',
		'960px'		=> '960px'
	);
	$cw_options = apply_filters( 'pgb_page_width_options', $cw_options, $post );
	foreach($cw_options as $k => $cw_option) {
		$sel = $custom_width == $k ? 'selected="selected"':'';
		echo '<option value="'.$k.'" '.$sel.'>'.$cw_option.'</option>';
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

	// Make sure that it is set?
	if ( isset( $_POST['page_layout'] ) ) {
		//return;
    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['page_layout'] );
    update_post_meta( $post_id, 'metabox_page_layout_option', $my_data );
	}
	if ( isset( $_POST['custom_width'] ) ) {
    // Sanitize user input.
    $my_data2 = sanitize_text_field( $_POST['custom_width'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'custom_container_width', $my_data2 );
	}
}
add_action( 'save_post', 'pgb_save_meta_box_data' );

?>