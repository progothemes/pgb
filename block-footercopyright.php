<?php
/**
 * Footer Copyright Area
 *
 */

$show_footer_copyright = pgb_get_option( 'footer_show_copyright', false );
$default_copyright = 'Copyright &copy; ' . date( 'Y' ) . ' - ' . get_bloginfo( 'name' );

if( !empty( $show_footer_copyright ) && '1' === $show_footer_copyright ) { ?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php tha_footer_top(); ?>
	<div class="container">
		<div class="row">
			<?php if ( ! dynamic_sidebar( 'footer-copyright-right' ) ) : ?>
				<div class="col-xs-12 col-sm-12 col-md-6 pull-right text-right">
					<?php 
					wp_nav_menu( 
						array( 
							'theme_location' => 'footer',
							'container' => false,
							'menu_class' => 'list-inline navbar-right',
							'fallback_cb' => '',
							'depth' => 1,
							'walker' => new wp_bootstrap_navwalker()
							) 
						); 
					?>
				</div>
			<?php endif; ?>
			<?php if ( ! dynamic_sidebar( 'footer-copyright-left' ) ) : ?>
				<div class="col-xs-12 col-sm-12 col-md-6 pull-left">
					<div class="site-copyright">
						<?php echo pgb_get_option( 'footer_copyright_text', $default_copyright ); ?>
					</div><!-- close .site-info -->
				</div>
			<?php endif; ?>
		</div>
	</div><!-- close .container -->
	<?php tha_footer_bottom(); ?>
</footer><!-- close #colophon -->
<?php } ?>