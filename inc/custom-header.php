<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @package nodistractions
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses nodistractions_header_style()
 * @uses nodistractions_admin_header_style()
 * @uses nodistractions_admin_header_image()
 */
function nodistractions_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'nodistractions_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'nodistractions_header_style',
		'admin-head-callback'    => 'nodistractions_admin_header_style',
		'admin-preview-callback' => 'nodistractions_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'nodistractions_custom_header_setup' );

if ( ! function_exists( 'nodistractions_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see nodistractions_custom_header_setup().
 */
function nodistractions_header_style() {
	$header_text_color = get_header_textcolor();
	
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	//if ( HEADER_TEXTCOLOR == $header_text_color ) {
	//	return;
	//}
	
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-description {
			color: <?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	
	a {
		color: <?=esc_attr(get_theme_mod('nodistractions_link_color', NODISTRACTIONS_LINK_COLOR));?>;
	}
	
	a:hover {
		color: <?=esc_attr(get_theme_mod('nodistractions_link_hover_color', NODISTRACTIONS_LINK_HOVER_COLOR));?>;
	}
	
	.site-title a {
		color: <?=esc_attr(get_theme_mod('nodistractions_site_title_color', NODISTRACTIONS_SITE_TITLE_COLOR));?>;
	}
	
	.site-title a:hover {
		color: <?=esc_attr(get_theme_mod('nodistractions_site_title_hover_color', NODISTRACTIONS_SITE_TITLE_HOVER_COLOR));?>;
	}
	
	body {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_page_background_color', NODISTRACTIONS_PAGE_BACKGROUND_COLOR));?>;
	}
	
	.site-header {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_header_background_color', NODISTRACTIONS_HEADER_BACKGROUND_COLOR));?>;
	}
	
	.sidebar {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_sidebar_background_color', NODISTRACTIONS_SIDEBAR_BACKGROUND_COLOR));?>;
	}
	
	.main-navigation {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_menu_background_color', NODISTRACTIONS_MENU_BACKGROUND_COLOR));?>;
	}
	
	.main-navigation ul {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_menu_background_color', NODISTRACTIONS_MENU_BACKGROUND_COLOR));?>;
	}
	
	.menu-widget-area.widget-area-container {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_widgets_background_color', NODISTRACTIONS_WIDGETS_BACKGROUND_COLOR));?>;
	}
	
	#content {
		background-color: <?=esc_attr(get_theme_mod('nodistractions_content_background_color', NODISTRACTIONS_CONTENT_BACKGROUND_COLOR));?>;
	}
	
	
	@media screen and (min-width: 890px) {
	<?php
		// Menu orientation
		// Horizontal Menu
		if("horizontal" == get_theme_mod('nodistractions_menu_orientation', NODISTRACTIONS_MENU_ORIENTATION)) :
	?>
		.main-navigation 
		{
			width: 100%;
			margin-top: 18px;
			margin-bottom: 18px;
		}
		
		.menu-item div
		{
			padding-top: 8px;
		}
		
		.main-navigation ul
		{
			border: none;
		}
		
		.main-navigation ul:after
		{
			content: '';
			display: block;
			clear: both;
		}
		
		.main-navigation ul li
		{
			margin: 0;
			float: left;
		}
		
		.main-navigation ul li a
		{
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 20px;
			padding-right: 30px;
		}
		
		.main-navigation ul li~li a
		{
			padding-left: 30px;
			border-top: none;
		}
		
		.main-navigation li~li 
		{
			border-left: 1px solid #eaeaea;
		}
		
		.main-navigation ul ul li~li 
		{
			border-left: none;
		}
		
		ul ul .dropdown-toggle {
			-ms-transform: rotate(-90deg);
			-webkit-transform: rotate(-90deg); 
			transform: rotate(-90deg);
		}

		.main-navigation ul ul {
			position: absolute;
			border: 1px solid #cfcfcf;
			margin: 0;
			-webkit-box-shadow: 0px 0px 4px 0px rgba(0,0,0,0.13);
			-moz-box-shadow: 0px 0px 4px 0px rgba(0,0,0,0.13);
			box-shadow: 0px 0px 4px 0px rgba(0,0,0,0.13);
		}
		
		.main-navigation ul ul .dropdown-toggle
		{
			margin-right: 5px;
		}

		.main-navigation ul ul li
		{
			width: 170px;
		}
		
		.main-navigation ul ul li a 
		{
			padding-left: 13px;
		}

		.main-navigation ul ul li~li
		{
			border-top: 1px solid #cfcfcf;
		}

		.main-navigation ul ul ul
		{
			top: -1px;
			left: 100%;
		}
		
		
		.site-content
		{
			float: left;
			width: 70%;
		}
	<?php
		// Vertical Menu
		else :
	?>
		<?php 
			// Left float
			if("left" == get_theme_mod('nodistractions_menu_float', NODISTRACTIONS_MENU_FLOAT)) :
		?>
			.sidebar-wrapper
			{
				float: left;
				width: 30%;
			}
			
			.sidebar
			{
				border-right: 20px solid rgba(255,255,255,0);
			}
		<?php
			// Right float
			else:
		?>
			.sidebar-wrapper
			{
				float: right;
				width: 30%;
			}
			
			.sidebar
			{
				border-left: 20px solid rgba(255,255,255,0);
			}
		<?php endif; ?>
			
		.sidebar
		{
			background-clip: padding-box;
			padding: 20px;
			padding-top: 15px;
		}
		
		.site-content
		{	
			float: left;
			width: 70%;
		}
		
		.sidebar input
		{
			width: 100%;
		}
		
		.menu-item div
		{
			padding-top: 14px;
			padding-bottom: 14px;
		}
	<?php endif ; ?>	
	
	.widget-area-container
	{
		padding: 20px;
		background-color: #ffffff;
		background-clip: padding-box;
	}
	
	.social-navigation
	{
		margin-top: 5px;
	}
	
	<?php
		// Widgets float
		// Widgets Right Float
		if("right" == get_theme_mod('nodistractions_menu_widgets_float', NODISTRACTIONS_MENU_WIDGETS_FLOAT)) :
	?>
		.footer-widget-area
		{
			float: right;
			overflow: hidden;
			width: 30%;
		}
		
		.menu-widget-area.widget-area-container
		{
			float: right;
			overflow: hidden;
			width: 30%;
		}
		
		.widget-area-container
		{
			border-left: 20px solid rgba(255,255,255,0);
		}
			
		.site-footer 
		{
			clear: both;
			width: 100%;
		}
	
		/*
		.site-content
		{
			padding-left: 20px;
		}
		*/
	<?php
		// Widgets Left Float
		elseif("left" == get_theme_mod('nodistractions_menu_widgets_float', NODISTRACTIONS_MENU_WIDGETS_FLOAT)) :
	?>
		.footer-widget-area
		{
			float: left;
			overflow: hidden;
			width: 30%;
		}
		
		.menu-widget-area.widget-area-container
		{
			float: left;
			overflow: hidden;
			width: 30%;
		}
		
		.widget-area-container
		{
			border-right: 20px solid rgba(255,255,255,0);
		}
			
		.site-footer 
		{
			clear: both;
			width: 100%;
		}
		
		.site-content
		{
			/* padding-right: 20px; */
			float: right;
		}
	
	<?php
		// Widgets No Float
		else :
	?>
		.footer-widget-area
		{
			display: inline-block;
			width: 100%;
		}
	<?php endif; ?>
	
	<?php
		if("sidebar" == get_theme_mod('nodistractions_menu_widgets_location', NODISTRACTIONS_MENU_WIDGETS_LOCATION)
			&&
			"vertical" == get_theme_mod('nodistractions_menu_orientation', NODISTRACTIONS_MENU_ORIENTATION
			)) :
	?>
		.widget-area-container
		{
			margin-top: 40px;
		}
	<?php endif; ?>
	
	<?php
		if("footer" == get_theme_mod('nodistractions_menu_widgets_location', NODISTRACTIONS_MENU_WIDGETS_LOCATION)
			&&
			"vertical" == get_theme_mod('nodistractions_menu_orientation', NODISTRACTIONS_MENU_ORIENTATION)
			&&
			get_theme_mod('nodistractions_menu_float', NODISTRACTIONS_MENU_FLOAT)
			  !=
			get_theme_mod('nodistractions_menu_widgets_float', NODISTRACTIONS_MENU_WIDGETS_FLOAT)
			&&
			"footer" != get_theme_mod('nodistractions_menu_widgets_float', NODISTRACTIONS_MENU_WIDGETS_FLOAT)
			) :
	?>
		.sidebar-wrapper
		{
			width: 22.5%;
		}
	
		.footer-widget-area
		{
			width: 22.5%;
		}
	
		.site-content
		{
			width: 55%;
		}
	<?php endif; ?>
	
	}
	</style>
	<?php
}
endif; // nodistractions_header_style

if ( ! function_exists( 'nodistractions_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see nodistractions_custom_header_setup().
 */
function nodistractions_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // nodistractions_admin_header_style

if ( ! function_exists( 'nodistractions_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see nodistractions_custom_header_setup().
 */
function nodistractions_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // nodistractions_admin_header_image
