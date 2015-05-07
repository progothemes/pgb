<?php
/**
 * block-mainnav.php
 *
 * @return string
 */

$options = pgb_get_options();

$topmenustyle           = '';
$menuleftright          = 'navbar-left';

// Static or Fixed navigation bar
if ( !empty( $options['top_menu_position'] ) && 'fixed' == $options['top_menu_position']) {
    $topmenustyle = 'navbar-fixed-top top-nav-menu';
} else {
    $topmenustyle = 'navbar-static-top';
} 

// Nav menu alignment
if( !empty( $options['menu_align_top'] ) && 'right' == $options['menu_align_top'] ) {
    $menuleftright = 'navbar-right';
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
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <?php echo pgb_get_logo(); ?> </a> </div>
      <div class="collapse navbar-collapse navbar-responsive-collapse">
        <?php // Show search form
        if( ( !empty( $options['search_top'] ) && '1' == $options['search_top'] ) )
          get_search_form();
        ?>
        <?php // Main Menu
        wp_nav_menu(
						array(
							'theme_location' => 'primary',
              'container' => false,
							//'container_class' => 'top-view-primary-menu',
							'menu_class' => 'nav navbar-nav '.$menuleftright,
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
