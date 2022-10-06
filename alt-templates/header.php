<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woosta
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'woosta' ); ?></a>
	<?php dynamic_sidebar( 'preheader' ); ?>
		
	<header id="masthead" class="site-header">
	<?php
		//the_header_image_tag();
	?>
		<div class="site-branding">
			<?php the_custom_logo(); ?>
			<div class="site-name">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$woosta_description = get_bloginfo( 'description', 'display' );
			if ( $woosta_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $woosta_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="navigation-menu" aria-expanded="false"><?php esc_html_e( 'Navigation Menu', 'woosta' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'navigation-menu',
					'menu_id'        => 'header-navigation',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>  
