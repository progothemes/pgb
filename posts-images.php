<?php
/**
 * Template for displaying post/page images
 *
 * @package pgb
 */

global $post;

if ( has_post_thumbnail( $post->ID ) ) {

	$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

	$size = 'full';

	$attr = array(
		'class' => 'img-responsive center-block'
	);

	$alt_text = get_post_meta( $post_thumbnail_id , '_wp_attachment_image_alt', true );

	?>

	<?php if ( pgb_is_blog_page() && $post_thumbnail_id ) { // Blog or Featured Posts pages only ?>

		<div class="entry-image thumbnail alignleft col-xs-12 col-md-6">

			<?php echo the_post_thumbnail( $size, $attr ); ?>

		</div>

	<?php } else { // All other pages ?>

		<div class="entry-image col-md-12">

			<?php echo the_post_thumbnail( $size, $attr ); ?>

		</div>

	<?php }

} ?>