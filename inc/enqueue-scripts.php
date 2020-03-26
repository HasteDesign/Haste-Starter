<?php

/**
 * Load scripts and styles.
 *
 * @since 2.2.0
 */
function haste_starter_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Loads main stylesheet file.
		wp_enqueue_style( 'haste-starter-main-style', $template_url . '/assets/css/main.css' );

		// Loads main script file.
		wp_enqueue_script( 'haste-starter-main-script', $template_url . '/assets/js/main.js', array(), null, true );

	} else {
		// Loads main stylesheet file compressed.
		wp_enqueue_style( 'haste-starter-main-style', get_stylesheet_uri() );

		// Loads main script file compressed.
		wp_enqueue_script( 'haste-starter-main-script', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Load Thread comments WordPress script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'haste_starter_enqueue_scripts', 1 );

/**
 * Haste Starter custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function haste_starter_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/main.css';
}
add_filter( 'stylesheet_uri', 'haste_starter_stylesheet_uri', 10, 2 );

/**
 * Enqueue LaravelMix LiveReload script
 */
function haste_starter_browser_sync() {
	if ( in_array( $_SERVER['HTTP_HOST'], array( 'localhost', '127.0.0.1', '127.0.1.1' ), true ) ) {
		?>
		<script src="http://localhost:35729/livereload.js"></script>
		<?php
	}
}
add_action( 'wp_footer', 'haste_starter_browser_sync' );
