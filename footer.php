<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the <div class="row">, <div id="wrapper" class="container"> and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HasteStarter
 */

?>

	<footer id="footer" role="contentinfo">
		<div class="colophon">
			<div class="container">
				<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></p>
				<a title="Site desenvolvido por Estúdio Haste" href="http://www.hastedesign.com.br">Desenvolvido por Estúdio Haste</a>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>
