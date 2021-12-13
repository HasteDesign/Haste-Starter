<?php
/**
 * Breadcrumbs.
 *
 * @since  1.0.0
 *
 * @param  string $homepage  Homepage name.
 *
 * @return string            HTML of breadcrumbs.
 */
function haste_starter_breadcrumbs( $homepage = '' ) {
	$homepage = ! empty( $homepage ) ? $homepage : __( 'Home', 'haste-starter' );

	// First level.
	breadcrumb_first_level( $homepage );

	// Single
	haste_breadcrumb_post_type_single();

	// Page
	haste_breadcrumb_page();

	// Attachment
	haste_breadcrumb_attachment();

	// Category archive
	haste_breadcrumb_category_archive();

	// Tag archive
	if ( is_tag() ) {
		printf( __( 'Tag: %1$s', 'haste-starter' ), haste_active_li( single_tag_title( '', false ), false ) );
	}

	// Search
	if ( is_search() ) {
		printf( __( 'Search result for: &quot;%1$s&quot;', 'haste-starter' ), haste_active_li( get_search_query(), false ) );
	}

	// Author archive.
	haste_breadcrumb_author_archive();

	// Day archive.
	haste_breadcrumb_day_archive();

	// Month archive
	haste_breadcrumb_month_archive();

	// Archives per year.
	if ( is_year() ) {
		haste_active_li( get_the_time( 'Y' ) );
	}

	// Archive fallback for custom taxonomies.
	haste_breadcrumb_archive();

	// 404 page.
	haste_breadcrumb_404();

	// Woocommerce
	haste_breadcrumb_wc_archive();

	// Final level
	breadcrumb_final_level();
}

/**
 * Return breadcrumb 404 item
 *
 * @return string
 */
function haste_breadcrumb_404() {
	return haste_active_li( __( '404 Error', 'haste-starter' ) );
}

/**
 * Return breadcrumb pagination item
 */
function haste_breadcrumb_pagination() {
	// Gets pagination.
	if ( get_query_var( 'paged' ) ) {
		echo ' (' . sprintf( __( 'Page %s', 'haste-starter' ), get_query_var( 'paged' ) ) . ')';
	}
}

/**
 * For breadcrumb when is a post type single
 */
function haste_breadcrumb_post_type_single() {
	if ( is_single() && ! is_attachment() ) {
		haste_breadcrumb_post_single();
		haste_active_li( get_the_title() );
		return;
	}
}


/**
 * The initial of breadcrumb list
 *
 * @param mixed $homepage
 *
 * @return [type]
 */
function breadcrumb_first_level( $homepage ) {
	echo '<ol id="breadcrumbs" class="breadcrumb">';
	echo '<li><a href="' . home_url() . '" rel="nofollow">' . $homepage . '</a></li>';
}

/**
 * The final of breadcrumb list
 *
 * @return [type]
 */
function breadcrumb_final_level() {
	// Gets pagination.
	haste_breadcrumb_pagination();

	echo '</ol>';
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

/**
 * Render li item if active
 *
 * @param [type] $content
 */
function haste_active_li( $content, $echo = true ) {
	$current_before = '<li class="active">';
	$current_after  = '</li>';

	if ( $echo ) {
		echo $current_before . $content . $current_after;
	} else {
		return $current_before . $content . $current_after;
	}
}

/**
 * Create the breadcrumb for page and verify if the page with parents or not
 *
 * @return html
 */
function haste_breadcrumb_page() {
	global $post;

	if ( is_page() ) {

		if ( ! $post->post_parent ) {
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
}

/**
 * Create breadcrumb li when is category archive
 *
 * @return [type]
 */
function haste_breadcrumb_category_archive() {
	if ( is_category() ) {
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

		haste_active_li( __( 'Category: ', 'haste-starter' ) . single_cat_title( '', false ) );
	}
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

/**
 * Get the author of archive
 *
 * @return [type]
 */
function haste_breadcrumb_author_archive() {
	global $author;

	if ( is_author() ) {
		$userdata = get_userdata( $author );
		haste_active_li( __( 'Posted by', 'haste-starter' ) . ' ' . $userdata->display_name );
	}
}

/**
 * Render breadcrumb for day archive
 */
function haste_breadcrumb_day_archive() {
	if ( is_day() ) {
		echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
		echo '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>';
		haste_active_li( get_the_time( 'd' ) );
	}
}

/**
 * Render breadcrumb for month archive
 */
function haste_breadcrumb_month_archive() {
	if ( is_month() ) {
		echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
		haste_active_li( get_the_time( 'F' ) );
	}
}

/**
 * Breadcrumb for generic archiver or custom taxonomies
 */
function haste_breadcrumb_archive() {
	global $wp_query;

	if ( ! is_category() && ! is_tag() && ! is_author() && ! is_search() && ! is_home() && is_archive() ) {
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
}

/**
 * Create the li when CPT is single
 *
 * @return [type]
 */
function haste_breadcrumb_cpt_single() {
	global $post;
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
}

/**
 * Render the single breadcrumb.
 */
function haste_breadcrumb_single() {
	$category = get_the_category();
	$category = $category[0];

	if ( 1 === $category->parent ) {
		// Gets parent post terms.
		$parent_cat = get_term( $category->parent, 'category' );
		// Gets top term
		$cat_tree = get_category_parents( $category, false, ':' );
		$top_cat  = explode( ':', $cat_tree );
		$top_cat  = $top_cat[0];

		haste_create_breadcrumb_parent( $category, $parent_cat );
		return;
	}

	echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
}

/**
 * Create a link to parent element
 *
 * @param [type] $term_or_cat
 * @param [type] $parent
 */
function haste_create_breadcrumb_parent( $term_or_cat, $parent ) {
	if ( $term_or_cat ) {
		if ( $term_or_cat->parent ) {
			echo '<li><a href="' . get_term_link( $parent ) . '">' . $parent->name . '</a></li> ';
		}
		echo '<li><a href="' . get_term_link( $term_or_cat ) . '">' . $term_or_cat->name . '</a></li> ';
	}
}

/**
 * Return 'haste_breadcrumb_single' if post type is post otherwise return 'haste_breadcrumb_cpt_single'
 *
 * @return [type]
 */
function haste_breadcrumb_post_single() {
	global $post;
	return 'post' === $post->post_type ? haste_breadcrumb_single() : haste_breadcrumb_cpt_single();
}
