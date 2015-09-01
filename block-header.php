<?php

/**
 * Header Block - masthead
 *
 * This block renders below the Navbar and above site content
 *
 **/


?>
<header id="masthead" class="page-header" role="banner">
  <?php tha_header_top(); ?>
    <?php if( pgb_get_option( 'show_breadcrumb' ) == '1' ) pgb_block_breadcrumbs(); ?>
    <div class="container">
      <div class="row">
        <?php pgb_block_page_title(); ?>
      </div>
    </div><!-- .container -->
  <?php tha_header_bottom(); ?>
</header><!-- #masthead -->