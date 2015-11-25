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
			printf( '<h1 class="page-title">%s</h1>', get_bloginfo( 'name' ) );
			printf( '<h3 class="page-sub-title">%s</h3>', get_bloginfo( 'description' ) );
		elseif ( is_single() || is_page() ) :
			the_title( '<h1 class="page-title">', '</h1>' );
			pgb_the_subtitle( '<h3 class="page-sub-title">', '</h3>' );
		elseif ( pgb_is_blog_page() ) :
			pgb_blog_page_title();
			pgb_get_the_subtitle( pgb_blog_page_id(), '<h3 class="page-sub-title">', '</h3>', true );
		elseif ( is_search() ) :
			printf( '<h1 class="page-title">%s%s</h1>', __( 'Search Results for: ', 'pgb' ), '<span>' . get_search_query() . '</span>' );
		elseif ( is_archive() ) :
			if ( is_category() ) {
				printf( '<h1 class="page-title">%s</h1>', single_cat_title( '', false ) );
			}
			elseif ( is_tag() ) {
				printf( '<h1 class="page-title">%s</h1>', single_tag_title( '', false ) );
			}
			elseif ( is_author() ) {
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				printf( '<h1 class="page-title">%s%s</h1>', __( 'Author: ', 'pgb' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			}
			elseif ( is_day() ) {
				printf( '<h1 class="page-title">%s%s</h1>', __( 'Day: ', 'pgb' ), '<span>' . get_the_date() . '</span>' );
			}
			elseif ( is_month() ) {
				printf( '<h1 class="page-title">%s%s</h1>', __( 'Month: ', 'pgb' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
			}
			elseif ( is_year() ) {
				printf( '<h1 class="page-title">%s%s</h1>', __( 'Year: ', 'pgb' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
			}
			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
				printf( '<h1 class="page-title">%s</h1>', __( 'Asides', 'pgb' ) );
			}
			elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				printf( '<h1 class="page-title">%s</h1>', __( 'Images', 'pgb') );
			}
			elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				printf( '<h1 class="page-title">%s</h1>', __( 'Videos', 'pgb' ) );
			}
			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				printf( '<h1 class="page-title">%s</h1>', __( 'Quotes', 'pgb' ) );
			}
			elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				printf( '<h1 class="page-title">%s</h1>', __( 'Links', 'pgb' ) );
			}
			else {
				printf( '<h1 class="page-title">%s</h1>', __( 'Archives', 'pgb' ) );
			}
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		else :
			the_title( '<h2 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			pgb_the_subtitle( '<h3 class="page-sub-title">', '</h3>' );
		endif;
	?><!-- .page-title -->
	<?php if ( 'post' == get_post_type() && is_single() ) : ?>
		<div class="entry-meta">
			<?php pgb_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</div>