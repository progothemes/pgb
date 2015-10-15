<?php
/**
 * @package pgb
 */
?>

<?php if ( is_search() || is_archive() || pgb_is_blog_page() ) : // Only display Excerpts for Search and Archive Pages ?>

	<div class="entry-summary col-md-12">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

<?php else : ?>

	<?php get_template_part( 'posts', 'images' ); ?>
	<div class="entry-content col-md-12">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		<?php pgb_block_linkpages(); ?>
	</div><!-- .entry-content -->

<?php endif; ?>
