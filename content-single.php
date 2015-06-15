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
	<?php pgb_block_linkpages(); ?>
</div><!-- /entry -->