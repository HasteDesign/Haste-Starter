<?php
/**
 * Breadcrumbs.
 *
 * @since  2.2.0
 *
 * @param  string $homepage  Homepage name.
 *
 * @return string            HTML of breadcrumbs.
 */
function haste_starter_breadcrumbs( $homepage = '' ) {
	global $wp_query, $post, $author;
	$homepage = ! empty( $homepage ) ? $homepage : __( 'Home', 'haste-starter' );

	if ( ! is_home() && ! is_front_page() || is_paged() ) {

		// First level.
		echo '<ol id="breadcrumbs" class="breadcrumb">';
		echo '<li><a href="' . home_url() . '" rel="nofollow">' . $homepage . '</a></li>';

		// Single post.
		if ( is_single() && ! is_attachment() ) {

			// Checks if is a custom post type.
			if ( 'post' !== $post->post_type ) {
				$taxonomies = get_object_taxonomies( $post->post_type );

				// But if Woocommerce
				if ( 'product' === $post->post_type ) {
					haste_get_breadcrumb_wc( $post );
				} else {
					$post_type = get_post_type_object( $post->post_type );

					echo '<li><a href="' . get_post_type_archive_link( $post_type->name ) . '">' . $post_type->label . '</a></li> ';
				}

				if ( $taxonomies ) {
					// If is woocommerce product post type, $taxonomy already defined
					$taxonomy = $taxonomies[0];

					// Gets post terms.
					$terms = get_the_terms( $post->ID, $taxonomy );
					$term  = $terms ? array_shift( $terms ) : '';
					// Gets parent post terms.
					$parent_term = get_term( $term->parent, $taxonomy );

					haste_create_breadcrumb_parent( $term, $parent_term );
				}
			} else {
				$category = get_the_category();
				$category = $category[0];
				// Gets parent post terms.
				$parent_cat = get_term( $category->parent, 'category' );
				// Gets top term
				$cat_tree = get_category_parents( $category, false, ':' );
				$top_cat  = explode( ':', $cat_tree );
				$top_cat  = $top_cat[0];

				haste_create_breadcrumb_parent( $category, $top_cat );

				echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
			}

			haste_active_li( get_the_title() );
			// Single attachment.
		} else {
			haste_breadcrumb_attachment();

			// Page without parents.
			haste_breadcrumb_page();

			// category archives
			haste_breadcrumb_category_archive();

			// tag archives
			if ( is_tag() ) {
				printf( __( '%1$sTag: %2$s%3$s', 'haste-starter' ), haste_active_li( single_tag_title( '', false ) ) );
			}
		}
		// Custom post type archive.
	} else {
		// Check if Woocommerce Shop
		haste_breadcrumb_wc_archive();

		// Search page.
		if ( is_search() ) {
			printf( __( '%1$sSearch result for: &quot;%2$s&quot;%3$s', 'haste-starter' ), haste_active_li( get_search_query() ) );
		}
		// Author archive.
		haste_breadcrumb_author_archive();

		// Day archive.
		haste_breadcrumb_day_archive();

		// Archives per month.
		haste_breadcrumb_month_archive();

		// Archives per year.
		if ( is_year() ) {
			haste_active_li( get_the_time( 'Y' ) );
		}
		// Archive fallback for custom taxonomies.
		haste_breadcrumb_archive();

		// 404 page.
		if ( is_404() ) {
			haste_active_li( __( '404 Error', 'haste-starter' ) );
		}
	}

		// Gets pagination.
	if ( get_query_var( 'paged' ) ) {
		echo ' (' . sprintf( __( 'Page %s', 'haste-starter' ), get_query_var( 'paged' ) ) . ')';
	}

	echo '</ol>';
}


function breadcrumb_first_level() {
	$homepage = ! empty( $homepage ) ?? __( 'Home', 'haste-starter' );
	echo '<li><a href="' . home_url() . '" rel="nofollow">' . $homepage . '</a></li>';
}

/**
 * Create a link in the list for woocommerce
 *
 * @return HTML li with link
 */
function haste_get_breadcrumb_wc( $post ) {
	if ( 'product' === $post->post_type ) {
		if ( is_woocommerce_activated() ) {
			$shop_page = get_post( wc_get_page_id( 'shop' ) );
			echo '<li><a href="' . esc_url( get_permalink( $shop_page ) ) . '">' . get_the_title( $shop_page ) . '</a></li>';
		}
	}
}

function haste_create_breadcrumb_parent( $term_or_cat, $parent ) {
	if ( $term_or_cat ) {
		if ( $term_or_cat->parent ) {
			echo '<li><a href="' . get_term_link( $parent ) . '">' . $parent->name . '</a></li> ';
		}
		echo '<li><a href="' . get_term_link( $term_or_cat ) . '">' . $term_or_cat->name . '</a></li> ';
	}
}

/**
 * Create the breadcrumb for attachment
 *
 * @return HTML
 */
function haste_breadcrumb_attachment() {
	if ( is_attachment() ) {
		global $post;
		$parent   = get_post( $post->post_parent );
		$category = get_the_category( $parent->ID );
		$category = $category[0];

		echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';

		echo '<li><a href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a></li>';

		haste_active_li( get_the_title() );
	}

}

function haste_active_li( $content ) {
	$current_before = '<li class="active">';
	$current_after  = '</li>';

	echo $current_before . $content . $current_after;
}

/**
 * Create the breadcrumb for page and verify if the page with parents or not
 *
 * @return html
 */
function haste_breadcrumb_page() {
	global $post;
	if ( is_page() && ! $post->post_parent ) {
		haste_active_li( get_the_title() );
		return;
	}
		// Page with parents.
		$parent_id   = $post->post_parent;
		$breadcrumbs = array();

	while ( $parent_id ) {
		$page = get_post( $parent_id );

		$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a></li>';
		$parent_id     = $page->post_parent;
	}

		$breadcrumbs = array_reverse( $breadcrumbs );

	foreach ( $breadcrumbs as $crumb ) {
		echo $crumb . ' ';
	}
		haste_active_li( get_the_title() );
}

function haste_breadcrumb_category_archive() {
	global $wp_query;
	$category_object  = $wp_query->get_queried_object();
	$category_id      = $category_object->term_id;
	$current_category = get_category( $category_id );
	$parent_category  = get_category( $current_category->parent );

	// Displays parent category.
	if ( 0 !== $current_category->parent ) {
		$parents = get_category_parents( $parent_category, true, false );
		$parents = str_replace( '<a', '<li><a', $parents );
		$parents = str_replace( '</a>', '</a></li>', $parents );
		echo $parents;
	}

	printf( __( '%1$sCategory: %2$s%3$s', 'haste-starter' ), haste_active_li( single_cat_title( '', false ) ) );

}

/**
 * Create breadcrumb for woocommerce archive
 *
 * @return html
 */
function haste_breadcrumb_wc_archive() {
		// Check if Woocommerce Shop
	if ( is_woocommerce_activated() && is_shop() ) {
		$shop_page_id = wc_get_page_id( 'shop' );
		haste_active_li( get_the_title( $shop_page_id ) );
		return;
	}
	haste_active_li( post_type_archive_title( '', false ) );

}

function haste_breadcrumb_author_archive() {
	global $author;
	$userdata = get_userdata( $author );

	haste_active_li( __( 'Posted by', 'haste-starter' ) . ' ' . $userdata->display_name );
}

function haste_breadcrumb_day_archive() {
	echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';

	echo '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>';

	haste_active_li( get_the_time( 'd' ) );

}

function haste_breadcrumb_month_archive() {
	echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';

	haste_active_li( get_the_time( 'F' ) );

}

function haste_breadcrumb_archive() {
	global $wp_query;
	$current_object = $wp_query->get_queried_object();
	$taxonomy       = get_taxonomy( $current_object->taxonomy );
	$term_name      = $current_object->name;

	// Displays the post type that the taxonomy belongs.
	if ( ! empty( $taxonomy->object_type ) ) {
		// Get correct Woocommerce Post Type crumb
		if ( is_woocommerce() ) {
			$shop_page = get_post( wc_get_page_id( 'shop' ) );
			echo '<li><a href="' . esc_url( get_permalink( $shop_page ) ) . '">' . get_the_title( $shop_page ) . '</a></li>';
		} else {
			$_post_type = array_shift( $taxonomy->object_type );
			$post_type  = get_post_type_object( $_post_type );
			echo '<li><a href="' . get_post_type_archive_link( $post_type->name ) . '">' . $post_type->label . '</a></li> ';
		}
	}

	// Displays parent term.
	if ( 0 !== $current_object->parent ) {
		$parent_term = get_term( $current_object->parent, $current_object->taxonomy );

		echo '<li><a href="' . get_term_link( $parent_term ) . '">' . $parent_term->name . '</a></li>';
	}

	haste_active_li( $taxonomy->label . ': ' . $term_name );

}
