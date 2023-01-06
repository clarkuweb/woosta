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
	<?php get_template_part( 'template-parts/header/head-element' ); ?>  
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'woosta' ); ?></a>
	<?php dynamic_sidebar( 'preheader' ); ?>
		
	<header id="masthead" class="site-header minimal">
		<?php get_template_part( 'template-parts/header/clark-bar' ); ?>  
		<div class="site-branding">		
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->