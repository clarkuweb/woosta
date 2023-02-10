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


echo '<div class="widget-area" id="prefooter">';
dynamic_sidebar( 'prefooter' );
echo '</div>';

?>

<footer id="colophon" class="site-footer">

		<div class="xalignwide">
		
			<div class="buttons">
				<a class="button" href="https://www.clarku.edu/undergraduate-admissions/apply/">Apply</a>
				<a class="button" href="https://www.clarku.edu/undergraduate-admissions/campus-visits/">Visit</a>
				<a class="button" href="https://www.clarku.edu/contactus/">Connect</a>
				<a class="button" href="https://alumni.clarku.edu/clarku">Give</a>
			</div>

			<figure class="wp-block-image aligncenter size-full is-resized"><img decoding="async" loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/media/clark-logo-tagline-w.png" alt="Clark University: Challenge convention. Change our world." width="192" height="232"></figure>

		
		</div>

		<div class="subfooter">
			<p class="alignwide policies"><a href="https://www.clarku.edu/who-we-are/fast-facts/public-information/">Public Information</a> | <a href="https://www.clarku.edu/policies/?wdt_search=privacy">Privacy Policy</a> | <a href="https://www.clarku.edu/website-accessibility-statement/">Accessibility</a> | <a href="http://clarku.edu/nondiscrimination-policy">Nondiscrimination Policy</a></p>
			<p class="alignwide copyright">© Clark University</p>
		</div>

</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
