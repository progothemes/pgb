<?php
/**
 * The template for displaying posts in the Audio (podcast) post format
 *
 * @package pgb
 */


$the_post_meta = get_post_meta( get_the_ID() );

$the_post_format_meta = get_post_meta( get_the_ID(), '_postformats_meta_value_key', true );

?>


<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>

<?php else : ?>

	<div class="entry-summary col-md-12">

<?php endif; ?>
		
		<div class="embed-responsive-item">
			<?php 

			if ( isset( $the_post_format_meta['audio_embed'] ) ):
				if ( substr( $the_post_format_meta['audio_embed'], 0, 7 ) === "[audio ") {
					echo do_shortcode( $the_post_format_meta['audio_embed'] );
				}
				else {
					echo wp_oembed_get( $the_post_format_meta['audio_embed'] ) 
						? wp_oembed_get( $the_post_format_meta['audio_embed'] ) 
						: '<p><a href="' . $the_post_format_meta['audio_embed'] . '">' . 
							( isset( $the_post_format_meta['audio_title'] ) ? $the_post_format_meta['audio_title'] : $the_post_format_meta['audio_embed'] ) . 
							'</a></p>';
				}
			endif;

			?>
		</div>

		<?php pgb_block_linkpages(); ?>

	</div><!-- //.entry- -->
