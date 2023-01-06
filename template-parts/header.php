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
	<div class="preheader">
		<?php dynamic_sidebar( 'preheader' ); ?>
	</div>
	<header class="site-header">

		<?php get_template_part( 'template-parts/header/clark-bar' ); ?>  
		<?php get_template_part( 'template-parts/header/site-branding' ); ?>  
		<?php get_template_part( 'template-parts/header/site-navigation' ); ?>  

	</header><!-- #masthead -->

	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>  
