<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package pgb
 */

if ( ! function_exists( 'pgb_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function pgb_content_nav( $nav_id ) {
	global $wp_query, $post, $paged;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h3 class="sr-only"><?php ( is_single() ? _e( 'Post navigation', 'pgb' ) : _e( 'Page navigation', 'pgb' ) ); ?></h3>
		<ul class="pager">

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<li class="nav-previous previous" data-post-id="' . ( $previous ? $previous->ID : '' ) . '">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'pgb' ) . '</span> %title' ); ?>
			<?php next_post_link( '<li class="nav-next next" data-post-id="' .( $next ? $next->ID : '' ) . '">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'pgb' ) . '</span>' ); ?>

		<?php elseif ( $wp_query->max_num_pages >= 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<li class="nav-previous previous" data-page-number="<?php echo ( $paged < $wp_query->max_num_pages ? $paged+1 : $paged ); ?>"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'pgb' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="nav-next next" data-page-number="<?php echo ( $paged > 1 ? $paged-1 : $paged ); ?>"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?></li>
			<?php endif; ?>

		<?php endif; ?>

		</ul>
	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // pgb_content_nav


if ( ! function_exists( 'pgb_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function pgb_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'pgb' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'pgb' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<a class="pull-left" href="#">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</a>

			<div class="media-body">
				<div class="media-body-wrap panel panel-default">

					<div class="panel-heading">
						<h5 class="media-heading"><?php printf( __( '%s <span class="says">says:</span>', 'pgb' ), sprintf( '<cite class="fn" itemprop="name" >%s</cite>', get_comment_author_link() ) ); ?></h5>
						<div class="comment-meta">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'pgb' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'pgb' ), '<span class="edit-link">', '</span>' ); ?>
						</div>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pgb' ); ?></p>
					<?php endif; ?>

					<div class="comment-content panel-body" itemprop="commentText">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => 'div-comment',
								'depth' 	=> $depth,
								'max_depth' => $args['max_depth'],
								'before' 	=> '<footer class="reply comment-reply panel-footer">',
								'after' 	=> '</footer><!-- .reply -->'
							)
						)
					); ?>

				</div>
			</div><!-- .media-body -->

		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for pgb_comment()


add_action( 'comment_form_after', 'pgb_comments_after' );
if ( ! function_exists( 'pgb_comments_after' ) ) :
/**
 * After Comments
 */
function pgb_comments_after() {
	print '<script type="text/javascript"> jQuery(\'#commentform\').validate(); </script>';
}
endif;

if ( ! function_exists( 'pgb_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function pgb_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'pgb_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;


if ( ! function_exists( 'pgb_breadcrumbs' ) ) :
/**
 * Breadcrumbs
 *
 * @return HTML breadcrumbs
 * @since ProGo 0.6.3
 */
function pgb_get_breadcrumbs() {

	// Our breadcrumb trail
	$breadcrumb         = '';
	$bread              = array();
	// Settings
	$separator          = '';
	$breadcrumb_id      = 'breadcrumbs';
	$breadcrumb_class   = 'breadcrumb';
	$home_title         = 'Home';
	$error_404          = 'Error 404';
	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	$custom_taxonomy    = 'product_cat';
	// Get the query & post information
	global $post,$wp_query;

	// Do not display on the homepage
	if ( ! is_front_page() ) {

		// WooCommerce
		if ( function_exists('is_woocommerce') && is_woocommerce() ) {
			woocommerce_breadcrumb();
			return; // Exit breadcrumb function
		}

		$crumbs = array(
			'<a href="' . get_home_url() . '" title="' . $home_title . '" itemprop="item">'.
			'<span itemprop="name">' . $home_title . '</span></a>'
			);

		if ( is_archive() && !is_tax() && !is_category() && ! is_day() && ! is_month() && ! is_year() ) {
			$crumbs[] = '<span itemprop="name">' . post_type_archive_title( '', false ) . '</span>';
		}
		elseif ( is_archive() && is_tax() && !is_category() ) {
			// If post is a custom post type
			$post_type = get_post_type();
			// If it is a custom post type display name and link
			if ( $post_type != 'post' ) {
				$post_type_object  = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link( $post_type );
				$crumbs[] = '<a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '" itemprop="item">'.
					'<span itemprop="name">' . $post_type_object->labels->name . '</span></a></li>';
			}
			$custom_tax_name = get_queried_object()->name;
			$crumbs[] = '<span itemprop="name">' . $custom_tax_name . '</span>';
		}
		elseif ( pgb_is_blog_page() ) {
			if ( is_home() && get_option('page_for_posts') ) {
				$blog_page_id = get_option('page_for_posts');
				$blog_page_title = get_the_title( $blog_page_id );
				$crumbs[] = '<span itemprop="name">' . $blog_page_title . '</span>';
			}
		}
		elseif ( is_single() ) {
			// If post is a custom post type
			$post_type = get_post_type();
			// If it is a custom post type display name and link
			if ( $post_type != 'post' ) {
				$post_type_object = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link($post_type);
				$crumbs[] = '<a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '" itemprop="item">'.
					'<span itemprop="name">' . $post_type_object->labels->name . '</span></a>';
			}
			
			// Get post categories
			$categories = get_the_category();
			if ( is_array( $categories ) && ! empty( $categories ) ) {
				// Get last category post is in
				$category_vals = array_values( $categories );
				$last_category = end( $category_vals );
				// Get parent any categories and create array
				$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
				$cat_parents = explode( ',', $get_cat_parents);
				// Loop through parent categories and store in variable $cat_display
				$cat_display = array();
				foreach ( $cat_parents as $parents ) {
					$cat_display[] = '<span itemprop="name">'.$parents.'</span>';
				}
				// If it's a custom post type within a custom taxonomy
				$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
				if ( empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists ) {
					$taxonomy_terms  = get_the_terms( $post->ID, $custom_taxonomy );
					$cat_id		     = $taxonomy_terms[0]->term_id;
					$cat_nicename	 = $taxonomy_terms[0]->slug;
					$cat_link		 = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
					$cat_name		 = $taxonomy_terms[0]->name;
				}
				// Check if the post is in a category
				if ( ! empty( $last_category ) ) {
					$crumbs = array_merge( $crumbs, $cat_display );
					$crumbs[] = '<span itemprop="name">' . get_the_title() . '</span>';
				// Else if post is in a custom taxonomy
				}
				elseif( ! empty( $cat_id ) ) {
					$crumbs[] = '<a href="' . $cat_link . '" title="' . $cat_name . '" itemprop="item">'.
						'<span itemprop="name">' . $cat_name . '</span></a>';
					$crumbs[] = '<span itemprop="name">' . get_the_title() . '</span>';
				} else {
					$crumbs[] = '<span itemprop="name">' . get_the_title() . '</span>';
				}
			}
			else {
				$crumbs[] = '<span itemprop="name">' . get_the_title() . '</span>';
			}
		}
		elseif ( is_category() ) {
			// Category page
			$crumbs[] = '<span itemprop="name">' . single_cat_title('', false) . '</span>';
		}
		elseif ( is_page() ) {
			// Standard page
			if( $post->post_parent ){
				// If child page, get parents 
				$anc = get_post_ancestors( $post->ID );
				// Get parents in the right order
				$anc = array_reverse($anc);
				// Parent page loop
				$parents = array();
				foreach ( $anc as $ancestor ) {
					$parents[] = '<a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '" itemprop="item">'.
						'<span itemprop="name">' . get_the_title($ancestor) . '</span></a>';
				}
				// Display parent pages
				$crumbs = array_merge( $crumbs, $parents );
				// Current page
				$crumbs[] = '<span itemprop="name">' . get_the_title() . '</span>';
			} else {
				// Just display current page if not parents
				$crumbs[] = '<span itemprop="name">' . get_the_title() . '</span>';
			}
		}
		elseif ( is_tag() ) {
			// Tag page
			// Get tag information
			$term_id = get_query_var('tag_id');
			$taxonomy = 'post_tag';
			$args ='include=' . $term_id;
			$terms = get_terms( $taxonomy, $args );
			// Display the tag name
			$crumbs[] = '<span itemprop="name">' . $terms[0]->name . '</span>';
		}
		elseif ( is_day() ) {
			// Day archive
			// Year link
			$crumbs[] = '<a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '" itemprop="item">'.
				'<span itemprop="name">' . get_the_time('Y') . ' Archives</span></a>';
			// Month link
			$crumbs[] = '<a href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '" itemprop="item">'.
				'<span itemprop="name">' . get_the_time('M') . ' Archives</span></a>';
			// Day display
			$crumbs[] = '<span itemprop="name">' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span>';
		}
		elseif ( is_month() ) {
			// Month Archive
			// Year link
			$crumbs[] = '<a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '" itemprop="item">'.
				'<span itemprop="name">' . get_the_time('Y') . ' Archives</span></a>';
			// Month display
			$crumbs[] = '<span itemprop="name">' . get_the_time('M') . ' Archives</span>';
		}
		elseif ( is_year() ) {
			// Display year archive
			$crumbs[] = '<span itemprop="name">' . get_the_time('Y') . ' Archives</span>';
		}
		elseif ( is_author() ) {
			// Auhor archive
			// Get the author information
			global $author;
			$userdata = get_userdata( $author );
			// Display author name
			$crumbs[] = '<span itemprop="name">' . 'Author: ' . $userdata->display_name . '</span>';
		}
		elseif ( get_query_var('paged') ) {
			// Paginated archives
			$crumbs[] = '<span itemprop="name">'.__('Page') . ' ' . get_query_var('paged') . '</span>';
		}
		elseif ( is_search() ) {
			// Search results page
			$crumbs[] = '<span itemprop="name">Search results for: ' . get_search_query() . '</span>';
		}
		elseif ( is_404() ) {
			// 404 page
			$crumbs[] = '<span itemprop="name">' . $error_404 . '</span>';
		}

		// Build the breadcrums
		$n = count( $crumbs );
		$i = 1;
		foreach ( $crumbs as $crumb ) {
			$is_last = ( $i == $n ? 'class="active" ' : '' );
			$bread[] = '<li ' . $is_last . ' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . $crumb . '<meta itemprop="position" content="' . $i . '" /></li>';
			$i++;
		}
		$breadcrumb = implode( $separator, $bread );
		$breadcrumb = sprintf( '<ol id="%s" class="%s" itemscope itemtype="http://schema.org/BreadcrumbList">%s</ol>', $breadcrumb_id, $breadcrumb_class, $breadcrumb );
	}
	return $breadcrumb;
}
function pgb_breadcrumbs() {
	$breadcrumbs = pgb_get_breadcrumbs();
	print $breadcrumbs;
	return;
}
endif;


/**
 * WooCommerce Breadcrumbs need updating
 *
 * @since ProGo 0.8.0
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'pgb_woocommerce_breadcrumbs' );
function pgb_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<ol id="breadcrumbs" class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" itemprop="breadcrumb">',
		'wrap_after'  => '</ol>',
		'before'      => '<li class itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">',
		'after'       => '</li>',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	);
}
add_action( 'init', 'pgb_remove_wc_breadcrumbs' );
function pgb_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pgb_posted_on() {
	do_action( 'pgb_posted_on' );
}
add_action( 'pgb_posted_on', 'pgb_do_posted_on', 10 );
/* callback */
function pgb_do_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		$time_string
	);

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ){
		$time_string_update = '<time class="updated" datetime="%1$s">%2$s</time>';
		$time_string_update = sprintf( $time_string_update,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$time_string_update = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string_update
		);
		$time_string .= __(', updated on ', 'pgb') . $time_string_update;
	}
  // get_the_author stuff only works reliably inside The Loop
  // unless we grab $post->post_author
  global $post;
  $author_id = $post->post_author;
  $author_name = get_the_author_meta( 'nickname', $author_id );
  
	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'pgb' ),
		$time_string,
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_author_posts_url( $author_id ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'pgb' ), $author_name ) ),
			esc_html( $author_name )
		)
	);
}


if ( ! function_exists( 'pgb_rich_snippets' ) ) :
/**
 * Google Rich Snippets support
 * @since ProGo 0.6.2
 * @return image HTML
 */
add_action( 'wp_head', 'pgb_rich_snippets', 10 );
function pgb_rich_snippets() {

	global $post, $wp_query;
	$post_id = get_queried_object_id();
	$post_object = get_post( $post_id );

	/* Front Page */
	if ( is_front_page() ) {
		$front_page_snippet = array(
			"@context" => "http://schema.org",
			"@type" => ( get_option( 'rich_snippet_type', false ) ? get_option( 'rich_snippet_type', 'WebSite' ) : 'WebSite' ),
			"url" => get_bloginfo('url'),
			"name" => get_bloginfo( 'name' ),
			"logo" => pgb_get_logo( false ),
			);
		if ( pgb_includes_search() ) {
			$page_includes_search = array(
				"potentialAction" => array(
					"@type" => "SearchAction",
					"target" => get_bloginfo( 'url' ) . "/?s={search}",
					"query-input" => "required name=search"
					)
				);
			$front_page_snippet = array_merge( $front_page_snippet, $page_includes_search );
		}
		pgb_print_snippet( $front_page_snippet );
	}

	/* Search Results Page */
	elseif ( is_search() ) {
		$search_page_snippet = array(
			"@context" => "http://schema.org",
			"@type" => "SearchResultsPage",
			"url" => get_search_link(),
			"mainEntityOfPage" => array(
				"@type" => "SearchAction",
				"query" => get_search_query(),
				)
			);
		pgb_print_snippet( $search_page_snippet );
	}

	/* Blog Page */
	elseif ( pgb_is_blog_page() ) {
		$blog_page_snippet = array(
			"@type" => 'Blog',
			"url" => get_permalink( $post_id ),
			"BlogPost" => array(),
		);
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$blog_page_snippet["BlogPost"][] = array(
				"@type" => "BlogPosting",
				"headline" => get_the_title(),
				"datePublished" => get_the_date( "Y-m-d\TH:i:sP" ),
				"articleBody" => wp_strip_all_tags( get_the_content() ),
				);
		endwhile; endif;
		pgb_print_snippet( $blog_page_snippet );
	}

	/* Blog Post */
	if ( is_single() ) {
		$single_post_snippet = array(
			"@type" => 'BlogPosting',
			"url" => get_permalink( $post_id ),
			"headline" => get_the_title( $post_id ),
			"datePublished" => get_the_date( "Y-m-d\TH:i:sP", $post_id ),
			"articleBody" => wp_strip_all_tags( $post_object->post_content ),
			"author" => get_the_author_meta( 'user_nicename', $post_object->post_author ),
			);
		if ( has_post_thumbnail( $post_id ) ) {
			$post_thumbnail_id =  get_post_thumbnail_id( $post_id );
			$post_thumbnail = get_post( $post_thumbnail_id );
			$image_snippet = array(
				"image" => array(
					"@type" => "ImageObject",
					"contentUrl" => wp_get_attachment_url( $post_thumbnail_id ),
					"datePublished" => $post_thumbnail->post_date,
					"description" => $post_thumbnail->post_content,
					"name" => $post_thumbnail->post_title,
					)
				);
			$single_post_snippet = array_merge( $single_post_snippet, $image_snippet );
		}
		pgb_print_snippet( $single_post_snippet );
	}
}
endif;


if ( ! function_exists( 'pgb_print_snippet' ) ) :
/**
 * Prints the rich snippet JSON object to the page header
 *
 * @since ProGo 0.7.0
 * @param array $snippet
 * @return string JSON object script printed to wp_head
 */
function pgb_print_snippet( $snippet = false ) {
	if ( is_array( $snippet ) ) {
		$snippet = array_filter( $snippet );
		if ( version_compare( phpversion(), '5.4.0', '<' ) ) {
			$json = str_replace( '\\/', '/', json_encode( $snippet ) );
		} else {
			$json = json_encode( $snippet, JSON_UNESCAPED_SLASHES );
		}
		print( sprintf( '<script type="application/ld+json">%s</script>', $json ) );
	}
}
endif;


if ( ! function_exists( 'pgb_includes_search' ) ) :
/**
 * Check if page contains search
 *
 * @since ProGo 0.8.0
 * @param none
 * @return boolean If page includes search form return TRUE
 */
function pgb_includes_search() {

	global $post, $wp_query;
	$includes_search = false;

	if ( pgb_get_option( 'nav_search' ) == '1' ) $includes_search = true;
	
	if ( function_exists('wp_get_sidebars_widgets') ) {
		$sidebars_widgets = wp_get_sidebars_widgets();
		foreach ($sidebars_widgets as $sidebar_widget_array) {
			if ( is_array( $sidebar_widget_array ) && in_array( 'search-2', $sidebar_widget_array ) ) $includes_search = true;
		}
	}

	return $includes_search;
}
endif;



if ( ! function_exists( 'pgb_footer_widget_columns' ) ) :
/**
 * Render Footer Widget columns
 *
 * @since ProGo 0.9.0
 * @param none
 * @return HTML
 */
function pgb_footer_widget_columns() {
	$footer_columns = pgb_get_option( 'footer_widgets_columns', '4' );
	$n = 12 / $footer_columns;
	$classes = array();
	// Build column width classes
	for ( $i = 1 ; $i <= $footer_columns; $i++) {
		$class_xs = 'col-xs-12';
		$class_sm = 'col-sm-6';
		$class_md = 'col-md-' . $n;
		if ( ! ( $footer_columns % 2 == 0 ) && $i == 1 ) {
			$class_sm = 'col-sm-12'; // For odd number of columns, we will set the first one full width
		}
		$classes[$i] = $class_xs . ' ' . $class_sm . ' ' . $class_md;
	}
	// Render the widget areas
	for ( $i = 1 ; $i <= $footer_columns; $i++) { ?>
		<div class="<?php echo $classes[$i]; ?>">
			<?php 
				$n = ( $i == 1 ? '' : '-'.$i );
				dynamic_sidebar( 'footer-widget'.$n );
			?>
		</div>
	<?php }
}
endif;



/**
 * Returns true if a blog has more than 1 category
 */
function pgb_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so pgb_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so pgb_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in pgb_categorized_blog
 */
function pgb_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'pgb_category_transient_flusher' );
add_action( 'save_post',     'pgb_category_transient_flusher' );



if ( ! function_exists('pgb_remove_admin_bar') ) :
/**
 * Hide Admin bar from all non-Administrators
 *
 * @param none
 * @return none
 */
function pgb_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'pgb_remove_admin_bar');
endif;