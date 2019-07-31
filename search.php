<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" class="<?php echo haste_starter_classes_page_sidebar(); ?>" tabindex="-1" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'haste-starter' ), get_search_query() ); ?></h1>
			</header>

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
