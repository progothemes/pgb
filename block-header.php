<?php

/**
 * Header Block - masthead
 *
 * This block renders below the Navbar and above site content
 *
 **/

?>

  <header id="masthead" class="site-header" role="banner">
    <?php tha_header_top(); ?>
      <div class="container">
        <div class="row">
          <div class="site-header-inner col-sm-12">

            <?php $header_image = get_header_image();
            if ( ! empty( $header_image ) ) { ?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
              </a>
            <?php } // end if ( ! empty( $header_image ) ) ?>


            <div class="site-branding">
              <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php printf( __( '%s', 'pgb' ), get_bloginfo( 'name' ) ); ?></a></h1>
              <h4 class="site-description"><?php $desc = get_bloginfo( 'description' ); printf( __( '%s', 'pgb' ), $desc ); ?></h4>
            </div>

          </div>
        </div>
      </div><!-- .container -->
    <?php tha_header_bottom(); ?>
  </header><!-- #masthead -->