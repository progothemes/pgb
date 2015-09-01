<?php
/**
* block-mainnav.php
*
* @return string
*/

$topmenustyle           = '';
$menuleftright          = 'navbar-' . pgb_get_option('menu_align', 'right');

$avatar = '';
if ( is_user_logged_in() ) {
	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();
	$avatar = '<div class="navbar-text navbar-avatar navbar-right"><a title="Update My Profile" id="user-profile-link" href="' . get_edit_user_link( $user_id ) . '">' . get_avatar( $user_id, $size = '32' ) . '</a></div>';
}

// Static or Fixed navigation bar
$topmenustyle = sprintf( 'navbar-%s-top', pgb_get_option( 'nav_position', 'static' ) );

?>
<nav id="main-nav" class="navbar navbar-default site-navigation <?php echo $topmenustyle; ?>" >
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
				<?php if( pgb_get_option( 'nav_search' ) == '1' ) get_template_part( 'searchform', 'nav' ); // Show search form ?>
				<?php echo $avatar; ?>
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
			</div>

		</div>
	</div>
	<!-- .navbar --> 
</nav>
<!-- .site-navigation -->