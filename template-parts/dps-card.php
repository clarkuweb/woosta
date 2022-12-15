<?php
/**
 * "Card" layout for Display Posts Shortcode
 *
 */

echo '
<a class="clarku-block-card" href="' . get_the_permalink() . '">
	<div class="clarku-block-card-img-container">
		' . get_the_post_thumbnail() . '
	</div>
	<div class="clarku-block-card-content">
		<h3>' . get_the_title() . '</h3>
		<p>' . get_the_excerpt() . '</p>
	</div>
</a>
';
