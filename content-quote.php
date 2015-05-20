<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package pgb
 */


$the_post_meta = get_post_meta( get_the_ID() );

$the_post_format_meta = get_post_meta( get_the_ID(), '_postformats_meta_value_key', true );


$quote_name 	= ! empty( $the_post_format_meta['quote_source_name'] ) ? $the_post_format_meta['quote_source_name'] : false;
$quote_url 		= ! empty( $the_post_format_meta['quote_source_url'] ) ? $the_post_format_meta['quote_source_url'] : false;
$quote_title 	= ! empty( $the_post_format_meta['quote_source_title'] ) ? $the_post_format_meta['quote_source_title'] : false;
$quote_date 	= ! empty( $the_post_format_meta['quote_source_date'] ) ? $the_post_format_meta['quote_source_date'] : false;

$source_title = null;

$_quote_array = array();
$_quote = null;


if ( $quote_name )
	$_quote_array[] = sprintf( '<cite>%1$s</cite>', ( ! $quote_title && $quote_url ? sprintf( '<a href="%1$s">%2$s</a>', $quote_url, $quote_name ) : $quote_name ) );

if ( $quote_title ) {
	$source_title = sprintf( 'title="%1$s"', $quote_title );
	$_quote_array[] = sprintf( '<cite %1$s>%2$s</cite>', $source_title, ( $quote_url ? sprintf( '<a href="%1$s">%2$s</a>', $quote_url, $quote_title ) : $quote_title ) );
}

if ( $quote_date )
	$_quote_array[] = $quote_date;

$_quote = implode( ", ", $_quote_array );

$_quote = sprintf( '<footer>%1$s</footer>', $_quote );

?>

<?php if ( is_single() ) : // Only display Excerpts for Search and Archive Pages ?>

	<div class="entry-content col-md-12">

<?php else : ?>

	<div class="entry-summary col-md-12">

<?php endif; ?>
			
		<blockquote>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pgb' ) ); ?>
			<?php echo $_quote; ?>
		</blockquote>

		<?php if ( is_single() ) : // Only display Excerpts for Search and Archive Pages ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
					'after'  => '</div>',
				) );
			?>

		<?php endif; ?>
			
	</div><!-- .entry-summary -->
