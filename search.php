<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package pgb
 */

get_header(); ?>

	<div id="content" class="main-content-inner col-sm-12 col-md-8 col-lg-9">

		<?php if ( have_posts() ) : ?>

			<div class="row">

				<div class="col-md-12">

					<header class="page-header">

						<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'pgb' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

					</header><!-- .page-header -->

				</div>

			</div>

			<?php // start the loop. ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php tha_entry_before(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

					<?php tha_entry_top(); ?>

					<?php get_template_part( 'posts', 'header' ); ?>

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

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; // end of loop. ?>

	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>