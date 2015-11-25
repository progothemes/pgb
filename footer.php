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
	
	<?php pgb_block_footercopyright(); ?>

<?php tha_footer_after(); ?>

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>