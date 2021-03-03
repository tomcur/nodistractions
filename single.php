<?php
/**
 * The template for displaying all single posts.
 *
 * @package nodistractions
 */

get_header(); ?>

<style type="text/css">
@media screen and (min-width: 890px)
{
	.site-content
	{
		width: 70%;
		float: left;
	}
}
</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>
			
			<?php the_post_navigation(array(
				'prev_text' => '&#8592; %title',
				'next_text' => '%title &#8594;'
			)); ?>
			
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
