<?php
/**
 * Adds a bit of metadata to pages and posts to allow authors to show or hide the title and featured image
 *
 * @package woosta
 */


/**
 * Adds default templates to posts and pages
 */
function woosta_register_template() {

	$starter_template = array(
		array( 'core/post-featured-image'),
		array( 'core/paragraph', array(
			'placeholder' => 'A good introduction',
			'fontSize' => 'large'
		))
	);

	$page = get_post_type_object( 'page' );
	$page->template = $starter_template;
	
	$post = get_post_type_object( 'post' );
	$post->template = $starter_template;
}
add_action( 'init', 'woosta_register_template' );


/**
 * Add metadata defaults to the Customizer.
 * @todo decide on whether there should be a set of site defaults and how to configure them.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function woosta_metadata_customizer( $wp_customize ) {

	$wp_customize->add_section(
		'woosta_metadata',
		array(
			'title'    => __( 'Metadata', 'woosta' ),
			'priority' => 150,
		)
	);

	$wp_customize->add_setting(
		'woosta_show_featured_image_default',
		array(
			'default'           => TRUE,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'woosta_show_featured_image_default',
			array(
				'section'     => 'woosta_metadata',
				'label'       => __( 'Show featured image by default', 'woosta' ),
				'description' => __( 'Sets a default for the site that can be changed on each page.', 'woosta' ),
				'type'        => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'woosta_show_title_default',
		array(
			'default'           => TRUE,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'woosta_show_title_default',
			array(
				'section'     => 'woosta_metadata',
				'label'       => __( 'Show title by default', 'woosta' ),
				'description' => __( 'Sets a default for the site that can be changed on each page.', 'woosta' ),
				'type'        => 'checkbox',
			)
		)
	);

}
add_action( 'customize_register', 'woosta_metadata_customizer' );


/**
 * Adds custom meta data fields to all post types.
 */
function woosta_register_meta() {
	register_meta( 'post', '_woosta_show_title', [
		'auth_callback' => '__return_true',
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
		'default' => woosta_show_title()
	] );
 
	register_meta( 'post', '_woosta_show_featured_image', [
		'auth_callback' => '__return_true',
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
		'default' => woosta_show_featured_image()
	] );
}
add_action( 'init', 'woosta_register_meta' );


/**
 * Enqueues javascript to create metabox in the block editor
 */
function woosta_meta_editor_script() {
	$file = '/js/meta.js';
	wp_enqueue_script(
		'woosta-editor-customization', 
		get_template_directory_uri() . $file, 
		[ 'wp-edit-post' ],
		filemtime( get_template_directory() . $file ),
		FALSE
	);
}
add_action( 'enqueue_block_editor_assets', 'woosta_meta_editor_script' );


/**
 * Checks the metadata to see if the title should appear.
 * @return bool
 */
function woosta_show_title( $post=NULL ) {
	$out = get_theme_mod( 'woosta_show_title_default', TRUE );
	if( NULL !== $post ) {
		$show = get_post_custom_values('_woosta_show_title');
		if( is_array( $show ) ) {
			$out = $show[0];
		}
	}
	return $out;
}

/**
 * Checks the metadata to see if the featured image should appear.
 * @return bool
 */
function woosta_show_featured_image( $post=NULL ) {
	$out = get_theme_mod( 'woosta_show_featured_image_default', TRUE );
	if( NULL !== $post ) {
		$show = get_post_custom_values('_woosta_show_featured_image');
		if( is_array( $show ) ) {
			$out = $show[0];
		}
	}
	return $out;
}
