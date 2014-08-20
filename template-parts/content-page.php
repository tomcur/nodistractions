<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package nodistractions
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
		<?php edit_post_link( esc_html__( 'Edit', 'nodistractions' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

