<?php
/**
 * Template part for displaying single posts.
 *
 * @package nodistractions
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php nodistractions_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php 
			global $multipage, $numpages, $page;
			if($multipage !== 0)
			{
				echo "<div class=\"entry-num-pages\">".sprintf(__("Page %d of %d"), $page, $numpages)."</div>";
			}
			
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nodistractions' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'nodistractions' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>'
			) );
		?>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php nodistractions_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

