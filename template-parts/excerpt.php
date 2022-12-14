<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woosta
 */

 extract( $args );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				woosta_posted_on();
				woosta_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
		woosta_post_thumbnail();
	?>

	<div class="entry-content">
		<?php
			the_excerpt();			
			echo sprintf(
				__( '<a href="%s" class="continue">Continue reading<span class="screen-reader-text"> "%s"</span></a>', 'woosta' ),
					wp_kses_post( get_the_permalink() ),
					wp_kses_post( get_the_title() )
				);		
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
