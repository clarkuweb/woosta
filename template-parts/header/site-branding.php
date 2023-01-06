<?php
/**
 * Template part for the department branding
 */
?>
<div class="site-branding">
	<div class="column-width">
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
	</div>
</div><!-- .site-branding -->
