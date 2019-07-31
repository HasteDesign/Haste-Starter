<?php
/**
 * Template Name: With Sidebar
 *
 * The template for displaying pages with sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" tabindex="-1" role="main">

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; ?>

	</main>

<?php
get_sidebar();
get_footer();
