<?php
/**
 * Template part to display the post/page header
 *
 * @package pgb
 */
?>

<header class="page-header col-md-12">
	
	<?php
		if ( is_single() || is_page() ) :
			the_title( '<h1 class="page-title">', '</h1>' );
		else :
			the_title( '<h2 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
	?>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php pgb_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

</header><!-- .entry-header -->