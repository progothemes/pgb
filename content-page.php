<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package pgb
 */
?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php tha_entry_top(); ?>

		<header class="page-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'pgb' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php if (has_post_thumbnail()) { ?>
			<div>
				<?php echo the_post_thumbnail(); ?>
			</div>
		<?php } ?>
	
	<?php edit_post_link( __( 'Edit', 'pgb' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	
	<?php tha_entry_bottom(); ?>

</article><!-- #post-## -->
<?php tha_entry_after(); ?>