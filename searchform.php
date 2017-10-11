<?php
/**
 * The template for displaying search form.
 *
 * @package odin
 *
 */

?>

<form method="get" id="searchform" class="form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" class="form-control" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search', 'haste-starter' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'haste-starter' ); ?>" />
	<button type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="<?php esc_attr_e( 'Search', 'haste-starter' ); ?>">
		<?php esc_attr_e( 'Search', 'haste-starter' ); ?>
	</button>
</form>
