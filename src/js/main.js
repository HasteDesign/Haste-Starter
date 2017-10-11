/**
 *	Main
 */
jQuery(document).ready(function($) {

	/**
	 * Responsive wp_video_shortcode().
	 */

	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' )

	/**
	 * Fluid width video embeds.
	 * @link http://fitvidsjs.com
	 */

	$( '.entry-content' ).fitVids();

	/**
	 * Odin Core shortcodes.
	 */

	// Tabs.
	//$( '.odin-tabs a' ).click(function(e) {
	//	e.preventDefault();
	//	$(this).tab( 'show' );
	//});

	// Tooltip.
	//$( '.odin-tooltip' ).tooltip();
})
