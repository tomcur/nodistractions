<?php
/**
 * nodistractions functions and definitions
 *
 * @package nodistractions
 */

if ( ! function_exists( 'nodistractions_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nodistractions_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on nodistractions, use a find and replace
	 * to change 'nodistractions' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'nodistractions', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'nodistractions' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' )
	) );
	

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'status',
		'image',
		'gallery',
		'video',
		'audio',
		'quote',
		'chat',
		'link'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'nodistractions_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Disable infinite scrolling footer
	add_theme_support( 'infinite-scroll', array(
		'type' => 'click',
		'container' => 'content'
	) );
}
endif; // nodistractions_setup
add_action( 'after_setup_theme', 'nodistractions_setup' );

function nodistractions_infinite_scroll_credit() 
{
	return get_bloginfo( 'description', 'display' );
}
add_filter( 'infinite_scroll_credit', 'nodistractions_infinite_scroll_credit' );
 

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nodistractions_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nodistractions_content_width', 640 );
}
add_action( 'after_setup_theme', 'nodistractions_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function nodistractions_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nodistractions' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'nodistractions_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nodistractions_scripts() {
	wp_enqueue_style( 'nodistractions-style', get_stylesheet_uri() );
	
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
	
	
	
	wp_enqueue_script( 'nodistractions-script', get_template_directory_uri() . '/js/init.js', array(), '20150806', true );
	
	wp_enqueue_script( 'nodistractions-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20150806', true );
	wp_localize_script( 'nodistractions-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'nodistractions' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'nodistractions' ) . '</span>',
	) );
	wp_localize_script( 'nodistractions-navigation', 'nodistractionsParams', array(
		'menuOrientation'   => get_theme_mod('nodistractions_menu_orientation', NODISTRACTIONS_MENU_ORIENTATION)
	) );
	
	wp_enqueue_script( 'nodistractions-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'nodistractions_scripts' );

//Load javascript
function init_javascript() {
	if (!is_admin()) 
	{
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri()."/js/jquery.min.js", false, '1.11.3');
		wp_enqueue_script('jquery');
		
		wp_register_script('imagesLoaded', get_template_directory_uri()."/js/imagesloaded.pkgd.min.js", false, '3.1.8');
		wp_enqueue_script('imagesLoaded');
		wp_deregister_script('masonry');
		wp_register_script('masonry', get_template_directory_uri()."/js/masonry.pkgd.min.js", false, '3.3.0');
		wp_enqueue_script('masonry');
		
		wp_register_script('infinitescroll', get_template_directory_uri()."/js/infinitescroll.min.js", false, '2.1.0');
		wp_enqueue_script('infinitescroll');
	}
}
add_action('init', 'init_javascript');

/*
 * Custom masonry gallery.
 */
function gallery($id, $class, $perPage, $content, $handle, $minGridWidth=450, $gutterSize=3)
{
	$page = isset($_GET["masonry-{$id}-page"]) && $_GET["masonry-{$id}-page"] ? $_GET["masonry-{$id}-page"] : 1;
	$page = $page < 1 ? 1 : $page;
	$pages = ceil(count($content) / $perPage);
	$start = $perPage * ($page-1);
	$end = $start + $perPage;
	if($end > count($content))
	{
		$end = count($content);
	}
	
	
	$str = "<div class=\"masonry-container\"><div id=\"masonry-grid-{$id}\">";
	
	$ids = array_keys($content);
	for($i = $start; $i <$end; ++$i)
	{
		$c = $content[$ids[$i]];
		$str .= "<div class=\"{$class}\">".call_user_func($handle, $c)."</div>";
	}
	$str .= "</div>";
	$str .= "<div id=\"masonry-{$id}-nav\">";
	
	$link = "//" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	
	if($page > 1)
	{	
		$prev = add_query_arg(array("masonry-{$id}-page" => $page-1), $link);
		$str .= "<a id=\"masonry-{$id}-nav-previous\" href=\"{$prev}\" style=\"float: left;\">".__('Previous', 'nodistractions')."</a>";
	}
	
	if($page < $pages)
	{
		$next = add_query_arg(array("masonry-{$id}-page" => $page+1), $link);
		$str .= "<a id=\"masonry-{$id}-nav-next\" href=\"{$next}\" style=\"float: right;\">".__('Next', 'nodistractions')."</a>";
	}
	
	$pageLink = add_query_arg(array("masonry-{$id}-page" => ""), remove_query_arg("masonry-{$id}-page", $link));
	$pageLink .= "=";
	
	$str .= "</div></div>";
	
	$finishedMsg = __('No more images to load.', 'nodistractions');
	$msgText = __('Loading next set of images...', 'nodistractions');
	
	$loadingIconPath = get_stylesheet_directory_uri() . "/images/loading.gif";
	
	$str .= <<<EX
		<script type="text/javascript">
		
		var minGridSize = {$minGridWidth};
		var gutterSize = {$gutterSize};
		
		var \$container = \$('#masonry-grid-{$id}');
		

		var gridSize = function()
		{
			var width = \$container.width();
			
			// Calculate the number of columns
			var columns = 1;
			for(var i = 2; i * minGridSize + (i-1) * gutterSize < width; i++)
			{
				columns++;
			}
			
			var gutters = columns-1;
			var gridSize = (width - gutters * gutterSize) / columns;
			
			\$('.{$class}').css('maxWidth', gridSize + 'px');
			
			// Set image height according to aspect ratio as indicated by wordpress
			// and the width as indicated by the layout
			\$container.find('img').each(function()
				{
					\$this = \$(this);
					\$this.height(\$this.attr('height') / \$this.attr('width') * \$this.width());
				}
			);
		};
		
		\$(window).resize(gridSize);
		
		// Masonry + ImagesLoaded
		//\$container.imagesLoaded(function(){
		//	gridSize();
		//	\$container.masonry({
		//		// selector for entry content
		//		itemSelector: '.{$class}',
		//		gutter: gutterSize
		//	});
		//	\$container.css('visibility', 'visible');
		//});
		
		$(document).ready(function()
		{
			setTimeout(function()
			{
				gridSize();
				\$container.masonry({
					// selector for entry content
					itemSelector: '.{$class}',
					gutter: gutterSize
				});
				\$container.masonry('layout');
			}, 100);
		});
		
		\$container.infinitescroll({
			navSelector: "#masonry-{$id}-nav",
			nextSelector: "#masonry-{$id}-nav-next",
			itemSelector: '.{$class}',
			pathParse: undefined,
			path: ['{$pageLink}', ''],
			bufferPx: 3000,
			loading: {
				finishedMsg: '{$finishedMsg}',
				msgText: '{$msgText}',
				img: '{$loadingIconPath}'
			}
		},
		// trigger Masonry as a callback
		function( newElements ) {
			
			// hide new items while they are loading
			var \$newElems = \$( newElements ).css({ opacity: 0 });
			// ensure that images load before adding to masonry layout
			\$newElems.imagesLoaded(function(){
				// show elems now they're ready
				gridSize();
				\$newElems.animate({ opacity: 1 });
				\$container.masonry( 'appended', \$newElems, true ); 
				if(typeof doLightBox !== 'undefined' && typeof jQuery !== 'undefined'){ doLightBox(); }
			});
		});
	</script>
EX;
	
	return $str;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom functions
 */ 
require get_template_directory() . '/functions_custom.php';