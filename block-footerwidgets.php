<?php
/**
 * Footer Widget Area
 *
 */

$metabox_custom_page_footer 	  = get_post_meta(get_the_ID(), 'metabox_page_footer_option', true);
$metabox_custom_page_footer_count = get_post_meta(get_the_ID(), 'custom_footer_layout', true);
$showFooter 					  = pgb_get_option( 'footer_show', '1' );
$footer_column 					  = pgb_get_option( 'footer_columns', '3' );

?>
<!-- Footer widget area -->
<div class="footerwidgetarea">
	<div class="container">
		<div class="row">
			<?php 
				if ( is_page() ) {
					if ( $metabox_custom_page_footer == "default" || ! isset($metabox_custom_page_footer) ) {
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
					} elseif ( $metabox_custom_page_footer == "custom" ) {
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
				} elseif ( !empty( $showFooter ) && '1' == $showFooter ) {
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
