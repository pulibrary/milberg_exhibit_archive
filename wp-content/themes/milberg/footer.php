<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Milberg
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
		<div class="site-info">
			<span>Copyright &copy; <?php echo date("Y"); ?> The Trustees of <a href="http://www.princeton.edu/">Princeton University</a> &middot; Princeton University, Princeton, NJ 08544 USA</span>
			<span class="more-info">For more information, e-mail <a href="mailto:loliveir@princeton.edu">loliveir@princeton.edu</a> or phone 609-258-3155</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
