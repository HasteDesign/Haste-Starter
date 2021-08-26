<?php
/**
 * General queries used to integrate this theme with WooCommerce.
 *
 * @package HasteStarter
 */

/**
 * Related Posts.
 *
 * Usage:
 * To show related by categories:
 * Add in single.php <?php haste_starter_related_posts(); ?>
 * To show related by tags:
 * Add in single.php <?php haste_starter_related_posts( 'tag' ); ?>
 *
 * @since  2.2.0
 *
 * @global array $post         WP global post.
 *
 * @param  string $display      Set category or tag.
 * @param  int    $qty          Number of posts to be displayed (default 4).
 * @param  string $title        Set the widget title.
 * @param  bool   $thumb        Enable or disable displaying images (default true).
 * @param  string $post_type    Post type (default post).
 *
 * @return string              Related Posts.
 */
function haste_starter_related_posts( $display = 'category', $qty = 4, $title = '', $thumb = true, $post_type = 'post' ) {
	global $post;
	$title    = ! empty( $title ) ?? __( 'Related Posts', 'haste-starter' );
	$show     = false;
	$post_qty = (int) $qty;

	// Creates arguments for WP_Query.
	if ( haste_related_posts_args( $display, $post, $post_qty, $post_type ) ) {
		$show = true;
		$args = haste_related_posts_args( $display, $post, $post_qty, $post_type );
	}

	if ( $show ) {

		$related = new WP_Query( $args );
		if ( $related->have_posts() ) {

			$layout = haste_starter_first_level_related_posts( $thumb, $title );

			while ( $related->have_posts() ) {
				$related->the_post();

				$layout .= haste_starter_thumb_related_posts( $thumb, $qty );
				$layout .= '<span class="text">';
				$layout .= sprintf( '<a href="%1$s" title="%2$s">%2$s</a>', esc_url( get_permalink() ), get_the_title() );
				$layout .= '</span>';

				$layout .= ( $thumb ) ? '</div>' : '</li>';
			}

			$layout .= ( $thumb ) ? '</div>' : '</ul>';
			$layout .= '</div>';

			echo $layout;
		}
		wp_reset_postdata();
	}
}


/**
 * Create thumbnail img tag with link of related posts
 *
 * @param mixed $thumb
 * @param mixed $qty
 *
 * @return [type]
 */
function haste_starter_thumb_related_posts( $thumb, $qty ) {
	$layout  = '';
	$layout .= ( $thumb ) ? '<div class="col-md-' . ceil( 12 / $qty ) . '">' : '<li>';

	if ( $thumb ) {
		if ( has_post_thumbnail() ) {
			$img = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
		} else {
			$img = '<img src="' . get_template_directory_uri() . '/assets/img/thumb-placeholder.jpg" alt="' . get_the_title() . '">';
		}
		// Filter to replace the image.
		$image = apply_filters( 'haste_starter_related_posts_thumbnail', $img );

		$layout .= '<span class="thumb">';
		$layout .= sprintf( '<a href="%s" title="%s" class="thumbnail">%s</a>', esc_url( get_permalink() ), get_the_title(), $image );
		$layout .= '</span>';
		return $layout;
	}
}

function haste_starter_first_level_related_posts( $thumb, $title ) {

	$layout  = '<div id="related-post">';
	$layout .= '<h3>' . esc_attr( $title ) . '</h3>';
	$layout .= ( $thumb ) ? '<div class="row">' : '<ul>';
	return $layout;
}

/**
 * args for display tag or category
 *
 * @param mixed $display
 * @param mixed $post
 * @param mixed $post_qty
 * @param mixed $post_type
 *
 * @return [type]
 */
function haste_related_posts_args( $display, $post, $post_qty, $post_type ) {
	$args = array(
		'post__not_in'        => array( $post->ID ),
		'posts_per_page'      => $post_qty,
		'post_type'           => $post_type,
		'ignore_sticky_posts' => 1,
	);

	$cat_or_tag = 'tag' === $display ? wp_get_post_tags( $post->ID ) : get_the_category( $post->ID );

	if ( $cat_or_tag ) {

		$ids = array();

		foreach ( $cat_or_tag as $ct ) {
			$ids[] = $ct->term_id;
		}

		$args = 'tag' === $display ? $args['tag__in'] = $ids : $args['category__in'] = $ids;
		return $args;
	}
	return false;
}
