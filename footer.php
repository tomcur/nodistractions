<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package nodistractions
 */

?>
	</div><!-- #content -->

	<?php
		/* 
		 * This is for a horizontal menu / widget bar that will 
		 * collapse to the bottom of the page on small screens.
		 */
		if((is_home() || is_single()) && "footer" == get_theme_mod('nodistractions_menu_widgets_location', NODISTRACTIONS_MENU_WIDGETS_LOCATION))
		{
			echo "<div class=\"footer-widget-area\">";
			echo "<div class=\"widget-area-container\">";
			if ( has_nav_menu( 'social' ) ) : 
			?>
				<nav id="social-navigation" class="social-navigation" role="navigation">
					<?php
						// Social links navigation menu.
						wp_nav_menu( array(
							'theme_location' => 'social',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav>
			<?php
			endif;
			get_sidebar(); 
			echo "</div>";
			echo "</div>";
		}
	?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php /*
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'nodistractions' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'nodistractions' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'nodistractions' ), 'nodistractions', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
			*/ ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
