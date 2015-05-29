<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package pgb
 */
?>
				
		</div><!-- close .row -->
	</div><!-- close .container -->
	<?php tha_content_after(); ?>
</div><!-- close .main-content -->

<?php pgb_block_footerwidgets(); ?>

<?php tha_footer_before(); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php tha_footer_top(); ?>
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">

				<div class="site-info">
					<?php do_action( 'pgb_credits' ); ?>
				</div><!-- close .site-info -->

			</div>
		</div>
	</div><!-- close .container -->
	<?php tha_footer_bottom(); ?>
</footer><!-- close #colophon -->
<?php tha_footer_after(); ?>
<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>