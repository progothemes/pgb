<?php
/**
 * Template part to display the post/page header
 *
 * @package pgb
 */
?>

<div class="col-md-12">
	<?php
		if ( is_front_page() ) :
			echo sprintf( '<h1 class="page-title">%s</h1>', get_bloginfo( 'name' ) );
			echo sprintf( '<h3 class="page-sub-title">%s</h3>', get_bloginfo( 'description' ) );
		elseif ( is_single() || is_page() ) :
			the_title( '<h1 class="page-title">', '</h1>' );
			the_subtitle( '<h3 class="page-sub-title">', '</h3>' );
		elseif ( is_blog_page() ):
			blog_page_title();
			get_the_subtitle( blog_page_id(), '<h3 class="page-sub-title">', '</h3>', true );
		else :
			the_title( '<h2 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			the_subtitle( '<h3 class="page-sub-title">', '</h3>' );
		endif;
	?><!-- .page-title -->
	<?php if ( 'post' == get_post_type() && is_single() ) : ?>
		<div class="entry-meta">
			<?php pgb_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</div>