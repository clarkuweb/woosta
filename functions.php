<?php
/**
 * woosta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woosta
 */

if ( ! defined( '_WOOSTA_VERSION' ) ) {
	define( '_WOOSTA_VERSION', wp_get_theme()->get( 'Version' ) );
}

/**
 * Returns a string to be used for cache busting
 *
 * @return str
 */
function woosta_cache_buster() {
	static $cache_buster;
	if ( empty( $cache_buster ) ) {
		$cache_buster = _WOOSTA_VERSION;
		$cache_buster = date(time());
	}
	return $cache_buster;
}

/**
 * Determines whether or not we're in the production environment
 * @see woosta_gtm() in inc/head-functions.php
 *
 * @return bool
 */
function is_prod() {
	if( defined( 'DOMAIN_CURRENT_SITE' ) && 'www.clarku.edu' === 'DOMAIN_CURRENT_SITE' ) { // this gets set in wp-config, so it ought to be the quickest test
		return TRUE;
	}
	$domain_segments = explode( ".", $_SERVER['SERVER_NAME'] );
	if( 
		in_array('dev', $domain_segments ) || 
		in_array('testing', $domain_segments ) || 
		in_array('training', $domain_segments ) || 
		'local' === end( $domain_segments ) ) {
			return FALSE;
	}
	return TRUE;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function woosta_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on cu, use a find and replace
		* to change 'woosta' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'woosta', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// add the excerpt field to pages
	add_post_type_support( 'page', 'excerpt' );
	//add_post_type_support( 'page', 'custom-fields' );
	
	add_theme_support('editor-styles');
	add_editor_style( 'style-editor.css' );
	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'navigation-menu' => esc_html__( 'Navigation', 'woosta' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'woosta_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	
	// add_theme_support( 'wp-block-styles' );
		
	add_theme_support( 'align-wide' );
	
	add_theme_support( 'editor-font-sizes', array(
		array(
        'name' => esc_attr__( 'Regular', 'woosta' ),
        'size' => 16,
        'slug' => 'regular'
    ),
    array(
        'name' => esc_attr__( 'Large', 'woosta' ),
        'size' => 24,
        'slug' => 'large'
    )
  ));
	
}
add_action( 'after_setup_theme', 'woosta_setup' );



/**
 * Loads customizer styles in the block editor.
 * but it doesn't auto-prefix selectors, so it styles the chrome too.  :(
 */
// function woosta_add_customizer_styles_to_block_editor() {
// 	wp_register_style( 'woosta-customizer-styles', false );
// 	wp_enqueue_style( 'woosta-customizer-styles' );
// 	wp_add_inline_style( 'woosta-customizer-styles', wp_get_custom_css() );
// }
// add_action( 'enqueue_block_editor_assets', 'woosta_add_customizer_styles_to_block_editor', 100 );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woosta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'woosta_content_width', 832 );
}
add_action( 'after_setup_theme', 'woosta_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woosta_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Header', 'woosta' ),
			'id'            => 'preheader',
			'description'   => esc_html__( 'Add widgets here.', 'woosta' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Content', 'woosta' ),
			'id'            => 'precontent',
			'description'   => esc_html__( 'Add widgets here.', 'woosta' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Footer', 'woosta' ),
			'id'            => 'prefooter',
			'description'   => esc_html__( 'Add widgets here.', 'woosta' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'woosta_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function woosta_scripts() {
	wp_enqueue_style( 'woosta-style', get_template_directory_uri() . '/style.css', array(), woosta_cache_buster() );
	wp_style_add_data( 'woosta-style', 'rtl', 'replace' );

// 	<link rel="preconnect" href="https://fonts.googleapis.com">
// 	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
// 	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200..900&amp;display=swap" rel="stylesheet">
	wp_enqueue_style( 'woosta-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@200..900&amp;display=swap', array(), NULL );

	wp_enqueue_style( 'woosta-print', get_template_directory_uri() . '/style-print.css', array(), woosta_cache_buster(), 'print');

	wp_enqueue_script( 'woosta-navigation', get_template_directory_uri() . '/js/navigation.js', array(), woosta_cache_buster(), TRUE );

	wp_enqueue_script( 'woosta-jacket', get_template_directory_uri() . '/js/jacket.js', array(), woosta_cache_buster(), TRUE );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'woosta_scripts' );



/**
 * Test if the current page is using a "minimal" template.
 * @return bool
 */
function woosta_is_minimal() {
	$template_slug = get_page_template_slug();
	$minimal = substr( $template_slug, -11 ); // it goes to 11
	$is_minimal = ( 'minimal.php' === $minimal );
	return $is_minimal;
}


function woosta_customize_blocks() {
	wp_enqueue_style( 'woosta-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@200..900&amp;display=swap', array(), NULL );
	wp_enqueue_script(
		'woosta-block-editor',
		get_template_directory_uri() . '/js/block-editor.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
		woosta_cache_buster(),
		TRUE
	);
}
add_action( 'enqueue_block_editor_assets', 'woosta_customize_blocks' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Head functions like opengraph and GTM.
 */
require get_template_directory() . '/inc/head-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Breadcrumb generator.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Custom metadata to toggle visibility of title and featured image.
 */
require get_template_directory() . '/inc/meta.php';

/**
 * Custom metadata to toggle visibility of title and featured image.
 */
require get_template_directory() . '/inc/admin-login.php';

/**
 * Custom settings for Display Posts Shortcode plugin.
 */
require get_template_directory() . '/inc/dps.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

