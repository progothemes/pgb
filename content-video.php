<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package pgb
 */
?>

<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		<?php pgb_block_linkpages(); ?>
	</div><!-- /entry -->

<?php else : ?>

	<div class="entry-summary col-md-12">
		<?php if ( pgb_get_video() ) { ?>
			<div class="embed-responsive-item">
				<p><?php echo do_shortcode( '[video src="' . pgb_get_video() . '"]' ); ?></p>
			</div>
		<?php } else { ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		<?php } ?>
	</div><!-- /entry -->

<?php endif; ?>