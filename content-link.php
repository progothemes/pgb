<?php
/**
 * The template for displaying posts in the Link post format
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
		<?php if( pgb_get_link() ) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a href="<?php echo pgb_get_link(); ?>" target="_blank">
							<?php echo the_title(); ?>
						</a> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					</h3>
				</div>
				<div class="panel-body">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
				</div>
			</div><!-- /panel -->
		<?php } else { ?>
			<div class="entry-content col-md-12">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
				<?php pgb_block_linkpages(); ?>
			</div><!-- /entry -->
		<?php } ?>
	</div>

<?php endif; ?>