<?php
/**
 * Footer Widget Area
 *
 */

$show_footer = pgb_get_option( 'footer_show_widgets', '1' );

if( !empty( $show_footer ) && '1' == $show_footer ) { ?>
<!-- Footer widget area -->
<div id="footerwidgets" class="footerwidgetarea">
	<div class="container">
		<div class="row">
			<?php pgb_footer_widget_columns(); ?>
		</div>
	</div>
</div>
<?php } ?>