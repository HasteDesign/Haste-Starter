<?php

/**
 * Load scripts and styles.
 *
 * @since 2.2.0
 */
function haste_starter_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Vendor Bundle
	wp_enqueue_script( 'haste-starter-bundle', $template_url . '/assets/js/vendor/bundle.min.js', array(), null, true );

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
 * Displays BrowserSync script
 */
function haste_starter_browser_sync() {
	if ( in_array( $_SERVER['HTTP_HOST'], array( 'localhost', '127.0.0.1', '127.0.1.1' ) ) ) {
		?>
		<script id="__bs_script__">
		//<![CDATA[
			document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.13'><\/script>".replace("HOST", location.hostname));
		//]]>
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'haste_starter_browser_sync' );
