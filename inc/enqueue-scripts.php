<?php

/**
 * Load scripts and styles.
 *
 * @since 1.0.0
 */
function haste_starter_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads main stylesheet
	wp_enqueue_style( 'haste-starter-main-style', get_stylesheet_uri() );

	// Loads main script
	wp_enqueue_script( 'haste-starter-main-script', $template_url . '/assets/dist/js/main.js', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'haste_starter_enqueue_scripts', 1 );

/**
 * Haste Starter custom stylesheet URI.
 *
 * @since 1.0.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function haste_starter_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/dist/css/main.css';
}
add_filter( 'stylesheet_uri', 'haste_starter_stylesheet_uri', 10, 2 );

/**
 * Enqueue LaravelMix LiveReload script
 */
function haste_starter_browser_sync() {
	if ( 'development' === wp_get_environment_type() ) {
		?>
		<script src="http://localhost:35729/livereload.js"></script>
		<?php
	}
}
add_action( 'wp_footer', 'haste_starter_browser_sync' );
