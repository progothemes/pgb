<?php
/**
 * Template Name: Page with no sidebar
 */

get_header(); ?>
	
	</div><!-- close .main-content-inner -->
	<div class="col-sm-12 col-md-12">
	<?php while ( have_posts() ) : the_post(); ?>

		<?php tha_entry_before(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php tha_entry_top(); ?>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				
			<?php edit_post_link( __( 'Edit', 'pgb' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
			<?php tha_entry_bottom(); ?>
		</article><!-- #post-## -->
		<?php tha_entry_after(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			// if ( comments_open() || '0' != get_comments_number() )
			// 	comments_template();
		?>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>