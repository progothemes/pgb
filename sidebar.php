<?php
/**
 * The sidebar containing the main widget area
 *
 * @package pgb
 */
?>

	<div class="sidebar col-sm-12 col-md-3">
		
		<?php tha_sidebars_before(); ?>
			<div class="sidebar-padder">
				<?php tha_sidebar_top(); ?>
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

					<aside id="search" class="widget widget_search">
						<?php get_search_form(); ?>
					</aside>

					<aside id="archives" class="widget widget_archive">
						<h3 class="widget-title"><?php _e( 'Archives', 'pgb' ); ?></h3>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</aside>

					<aside id="meta" class="widget widget_meta">
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
