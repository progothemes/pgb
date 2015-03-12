<?php
$topmenustyle = ''; $menuleftright = ''; $navid = '';
$header_menu 						= 'top'; //ot_get_option( 'pgb_headermenu' );
$topleft_menu_logo_position 		= ot_get_option( 'pgb_logo_postion_topleft' );
$topleft_menu_logo_inheader_align 	= ot_get_option( 'pgb_logo_headeralign_topleft' );
$topleft_menu_logo_inleft_align 	= ot_get_option( 'pgb_logo_leftmenualign_topleft' );
$topleft_sitetagline 				= ot_get_option( 'pgb_sitetagline_topleft' );
$topleft_sitetagline_location 		= ot_get_option( 'pgb_sitetagline_postion_topleft' );
$topleft_leftmenu_sitetagline_align = ot_get_option( 'pgb_sitetagline_leftmenualign_topleft' );
$topleft_header_sitetagline_align 	= ot_get_option( 'pgb_sitetagline_headeralign_topleft' );
$topleft_search_field 				= ot_get_option( 'pgb_search_topleft' );
$topleft_searchfield_location 		= ot_get_option( 'pgb_search_position_topleft' );
$topleft_searchfield_inleft 		= ot_get_option( 'pgb_searchfield_leftmenustyle_topleft' );
$topleft_searchfield_inheader_style = ot_get_option( 'pgb_searchfield_headerstyle_topleft' );

if ( !empty( $header_menu ) ) {

	// TOP+LEFT 
	if( "topleft" == $header_menu ) {
		$navid = 'topleft-top-nav';
		$navid2 = 'topleft-side-nav';
		$topmenustyle = 'navbar-fixed-top navbar-fixed-top-left';

		if( !empty( $topleft_menu_logo_position ) ) {
			if( 'inheader' == $topleft_menu_logo_position ) {
				if ( 'center' == $topleft_menu_logo_inheader_align ) {
					$logo_align_center = "logo-align-center logo-center";
					$logo_align_centr = "logo-align-center";
				}
			}
		}
		if ( !empty( $topleft_sitetagline ) ) {
			if ( 'inheader' == $topleft_sitetagline_location ) {
				if ( !empty( $topleft_header_sitetagline_align) && 'center' == $topleft_header_sitetagline_align ) {
					$logo_align_centr = "logo-align-center";
				}
			}
		}

		if ( !empty( $topleft_search_field ) && 'on' == $topleft_search_field ) {
			if( !empty( $topleft_searchfield_location ) && 'inheader' == $topleft_searchfield_location ) {
				if( !empty( $topleft_searchfield_inheader_style ) && 'icon' == $topleft_searchfield_inheader_style ) {
					$searchclass =  'search-form-icon';
				}
			}
		}

	}

} // end if ( !empty($header_menu) ) {
?>
	<nav id="main-nav" class="site-navigation <?php echo $leftmain; ?>">
						
		<div class="top-nav-menu navbar navbar-default  <?php echo $topmenustyle; ?>" role="navigation">
			<div  id="<?php echo $navid; ?>"  class="container nav-contain menu-container-width <?php echo $searchclass; ?>" >

				<div class="navbar-header <?php echo $logo_align_centr; ?>" >
					<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php
					if ( !empty( $header_menu ) ) {
						if( "topleft" == $header_menu ) {
							if( !empty( $topleft_menu_logo_position ) ) {

									$tagline = '';//rm-padding
								if( 'inheader' == $topleft_menu_logo_position ) {	
					?>
					<a class="navbar-brand <?php echo $logo_align_center; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php											
									if ( !empty( $topleft_menu_logo_inheader_align ) ) {

										if( 'left' == $topleft_menu_logo_inheader_align ) {
											$place = 'logoleft';
										}
										elseif ( 'center' == $topleft_menu_logo_inheader_align ) {
											$place = 'logocenter';
										}

									}

									echo pgb_get_logo( $place );
					?>
					</a>
					<?php
								}
							}


							if( !empty( $topleft_sitetagline ) && 'on' == $topleft_sitetagline ) {
								if( !empty( $topleft_sitetagline_location ) && 'inheader' == $topleft_sitetagline_location ) {
									if( !empty( $topleft_header_sitetagline_align ) ){

										$desc = get_bloginfo( 'description' );

										if( 'left' == $topleft_header_sitetagline_align ) {

											echo '<h4 class="site-description logoleft l-padding" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';

										} elseif( 'center' == $topleft_header_sitetagline_align ) {

											echo '<h4 class="site-description logocenter" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';
										}
									}
								}
							}


						}
					}
					?>
					

				</div>


			<!-- SEARCH-FORM -->
				<?php
					if ( !empty( $header_menu ) ) {
						if ( 'topleft' == $header_menu ) {
							if ( !empty( $topleft_search_field ) && 'on' == $topleft_search_field ) {
								if( !empty( $topleft_searchfield_location ) && 'inheader' == $topleft_searchfield_location ) {
									if( !empty( $topleft_searchfield_inheader_style ) && 'full' == $topleft_searchfield_inheader_style ) {
										get_template_part('partials/block', 'search' );
									}
								}
							}
						}
					}
				?>
				<?php
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'top-header-area' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'secondary',
							// 'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
							'menu_class' => 'nav navbar-nav navbar-right top-nav',
							'fallback_cb' => '',
							'menu_id' => 'secondary-menu',
							'walker' => new wp_bootstrap_navwalker()
						)
					);
				}
				?>

				<!-- SEARCH-FORM -->
				<?php
					if ( !empty( $header_menu ) ) {
						if ( 'topleft' == $header_menu ) {
							if ( !empty( $topleft_search_field ) && 'on' == $topleft_search_field ) {
								if( !empty( $topleft_searchfield_location ) && 'inheader' == $topleft_searchfield_location ) {
									if( !empty( $topleft_searchfield_inheader_style ) && 'icon' == $topleft_searchfield_inheader_style ) {
										get_template_part('partials/block', 'search' );
									}
								}
							}

		                }
			        } 
				?>
				
				<!-- </div> -->
			</div>
		</div><!-- .navbar -->

	</nav> <!-- .site-navigation -->
	<div  class="left-nav-menu side-nav-reveal sidebar-slide <?php echo $topmenustyle; ?>" role="navigation">
		<div class="collapse navbar-default navbar-collapse navbar-responsive-collapse">
			<div id="<?php echo $navid2; ?>" class="side-nav navbar-default">
									
				<?php
				if ( !empty( $header_menu ) ) {
					if( "topleft" == $header_menu ) {
						if( !empty( $topleft_menu_logo_position ) ) {

								$tagline = '';
							if( 'inleftmenu' == $topleft_menu_logo_position ) {
								if( 'topleft' == $topleft_menu_logo_inleft_align ) {
									echo pgb_get_logo( 'logoleft l-padding' );
								}
								elseif ( 'topcenter' == $topleft_menu_logo_inleft_align ) {
									echo pgb_get_logo( 'logocenter');
								}
							}


						}

						if( !empty( $topleft_sitetagline ) && 'on' == $topleft_sitetagline ) {
							if( !empty( $topleft_sitetagline_location ) && 'inleftmenu' == $topleft_sitetagline_location ) {
								if( !empty( $topleft_leftmenu_sitetagline_align ) ){

									$desc = get_bloginfo( 'description' );

									if( 'topleft' == $topleft_leftmenu_sitetagline_align ) {

										echo '<h4 class="site-description logoleft l-padding" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';

									} elseif( 'topcenter' == $topleft_leftmenu_sitetagline_align ) {

										echo '<h4 class="site-description logocenter" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';
									}
								}
							}
						}
					}
				}
				?>
				
				<!-- SEARCH-FORM TOP -->
				<?php
					if ( !empty( $header_menu ) ) {
						if ( 'topleft' == $header_menu ) {

							if ( !empty( $topleft_search_field ) && 'on' == $topleft_search_field ) {
								if( !empty( $topleft_searchfield_location ) && 'inleftmenu' == $topleft_searchfield_location ) {
									if ( !empty( $topleft_searchfield_inleft ) && 'top' == $topleft_searchfield_inleft ) {
										get_template_part('partials/block', 'search' );
									}
								}
							}

						}
					}
				?>

			<!-- The WordPress Menu goes here -->
			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					// 'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
					'menu_class' => 'nav navbar-nav navbar-default liwidth',//.$menuleftright,
					'fallback_cb' => '',
					'menu_id' => 'main-menu',
					'walker' => new wp_bootstrap_navwalker_collapse()
				)
			); ?>

			<!-- SEARCH-FORM -->
				<?php
					if ( !empty( $header_menu ) ) {
						if ( 'topleft' == $header_menu ) {

							if ( !empty( $topleft_search_field ) && 'on' == $topleft_search_field ) {
								if( !empty( $topleft_searchfield_location ) && 'inleftmenu' == $topleft_searchfield_location ) {
									if ( !empty( $topleft_searchfield_inleft ) && 'bottom' == $topleft_searchfield_inleft ) {
										get_template_part('partials/block', 'search' );
									}
								}
							}
						}
					}
				?>

			<?php
				if ( !empty( $header_menu ) ) {
					if( "topleft" == $header_menu ) {
						if( !empty( $topleft_menu_logo_position ) ) {

								$tagline = '';
							if( 'inleftmenu' == $topleft_menu_logo_position ) {
								if( 'bottomleft' == $topleft_menu_logo_inleft_align ) {
									echo pgb_get_logo( 'logoleft l-padding t-padding' );
								}
								elseif ( 'bottomcenter' == $topleft_menu_logo_inleft_align ) {
									echo pgb_get_logo( 'logocenter t-padding' );
								}
							}


						}

						if( !empty( $topleft_sitetagline ) && 'on' == $topleft_sitetagline ) {
							if( !empty( $topleft_sitetagline_location ) && 'inleftmenu' == $topleft_sitetagline_location ) {
								if( !empty( $topleft_leftmenu_sitetagline_align ) ){

									$desc = get_bloginfo( 'description' );

									if( 'bottomleft' == $topleft_leftmenu_sitetagline_align ) {

										echo '<h4 class="site-description logoleft l-padding" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';

									} elseif( 'bottomcenter' == $topleft_leftmenu_sitetagline_align ) {

										echo '<h4 class="site-description logocenter" >'. sprintf( __( '%s', 'pgb' ), $desc ) .'</h4>';
									}
								}
							}
						}
					}
				}
				?>
			</div>
		</div>
</div>