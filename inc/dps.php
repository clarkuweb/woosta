<?php
/**
 * Display Posts Shortcode settings
 */


/**
 * Set DPS defaults.
 * @see https://displayposts.com/2019/01/04/change-default-attributes/
 */
function woosta_dps_defaults( $out, $pairs, $atts ) {
	// always add dps as a wrapper class
	if( is_array( $out['wrapper_class'] ) ) {
		$out['wrapper_class'][] = 'dps';
	} else {
		$out['wrapper_class'] .= ' dps';
	}
	
// 	echo '<pre>';
// 	var_dump($out);
// 	echo '</pre>';

	$new_defaults = array( 
		'include_excerpt_dash' => FALSE,
		'wrapper' => 'div',
	);
	
	foreach( $new_defaults as $name => $default ) {
		if( array_key_exists( $name, $atts ) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	
	return $out;
}
add_filter( 'shortcode_atts_display-posts', 'woosta_dps_defaults', 10, 3 );


/**
 * Template Parts with Display Posts Shortcode
 * @author Bill Erickson
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param string $output, current output of post
 * @param array $original_atts, original attributes passed to shortcode
 * @return string $output
 */
function woosta_dps_template_part( $output, $original_atts ) {

	// Return early if our "layout" attribute is not specified
	if( empty( $original_atts['layout'] ) )
		return $output;
	ob_start();
	get_template_part( 'template-parts/dps', $original_atts['layout'] );
	$new_output = ob_get_clean();
	if( !empty( $new_output ) )
		$output = $new_output;
	return $output;
}
add_action( 'display_posts_shortcode_output', 'woosta_dps_template_part', 10, 2 );