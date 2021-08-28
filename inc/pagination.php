<?php
/**
 * Pagination.
 *
 * @since 1.0.0
 *
 * @global array $wp_query   Current WP Query.
 * @global array $wp_rewrite URL rewrite rules.
 *
 * @param  int   $mid   Total of items that will show along with the current page.
 * @param  int   $end   Total of items displayed for the last few pages.
 * @param  bool  $show  Show all items.
 * @param  mixed $query Custom query.
 *
 * @return string       Return the pagination.
 */
function haste_starter_pagination( $mid = 2, $end = 1, $show = false, $query = null ) {

	// Prevent show pagination number if Infinite Scroll of JetPack is active.
	if ( ! isset( $_GET['infinity'] ) ) {

		global $wp_query, $wp_rewrite;

		$total_pages = is_object( $query ) && null !== $query ? $query->max_num_pages : $wp_query->max_num_pages;

		if ( $total_pages > 1 ) {
			$url_base  = $wp_rewrite->pagination_base;
			$arguments = haste_paginate_links_filters_args( $show, $total_pages, $end, $mid );

			$pagination = '<div class="pagination-wrap">' . paginate_links( $arguments ) . '</div>';

			// Prevents duplicate bars in the middle of the url.
			return $url_base ? str_replace( '//' . $url_base . '/', '/' . $url_base . '/', $pagination ) : $pagination;
		}
	}
}

/**
 * Return pagination links arguments.
 *
 * @param bool $show
 * @param int $total_pages
 * @param int $end
 * @param int $mid
 */
function haste_paginate_links_filters_args( $show, $total_pages, $end, $mid ) {
	$big = 999999999;

	// Sets the paginate_links arguments.
	return apply_filters(
		'haste_starter_pagination_args',
		array(
			'base'      => esc_url_raw( str_replace( $big, '%#%', get_pagenum_link( $big, false ) ) ),
			'format'    => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $total_pages,
			'show_all'  => $show,
			'end_size'  => $end,
			'mid_size'  => $mid,
			'type'      => 'list',
			'prev_text' => __( '&laquo; Previous', 'haste-starter' ),
			'next_text' => __( 'Next &raquo;', 'haste-starter' ),
		)
	);
}
