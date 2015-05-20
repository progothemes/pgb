<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package pgb
 */


$the_post_meta = get_post_meta( get_the_ID() );

$the_post_format_meta = get_post_meta( get_the_ID(), '_postformats_meta_value_key', true );

if ( has_post_thumbnail() ) :

	$image_id 		= get_post_thumbnail_id( $post->ID );
	$image_link 	= isset( $the_post_format_meta['image_link'] ) ? $the_post_format_meta['image_link'] : false;
	$image_caption 	= isset( $the_post_format_meta['image_caption'] ) ? $the_post_format_meta['image_caption'] : false;
	$alt_text 		= isset( $the_post_format_meta['image_alt'] ) && ! empty( $the_post_format_meta['image_alt'] ) ? $the_post_format_meta['image_alt'] : get_post_meta( $image_id , '_wp_attachment_image_alt', true );

	$_image = sprintf( '<img width="100%%" height="auto" src="%1$s" class="img-responsive wp-post-image" alt="%2$s" />', wp_get_attachment_url( $image_id ), $alt_text );

	if ( $image_link !== false ) {
		$_image = sprintf( '<a href="%1$s">%2$s</a>', $image_link, $_image );
	}

	if ( $image_caption ) {
		$_image = sprintf( '<div id="attachment_%1$s" class="wp-caption alignnone">%2$s<p class="wp-caption-text">%3$s</p></div>', $image_id, $_image, $image_caption );
	}

	if ( is_single() ) {
		echo sprintf( '<div class="entry-content col-md-12">%1$s</div><!-- /entry -->', $_image );
	}
	else {
		echo sprintf( '<div class="entry-summary col-md-12">%1$s</div><!-- /entry -->', $_image );
	}

endif;

if ( is_single() ) : ?>

	<div class="entry-content col-md-12">

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

<?php endif; ?>
