<?php
	
	$id = get_the_ID();
	$email = get_post_meta( $id, 'cu_people_email', TRUE );
	$phone = get_post_meta( $id, 'cu_people_phone', TRUE );
	$title = get_post_meta( $id, 'cu_people_title', TRUE );
 	$has_thumbnail = ( has_post_thumbnail() ) ? TRUE : FALSE;


get_template_part( 'template-parts/header' );
echo '<div class="widget-area" id="precontent">';
dynamic_sidebar( 'precontent' );
echo '</div>';

?>
<main>
	<article class="clarku-people">

			<?php the_title('<div class="title p-name"><h1>', '</h1></div>'); ?>
		

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry">
					<div class="people-card h-card">
						<?php if ( $has_thumbnail ) : ?>
						<figure class="person-photo">
							<?php the_post_thumbnail( 'medium', array( 'class' => 'u-photo medium' )); ?>
						</figure>
						<?php else: ?>
							<figure class="initials">
								<?php
									$name_words = explode( ' ', get_the_title() );
									foreach( $name_words as $n ) {
										echo $n[0];
									}
								?>
							</figure>
						<?php endif; ?>
					
						<ul class="person-details">
							<li class="p-name"><?php the_title(); ?></li>
							<?php if( ! empty( $title ) ) { ?><li class="p-job-title"><?php echo $title; ?></li><?php } ?>
							<?php if( ! empty( $phone ) ) { ?><li class="p-tel"><strong class="screen-reader-text">Phone:</strong> <?php echo $phone; ?></li><?php } ?>
							<?php if( ! empty( $email ) ) { ?><li class="u-email"><strong class="screen-reader-text">Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li><?php } ?>
						</ul>
					</div>

					<?php
						the_content();
					?>

				</div>
			</div>

	</article>
</main>

<?php
get_template_part( 'template-parts/footer' );
