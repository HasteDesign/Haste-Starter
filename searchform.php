<?php
/**
 * The template for displaying search form.
 *
 * @package HasteStarter
 *
 */

?>


<form method="get" id="searchform" class="form-inline input-group" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" class="form-control" name="s" id="s" value="<?php echo get_search_query(); ?>" aria-label="<?php esc_attr_e( 'Search', 'haste_starter' ); ?>" />

	<div class="input-group-append">
		<button type="submit" class="btn btn-primary" value="<?php esc_attr_e( 'Search', 'haste-starter' ); ?>">
			<?php esc_attr_e( 'Search', 'haste-starter' ); ?>
		</button>
	</div>
</form>
