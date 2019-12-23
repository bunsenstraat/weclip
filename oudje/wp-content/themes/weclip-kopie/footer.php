<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<div id="colophon" role="contentinfo">
		<div class="footer">
			<div class="footer_1">
				<div class="site-info">
						<img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/contact.png" /><h2 class="con">CONTACT</h2>
				</div>
				<div class="footer_link">
					<div id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'Footer', 'menu_class' => 'nav-menu' ) ); ?>
					</div><!-- #site-navigation -->
				</div>
			</div>
			<div class="footer_2">
				<div class="footer_inr">
					<div class="footer_part_first">
						<div class="f_i"></div>
						<h2 class="add">2013, WECLIP</h2>
					</div>
					<div class="footer_part">
						<div class="f_i"><img class="footer_i" src="<?php bloginfo('template_directory'); ?>/images/footer_2.png" /></div>
						<h2 class="add">EUCLIDESLAAN 60</h2>
					</div>
					<div class="footer_part">
						<div class="f_i"></div>
						<h2 class="add">3584 BN UTRECHT</h2>
					</div>
					<div class="footer_part">
						<div class="f_i"><img class="footer_i" src="<?php bloginfo('template_directory'); ?>/images/footer_4.png" /></div>
						<h2 class="add"><a href="mailt:info@weclip.nl">INFO@WECLIP.NL</a></h2>
					</div>
					<div class="footer_part_last">
						<div class="f_i"><img class="footer_i" src="<?php bloginfo('template_directory'); ?>/images/footer_5.png" /></div>
						<h2 class="add">030 3200 363</h2>
					</div>
				</div>
			</div>
		</div>
	</div><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
