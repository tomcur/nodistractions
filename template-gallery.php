<?php
/*
Template Name: Gallery
*/
/**
 * The template for displaying the illustrations page.
 *
 * @package anitabijsterbosch
 */

get_header(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

function setGallery($output, $atts, $content = false, $tag = false) 
{	
	$ids = explode(',', $atts['ids']);
	$size = isset($atts['size']) ? $atts['size'] : 'medium';
	
	return gallery("illustrations", "grid-item", $ids, function($id) use($size)
	{
		return wp_get_attachment_link($id, $size);
	});
}
add_filter( 'post_gallery', 'setGallery', 10, 4 );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
			
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
