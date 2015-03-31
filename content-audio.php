<?php
/**
 * The template for displaying posts in the Audio (podcast) post format
 *
 * @package pgb
 */
?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>

<?php else : ?>

	<div class="entry-summary col-md-12">

<?php endif; ?>
		
		<div class="embed-responsive-item">
			<?php 

			if ( isset( $the_post_meta['_format_audio_embed'] ) ):
				if ( substr( $the_post_meta['_format_audio_embed'][0], 0, 7 ) === "[audio ") {
					echo do_shortcode( $the_post_meta['_format_audio_embed'][0] );
				}
				else {
					echo wp_oembed_get( $the_post_meta['_format_audio_embed'][0] );
				}
			endif;

			?>
		</div>

		<?php if ( is_single() ) : ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
					'after'  => '</div>',
				) );
			?>

		<?php endif; ?>

	</div><!-- .entry-summary -->
