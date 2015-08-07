<?php
/**
 * The template for displaying search form in pgb navbar
 *
 * @package pgb
 */
?>
<form class="navbar-form navbar-right" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="s">Search</label>
	<div class="input-group">
		<input type="search" class="form-control pull-right" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pgb' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'pgb' ); ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
				<span class="fa fa-search">
					<span class="sr-only">Search</span>
				</span>
			</button>
		</span>
	</div>
</form>