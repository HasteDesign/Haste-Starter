<?php
/**
 * Register the required plugins for this theme.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    WordPress\HasteStarter
 */

add_action( 'tgmpa_register', 'haste_starter_register_required_plugins' );

/**
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function haste_starter_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// If your plugin is in the official repository
		array(
			'name'   => 'Jetpack',
			'slug'   => 'jetpack'
		),
		// If your plugin is delivered within the theme
		array(
			'name'   => 'Haste Toolkit',
			'slug'   => 'haste-toolkit'
		),
		// If your plugin is hosted anywhere
		array(
			'name'   => 'Haste Starter',
			'slug'   => 'haste-toolkit',
			'source' => 'https://github.com/HasteDesign/Haste-Toolkit/archive/master.zip'
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'haste-starter',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
