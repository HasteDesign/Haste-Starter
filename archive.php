<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" tabindex="-1" role="main">
		<?php haste_starter_breadcrumbs(); ?>
		<?php if ( have_posts() ) : ?>

			<?php get_template_part( 'template-parts/header', 'title' ); ?>

			<!-- Start the Loop -->
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );
				?>
			<?php endwhile; ?>

			<?php haste_starter_paging_nav(); ?>

		<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
	</main>

<?php
get_sidebar();
get_footer();
