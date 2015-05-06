<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package pgb
 */
 
$options = pgb_get_options();

$topmenustyle 					= '';
$menuleftright					= '';

// Static or Fixed navigation bar
if ( !empty( $options['top_menu_position'] ) && 'fixed' == $options['top_menu_position']) {
		$topmenustyle = 'navbar-fixed-top top-nav-menu';
} else {
		$topmenustyle = 'navbar-static-top';
} 

// Nav menu alignment
if( !empty( $options['menu_align_top'] ) && 'right' == $options['menu_align_top'] ) {
		$menuleftright = 'navbar-nav-right';
}

 
?>
<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php tha_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php tha_head_bottom(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php tha_body_top(); ?>
<?php tha_header_before(); ?>
<?php do_action( 'before' ); ?>
<nav id="main-nav" class="navbar navbar-default site-navigation <?php echo $topmenustyle; ?>" >
  <div class="navbar-default container-fluid" role="navigation">
    <div  class="container nav-contain menu-container-width" >
      <div class="navbar-header"> 
        <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        
        <!-- Your site title as branding in the menu --> 
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <?php echo pgb_get_logo( 'logoleft' ); ?> </a> </div>
      <?php
					if( ( !empty( $options['search_top'] ) && '1' == $options['search_top'] ) ) {
					?>
      <form class="navbar-form" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="input-group">
          <input type="text" class="form-control pull-right" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pgb' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'pgb' ); ?>">
          <span class="input-group-btn">
          <button type="reset" class="btn btn-default"> <span class="fa fa-close"> <span class="sr-only">Close</span> </span> </button>
          <button type="submit" class="btn btn-default"> <span class="fa fa-search"> <span class="sr-only">Search</span> </span> </button>
          </span> </div>
      </form>
      <?php
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
  </div>
  <!-- .navbar --> 
</nav>
<!-- .site-navigation -->
<div id="page-content-wrapper" class="page-content-wrapper-left">
<header id="masthead" class="site-header" role="banner">
  <?php tha_header_top(); ?>
  <div class="container">
    <div class="row">
      <div class="site-header-inner col-sm-12">
        <?php $header_image = get_header_image();
						if ( ! empty( $header_image ) ) { ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt=""> </a>
        <?php } // end if ( ! empty( $header_image ) ) ?>
        <div class="site-branding">
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php printf( __( '%s', 'pgb' ), get_bloginfo( 'name' ) ); ?></a></h1>
          <h4 class="site-description">
            <?php $desc = get_bloginfo( 'description' ); printf( __( '%s', 'pgb' ), $desc ); ?>
          </h4>
        </div>
      </div>
    </div>
  </div>
  <!-- .container -->
  <?php tha_header_bottom(); ?>
</header>
<!-- #masthead -->

<?php tha_header_after();  ?>
<?php tha_content_before(); ?>
<div class="main-content">
<div class="container">
<div class="row">
