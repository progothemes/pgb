<?php
/**
 * Template part to display the post/page header
 *
 * @package pgb
 */
?>

<div class="col-md-12">
	<?php
		if ( is_single() || is_page() ) :
			the_title( '<h1 class="page-title">', '</h1>' );
			the_subtitle( '<h3 class="page-sub-title">', '</h3>' );
		elseif ( is_blog_page() ):
			blog_page_title();
			get_the_subtitle( blog_page_id(), '<h3 class="page-sub-title">', '</h3>', true );
		else :
			the_title( '<h2 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			the_subtitle( '<h3 class="page-sub-title">', '</h3>' );
		endif;
	?>
</div>