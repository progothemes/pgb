<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package pgb
 */
?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php if ( is_search() || is_archive() || is_blog_page() ) : // Only display Excerpts for Search and Archive Pages ?>

	<div class="entry-summary col-md-12">
		
		<div class="embed-responsive-item">
			<?php 

			if (substr( $the_post_meta['_format_video_embed'][0], 0, 7 ) === "[video ") {
				echo do_shortcode( $the_post_meta['_format_video_embed'][0] );
			}
			else {
				echo wp_oembed_get( $the_post_meta['_format_video_embed'][0] );
			}

			?>
		</div>

	</div><!-- .entry-summary -->

<?php else : ?>
	
	<div class="entry-content col-md-12">
		
		<div class="embed-responsive-item">
			<?php 

			if (substr( $the_post_meta['_format_video_embed'][0], 0, 7 ) === "[video ") {
				echo do_shortcode( $the_post_meta['_format_video_embed'][0] );
			}
			else {
				echo wp_oembed_get( $the_post_meta['_format_video_embed'][0] );
			}

			?>
		</div>
		
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
				'after'  => '</div>',
			) );
		?>
	
	</div><!-- .entry-content -->

<?php endif; ?>
