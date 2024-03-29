<?php
/**
 * Breadcrumbs
 */


/**
 * Add breadcrumbs to the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function woosta_breadcrumbs_customizer( $wp_customize ) {

	$wp_customize->add_section(
		'woosta_breadcrumbs',
		array(
			'title'    => __( 'Breadcrumbs', 'woosta' ),
			'priority' => 70,
		)
	);

	$wp_customize->add_setting(
		'woosta_show_breadcrumbs_on_front',
		array(
			'default'           => FALSE,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'woosta_show_breadcrumbs_on_front',
			array(
				'section'     => 'woosta_breadcrumbs',
				'label'       => __( 'Show breadcrumbs on the front page', 'woosta' ),
// 				'description' => __( 'Shows the breadcrumbs even on the root page.', 'woosta' ),
				'type'        => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'woosta_breadcrumbs_prepend',
		array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'woosta_breadcrumbs_prepend',
			array(
				'section'     => 'woosta_breadcrumbs',
				'label'       => __( 'Prepend Breadcrumbs', 'woosta' ),
				'description' => __( 'Add links to prepend to the breadcrumb, one link per line, using the Markdown format [text](url)', 'woosta' ),
				'type'        => 'textarea',
			)
		)
	);
}
add_action( 'customize_register', 'woosta_breadcrumbs_customizer' );






/**
 * Gets the current WP path as known by Apache, not WordPress.
 *
 * @param bool $strip is a switch to strip slashes from the end of the URL.
 * It does this so that paths like "who" and "who/*" can be differentiated.
 * Otherwise, there's no way to single out "who".
 *
 * @return str
 */
function woosta_get_current_path( $strip = true ) {

	if ( ! isset( $_SERVER['HTTP_REFERER'] ) || FALSE === strpos( $_SERVER['HTTP_REFERER'], 'wp-admin/customize.php' ) ) {
		$current_path = trim( $_SERVER['REQUEST_URI'] );
	} else {
		// when the Customizer is being used, we need to use the referrer
		// because the Request URI is a different endpoint.
		$url          = parse_url( $_SERVER['HTTP_REFERER'] );
		$q            = trim( urldecode( $url['query'] ) );
		$q            = str_replace( 'url=', '', $q );
		$url          = parse_url( $q );
		$current_path = $url['path'];
	}

	$base_bits = parse_url( site_url() );
	if ( ! empty( $current_path ) && ! empty( $base_bits['path'] ) ) {
		if ( strpos( $current_path, $base_bits['path'] ) === 0 ) {
			$current_path = substr( $current_path, strlen( $base_bits['path'] ) );
		}
	}
	if ( true === $strip ) {
		$current_path = rtrim( $current_path, '/' );
	}

	return $current_path;
}



/**
 * Call the breadcrumbs
 */
function woosta_breadcrumbs() {
	$crumbs  = array();
	$default = NULL;

	$option_val = get_theme_mod( 'woosta_breadcrumbs_prepend' );
	
	if( TRUE === MULTISITE ) {
		$main_site_id = get_network()->site_id;
		if ( $main_site_id !== get_current_blog_id() ) {
			$multisite = get_blog_details( array( 'blog_id' =>  $main_site_id ) );
			$default = '[' . $multisite->blogname . '](' . $multisite->siteurl . ')';
		}
	}
	
	$prepend = empty( $option_val ) ? array( $default ) : explode( "\n", $option_val );

	foreach ( $prepend as $l ) {
		if ( empty( $l ) ) { continue; }
		$bits = explode( '(', $l );
		$name = trim( $bits[0], '[]' );
		if( isset( $bits[1] ) ) {
			$href = rtrim( $bits[1], ')' );
		}
		if ( ! empty( $name ) && ! empty( $href ) ) {
			$crumbs[] = array(
				'name' => $name,
				'href' => $href,
			);
		}
	}

	$crumbs[] = array(
		'name' => get_bloginfo(),
		'href' => get_site_url(),
	);
	

	$url = woosta_get_current_path();	
	if ( empty ( $url ) && ! get_theme_mod( 'woosta_show_breadcrumbs_on_front' ) ) {
		// there's nothing to put into the breadcrumbs, we're at the root site
		return;
	}

	$path_segments = explode( '/', $url );
	
	$path = '';
	
	foreach ( $path_segments as $p ) {
		if ( empty( $p ) ) {
			continue;
		}
		$path = $path . '/' . $p;
		$link = woosta_breadcrumbs_get_link( $path );

		if ( ! empty( $link ) ) {
			$crumbs[] = $link;
		}
	}
	
	return woosta_format_breadcrumbs( $crumbs );
}


/**
 * WP lets us hunt and peck to see what the URL might be
 *
 * @param str $path the path.
 */
function woosta_breadcrumbs_get_link( $path ) {

	// ignore pagination i.e. if the path ends in /page/N
	if ( preg_match( '/\/page(\/(\d)*)?$/', $path ) !== 0 ) {
		return;
	}

	$p = '';
	$post_id = url_to_postid( get_site_url() . $path );

	if ( 0 !== $post_id ) { // it's a post or a page.
		// $p = get_page_by_path( $path );
		$p = get_post( $post_id );
		if ( ! is_object( $p ) ) { // solves an issue with page break paginated pages and posts
			return;
		}
		$output = array(
			'name' => get_the_title( $p->ID ),
			'href' => get_site_url() . $path,
		);

		return $output;
	}

	// is it a custom post type?
	// check this first so that it takes precedent over category
	$post_type_object = get_post_type_object( get_post_type() );
	if ( is_object( $post_type_object ) ) {
		if( is_array( $post_type_object->rewrite ) ) {
			$slug = $post_type_object->rewrite['slug'];
		}
	}

	if ( isset( $slug ) ) {
		$output = array(
			'name' => ucfirst( $slug ),
			'href' => get_site_url() . $path,
		);

		return $output;
	}

	if( is_page() ) { // with people page roots, this gets around weirdness
		$output = array(
			'name' => get_the_title(),
			'href' => get_site_url() . $path,
		);
		return $output;
	}
	

	// is it a category?
	// @todo Catch custom post type categories too.
	$category = get_category_by_path( $path );

	if ( is_object( $category ) && isset( $category->term_id ) ) {
		$output = array(
			'name' => $category->name,
			'href' => get_site_url() . '/' . $category->slug,
		);
		return $output;
	}

	
	

}

/**
 * Format the breadcrumbs
 *
 * @param arr $crumbs the crumbs.
 * @return $output
 */
function woosta_format_breadcrumbs( $crumbs ) {
	$output = '<ol>';
	$last   = end( $crumbs );
	foreach ( $crumbs as $c ) {
		if ( $c === $last ) { // last crumb isn't a hyperlink.
			$output .= '<li aria-current="page">' . $c['name'] . '</li>';
		} else {
			$output .= '<li><a href="' . trailingslashit( $c['href'] ) . '">' . $c['name'] . '</a></li>';
		}
	}
	$output .= '</ol>';
	return $output;
}
