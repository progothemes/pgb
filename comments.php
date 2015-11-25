<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to pgb_comment() which is
 * located in the includes/template-tags.php file.
 *
 * @package pgb
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<?php tha_comments_before(); ?>
	<div id="comments" class="comments-area row" itemscope itemtype="http://schema.org/UserComments">

		<div class="col-md-12">

		<?php if ( have_comments() ) : ?>
			<header class="page-header">
				<h2 class="comments-title">
					<?php
						printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'pgb' ),
							number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
					?>
				</h2>
			</header>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h5 class="sr-only"><?php _e( 'Comment navigation', 'pgb' ); ?></h5>
				<ul class="pager">
					<li class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'pgb' ) ); ?></li>
					<li class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'pgb' ) ); ?></li>
				</ul>
			</nav><!-- #comment-nav-above -->
			<?php endif; // check for comment navigation ?>

			<ol class="comment-list media-list">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use pgb_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define pgb_comment() and that will be used instead.
					 * See pgb_comment() in includes/template-tags.php for more.
					 */
					wp_list_comments( array( 'callback' => 'pgb_comment', 'avatar_size' => 50 ) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="sr-only"><?php _e( 'Comment navigation', 'pgb' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'pgb' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'pgb' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

		<?php
			// If comments are closed and there are comments
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'pgb' ); ?></p>
		<?php endif; ?>

		<?php comment_form(); ?>

		</div>

	</div><!-- #comments -->
<?php tha_comments_after(); ?>