<?php
/**
 * Custom template tags for Haste Starter.
 *
 * @package HasteStarter
 * @since 2.2.0
 */

if ( ! function_exists( 'haste_starter_classes_page_full' ) ) {

	/**
	 * Classes page full.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function haste_starter_classes_page_full() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'haste_starter_classes_page_sidebar' ) ) {

	/**
	 * Classes page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function haste_starter_classes_page_sidebar() {
		return 'col-md-9';
	}
}

if ( ! function_exists( 'haste_starter_classes_page_sidebar_aside' ) ) {

	/**
	 * Classes aside of page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function haste_starter_classes_page_sidebar_aside() {
		return 'col-md-3 hidden-xs hidden-print widget-area';
	}
}


/**
 * Open and close containers
 */


if ( ! function_exists( 'haste_starter_the_container' ) ) {

	function haste_starter_the_container( $type ) { ?>
		<?php if ( 'open' === $type ) { ?>

			<div class="container content-wrapper">
				<div class="row layout-row">

		<?php } elseif ( 'close' === $type ) { ?>

				</div>
			</div>

		<?php } ?>
	<?php } ?>
	<?php
}

if ( ! function_exists( 'haste_starter_open_content_wrapper' ) ) {

	function haste_starter_open_content_wrapper( $sidebar = false ) {

		haste_starter_the_container( 'open' );

		if ( true === $sidebar || 'sidebar' === $sidebar ) {
			?>
			<div class="<?php echo haste_starter_classes_page_sidebar(); ?>">
		<?php } else { ?>
				<div class="<?php echo haste_starter_classes_page_full(); ?>">
			<?php
		}
	}
}

if ( ! function_exists( 'haste_starter_close_content_wrapper' ) ) {

	function haste_starter_close_content_wrapper( $sidebar = false ) {
		?>
			</div>

			<?php
			if ( false !== $sidebar ) {
				get_sidebar( $sidebar );
			}

			haste_starter_the_container( 'close' );
	}
}


if ( ! function_exists( 'haste_starter_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function haste_starter_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', 'haste-starter' ) . ' </span>';
		}

		// Set up and print post meta information.
		printf(
			'<span class="entry-date">%s <time datetime="%s">%s</time></span> <span class="entry-byline byline">%s <span class="entry-author author vcard"><a class="url fn n" href="%s" rel="author">%s</a></span>.</span>',
			__( 'Posted in', 'haste-starter' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			__( 'by', 'haste-starter' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
}

if ( ! function_exists( 'haste_starter_paging_nav' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function haste_starter_paging_nav() {
		$mid  = 2;     // Total of items that will show along with the current page.
		$end  = 1;     // Total of items displayed for the last few pages.
		$show = false; // Show all items.

		echo haste_starter_pagination( $mid, $end, false );
	}
}

if ( ! function_exists( 'haste_starter_the_custom_logo' ) ) {

	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Haste Starter 1.0.0
	 */
	function haste_starter_the_custom_logo() {

		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';

		if ( function_exists( 'the_custom_logo' ) ) {

			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );

			if ( has_custom_logo() ) {

					echo '<img class="site-logo" alt="Logo ' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" src="' . esc_url( $logo[0] ) . '">';

			} else {
				echo haste_starter_custom_logo_name();
			}
		}
		echo '</a>';
	}
}

if ( ! function_exists( 'haste_starter_custom_logo_name' ) ) {
	function haste_starter_custom_logo_name() {
		if ( is_front_page() && is_home() ) {
			return '<h1 class="site-title">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</h1>';

		}
		return '<span class="site-title">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</span>';

	}
}


if ( ! function_exists( 'haste_starter_the_icon' ) ) {

	/**
	 * Displays inline SVG icons
	 *
	 * @param  string $file_name The SVG file name without the extesion
	 * @param  string $label     Descriptive label for accessibility
	 * @param  string $size      'base' = 1em, 'lg' = 1.5em, 'auto' = no resizing
	 * @return string            Echoes the icon HTML
	 */

	function haste_starter_the_icon( $file_name, $label = '', $size = 'base' ) {
		if ( empty( $label ) ) {
			$label = esc_html__( 'Ícone', 'haste_starter' );
		}

		echo '<span role="img" class="svg-icon icon-' . $size . ' ' . $file_name . '" aria-label="' . $label . '">';
		include get_template_directory() . '/assets/img/' . $file_name . '.svg';
		echo '</span>';
	}
}

if ( ! function_exists( 'haste_starter_the_svg' ) ) {
	/**
	 * Displays inline SVG images (without recoloring)
	 *
	 * @param  string $file_name The SVG file name without the extesion
	 * @param  string $label     Descriptive label for accessibility
	 * @return string            Echoes the icon HTML
	 */

	function haste_starter_the_svg( $args ) {
		if ( ! isset( $args['filename'] ) ) {
			return;
		}

		$filename = $args['filename'];
		$label    = isset( $args['label'] ) ? ' aria-label="' . $args['label'] . '"' : '';
		$classes  = ' class="svg-img svg-' . $args['filename'];
		$classes .= isset( $args['classes'] ) ? ' ' . $args['classes'] : '';

		echo '<span role="img"' . $classes . $label . '">';
		include get_template_directory() . '/assets/img/' . $filename . '.svg';
		echo '</span>';
	}
}
