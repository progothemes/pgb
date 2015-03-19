<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package pgb
 */
?>

<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search and Archive Pages ?>

	<div class="entry-summary col-md-12">

		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

<?php elseif ( is_blog_page() ) : ?>

	<div class="entry-summary col-md-12">
		
		<?php if (has_post_thumbnail()) { ?>

			<?php
			$img_id = get_post_thumbnail_id($post->ID);
			$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
			?>

			<div class="entry-image wp-caption alignleft col-md-6">
				<?php echo the_post_thumbnail(); ?>
				<p class="wp-caption-text"><?php _e( $alt_text, 'pgb' ); ?></p>
			</div>

		<?php } ?>
		
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
	
	</div><!-- .entry-summary -->

<?php else : ?>

	<div class="entry-content col-md-12">

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<?php if (has_post_thumbnail()) { ?>

		<div class="entry-image col-md-12">

			<?php echo the_post_thumbnail(); ?>

		</div>

	<?php } ?>

<?php endif; ?>