<?php
/**
 * The template for displaying tag pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" class="<?php echo haste_starter_classes_page_sidebar(); ?>" tabindex="-1" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>

			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php haste_starter_paging_nav(); ?>

		<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main>

<?php
get_sidebar();
get_footer();
