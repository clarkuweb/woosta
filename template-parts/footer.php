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

<section class="footer-buttons alignfull">
	<div class="buttons column-width">
		<a class="button" href="https://www.clarku.edu/undergraduate-admissions/apply/">Apply</a>
		<a class="button" href="https://www.clarku.edu/undergraduate-admissions/campus-visits/">Visit</a>
		<a class="button" href="https://www.clarku.edu/contactus/">Connect</a>
		<a class="button" href="https://alumni.clarku.edu/clarku">Give</a>
	</div>
</section>

<footer id="colophon" class="site-footer">

		<div class="links column-width">
			<div>
				<ul class="equity">
					<li><a href="https://www.clarku.edu/report-a-concern/">Report a Concern</a></li>
					<li><a href="https://www.clarku.edu/offices/emergency-management-and-campus-assistance/">Campus Safety</a></li>
					<li><a href="https://www.clarku.edu/nondiscrimination-policy">Nondiscrimination Policy</a></li>
				</ul>
			</div>
			<div>
				<ul class="engage">
					<li><a href="https://www.clarku.edu/contactus/">Contact Us</a></li>
					<li><a href="https://www.clarku.edu/offices/human-resources/job-opportunities/">Employment</a></li>
					<li><a href="https://www.clarku.edu/events/">Events</a></li>
				</ul>
			</div>
			<div>
				<ul class="website">
					<li><a href="https://www.clarku.edu/who-we-are/fast-facts/public-information/">Public Information</a></li>
					<li><a href="https://www.clarku.edu/website-accessibility-statement/">Website Accessibility</a></li>
					<li><a href="https://www.clarku.edu/policies/?wdt_search=privacy">Privacy Policy</a></li>
				</ul>
			</div>
		</div>

		<div class="clark column-width">
			<figure class="wp-block-image aligncenter size-full is-resized"><a href="https://www.clarku.edu/"><img decoding="async" loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/media/clark-logo-tagline-w.png" alt="Clark University: Challenge convention. Change our world." width="192" height="232"></a></figure>
		</div>

		<div class="social-media">
			<ul>
				<li class="facebook"><svg viewBox="0 0 200 200"><use xlink:href="#facebook" /></svg><a href="https://www.facebook.com/ClarkUniversityWorcester">Facebook</a></li>
				<li class="twitter"><svg viewBox="0 0 200 200"><use xlink:href="#twitter" /></svg><a href="https://twitter.com/clarkuniversity">Twitter</a></li>
				<li class="instagram"><svg viewBox="0 0 200 200"><use xlink:href="#instagram" /></svg><a href="https://www.instagram.com/clarkuniversity/">Instagram</a></li>
				<li class="tiktok"><svg viewBox="0 0 200 200"><use xlink:href="#tiktok" /></svg><a href="https://www.tiktok.com/@clarkuniversityworcester?">Tiktok</a></li>
				<li class="youtube"><svg viewBox="0 0 200 200"><use xlink:href="#youtube" /></svg><a href="https://www.youtube.com/clarkuniversity">Youtube</a></li>
				<li class="linkedin"><svg viewBox="0 0 200 200"><use xlink:href="#linkedin" /></svg><a href="https://www.linkedin.com/school/clark-university/">LinkedIn</a></li>
			</ul>	
			<figure class="svg-sprite" style="display: none;">
				<?php
					echo file_get_contents(get_stylesheet_directory_uri() . '/media/social-media/sprite.svg');
				?>
			</figure>
			
		</div>

		<div class="subfooter">
			<p class="copyright">© Clark University<br>
			950 Main Street Worcester, MA 01610<br>
			508-793-7711</p>
		</div>

</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
