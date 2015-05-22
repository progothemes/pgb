<?php
/**
 * Posts previous/next block
 *
 * @return html
 */

if ( is_single() ) :

	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
		'after'  => '</div>',
	) );

endif;
?>