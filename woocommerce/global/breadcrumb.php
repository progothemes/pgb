<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo $wrap_before;

	$n = count( $breadcrumb );
	$i = 1;
	foreach ( $breadcrumb as $key => $crumb ) {

		$is_last = ( $i == $n ? 'class="active" ' : '' );

		echo str_replace('class', $is_last, $before);

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '"><span itemprop="name">' . esc_html( $crumb[0] ) . '</span></a><meta itemprop="position" content="' . $i . '" />';
		} else {
			echo '<span itemprop="name">' . esc_html( $crumb[0] ) . '</span><meta itemprop="position" content="' . $i . '" />';
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}

		$i++;

	}

	echo $wrap_after;

}