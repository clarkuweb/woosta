<?php
/**
 * Template part for the main site navigation
 */
?>
<nav id="site-navigation" class="main-navigation">
	<button class="menu-toggle" aria-controls="navigation-menu" aria-expanded="false"><?php esc_html_e( 'Navigation Menu', 'woosta' ); ?></button>
	<?php
	wp_nav_menu(
		array(
			'theme_location'	=> 'navigation-menu',
			'menu_id'					=> 'header-navigation',
		)
	);
	?>
</nav><!-- #site-navigation -->
