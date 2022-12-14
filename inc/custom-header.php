<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package woosta
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses woosta_header_style()
 */
function woosta_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'woosta_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 2000,
				'height'             => '',
				'flex-height'        => true,
				'wp-head-callback'   => 'woosta_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'woosta_custom_header_setup' );


/**
 * adds css for customized header.
 */
function woosta_add_custom_header_styles() {

	if ( ! woosta_is_minimal() && has_header_image() ) {
		$header_image = (object)get_theme_mod( 'header_image_data' );
		
		$style_properties = array(
			'background-image' => 'url(' . get_header_image() . ')',
			'background-position' => '50% 50%',
			'background-size' => 'cover',
			'height' => $header_image->height . 'px;',			
		);
		$css = '.site-branding { ';
		foreach( $style_properties as $prop => $value ) {
			$css .= $prop . ':' . $value . ';';
		}
		$css .= '}';
		wp_register_style( 'woosta-custom-header-image', false );
		wp_enqueue_style( 'woosta-custom-header-image' );
		wp_add_inline_style( 'woosta-custom-header-image', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'woosta_add_custom_header_styles', 100 );


if ( ! function_exists( 'woosta_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see woosta_custom_header_setup().
	 */
	function woosta_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
