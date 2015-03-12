<?php
/**
 * The sidebar containing the main widget area
 *
 * @package pgb
 */
?>

	<div class="sidebar col-sm-12 col-md-4 col-lg-3">
		
		<?php tha_sidebars_before(); ?>
			<div class="row">
				<?php tha_sidebar_top(); ?>
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

					<aside id="search" class="widget widget_search col-xs-12 col-sm-6 col-md-12">
						<div class="">
							<?php get_search_form(); ?>
						</div>
					</aside>

					<aside id="archives" class="widget widget_archive col-xs-12 col-sm-6 col-md-12">
						<div class="col-lg-12">
							<h3 class="widget-title"><?php _e( 'Archives', 'pgb' ); ?></h3>
							<ul>
								<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
							</ul>
						</div>
					</aside>

					<aside id="meta" class="widget widget_meta col-xs-12 col-sm-6 col-md-12">
						<div class="col-lg-12">
							<h3 class="widget-title"><?php _e( 'Meta', 'pgb' ); ?></h3>
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<?php wp_meta(); ?>
							</ul>
						</div>
					</aside>

				<?php endif; ?>
				<?php tha_sidebar_bottom(); ?>
			</div><!-- close .sidebar-padder -->
		<?php tha_sidebars_after(); ?>

	</div>
