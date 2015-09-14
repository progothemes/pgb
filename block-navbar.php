<?php
/**
* block-mainnav.php
*
* @return string
*/

$menuleftright          = 'navbar-' . pgb_get_option('menu_align', 'right');

// Static or Fixed navigation bar
$is_affix = ( 'fixed' === pgb_get_option( 'nav_position', 'static' ) ? true : false );
$menustyle = sprintf( 'navbar-%s-top', pgb_get_option( 'nav_position', 'static' ) );

?>
<nav id="main-nav" class="navbar navbar-default site-navigation <?php echo $menustyle; ?>" <?php echo ( $is_affix ? 'data-spy="affix" data-offset-top="0"' : '' ); ?> >
	<div class="container-fluid" role="navigation">
		<div  class="container nav-contain menu-container-width" ><!-- helper div/class for container width -->
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
				<?php // if ( '1' === pgb_get_option( 'nav_search' ) ) get_template_part( 'searchform', 'nav' ); // Show search form ?>
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
	</div>
	<!-- .navbar --> 
</nav>
<!-- .site-navigation -->