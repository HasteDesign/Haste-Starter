<?php
if ( ! function_exists( 'haste_starter_comment_loop' ) ) {

	/**
	 * Custom comments loop.
	 *
	 * @since 2.2.0
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
				?>
				<li class="media post pingback">
					<p><?php _e( 'Pingback:', 'haste-starter' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'haste-starter' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default:
				?>
				<li <?php comment_class( 'media' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="div-comment-<?php comment_ID(); ?>" class="comment-body comment-author vcard">
						<div class="media-meta">
							<?php echo str_replace( "class='avatar", "class='media-object avatar", get_avatar( $comment, 64 ) ); ?>
							<h5 class="media-author">
							<?php 
							echo sprintf(
								'<strong><span class="fn">%1$s</span></strong>',
								get_comment_author_link()
							); 
							?>
							</h5>
							<h5 class="media-date">
								<?php
								echo sprintf(
									'<a href="%1$s"><time datetime="%2$s">%3$s %4$s </time></a>
									<span class="says"> %5$s</span>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									get_comment_date(),
									__( 'at', 'haste-starter' ),
									get_comment_time(),
									__( 'said:', 'haste-starter' )
								);
								?>
							</h5>
						</div>
						<div class="media-body">
							<footer class="comment-meta">
								

								<?php edit_comment_link( __( 'Edit comment', 'haste-starter' ), '<span class="edit-link">', ' </span>' ); ?>

								<?php if ( '0' === $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation alert alert-info"><?php _e( 'Your comment is awaiting moderation.', 'haste-starter' ); ?></p>
								<?php endif; ?>
							</footer><!-- .comment-meta -->

							<div class="comment-content">
								<?php comment_text(); ?>
							</div><!-- .comment-content -->

							<div class="comment-metadata">
								<span class="btn btn-outline-primary reply-link">
									<?php
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
									?>
								</span>
							</div><!-- .comment-metadata -->
						</div>
					</article><!-- .comment-body -->
				<?php
				break;
		}
	}
}
