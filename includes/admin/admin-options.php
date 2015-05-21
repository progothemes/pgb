<?php
/**
 * Renders Theme Options Page in WP Admin
 *
 */
?>
<div class="wrap" id="pgb_container">
<h2 class="pgb_name">ProGo Theme Options</h2>

	<div id="pgb-popup-save" class="pgb-save-popup">
		<div class="pgb-save-save">Options Updated</div>
	</div>
	
	<div id="pgb-popup-reset" class="pgb-save-popup">
		<div class="pgb-save-reset">Options Reset</div>
	</div>
	
	<div id="pgb-popup-fail" class="pgb-save-popup">
		<div class="pgb-save-fail">Error!</div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(pgb_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('pgb_ajax_nonce'); ?>" />

	<form id="pgb_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
	
		<div id="header">
		
			<div class="logo">
				
				<?php echo THEMENAME; ?> <span><?php echo ('v'. THEMEVERSION); ?></span>
			</div>
		
			<div id="js-warning">Warning- This options panel will not work properly without javascript!</div>
			<div class="clear"></div>
		
    	</div>

		<div id="info_bar">
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />

			<button id="pgb_save" type="button" class="button-primary">
				<?php _e('Save All Changes');?>
			</button>
			
		</div><!--.info_bar--> 	
		
		<div id="main">
		
			<div id="pgb-nav">
				<ul>
				  <?php echo $progobase_options->Menu ?>
				</ul>
			</div>

			<div id="content">
		  		<?php echo $progobase_options->Inputs ?>
		  	</div>
		  	
			<div class="clear"></div>
			
		</div>
		
		<div class="save_bar"> 
		
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id ="pgb_save" type="button" class="button-primary"><?php _e('Save All Changes');?></button>			
			<button id ="pgb_reset" type="button" class="button submit-button reset-button" ><?php _e('Options Reset');?></button>
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>admin/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
			
		</div><!--.save_bar--> 
 
	</form>
	
	<div style="clear:both;"></div>

</div><!--wrap-->
