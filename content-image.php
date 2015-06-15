<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package pgb
 */

if ( has_post_thumbnail() ) :
	$image_id = get_post_thumbnail_id( $post->ID );
	$image_src = wp_get_attachment_url( $image_id );
elseif ( pgb_get_image() ) :
	$image_src = pgb_get_image();
else :
	$image_src = false;
endif;
$the_image = $image_src ? sprintf( '<img width="100%%" height="auto" src="%1$s" class="img-responsive wp-post-image" />', $image_src ) : the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) );

?>

<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		<?php pgb_block_linkpages(); ?>
	</div><!-- /entry -->

<?php else : ?>

	<?php echo sprintf( '<div class="entry-summary col-md-12"><p>%1$s</p></div><!-- /entry -->', $the_image ); ?>

<?php endif; ?>
