<?php
/**
 * Haste Starter admin functions.
 */

/**
 * Custom admin scripts.
 */
function haste_starter_admin_scripts() {
	wp_enqueue_style( 'haste-starter-admin', get_template_directory_uri() . '/assets/css/admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'haste_starter_admin_scripts' );
add_action( 'login_enqueue_scripts', 'haste_starter_admin_scripts' );

/**
 * Remove logo from admin bar.
 */
function haste_starter_admin_adminbar_remove_logo() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'wp-logo' );
}

add_action( 'wp_before_admin_bar_render', 'haste_starter_admin_adminbar_remove_logo' );

/**
 * Custom Footer.
 */
function haste_starter_admin_footer() {
	echo date( 'Y' ) . ' - ' . get_bloginfo( 'name' );
}

add_filter( 'admin_footer_text', 'haste_starter_admin_footer' );

/**
 * Custom logo URL.
 */
function haste_starter_admin_logo_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'haste_starter_admin_logo_url' );

/**
 * Custom logo title.
 */
function haste_starter_admin_logo_title() {
	return get_bloginfo( 'name' );
}

add_filter( 'login_headertitle', 'haste_starter_admin_logo_title' );

/**
 * Remove widgets dashboard.
 */
function haste_starter_admin_remove_dashboard_widgets() {
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

	// Yoast's SEO Plugin Widget
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );
}

add_action( 'wp_dashboard_setup', 'haste_starter_admin_remove_dashboard_widgets' );

/**
 * Remove Welcome Panel.
 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );
