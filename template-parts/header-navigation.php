<nav id="navigation-top" class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
	<div class="container">
		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="main-menu">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main-menu',
						'depth'          => 2,
						'container'      => false,
						'menu_class'     => 'navbar-nav mr-auto',
						'fallback_cb'    => 'Haste_Starter_Bootstrap_Nav_Walker::fallback',
						'walker'         => new Haste_Starter_Bootstrap_Nav_Walker(),
					)
				);
				?>
			<?php get_template_part( 'searchform' ); ?>
		</div><!-- .navbar-collapse -->
	</div><!-- .container -->
</nav>
