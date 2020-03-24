<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HasteStarter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php haste_starter_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( is_search() ) : ?>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'haste-starter' ) );
				wp_link_pages(
					array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'haste-starter' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					)
				);
			?>
		</div>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ), true ) ) : ?>
			<span class="cat-links">
				<?php echo __( 'Posted in:', 'haste-starter' ) . ' ' . get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'haste-starter' ) ); ?>
			</span>
		<?php endif; ?>

		<?php the_tags( '<ul class="tags"><li class="tag">', '</li><li class="tag">', '</li></ul>' ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link">
				<?php comments_popup_link( __( 'Leave a comment', 'haste-starter' ), __( '1 Comment', 'haste-starter' ), __( '% Comments', 'haste-starter' ) ); ?>
			</span>
		<?php endif; ?>
	</footer>
</article><!-- #post-## -->
