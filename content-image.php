<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package pgb
 */
?>

<?php // Add the class "panel" below here to wrap the content-padder in Bootstrap style
		// Simply replace post_class() with post_class('panel') below here ?>

<?php $the_post_meta = get_post_meta( get_the_ID() ); ?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php tha_entry_top(); ?>
	<header class="page-header">
	
		<?php 
			if ( is_single() || 'page' == get_post_type() ) :
				the_title( '<h1 class="page-title">', '</h1>' );
			else :
				the_title( '<h1 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php pgb_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search and Archive Pages ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>

		<?php if (has_post_thumbnail()) { ?>
			<div class="entry-content">
				<?php echo the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
			</div>
		<?php } ?>

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'pgb' ) );
				if ( $categories_list && pgb_categorized_blog() ) :
			?>
				<span class="cat-links">
					<?php printf( __( 'Posted in %1$s', 'pgb' ), $categories_list ); ?>
				</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'pgb' ) );
				if ( $tags_list ) :
			?>
				<span class="tags-links">
					<?php printf( __( 'Tagged %1$s', 'pgb' ), $tags_list ); ?>
				</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'pgb' ), __( '1 Comment', 'pgb' ), __( '% Comments', 'pgb' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'pgb' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->
<?php tha_entry_after(); ?>
