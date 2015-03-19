<?php
/**
 * @package pgb
 */
?>


<?php if ( is_search() || is_archive() || is_blog_page() ) : // Only display Excerpts for Search and Archive Pages ?>

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
		<div class="entry-content">
			<?php echo the_post_thumbnail(); ?>
		</div>
	<?php } ?>

<?php endif; ?>
