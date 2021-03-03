<?php
/*
Template Name: Books Gallery
*/
/**
 * The template for displaying the books page.
 *
 * @package anitabijsterbosch
 */

get_header(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

function setGallery($output, $atts, $content = false, $tag = false) 
{
	global $post;
	
	$args = array(
		'post_parent' => $post->ID,
		'post_type'   => 'page', 
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	); 
	$children = get_children($args);
	
	return gallery("books", "grid-item-books-gallery", $children, function($child)
	{
		$img = get_the_post_thumbnail($child->ID, 'medium');
		$link = get_page_link($child->ID);
		$title = get_the_title($child->ID);
		$information = getInformation($child->ID);
		$flavor = isset($information['short_text']) ? $information['short_text'] : '';
		
		$str = <<<EX
		<div class="grid-item-books-gallery-image">
				<a href="{$link}">{$img}</a>
			</div>
			<div class="grid-item-books-gallery-header">
				<h3>{$title}</h3>
			</div>
			<div class="grid-item-books-gallery-flavor">
				{$flavor}
			</div>
			<div class="grid-item-books-gallery-link">
				<a href="{$link}">%s</a>
			</div>
EX;
	return sprintf($str, __('more information', 'nodistractions'));
	}, 250, 35);
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
