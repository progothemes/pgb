<?php 
$menu1 = '';
$menu2 = '';
$secondary_menu_position   = ot_get_option('pgb_secondary_header_menu_position_top');
$secondary_widget_position = ot_get_option('pgb_secondary_header_widget_position_top');

if ( !empty( $secondary_menu_position ) && 'right' == $secondary_menu_position ) {	
	$menu1 = 'right';
} else {
	$menu1 = 'left';
}
if ( !empty( $secondary_widget_position ) && 'right' == $secondary_widget_position ) {	
	$menu2 = 'right';
} else {
	$menu2 = 'left';
}


?>

<div class="col-md-6 <?php echo $menu1; ?>">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'secondary',
				'menu_class' => 'nav navbar-right top-nav',
				'fallback_cb' => '',
				'menu_id' => 'secondary-menu',
				'walker' => new wp_bootstrap_navwalker()
			)
		);
	?>
</div>
<div class="col-md-6 <?php echo $menu2; ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-sidebar') ) : ?>
	<?php endif; ?>
</div>