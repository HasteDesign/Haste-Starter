<?php
/**
 * Register theme supports.
 *
 * @package  Haste Starter
 * @category Supports
 * @author   Haste
 * @version  1.0.0
 *
 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
 */

if ( ! function_exists( 'haste_starter_load_textdomain' ) ) {
	/**
	 * Setup theme supported features.
	 */
	function haste_starter_load_textdomain() {

		// Add multiple languages support.
		load_theme_textdomain( 'haste-starter', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'haste_starter_load_textdomain' );

if ( ! function_exists( 'haste_starter_support_style' ) ) {
	/**
	 * Add support to editor style.
	 */
	function haste_starter_support_style() {
		add_theme_support( 'editor-styles' );

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || 'development' === wp_get_environment_type() ) {
			add_editor_style( 'assets/dist/css/editor.css' );
		} else {
			add_editor_style( 'assets/dist/css/editor.min.css' );
		}
	}
}
add_action( 'after_setup_theme', 'haste_starter_support_style' );

if ( ! function_exists( 'haste_starter_support_posts' ) ) {
	/**
	 * All supports related a post type
	 *
	 * @return [type]
	 */
	function haste_starter_support_posts() {
		// Add post_thumbnails suport.
		add_theme_support( 'post-thumbnails' );

		// Add feed link support.
		add_theme_support( 'automatic-feed-links' );
	}
}
add_action( 'after_setup_theme', 'haste_starter_support_posts' );

if ( ! function_exists( 'haste_starter_support_project' ) ) {
	/**
	 * All supports related to the project itself
	 *
	 * @return [type]
	 */
	function haste_starter_support_project() {
		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
	}
}
add_action( 'after_setup_theme', 'haste_starter_support_project' );

if ( ! function_exists( 'haste_starter_support_custom' ) ) {
	/**
	 * All supports related a custom configuration
	 */
	function haste_starter_support_custom() {
		// Add custom logo support.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Add support custom background support.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => '',
				'default-image' => '',
			)
		);
	}
}
add_action( 'after_setup_theme', 'haste_starter_support_custom' );

if ( ! function_exists( 'haste_starter_content_width' ) ) {
	/**
	 * Sets the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function haste_starter_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'haste_starter_content_width', 860 );
	}
}
add_action( 'after_setup_theme', 'haste_starter_content_width', 0 );

if ( ! function_exists( 'haste_starter_gutenberg_support' ) ) {
	/**
	 * Setup theme support.
	 * Most of the supports have been moved to the theme.json file
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/#backward-compatibility-with-add_theme_support
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
	 */
	function haste_starter_gutenberg_support() {
		/**
		 * Responsive embeds
		 * https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
		 */
		add_theme_support( 'responsive-embeds' );
	}
}
add_action( 'after_setup_theme', 'haste_starter_gutenberg_support' );
