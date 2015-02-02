<?php
/**
 * Template Name: Page with no sidebar
 *
 * @package pgb
 */

get_header(); ?>

	<div id="content" class="main-content-inner col-sm-12 col-md-12">
		<?php tha_content_top(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		<?php tha_content_bottom(); ?>
	</div>

<?php get_footer(); ?>
