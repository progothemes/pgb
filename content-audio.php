<?php
/**
 * The template for displaying posts in the Audio (podcast) post format
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
		<?php if ( pgb_get_audio() ) { ?>
			<div class="embed-responsive-item">
				<p><?php echo do_shortcode( '[audio src="' . pgb_get_audio() . '"]' ); ?></p>
			</div>
		<?php } else { ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
		<?php } ?>
	</div><!-- /entry -->

<?php endif; ?>