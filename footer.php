<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package pgb
 */
$options = pgb_get_options();
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
				$metabox_custom_page_footer 	  = get_post_meta(get_the_ID(), 'metabox_page_footer_option', true);
				$metabox_custom_page_footer_count = get_post_meta(get_the_ID(), 'custom_footer_layout', true);
				$showFooter 					  = $options['footer'];
				$footer_column 					  = $options['footer_column'];

				if ( is_page() ) {
					if( $metabox_custom_page_footer == "default" ) {
						if( !empty( $showFooter ) && '1' == $showFooter ) {
							if ( !empty( $footer_column )) {
								if ( $footer_column == 'default' ) {
										?>
										<div class="col-sm-4">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
										<?php endif; ?>
										</div>
										<?php
									for ( $i = 2 ; $i <= 3; $i++) {
										?>
										<div class="col-sm-4">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
										<?php endif; ?>
										</div>
										<?php
									}
								} else {
									$num = 12/$footer_column;
										?>
										<div class="col-sm-<?php echo $num; ?>">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
										<?php endif; ?>
										</div>
										<?php
									for ( $i = 2 ; $i <= $footer_column; $i++) {
										?>
										<div class="col-sm-<?php echo $num; ?>">
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
							<div class="col-sm-<?php echo $num; ?>">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
							<?php endif; ?>
							</div>
							<?php
						for ( $i = 2 ; $i <= $metabox_custom_page_footer_count; $i++) {
							?>
							<div class="col-sm-<?php echo $num; ?>">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
							<?php endif; ?>
							</div>
							<?php
						}
					}
				} else if( !empty( $showFooter ) && '1' == $showFooter ) {
					if ( !empty($footer_column)) {
						if ( $footer_column == 'default' ) {
								?>
								<div class="col-sm-4">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
								<?php endif; ?>
								</div>
								<?php
							for ( $i = 2 ; $i <= 3; $i++) {
								?>
								<div class="col-sm-4">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer-widget-'.$i ) ) : ?>
								<?php endif; ?>
								</div>
								<?php
							}
			 			} else { 
							$num = 12/$footer_column;
								?>
								<div class="col-sm-<?php echo $num; ?>">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget') ) : ?>
								<?php endif; ?>
								</div>
								<?php
							for ( $i = 2 ; $i <= $footer_column; $i++) {
								?>
								<div class="col-sm-<?php echo $num; ?>">
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
				</div><!-- close .site-info -->

			</div>
		</div>
	</div><!-- close .container -->
	<?php tha_footer_bottom(); ?>
</footer><!-- close #colophon -->
<?php tha_footer_after(); ?>
<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>