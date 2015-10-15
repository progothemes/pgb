<?php
/**
* block-mainnav.php
*
* @return string
*/

$menuleftright = 'navbar-' . pgb_get_option('menu_align', 'right');
$fixed = pgb_get_option( 'nav_position', false );
$menustyle = '';
$datafix = '';

if ( 'fixed' === $fixed ) {
	$menustyle = 'navbar-fixed-top';
	$datafix = 'data-spy="affix" data-offset-top="0"';
}

$navbar_width = pgb_get_option( 'navbar_width', 'container' );
switch ($navbar_width) {
	case 'container-fluid':
		$menustyle = 'navbar-static-top';
		$navbar_width_inner = 'container';
		break;
	case 'full':
		$menustyle = 'navbar-static-top';
		$navbar_width_inner = 'container-fluid';
		break;
	case 'container':
	default:
		$navbar_width_inner = 'container-fluid';
		break;
}

?>
<nav id="main-nav" class="navbar navbar-default site-navigation <?php echo $menustyle; ?> <?php echo $navbar_width; ?>" <?php echo $datafix; ?> >
	<div  class="<?php echo $navbar_width_inner; ?> nav-contain" role="navigation">
		<div class="navbar-header"> 
			<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- Your site title as branding in the menu --> 
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo pgb_get_logo(); ?></a>
		</div>
		<div class="collapse navbar-collapse navbar-responsive-collapse">
			<?php // Main Menu
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_class' => 'nav navbar-nav '. esc_attr( $menuleftright ),
					'fallback_cb' => '',
					'menu_id' => 'main-menu',
					'walker' => new wp_bootstrap_navwalker()
				)
			);
			?>
			<?php // Top Menu
			if ( has_nav_menu('secondary') )
				wp_nav_menu(
					array(
						'theme_location' => 'secondary',
						'container' => false,
						'menu_class' => 'nav navbar-nav visible-xs',
						'fallback_cb' => '',
						'menu_id' => 'top-menu',
						'walker' => new wp_bootstrap_navwalker()
					)
				);
			?>
		</div>

	</div>
	<!-- .navbar --> 
</nav>
<!-- .site-navigation -->