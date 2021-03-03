<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package anitabijsterbosch
 */
get_header(); 
remove_action( 'wp_footer', 'shiftnav_direct_injection' );

// Retrieve the first gallery in the post
$gallery = get_post_gallery_images( $post );

?>
<style type="text/css">
.sidebar-wrapper
{
	display: none;
}
</style>
<div style="background: #000; height: 100%; width: 100%; position: fixed; top: 0; left: 0;"></div>
<?php

$i = 0;
foreach($gallery as $src)
{
	echo "<div id=\"homepage-{$i}-image\" class=\"homepage-landing\" style=\"background-image: url('{$src}'); " 
	. ($i > 0 ? "display: none;" : "")
	. "\"></div>";
	++$i;
}

?>



<div id="homepage-enter-container">
	<div id="homepage-enter"><h1><a href="<?=get_page_link(23);?>"><?=__('ENTER', 'anitabijsterbosch');?></a></h1></div>
</div>

<script type="text/javascript">
	var max = <?=$i;?>;
	var curr = 0;
	
	function nextImage()
	{
		$("#homepage-" + curr + "-image").fadeOut(1000, function()
		{
			curr++;
			curr = curr % max;
			$("#homepage-" + curr + "-image").fadeIn(1000);
		});
		
	}
	
	$(document).ready(function() {
		$("#homepage-enter a").hover(function() {
			$(this).stop(true, false);
			$(this).fadeTo(2000, 1);
			$(this).animate({ letterSpacing: "20px" }, {duration: 2000, queue: false });
			
		}, function() {
			$(this).stop(true, false);
			$(this).fadeTo(350, 0.7);
			$(this).animate({ letterSpacing: "10px" }, {duration: 350, queue: false });
		});
		
		setInterval(nextImage, 7500);
	});
	
	$('.homepage-landing').click(function()
		{
			window.location.href = $('#homepage-enter').find('a').attr('href');
		}
	);
	
</script>

<?php get_footer(); ?>
