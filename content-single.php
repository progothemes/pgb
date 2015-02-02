<?php
/**
 * @package pgb
 */
?>

<div class="entry-content">
	<?php the_content(); ?>
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
