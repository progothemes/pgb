<?php
/**
 * The template for displaying Archive pages.
 *
 *
 * @package pgb
 */

get_header(); ?>

	<?php if ( $template === 'left' ) get_sidebar(); ?>

	<div id="content" class="main-content-inner col-sm-12 <?php echo ( $template === 'full' ? 'col-md-12 col-lg-12' : 'col-md-8 col-lg-9' ); ?>">

		<?php tha_content_top(); ?>

		<?php // <!--The Loop ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php tha_entry_before(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

					<?php tha_entry_top(); ?>

					<?php pgb_block_post_title(); ?>

					<div class="col-md-12">

						<div class="row">

							<?php get_template_part( 'content', get_post_format() ); ?>

						</div>

					</div>

					<?php get_template_part( 'posts', 'footer' ); ?>

					<?php tha_entry_bottom(); ?>

				</article><!-- #post-## -->

				<?php tha_entry_after(); ?>

			<?php endwhile; ?>

			<?php pgb_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

	</div>

	<?php if ( ! $template || $template === 'right' ) get_sidebar(); ?>

<?php get_footer(); ?>
