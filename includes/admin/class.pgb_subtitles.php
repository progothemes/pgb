<?php

/**
 * @package     ProGo Base
 */

add_action( 'init', array( 'PGB_Subtitle', '_setup' ) );

class PGB_Subtitle {

	const TEXTDOMAIN = 'pgb';

	/**
	 * Setup
	 *
	 * @since  2.2
	 * @internal
	 */
	static function _setup() {
		add_action( 'admin_init', array( 'PGB_Subtitle', '_admin_init' ) );
		add_action( 'save_post', array( 'PGB_Subtitle', '_save_post' ) );
	}

	/**
	 * Admin Init
	 *
	 * @since  2.3
	 * @internal
	 */
	static function _admin_init() {

		global $pagenow;

		// Get post type
		$post_type = '';

		if ( isset( $_GET['post_type'] ) ) {
			$post_type = $_GET['post_type'];
		} elseif ( isset( $_GET['post'] ) ) {
			$post_type = get_post_type( $_GET['post'] );
		} elseif ( in_array( $pagenow, array( 'post-new.php', 'edit.php' ) ) ) {
			$post_type = 'post';
		}

		// Setup Field / Meta Box
		if ( PGB_Subtitle::is_supported_post_type( $post_type ) ) {
			if ( PGB_Subtitle::edit_form_after_title_supported( $post_type ) ) {
				add_action( 'admin_head', array( 'PGB_Subtitle', '_add_admin_styles' ) );
				add_action( 'edit_form_after_title', array( 'PGB_Subtitle', '_add_subtitle_field' ) );
			} else {
				add_action( 'add_meta_boxes', array( 'PGB_Subtitle', '_add_meta_boxes' ) );
			}

			add_filter( 'manage_edit-' . $post_type . '_columns', array( 'PGB_Subtitle', 'manage_subtitle_columns' ) );
			add_action( 'manage_' . $post_type . '_posts_custom_column', array( 'PGB_Subtitle', 'manage_subtitle_columns_content' ), 10, 2 );

		}

	}

	/**
	 * Add subtitle admin column.
	 *
	 * @since  2.4
	 *
	 * @param   array  $columns  A columns
	 * @return  array            Updated columns.
	 */
	public static function manage_subtitle_columns( $columns ) {

		$new_columns = array();

		foreach ( $columns as $column => $value ) {
			$new_columns[ $column ] = $value;
			if ( 'title' == $column ) {
				$new_columns['progo_material_subtitle'] = __( 'Subtitle', PGB_Subtitle::TEXTDOMAIN );
			}
		}

		return $new_columns;

	}

	/**
	 * Display subtitle column.
	 *
	 * @since  2.4
	 *
	 * @param  string  $column_name  Column name.
	 * @param  int     $post_id      Post ID
	 */
	public static function manage_subtitle_columns_content( $column_name, $post_id ) {

		if ( $column_name == 'progo_material_subtitle' ) {
			echo pgb_get_the_subtitle( $post_id, '', '', false );
		}

	}

	/**
	 * Add Admin Styles
	 *
	 * @since  2.2
	 * @internal
	 */
	static function _add_admin_styles() {
		?>
		<style>
		#subtitlediv.top {
			margin-top: 5px;
			margin-bottom: 15px;
			position: relative;
		}
		#subtitlediv.top #subtitlewrap {
			border: 0;
			padding: 0;
		}
		#subtitlediv.top #wpsubtitle {
			background-color: #fff;
			font-size: 1.4em;
			line-height: 1em;
			margin: 0;
			outline: 0;
			padding: 3px 8px;
			width: 100%;
			height: 1.7em;
		}
		#subtitlediv.top #wpsubtitle::-webkit-input-placeholder { padding-top: 3px; }
		#subtitlediv.top #wpsubtitle:-moz-placeholder { padding-top: 3px; }
		#subtitlediv.top #wpsubtitle::-moz-placeholder { padding-top: 3px; }
		#subtitlediv.top #wpsubtitle:-ms-input-placeholder { padding-top: 3px; }
		#subtitlediv.top #subtitledescription {
			margin: 5px 10px 0 10px;
		}
		</style>
		<?php
	}

	/**
	 * Get Meta Box Title
	 *
	 * @since  2.2
	 *
	 * @uses  apply_filters( 'progo_material_meta_box_title' )
	 */
	static function get_meta_box_title( $post_type ) {
		return apply_filters( 'progo_material_meta_box_title', __( 'Subtitle', PGB_Subtitle::TEXTDOMAIN ), $post_type );
	}

	/**
	 * Add Meta Boxes
	 *
	 * @since  2.0
	 * @internal
	 *
	 * @uses  PGB_Subtitle::get_supported_post_types()
	 * @uses  apply_filters( 'progo_material_meta_box_title' )
	 * @uses  PGB_Subtitle::_add_subtitle_meta_box()
	 */
	static function _add_meta_boxes() {
		$post_types = PGB_Subtitle::get_supported_post_types();
		foreach ( $post_types as $post_type ) {
			add_meta_box( 'progo_material_subtitle_panel',  PGB_Subtitle::get_meta_box_title( $post_type ), array( 'PGB_Subtitle', '_add_subtitle_meta_box' ), $post_type, 'normal', 'high' );
		}
	}

	/**
	 * Add Subtitle Meta Box
	 *
	 * @since  2.0
	 * @internal
	 *
	 * @uses  PGB_Subtitle::_get_post_meta()
	 * @uses  apply_filters( 'progo_material_subtitle_field_description' )
	 */
	static function _add_subtitle_meta_box() {
		global $post;
		echo '<input type="hidden" name="progo_material_noncename" id="progo_material_noncename" value="' . wp_create_nonce( 'progo-material-subtitle' ) . '" />';
		echo '<input type="text" id="wpsubtitle" name="progo_material_subtitle" value="' . esc_attr( PGB_Subtitle::_get_post_meta( $post->ID ) ) . '" style="width:99%;" />';
		echo apply_filters( 'progo_material_subtitle_field_description', '', $post );
	}

	/**
	 * Add Subtitle Field
	 *
	 * @since  2.2
	 * @internal
	 *
	 * @uses  PGB_Subtitle::_get_post_meta()
	 * @uses  apply_filters( 'progo_material_subtitle_field_description' )
	 */
	static function _add_subtitle_field() {
		global $post;
		echo '<input type="hidden" name="progo_material_noncename" id="progo_material_noncename" value="' . wp_create_nonce( 'progo-material-subtitle' ) . '" />';
		echo '<div id="subtitlediv" class="top">';
			echo '<div id="subtitlewrap">';
				echo '<input type="text" id="wpsubtitle" name="progo_material_subtitle" value="' . esc_attr( PGB_Subtitle::_get_post_meta( $post->ID ) ) . '" autocomplete="off" placeholder="' . esc_attr( apply_filters( 'progo_material_subtitle_field_placeholder', __( 'Enter subtitle here', PGB_Subtitle::TEXTDOMAIN ) ) ) . '" />';
			echo '</div>';

		// Description
		$description = apply_filters( 'progo_material_subtitle_field_description', '', $post );
		if ( ! empty( $description ) ) {
			echo '<div id="subtitledescription">' . $description . '</div>';
		}
		echo '</div>';
	}

	/**
	 * Save Subtitle
	 *
	 * @since  2.0
	 * @internal
	 *
	 * @uses  PGB_Subtitle::get_supported_post_types()
	 *
	 * @param  int  $post_id  Post ID or object.
	 */
	static function _save_post( $post_id ) {

		// Verify if this is an auto save routine. 
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Verify nonce
		if ( ! PGB_Subtitle::_verify_posted_nonce( 'progo_material_noncename', 'progo-material-subtitle' ) ) {
			return;
		}

		// Check edit capability
		if ( ! PGB_Subtitle::_verify_post_edit_capability( $post_id ) ) {
			return;
		}
	
		// Save data
		if ( isset( $_POST['progo_material_subtitle'] ) ) {
			update_post_meta( $post_id, 'progo_material_subtitle', wp_kses_post( $_POST['progo_material_subtitle'] ) );
		}
	}

	/**
	 * Verify Post Edit Capability
	 *
	 * @since  2.0.1
	 * @internal
	 *
	 * @param   int  $post_id  Post ID.
	 * @return  bool
	 */
	static function _verify_post_edit_capability( $post_id ) {

		$post_types_obj = (array) get_post_types( array(
			'_builtin' => false
		), 'objects' );

		// Check supported post type
		if ( isset( $_POST['post_type'] ) && PGB_Subtitle::is_supported_post_type( $_POST['post_type'] ) ) {
			if ( 'page' == $_POST['post_type'] && current_user_can( 'edit_page', $post_id ) ) {
				return true;
			} elseif ( 'post' == $_POST['post_type'] && current_user_can( 'edit_post', $post_id ) ) {
				return true;
			} elseif ( current_user_can( $post_types_obj[ $_POST['post_type'] ]->cap->edit_post, $post_id ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Verify Posted Nonce
	 *
	 * @since  2.0.1
	 * @internal
	 *
	 * @param   string  $nonce   Posted nonce name.
	 * @param   string  $action  Nonce action.
	 * @return  bool
	 */
	static function _verify_posted_nonce( $nonce, $action ) {
		if ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], $action ) ) {
			return true;
		}
		return false;
	}

	/**
	 * edit_form_after_title Supported
	 *
	 * @since  2.2
	 *
	 * @param   string  $post_type  Post type.
	 * @return  bool
	 */
	static function edit_form_after_title_supported( $post_type = '' ) {
		global $wp_version;

		if ( version_compare( $wp_version, '3.5', '<' ) ) {
			return false;
		}
		return ! apply_filters( 'progo_material_subtitle_use_meta_box', false, $post_type );
	}



	/**
	 * Add Default Post Type Support
	 *
	 * @since  2.0
	 * @internal
	 */
	static function _add_default_post_type_support() {
		add_post_type_support( 'page', 'progo_material_subtitle' );
		add_post_type_support( 'post', 'progo_material_subtitle' );
	}

	/**
	 * Get Supported Post Types
	 *
	 * @since  2.0
	 *
	 * @return  array  Array of supported post types.
	 */
	static function get_supported_post_types() {
		$post_types = array( 'post', 'page' );
		return $post_types;
	}

	/**
	 * Is Supported Post Type
	 *
	 * @since  2.3
	 *
	 * @param   string   $post_type  Post Type.
	 * @return  boolean
	 */
	static function is_supported_post_type( $post_type ) {
		$post_types = PGB_Subtitle::get_supported_post_types();
		if ( in_array( $post_type, $post_types ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Get the Subtitle
	 *
	 * @since  2.0
	 *
	 * @uses  PGB_Subtitle::_get_post_meta()
	 * @uses  apply_filters( 'progo_material_subtitle' )
	 *
	 * @param   int|object  $post  Post ID or object.
	 * @return  string             The filtered subtitle meta value.
	 */
	static function pgb_get_the_subtitle( $post = 0 ) {
		$post = get_post( $post );
		if ( $post && PGB_Subtitle::is_supported_post_type( $post->post_type ) ) {
			$subtitle = PGB_Subtitle::_get_post_meta( $post );
			return apply_filters( 'progo_material_subtitle', $subtitle, $post );
		}
		return '';
	}

	/**
	 * Get Post Meta
	 *
	 * @since  2.0
	 * @internal
	 *
	 * @param   int|object  $post  Post ID or object.
	 * @return  string             The subtitle meta value.
	 */
	static function _get_post_meta( $id = 0 ) {
		$post = get_post( $id );
		return get_post_meta( $post->ID, 'progo_material_subtitle', true );
	}

}

/**
 * The Subtitle
 *
 * @since  1.0
 *
 * @uses  pgb_get_the_subtitle()
 *
 * @param   string  $before  Before the subtitle.
 * @param   string  $after   After the subtitle.
 * @param   bool    $echo    Output if true, return if false.
 * @return  string           The subtitle string.
 */
function pgb_the_subtitle( $before = '', $after = '', $echo = true ) {
	return pgb_get_the_subtitle( 0, $before, $after, $echo );
}

/**
 * Get the Subtitle
 *
 * @since  1.0
 *
 * @uses  PGB_Subtitle::pgb_get_the_subtitle()
 *
 * @param   int|object  $post    Post ID or object.
 * @param   string      $before  Before the subtitle.
 * @param   string      $after   After the subtitle.
 * @param   bool        $echo    Output if true, return if false.
 * @return  string               The subtitle string.
 */
function pgb_get_the_subtitle( $post = 0, $before = '', $after = '', $echo = false ) {
	$subtitle = PGB_Subtitle::pgb_get_the_subtitle( $post );

	if ( ! empty( $subtitle ) ) {
		$subtitle = $before . $subtitle . $after;
	}

	if ( ! $echo ) {
		return $subtitle;
	}
	echo $subtitle;
}
