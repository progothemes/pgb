<?php
/**
 * Post Formats Meta boxes
 */

/**
 * Calls the class on the post edit screen.
 */
function pgb_call_postFormatsClass() {
	new PGB_postFormatsClass();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'pgb_call_postFormatsClass' );
	add_action( 'load-post-new.php', 'pgb_call_postFormatsClass' );
}

/** 
 * The Class.
 */
class PGB_postFormatsClass {

	/**
	 * Define meta boxes
	 *
	 * @param $id
	 * @param $title
	 * @param $callback
	 * @param $screen
	 * @param $context
	 * @param $priority
	 *
	 * @return array
	 */
	public $post_format_meta_boxes = array(
		'aside' 	=> array(
						'id' 		=> 'postformats_aside_meta_box',
						'title' 	=> 'Aside Options',
						'callback'	=> 'render_aside_meta_box_content'
			),
		'audio' 	=> array(
						'id' 		=> 'postformats_audio_meta_box',
						'title' 	=> 'Audio Options',
						'callback'	=> 'render_audio_meta_box_content'
			),
		'image' 	=> array(
						'id' 		=> 'postformats_image_meta_box',
						'title' 	=> 'Image Options',
						'callback'	=> 'render_image_meta_box_content'
			),
		'link' 		=> array(
						'id' 		=> 'postformats_link_meta_box',
						'title' 	=> 'Link Options',
						'callback'	=> 'render_link_meta_box_content'
			),
		'quote' 	=> array(
						'id' 		=> 'postformats_quote_meta_box',
						'title' 	=> 'Quote Options',
						'callback'	=> 'render_quote_meta_box_content'
			),
		'video' 	=> array(
						'id' 		=> 'postformats_video_meta_box',
						'title' 	=> 'Video Options',
						'callback'	=> 'render_video_meta_box_content'
			),
		);

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}


	/**
	 * Adds the meta box containers.
	 */
	public function add_meta_box( $post_type ) {
		
		foreach ( $this->post_format_meta_boxes as $meta_box ) {

			if ( method_exists( $this, $meta_box['callback'] ) ) {
				add_meta_box(
					$meta_box['id'],
					__( $meta_box['title'], 'pgb' ),
					array( $this, $meta_box['callback'] ),
					'post',
					'normal',
					'high'
				);
			}
		}
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['postformats_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['postformats_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'postformats_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
				//	 so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = $_POST['postformats'];

		// Update the meta field.
		update_post_meta( $post_id, '_postformats_meta_value_key', $mydata );
	}


	/**
	 * Render Audio Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_audio_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'postformats_inner_custom_box', 'postformats_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_postformats_meta_value_key', true );

		// Display the form, using the current value.
		?>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<p><?php echo sprintf( __( 'Embed audio from services like SoundCloud and Rdio. You can find a list of supported oEmbed sites in the %1$s.', 'pgb'), '<a href="http://codex.wordpress.org/Embeds" target="_blank">' . __( 'WordPress Codex', 'pgb' ) .'</a>' ); ?></p>
						<p><?php echo sprintf( __( 'Alternatively, you could use WordPress\' built-in %1$s %2$s.', 'pgb' ), '<code>[audio]</code>', '<a href="https://codex.wordpress.org/Audio_Shortcode">' . __( 'shortcode', 'pgb' ) . '</a>' ); ?></p>
					</td>
				</tr>
				<tr>
					<td><label for="postformats[audio_embed]"><?php _e( 'Audio', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[audio_embed]" name="postformats[audio_embed]" value="<?php echo ( isset( $value['audio_embed'] ) ? esc_attr( $value['audio_embed'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[audio_title]"><?php _e( 'Title', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[audio_title]" name="postformats[audio_title]" value="<?php echo ( isset( $value['audio_title'] ) ? esc_attr( $value['audio_title'] ) : '' ); ?>" size="25" /></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Render Image Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_image_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'postformats_inner_custom_box', 'postformats_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_postformats_meta_value_key', true );

		// Display the form, using the current value.
		?>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<p><?php echo sprintf( __('Post format "Image" uses featured image. To exclude any of the following, leave blank.', 'pgb'), '' ); ?></p>
					</td>
				</tr>
				<tr>
					<td><label for="postformats[image_link]"><?php _e( 'Link To', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[image_link]" name="postformats[image_link]" value="<?php echo ( isset( $value['image_link'] ) ? esc_attr( $value['image_link'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[image_caption]"><?php _e( 'Caption', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[image_caption]" name="postformats[image_caption]" value="<?php echo ( isset( $value['image_caption'] ) ? esc_attr( $value['image_caption'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[image_alt]"><?php _e( 'Alt Text', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[image_alt]" name="postformats[image_alt]" value="<?php echo ( isset( $value['image_alt'] ) ? esc_attr( $value['image_alt'] ) : '' ); ?>" size="25" /></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Render Link Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_link_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'postformats_inner_custom_box', 'postformats_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_postformats_meta_value_key', true );

		// Display the form, using the current value.
		?>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<p><?php echo sprintf( __('Post format "Link" displays post content in a panel with linked title.', 'pgb'), '' ); ?></p>
					</td>
				</tr>
				<tr>
					<td><label for="postformats[link_url]"><?php _e( 'URL', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[link_url]" name="postformats[link_url]" value="<?php echo ( isset( $value['link_url'] ) ? esc_attr( $value['link_url'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[link_title]"><?php _e( 'Title', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[link_title]" name="postformats[link_title]" value="<?php echo ( isset( $value['link_title'] ) ? esc_attr( $value['link_title'] ) : '' ); ?>" size="25" /></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Render Quote Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_quote_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'postformats_inner_custom_box', 'postformats_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_postformats_meta_value_key', true );

		// Display the form, using the current value.
		?>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<p><?php echo sprintf( __('Post format "Quote" displays post content as block-quote.', 'pgb'), '' ); ?></p>
					</td>
				</tr>
				<tr>
					<td><label for="postformats[quote_source_name]"><?php _e( 'Source Name', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[quote_source_name]" name="postformats[quote_source_name]" value="<?php echo ( isset( $value['quote_source_name'] ) ? esc_attr( $value['quote_source_name'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[quote_source_url]"><?php _e( 'Source URL', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[quote_source_url]" name="postformats[quote_source_url]" value="<?php echo ( isset( $value['quote_source_url'] ) ? esc_attr( $value['quote_source_url'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[quote_source_title]"><?php _e( 'Source Title', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[quote_source_title]" name="postformats[quote_source_title]" value="<?php echo ( isset( $value['quote_source_title'] ) ? esc_attr( $value['quote_source_title'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[quote_source_date]"><?php _e( 'Source Date', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[quote_source_date]" name="postformats[quote_source_date]" value="<?php echo ( isset( $value['quote_source_date'] ) ? esc_attr( $value['quote_source_date'] ) : '' ); ?>" size="25" /></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Render Video Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_video_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'postformats_inner_custom_box', 'postformats_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_postformats_meta_value_key', true );

		// Display the form, using the current value.
		?>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<p><?php echo sprintf( __( 'Embed video from services like Youtube, Vimeo, or Hulu. You can find a list of supported oEmbed sites in the %1$s.', 'pgb'), '<a href="http://codex.wordpress.org/Embeds" target="_blank">' . __( 'WordPress Codex', 'pgb' ) .'</a>' ); ?></p>
						<p><?php echo sprintf( __( 'Alternatively, you could use WordPress\' built-in %1$s %2$s.', 'pgb' ), '<code>[video]</code>', '<a href="https://codex.wordpress.org/Video_Shortcode">' . __( 'shortcode', 'pgb' ) . '</a>' ); ?></p>
					</td>
				</tr>
				<tr>
					<td><label for="postformats[video_embed]"><?php _e( 'Video', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[video_embed]" name="postformats[video_embed]" value="<?php echo ( isset( $value['video_embed'] ) ? esc_attr( $value['video_embed'] ) : '' ); ?>" size="25" /></td>
				</tr>
				<tr>
					<td><label for="postformats[video_title]"><?php _e( 'Title', 'pgb' ); ?></label></td>
					<td><input type="text" id="postformats[video_title]" name="postformats[video_title]" value="<?php echo ( isset( $value['video_title'] ) ? esc_attr( $value['video_title'] ) : '' ); ?>" size="25" /></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

}


?>