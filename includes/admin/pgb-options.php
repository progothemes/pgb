<?php

add_action('init','pgb_options');

if (!function_exists('pgb_options'))
{
	function pgb_options()
	{	

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $pgbo_options;
$pgbo_options = array();
$theme_path = get_template_directory_uri();

$pgbo_options[] = array( "name" 		=> "Home Settings",
						"type" 		=> "heading"
				);
					

$pgbo_options[] = array("name" 		=> "Default ProGo Theme",
						"desc" 		=> "Select the Bootstrap theme from the available list of themes",
						"id" 		=> "bootstrap_theme",
						"std" 		=> 'default',
						"type" 		=> "select",
						"options"	=> array('default'		=> 'Default',
											 'cerulean'		=> 'Cerulean',
											 'cosmo'		=> 'Cosmo',
											 'cyborg'		=> 'Cyborg',
											 'darkly'		=> 'Darkly',
											 'flatly'		=> 'Flatly',
											 'journal'		=> 'Journal',
											 'lumen'		=> 'Lumen',
											 'paper'		=> 'Paper',
											 'readable'		=> 'Readable',
											 'sandstone'	=> 'Sandstone',
											 'simplex'		=> 'Simplex',
											 'slate'		=> 'Slate',
											 'spacelab'		=> 'Spacelab',
											 'superhero'	=> 'Superhero',
											 'united'		=> 'United',
											 'yeti'			=> 'Yeti')
				);

$pgbo_options[] = array("name" 		=> "Page Container Width",
						"desc" 		=> "Set site­wide default container size",
						"id" 		=> "container_width",
						"std" 		=> 'default',
						"type" 		=> "select",
						"options"	=> array('default'		=> 'Default',
											 'full'			=> 'Full Width (100%)',
											 '1366px'		=> '1366px',
											 '1240px'		=> '1240px',
											 '1170px'		=> '1170px',
											 '1080px'		=> '1080px',
											 '960px'		=> '960px')
				);

$pgbo_options[] = array("name" 		=> "Navbar Position",
						"desc" 		=> "Select navbar position: <br/>Fixed - remains visible regardless of scroll <br/>Static - remains at top of content area so can be hidden on scroll",
						"id" 		=> "menu_position_top",
						"std" 		=> 'static',
						"type" 		=> "select",
						"options"	=> array('static'		=> 'Static',
											 'fixed'		=> 'Fixed')
				);

$pgbo_options[] = array("name" 		=> "Menu Align",
						"desc" 		=> "Select whether the menu will be left aligned or right aligned. Default: Left",
						"id" 		=> "menu_align_top",
						"std" 		=> 'right',
						"type" 		=> "radio",
						"options"	=> array('left'		=> 'Left',
											 'right'	=> 'Right')
				);

$pgbo_options[] = array("name" 		=> "Show Search Field",
						"desc" 		=> "Displays the search field",
						"id" 		=> "search_top",
						"std" 		=> '1',
						"off"		=> "No",
						"on"		=> "Yes",
						"type" 		=> "switch",
						"folds"		=> true
				);

$pgbo_options[] = array("name" 		=> "Desktop Logo",
						"desc" 		=> "Upload the website logo for desktop view. (supports PNG, JPEG, GIF).",
						"id" 		=> "logo_image",
						"std" 		=> '',
						"type" 		=> "media"
				);

$pgbo_options[] = array("name" 		=> "Mobile / Navbar Logo",
						"desc" 		=> "Upload the website logo for mobile view. (supports PNG, JPEG, GIF; max height 50px).",
						"id" 		=> "mobile_logo",
						"std" 		=> '',
						"type" 		=> "media"
				);

$pgbo_options[] = array("name" 		=> "Footer Section",
						"desc" 		=> "Select whether to display footer or not.",
						"id" 		=> "footer",
						"std" 		=> '1',
						"type" 		=> "switch",
						"folds"		=> true
				);

$pgbo_options[] = array("name" 		=> "Footer Column",
						"desc" 		=> "Select the number of footer columns to display. <br/> Default : 3",
						"id" 		=> "footer_column",
						"std" 		=> 'default',
						"type" 		=> "select",
						"fold"		=> "footer",
						"options"	=> array('default'	=> 'Default',
											 1			=> '1',
											 2			=> '2',
											 3			=> '3',
											 4			=> '4')
				);
				
// Backup Options
$pgbo_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$pgbo_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "pgb_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$pgbo_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "pgb_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
	}//End function: of_options()
}//End chack if function exists: of_options()
?>