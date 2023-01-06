<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woosta
 */

if ( ! isset( $args['type'] ) ) {
	get_template_part( 'template-parts/footer' );
} elseif ( 'minimal' === $args['type'] ) {
	get_template_part( 'template-parts/footer', 'minimal' );
}


