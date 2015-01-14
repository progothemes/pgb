<?php 
$topleft_search_field 		  = ot_get_option('pgb_search_topleft');
$topleft_searchfield_location = ot_get_option( 'pgb_search_position_topleft' );

if ( !empty( $topleft_search_field ) && 'on' == $topleft_search_field ) {
	if( !empty( $topleft_searchfield_location ) && 'inleftmenu' == $topleft_searchfield_location ) {
		$searchformclass = "left";
	}
}
 ?>
<form class="navbar-form <?php echo $searchformclass; ?>" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="text" class="form-control pull-right" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pgb' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'pgb' ); ?>">
		<span class="input-group-btn">
			<button type="reset" class="btn btn-default">
				<span class="fa fa-close">
					<span class="sr-only">Close</span>
				</span>
			</button>
			<button type="submit" class="btn btn-default">
				<span class="fa fa-search">
					<span class="sr-only">Search</span>
				</span>
			</button>
		</span>
	</div>
</form>