<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="wrapper" class="container"><div class="row">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HasteStarter
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) ) { ?>
		<?php wp_body_open(); ?>
	<?php } else { ?>
		<?php do_action( 'wp_body_open' ); ?>
	<?php } ?>
	<nav class="navigation-skiplink" role="navigation">
		<a class="navigation-skiplink-link" href="#content"><?php _e( 'Skip to content', 'haste-starter' ); ?></a>
	</nav>

	<header id="header" role="banner">

		<?php get_template_part( 'template-parts/header', 'navigation' ); ?>

	</header><!-- #header -->
