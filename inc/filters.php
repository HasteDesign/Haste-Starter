<?php

/**
 * Filter archive titles.
 * Controls the display of archive titles.
 *
 * @return string $title    Filtered archive title.
 */
function haste_starter_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'haste_starter_archive_title' );

/**
 * Wrap YouTube or Vimeo videos in a div with Bootstrap Responsive video classes.
 *
 * @param string $cached_html    The current embed cached HTML.
 * @param string $url            Embed url.
 * @param string $attr           Embed attributes.
 * @param int    $post_id        Post ID in which the embed is attached.
 * @return boolean
 */
function haste_starter_wrap_youtube( $cached_html, $url, $attr, $post_id ) {
	if ( false !== strpos( $url, '://youtube.com' ) || false !== strpos( $url, '://youtu.be' ) || false !== strpos( $url, '://vimeo.com' ) ) {
		$cached_html = '<div class="embed-responsive embed-responsive-16by9">' . $cached_html . '</div>';
	}
	return $cached_html;
}
add_filter( 'embed_oembed_html', 'haste_starter_wrap_youtube', 99, 4 );
