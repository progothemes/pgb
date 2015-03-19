<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package pgb
 */
?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php if ( is_single() ) : ?>

	<div class="entry-content">

<?php else : ?>

	<div class="entry-summary">

<?php endif; ?>
		
		<div class="panel panel-default">
			
			<?php if ( get_the_content() ) { ?>
				
				<div class="panel-heading">
					<h3 class="panel-title">
						<a href="<?php echo $the_post_meta['_format_link_url'][0]; ?>" target="_blank"><?php echo ( ($the_post_meta['_format_link_title'][0]) ? $the_post_meta['_format_link_title'][0] : ( (the_title('', '', false) ) ? : $the_post_meta['_format_link_url'][0] ) ); ?></a> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					</h3>
				</div>
				<div class="panel-body">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
				</div>
			
			<?php } else { ?>
				
				<div class="panel-body">
					<h3 class="panel-title">
						<a href="<?php echo $the_post_meta['_format_link_url'][0]; ?>" target="_blank"><?php echo ($the_post_meta['_format_link_title'][0]) ? $the_post_meta['_format_link_title'][0] : $the_post_meta['_format_link_url'][0]; ?></a> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					</h3>
				</div>
			
			<?php } ?>
		
		</div>

		<?php if ( is_single() ) : ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
					'after'  => '</div>',
				) );
			?>

		<?php endif; ?>

	</div><!-- /entry -->
