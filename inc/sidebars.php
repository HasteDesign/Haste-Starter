<?php
/**
 * Register widget areas.
 *
 * @since 1.0.0
 */
function haste_starter_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'haste-starter' ),
			'id'            => 'main-sidebar',
			'description'   => __( 'Site Main Sidebar', 'haste-starter' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widgettitle widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'haste_starter_widgets_init' );
