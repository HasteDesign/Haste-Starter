<?php
/**
 * Haste Starter admin functions.
 *
 * @package  Haste Starter
 * @category Admin
 * @author   Haste
 * @version  1.0.0
 */

/**
 * Custom admin scripts and styles.
 */
function haste_starter_admin_scripts() {
	wp_enqueue_style( 'haste-starter-admin', get_template_directory_uri() . '/assets/css/admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'haste_starter_admin_scripts' );
add_action( 'login_enqueue_scripts', 'haste_starter_admin_scripts' );

/**
 * Remove logo from admin top bar.
 */
function haste_starter_admin_adminbar_remove_logo() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'haste_starter_admin_adminbar_remove_logo' );

/**
 * Custom admin footer text.
 */
function haste_starter_admin_footer() {
	echo date( 'Y' ) . ' - ' . get_bloginfo( 'name' );
}
add_filter( 'admin_footer_text', 'haste_starter_admin_footer' );

/**
 * Custom login logo URL.
 */
function haste_starter_admin_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'haste_starter_admin_logo_url' );

/**
 * Custom login logo title.
 */
function haste_starter_admin_logo_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'haste_starter_admin_logo_title' );
