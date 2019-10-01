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

	</div><!-- .row -->

	<footer id="footer" role="contentinfo">
		<div class="container">
			<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a> -
				<?php _e( 'All rights reserved', 'haste-starter' ); ?> | <?php echo sprintf( __( 'Powered by the <a href="%1$s" rel="nofollow" target="_blank">Haste Starter</a> forces and <a href="%2$s" rel="nofollow" target="_blank">WordPress</a>.', 'haste-starter' ), 'https://github.com/HasteDesign/Haste-Starter', 'http://wordpress.org/' ); ?></p>
		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>
