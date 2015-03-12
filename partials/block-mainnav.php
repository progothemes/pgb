<?php
/**
 * Site navigation block
 *
 * @package pgb
 *
 */

$topmenustyle 					= '';
$menuleftright					= '';
$top_search_field 				= ot_get_option( 'pgb_search_top' );

// Static or Fixed navigation bar
$top_menu_position = ot_get_option('pgb_menu_position_top');
if ( !empty( $top_menu_position ) && 'fixed' == $top_menu_position ) {
		$topmenustyle = 'navbar-fixed-top top-nav-menu';
} else {
		$topmenustyle = 'navbar-static-top';
} 

// Search icon or field
if( 'on' == $top_search_field ) {
	$searchform = 'search-form-icon';
}

// Nav menu alignment
$top_menu_align = ot_get_option('pgb_menu_align_top');
if( !empty( $top_menu_align ) && 'right' == $top_menu_align ) {
		$menuleftright = 'navbar-nav-right';
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
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php echo pgb_get_logo( 'logoleft' ); ?>
					</a>
				</div>
				<?php
					if( ( !empty( $top_search_field ) && 'on' == $top_search_field ) ) {
						get_template_part('partials/block', 'search' );
					}
				?>


				<div class="collapse navbar-collapse navbar-responsive-collapse">
					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container_class' => 'top-view-primary-menu',
							'menu_class' => 'nav navbar-nav '.$menuleftright,
							'fallback_cb' => '',
							'menu_id' => 'main-menu',
							'walker' => new wp_bootstrap_navwalker()
						)
					);
					?>
				</div>
			</div>
		</div><!-- .navbar -->
	</nav> <!-- .site-navigation -->