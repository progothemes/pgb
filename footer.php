<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package pgb
 */
?>
				
		</div><!-- close .row -->
	</div><!-- close .container -->
	<?php tha_content_after(); ?>
</div><!-- close .main-content -->

<!-- Footer widget area -->
<div class="footerwidgetarea">
	<div class="container">
		<div class="row">
			<?php 
				$metabox_custom_page_footer 	  = get_post_meta(get_the_ID(), 'pgb_metabox_page_footer_option')[0];
				$metabox_custom_page_footer_count = get_post_meta(get_the_ID(), 'pgb_custom_footer_layout')[0];
				$showFooter 					  = ot_get_option('pgb_footer');
				$footer_column 					  = ot_get_option('pgb_footer_column');

				if ( is_page() ) {
					if( $metabox_custom_page_footer == "default" ) {
						if( !empty( $showFooter ) && 'on' == $showFooter ) {
							if ( !empty( $footer_column )) {
								if ( $footer_column == 'default' ) {
										?>
										<div class="col-md-4">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
										<?php endif; ?>
										</div>
										<?php
									for ( $i = 2 ; $i <= 3; $i++) {
										?>
										<div class="col-md-4">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
										<?php endif; ?>
										</div>
										<?php
									}
								} else {
									$num = 12/$footer_column;
										?>
										<div class="col-md-<?php echo $num; ?>">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
										<?php endif; ?>
										</div>
										<?php
									for ( $i = 2 ; $i <= $footer_column; $i++) {
										?>
										<div class="col-md-<?php echo $num; ?>">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
										<?php endif; ?>
										</div>
										<?php
									}
								}
							}
						}
					} else if( $metabox_custom_page_footer == "custom" ) {
						$num = 12/$metabox_custom_page_footer_count;
							?>
							<div class="col-md-<?php echo $num; ?>">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
							<?php endif; ?>
							</div>
							<?php
						for ( $i = 2 ; $i <= $metabox_custom_page_footer_count; $i++) {
							?>
							<div class="col-md-<?php echo $num; ?>">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
							<?php endif; ?>
							</div>
							<?php
						}
					}
				} else if( !empty( $showFooter ) && 'on' == $showFooter ) {
					if ( !empty($footer_column)) {
						if ( $footer_column == 'default' ) {
								?>
								<div class="col-md-4">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
								<?php endif; ?>
								</div>
								<?php
							for ( $i = 2 ; $i <= 3; $i++) {
								?>
								<div class="col-md-4">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
								<?php endif; ?>
								</div>
								<?php
							}
			 			} else { 
							$num = 12/$footer_column;
								?>
								<div class="col-md-<?php echo $num; ?>">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
								<?php endif; ?>
								</div>
								<?php
							for ( $i = 2 ; $i <= $footer_column; $i++) {
								?>
								<div class="col-md-<?php echo $num; ?>">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
								<?php endif; ?>
								</div>
								<?php
							}
			 			} 
			 		} 
				}
			?>
		</div>
	</div>
</div>

<?php tha_footer_before(); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php tha_footer_top(); ?>
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">

				<div class="site-info">
					<?php do_action( 'pgb_credits' ); ?>
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'pgb' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'pgb' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'pgb' ), 'pgb', '<a href="#" rel="designer">ProGoBase</a>' ); ?>
				</div><!-- close .site-info -->

			</div>
		</div>
	</div><!-- close .container -->
	<?php tha_footer_bottom(); ?>
</footer><!-- close #colophon -->
<?php 
$headermenu = 'top'; //ot_get_option( 'pgb_headermenu' );
if ( !empty( $headermenu ) && ( 'left' == $headermenu || 'topleft' == $headermenu ) ) { ?>
 </div> <!-- page-content-wrapper -->
</div> <!-- #wrapper -->
<?php } ?>
<?php tha_footer_after(); ?>
<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>