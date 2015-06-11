<?php
/**
* block-mainnav.php
*
* @return string
*/

$topmenustyle           = '';
$menuleftright          = 'navbar-' . pgb_get_option('menu_align', 'right');

// Static or Fixed navigation bar
if ( pgb_get_option( 'nav_position', 'static' ) == 'fixed' ) {
	$topmenustyle = 'navbar-fixed-top top-nav-menu';
} else {
	$topmenustyle = 'navbar-static-top';
} 

?>

<nav id="main-nav" class="navbar navbar-default site-navigation <?php echo $topmenustyle; ?>" >
	<div class="navbar-default container-fluid" role="navigation">
		<div  class="container nav-contain menu-container-width" >
			<div class="navbar-header"> 
				<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- Your site title as branding in the menu --> 
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <?php echo pgb_get_mobile_logo(); ?> </a>
			</div>
			<div class="collapse navbar-collapse navbar-responsive-collapse <?php esc_attr_e( $menuleftright ); ?>">
				
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

				<?php // Show search form
				if( pgb_get_option( 'nav_search' ) == '1' )
					get_search_form();
				?>

			</div>
		</div>
	</div>
	<!-- .navbar --> 
</nav>
<!-- .site-navigation -->
<?php pgb_block_navtop_after(); ?>