<?php
/**
 * Functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @see https://codex.wordpress.org/Plugin_API for more information on hooks, actions, and filters.
 * @see https://bitbucket.org/hastedesign/haste-starter for documentation Haste Starter.
 *
 * @package WordPress\HasteStarter
 */

/**
 * Classes.
 */
require_once get_template_directory() . '/inc/classes/class-bootstrap-nav-walker.php';

/**
 * Hooks.
 */

// Theme support options.
require_once get_template_directory() . '/inc/theme-support.php';

// WP Head and other cleanup functions.
require_once get_template_directory() . '/inc/cleanup.php';

// Register scripts and stylesheets.
require_once get_template_directory() . '/inc/enqueue-scripts.php';

// Register custom menus and menu walkers.
require_once get_template_directory() . '/inc/menus.php';

// Register sidebars/widget areas.
require_once get_template_directory() . '/inc/sidebars.php';

// Customize the WordPress admin and login menu.
require_once get_template_directory() . '/inc/admin.php';

// Custom filters.
require_once get_template_directory() . '/inc/filters.php';

/**
 * Queries.
 */

// Post queries.
require_once get_template_directory() . '/inc/queries/post.php';

/**
 * Helpers.
 */

// Custom templates tags.
require_once get_template_directory() . '/inc/template-tags.php';

// Custom comments loop.
require_once get_template_directory() . '/inc/comments-loop.php';

// Pagination
require_once get_template_directory() . '/inc/pagination.php';

// Breadcrumbs
require_once get_template_directory() . '/inc/breadcrumbs.php';

// WooCommerce
require_once get_template_directory() . '/inc/woocommerce.php';
