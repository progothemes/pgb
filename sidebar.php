<?php
/**
 * The sidebar containing the main widget area
 *
 * @package pgb
 */
?>

	<div class="sidebar col-xs-12 col-sm-4 col-md-3">
		
		<?php tha_sidebars_before(); ?>
			<div class="sidebar-padder row">
				<?php tha_sidebar_top(); ?>
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

					<aside id="search" class="widget widget_search col-xs-6 col-sm-12">
						<?php get_search_form(); ?>
					</aside>

					<aside id="archives" class="widget widget_archive col-xs-6 col-sm-12">
						<h3 class="widget-title"><?php _e( 'Archives', 'pgb' ); ?></h3>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</aside>

					<aside id="meta" class="widget widget_meta col-xs-6 col-sm-12">
						<h3 class="widget-title"><?php _e( 'Meta', 'pgb' ); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</aside>

				<?php endif; ?>
				<?php tha_sidebar_bottom(); ?>
			</div><!-- close .sidebar-padder -->
		<?php tha_sidebars_after(); ?>

	</div>
