<?php
/**
 * odin WooCommerce hooks
 *
 * @package HasteStarter
 */

/**
 * Remove native styles
 *
 */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Content wrapper before and after
 * @see  haste_starter_before_content()
 * @see  haste_starter_after_content()
 * @since  2.2.6
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'haste_starter_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'haste_starter_after_content', 10 );

/**
 * Remove sidebar
 *
 * Tip:
 * Case you use this action, change template page for full-width style in inc/woocommerce/functions.php
 *
 * @see woocommerce_sidebars
 * @since  2.2.6
 */
// remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Breadcrumb
 *
 * Use:
 * do_action( 'haste_starter_content_top' ); on anywhere for show the breadcrumb
 *
 * @see woocommerce_breadcrumb
 * @since  2.2.6
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'haste_starter_content_top', 'woocommerce_breadcrumb', 10 );

/**
 * Filters
 * @see  haste_starter_thumbnail_columns()
 * @see  haste_starter_products_per_page()
 * @see  haste_starter_loop_columns()
 * @since  2.2.6
 */
add_filter( 'woocommerce_product_thumbnails_columns', 	'haste_starter_thumbnail_columns' );
add_filter( 'loop_shop_per_page', 						'haste_starter_products_per_page' );
add_filter( 'loop_shop_columns', 						'haste_starter_loop_columns' );
