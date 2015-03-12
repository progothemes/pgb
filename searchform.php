<?php
/**
 * The template for displaying search forms in pgb
 *
 * @package pgb
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="s">Search</label>
	<div class="input-group">
		<input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pgb' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'pgb' ); ?>">
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
