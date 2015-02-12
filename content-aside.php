<?php
/**
 * The template for displaying Aside post format
 *
 * @package pgb
 */
?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search and Archive Pages ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

<?php else : ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php if (has_post_thumbnail()) { ?>
		<div>
			<?php echo the_post_thumbnail(); ?>
		</div>
	<?php } ?>

<?php endif; ?>
