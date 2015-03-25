<?php
/**
 * The default Single Post display
 *
 * @package pgb
 */
?>

<?php get_template_part( 'posts', 'images' ); ?>

<div class="entry-content col-md-12">
	
	<?php the_content(); ?>
	
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
			'after'  => '</div>',
		) );
	?>

</div><!-- .entry-content -->