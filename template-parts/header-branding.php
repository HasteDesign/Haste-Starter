<div id="header-branding">
	<div class="container">
		<?php haste_starter_the_custom_logo(); ?>

		<?php if ( get_bloginfo( 'description' ) || is_customize_preview() ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif ?>
	</div>
</div>
