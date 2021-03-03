<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package nodistractions
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js load">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Vollkorn">


<!-- favicons -->
<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicons/favicon-194x194.png" sizes="194x194">
<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#345696">
<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
<meta name="theme-color" content="#345696">

<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?=get_template_directory_uri() . '/style_custom.css';?>">
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nodistractions' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			
			<?php if ( get_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php bloginfo( 'name' ); ?> Logo">		
				</a>
			<?php endif; // End header image check. ?>
			
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			
			
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="sidebar-wrapper" class="sidebar-wrapper">
		<header class="sidebar-site-header" role="banner">
			<div class="sidebar-site-branding">
				<?php
					$img = get_theme_mod('nodistractions_mobile_header_icon');
					if($img)
					{
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?=$img;?>" alt="<?php bloginfo( 'name' ); ?> Logo">		
						</a>
						<?php
					}
					else
					{
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					}
				?>
			</div>
		</header>
		<button class="secondary-toggle" aria-expanded="false" aria-controls="secondary"><span class="screen-reader-text">Menu and widgets</span></button>
		<div id="sidebar" class="sidebar">
			<div id="navigation" class="navigation">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
			
			<?php
				if((is_home() || is_single()) && "sidebar" == get_theme_mod('nodistractions_menu_widgets_location', NODISTRACTIONS_MENU_WIDGETS_LOCATION))
				{
					echo "<div class=\"widget-area-container menu-widget-area\">";
					
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
				} 
			?>
		</div>
	</div>
	<div id="content" class="site-content">
