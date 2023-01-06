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

if ( ! isset( $args['type'] ) ) {
	get_template_part( 'template-parts/header' );
	echo '<div class="widget-area" id="precontent">';
	dynamic_sidebar( 'precontent' );
	echo '</div>';
} elseif ( 'minimal' === $args['type'] ) {
	get_template_part( 'template-parts/header', 'minimal' );
	dynamic_sidebar( 'precontent' );
}
