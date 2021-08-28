<?php
/**
 * The template for displaying author archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" tabindex="-1" role="main">
		<?php haste_starter_breadcrumbs(); ?>
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );

					/*
					 * Queue the first post, that way we know what author
					 * we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop properly
					 * with a call to rewind_posts().
					 */
					the_post();
				?>
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<div class="author-biography">
						<span class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?></span>
						<span class="author-description"><?php the_author_meta( 'description' ); ?></span>
					</div>
				<?php endif; ?>
			</header>

			<?php
			/*
			 * Since we called the_post() above, we need to rewind
			 * the loop back to the beginning that way we can run
			 * the loop properly, in full.
			 */
			rewind_posts();
			?>

			<?php
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
			?>

			<?php haste_starter_paging_nav(); ?>

		<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main>

<?php
get_sidebar();
get_footer();
