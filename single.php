<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" tabindex="-1" role="main">

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

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
