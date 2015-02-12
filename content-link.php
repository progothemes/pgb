<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package pgb
 */
?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search and Archive Pages ?>

	<div class="entry-summary">
		<?php //the_excerpt(); ?>
		
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

	</div><!-- .entry-summary -->

<?php else : ?>

	<div class="entry-content">

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

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

<?php endif; ?>
