<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package HasteStarter
 */

get_header(); ?>

	<main id="content" tabindex="-1" role="main">
		<?php haste_starter_breadcrumbs(); ?>

		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Not Found', 'haste-starter' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'haste-starter' ); ?></p>

			<?php get_search_form(); ?>
		</div>

	</main>

<?php
get_footer();
