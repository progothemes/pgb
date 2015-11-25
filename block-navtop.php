<?php
/**
* block-navtop.php
*
* The NavTop block is visible on SM and larger screen sizes.On XS screens, menu items are moved into main nav.
*
* @return string
*/
$fixed = pgb_get_option( 'topnav_position', 'static' );
$topmenustyle = '';
$datafix = '';

if ( 'fixed' === $fixed ) {
	$topmenustyle = 'navbar-fixed-top';
	$datafix = 'data-spy="affix" data-offset-top="0"';
}

$topnav_width = pgb_get_option( 'topnav_width', 'container' );
switch ($topnav_width) {
	case 'container-fluid':
		$topmenustyle = 'navbar-static-top';
		$topnav_width_inner = 'container';
		break;
	case 'full':
		$topmenustyle = 'navbar-static-top';
		$topnav_width_inner = 'container-fluid';
		break;
	case 'container':
	default:
		$topnav_width_inner = 'container-fluid';
		break;
}


?>
<nav id="top-nav" class="navbar navbar-inverse site-navigation hidden-xs <?php echo $topmenustyle; ?> <?php echo $topnav_width; ?>" <?php echo $datafix; ?> >
	<div  class="<?php echo $topnav_width_inner; ?> nav-contain" role="navigation">
		<div class="navbar-inner">
			<?php if( '1' === pgb_get_option( 'nav_search' ) ) get_template_part( 'searchform', 'nav' ); // Show search form ?>
			<?php // Main Menu
			wp_nav_menu(
				array(
					'theme_location' => 'secondary',
					'container' => false,
					'menu_class' => 'nav navbar-nav navbar-right',
					'fallback_cb' => '',
					'menu_id' => 'top-menu',
					'walker' => new wp_bootstrap_navwalker()
				)
			);
			?>
		</div>
	</div>
</nav>