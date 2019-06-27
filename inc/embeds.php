<?php

/**
 * Wrap YouTube or Vimeo videos in a div with Bootstrap Responsive video classes.
 *
 * @param string $cached_html The current embed cached HTML.
 * @param string $url Embed url.
 * @param string $attr Embed attributes.
 * @param int    $post_id Post ID in which the embed is attached.
 * @return boolean
 */
function haste_starter_wrap_youtube( $cached_html, $url, $attr, $post_id ) {
	if ( false !== strpos( $url, '://youtube.com' ) || false !== strpos( $url, '://youtu.be' ) || false !== strpos( $url, '://vimeo.com' ) ) {
		$cached_html = '<div class="embed-responsive embed-responsive-16by9">' . $cached_html . '</div>';
	}
	return $cached_html;
}
add_filter( 'embed_oembed_html', 'haste_starter_wrap_youtube', 99, 4 );
