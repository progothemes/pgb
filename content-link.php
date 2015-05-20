<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package pgb
 */


$the_post_meta = get_post_meta( get_the_ID() );

$the_post_format_meta = get_post_meta( get_the_ID(), '_postformats_meta_value_key', true );

?>

<?php if ( is_single() ) : ?>

	<div class="entry-content col-md-12">

<?php else : ?>

	<div class="entry-summary col-md-12">

<?php endif; ?>

	<?php if ( isset( $the_post_format_meta['link_title'] ) ) : ?>
		
		<div class="panel panel-default">
			
			<?php if ( get_the_content() ) { ?>
				
				<div class="panel-heading">
					<h3 class="panel-title">
						<a href="<?php echo $the_post_format_meta['link_url']; ?>" target="_blank"><?php echo ( ($the_post_format_meta['link_title']) ? $the_post_format_meta['link_title'] : ( (the_title('', '', false) ) ? : $the_post_format_meta['link_url'] ) ); ?></a> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					</h3>
				</div>
				<div class="panel-body">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
				</div>
			
			<?php } else { ?>
				
				<div class="panel-body">
					<h3 class="panel-title">
						<a href="<?php echo $the_post_format_meta['link_url']; ?>" target="_blank"><?php echo ($the_post_format_meta['link_title']) ? $the_post_format_meta['link_title'] : $the_post_format_meta['link_url']; ?></a> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					</h3>
				</div>
			
			<?php } ?>
		
		</div>

	<?php else : ?>

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>

	<?php endif; ?>

		<?php if ( is_single() ) : ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
					'after'  => '</div>',
				) );
			?>

		<?php endif; ?>

	</div><!-- /entry -->
