<?php
if ( ! function_exists( 'haste_starter_comment_loop' ) ) {

	/**
	 * Custom comments loop.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $comment Comment object.
	 * @param  array  $args    Comment arguments.
	 * @param  int    $depth   Comment depth.
	 */
	function haste_starter_comments_loop( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) {
			case 'pingback':
			case 'trackback':
				haste_starter_comment_trackback();
				break;
			default:
				?>
				<li <?php comment_class( 'media' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="div-comment-<?php comment_ID(); ?>" class="comment-body comment-author vcard">
						<div class="media-meta">
						<?php echo haste_starter_avatar_comments( $comment ); ?>
							<h5 class="media-author">
						<?php echo haste_starter_comments_author_name(); ?>
							</h5>
							<h5 class="media-date">
							<?php echo haste_starter_comment_date( $comment ); ?>
							</h5>
						</div>
						<?php haste_starter_comments_body( $comment, $args, $depth ); ?>
					</article><!-- .comment-body -->
					<?php
				break;
		}
	}
}

/**
 * The body content of comment
 *
 * @param mixed $comment
 * @param mixed $args
 * @param mixed $depth
 *
 * @return [type]
 */
function haste_starter_comments_body( $comment, $args, $depth ) {
	?>
	<div class="media-body">
	<?php haste_starter_footer_comments( $comment ); ?>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<div class="comment-metadata">
			<span class="btn btn-outline-primary reply-link">
				<?php haste_starter_reply_link( $args, $depth ); ?>
			</span>
		</div><!-- .comment-metadata -->
	</div>
	<?php
}

/**
 * Display the author name
 *
 * @return [type]
 */
function haste_starter_comments_author_name() {
	return sprintf(
		'<strong><span class="fn">%1$s</span></strong>',
		get_comment_author_link()
	);
}

/**
 * Display avatar of comment
 *
 * @param mixed $comment
 *
 * @return [type]
 */
function haste_starter_avatar_comments( $comment ) {
	return str_replace( "class='avatar", "class='media-object avatar", get_avatar( $comment, 64 ) );
}

/**
 * display meta informations
 *
 * @param mixed $comment
 *
 * @return [type]
 */
function haste_starter_footer_comments( $comment ) {
	?>
	<footer class="comment-meta">
	<?php edit_comment_link( __( 'Edit comment', 'haste-starter' ), '<span class="edit-link">', ' </span>' ); ?>

		<?php haste_starter_comment_approve( $comment ); ?>
	</footer><!-- .comment-meta -->
	<?php
}

/**
 *Create a reply link
 * @param mixed $args
 * @param mixed $depth
 * 
 * @return [type]
 */
function haste_starter_reply_link( $args, $depth ) {
	comment_reply_link(
		array_merge(
			$args,
			array(
				'reply_text' => __( 'Respond', 'haste-starter' ),
				'depth'      => $depth,
				'max_depth'  => $args['max_depth'],
			)
		)
	);
}

function haste_starter_comment_date( $comment ) {
	return sprintf(
		'<a href="%1$s"><time datetime="%2$s">%3$s %4$s </time></a>
		<span class="says"> %5$s</span>',
		esc_url( get_comment_link( $comment->comment_ID ) ),
		get_comment_time( 'c' ),
		get_comment_date(),
		__( 'at', 'haste-starter' ),
		get_comment_time(),
		__( 'said:', 'haste-starter' )
	);
}


function haste_starter_comment_trackback() {
	?>

	<li class="media post pingback">
	<p><?php _e( 'Pingback:', 'haste-starter' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'haste-starter' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
}

function haste_starter_comment_approve( $comment ) {
	if ( $comment->comment_aprove ) {
		?>
		<p class="comment-awaiting-moderation alert alert-info"><?php _e( 'Your comment is awaiting moderation.', 'haste-starter' ); ?></p>
		<?php
	}
}
