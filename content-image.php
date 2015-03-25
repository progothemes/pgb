<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package pgb
 */
?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">

<?php else : ?>

	<div class="entry-summary col-md-12">

<?php endif; ?>

		<?php if (has_post_thumbnail()) { ?>
			<?php echo the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
		<?php } ?>

	</div><!-- /entry -->

<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

<?php endif; ?>
