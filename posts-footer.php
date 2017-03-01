<?php
/**
 * The template for displaying post footer
 *
 * @package pgb
 */
?>

<footer class="entry-meta col-md-12">
	
	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
		
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'progo-base' ) );
			if ( $categories_list && pgb_categorized_blog() ) :
		?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'progo-base' ), $categories_list ); ?>
			</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'progo-base' ) );
			if ( $tags_list ) :
		?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'progo-base' ), $tags_list ); ?>
			</span>
		<?php endif; // End if $tags_list ?>
	
	<?php endif; // End if 'post' == get_post_type() ?>

	<?php if ( is_single() && comments_open() ) : ?>
		<span class="comments-link" title="<?php echo get_comments_number(); ?>"><?php comments_popup_link( __( 'Leave a comment', 'progo-base' ), __( '1 Comment', 'progo-base' ), __( '% Comments', 'progo-base' ) ); ?></span>
	<?php endif; ?>

	<?php edit_post_link( __( 'Edit', 'progo-base' ), '<span class="edit-link">', '</span>' ); ?>

</footer><!-- .entry-meta -->