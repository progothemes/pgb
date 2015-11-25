<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package pgb
 */
?><!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>

    <?php tha_head_top(); ?>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php tha_head_bottom(); ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php tha_body_top(); ?>
    <?php tha_header_before(); ?>
    <?php do_action( 'before' ); ?>

    <?php if ( has_nav_menu('secondary') || '1' === pgb_get_option( 'nav_search' ) ) pgb_block_navbartop(); ?>

    <?php pgb_block_navbar(); ?>

    <?php pgb_block_masthead(); ?>

    <?php tha_header_after();  ?>
    <div id="page-content-wrapper" class="page-content-wrapper-left">

        <?php tha_content_before(); ?>
        <div class="main-content">
            <div class="container">
                <div class="row">
