<?php
/*
Template Name: Downloads Gallery
*/
/**
 * The template for displaying the books page.
 *
 * @package anitabijsterbosch
 */
get_header(); 

function setGallery($content) 
{
	global $post;
	remove_filter( 'the_content', 'setGallery' );
	
	$args = array(
		'post_parent' => $post->ID,
		'post_type'   => 'page', 
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	); 
	$children = get_children($args);
	
	return gallery("downloads", "grid-item-downloads-gallery", $children, function($child)
	{
		$img = get_the_post_thumbnail($child->ID, 'medium');
		$link = get_page_link($child->ID);
		$title = get_the_title($child->ID);
		
		$meta = get_post_meta($child->ID);
		$color = isset($meta['color'][0]) && $meta['color'][0] ? $meta['color'][0] : "#fff";
		
		$post = get_post($child->ID);
		$content = apply_filters('the_content', $post->post_content);
		$str = <<<EX
			<div class="grid-item-downloads-gallery-container" style="background-color: {$color}">
				<div class="grid-item-downloads-gallery-image">
					<a href="{$link}">{$img}</a>
				</div>
				<div class="grid-item-downloads-gallery-header">
					<h3>{$title}</h3>
				</div>
				<div class="grid-item-downloads-gallery-flavor">
					{$content}
				</div>
				<div class="grid-item-downloads-gallery-link">
					<a href="{$link}">%s</a>
				</div>
			</div>
EX;
		return sprintf($str, __('Permalink', 'nodistractions'));
	}, 250, 3);
}
add_filter( 'the_content', 'setGallery' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'template-parts/content', 'page' ); ?>

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
