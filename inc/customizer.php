<?php
/**
 * nodistractions Theme Customizer
 *
 * @package nodistractions
 */

 /* Defaults */
define("NODISTRACTIONS_HEADER_TEXT_COLOR", "#808080");
define("NODISTRACTIONS_SITE_TITLE_COLOR", "#6a6a6a");
define("NODISTRACTIONS_SITE_TITLE_HOVER_COLOR", "#000000");
define("NODISTRACTIONS_LINK_COLOR", "#219b8e");
define("NODISTRACTIONS_LINK_HOVER_COLOR", "#0f3647");

define("NODISTRACTIONS_PAGE_BACKGROUND_COLOR", "#ffffff");
define("NODISTRACTIONS_HEADER_BACKGROUND_COLOR", "#ffffff");
define("NODISTRACTIONS_SIDEBAR_BACKGROUND_COLOR", "#ffffff");
define("NODISTRACTIONS_MENU_BACKGROUND_COLOR", "#ffffff");
define("NODISTRACTIONS_WIDGETS_BACKGROUND_COLOR", "#ffffff");
define("NODISTRACTIONS_CONTENT_BACKGROUND_COLOR", "#ffffff");

define("NODISTRACTIONS_MENU_ORIENTATION", "horizontal");
define("NODISTRACTIONS_MENU_FLOAT", "left");
define("NODISTRACTIONS_MENU_WIDGETS_LOCATION", "sidebar");
define("NODISTRACTIONS_MENU_WIDGETS_FLOAT", "right");


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nodistractions_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default = NODISTRACTIONS_HEADER_TEXT_COLOR;
	
	
	/* Color settings */
	// Headers
	$wp_customize->add_setting( 'nodistractions_site_title_color', array(
		'default' => NODISTRACTIONS_SITE_TITLE_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_site_title_color', array(
		'label'        => __( 'Site Title Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_site_title_color'
	)));
	
	// Title hover
	$wp_customize->add_setting( 'nodistractions_site_title_hover_color', array(
		'default' => NODISTRACTIONS_SITE_TITLE_HOVER_COLOR,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_site_title_hover_color', array(
		'label'        => __( 'Site title Hover Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_site_title_hover_color'
	)));
	
	// Page background color
	$wp_customize->add_setting( 'nodistractions_page_background_color', array(
		'default' => NODISTRACTIONS_PAGE_BACKGROUND_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_page_background_color', array(
		'label'        => __( 'Page Background Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_page_background_color'
	)));
	
	// Header background color
	$wp_customize->add_setting( 'nodistractions_header_background_color', array(
		'default' => NODISTRACTIONS_HEADER_BACKGROUND_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_header_background_color', array(
		'label'        => __( 'Header Background Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_header_background_color'
	)));
	
	// Sidebar background color
	$wp_customize->add_setting( 'nodistractions_sidebar_background_color', array(
		'default' => NODISTRACTIONS_SIDEBAR_BACKGROUND_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_sidebar_background_color', array(
		'label'        => __( 'Sidebar Background Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_sidebar_background_color'
	)));
	
	// Menu background color
	$wp_customize->add_setting( 'nodistractions_menu_background_color', array(
		'default' => NODISTRACTIONS_MENU_BACKGROUND_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_menu_background_color', array(
		'label'        => __( 'Menu Background Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_menu_background_color'
	)));
	
	// Widgets background color
	$wp_customize->add_setting( 'nodistractions_widgets_background_color', array(
		'default' => NODISTRACTIONS_WIDGETS_BACKGROUND_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_widgets_background_color', array(
		'label'        => __( 'Widgets Background Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_widgets_background_color'
	)));
	
	// Content background color
	$wp_customize->add_setting( 'nodistractions_content_background_color', array(
		'default' => NODISTRACTIONS_CONTENT_BACKGROUND_COLOR,
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_content_background_color', array(
		'label'        => __( 'Content Background Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_content_background_color'
	)));
	
	// Link
	$wp_customize->add_setting( 'nodistractions_link_color', array(
		'default' => NODISTRACTIONS_LINK_COLOR,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_link_color', array(
		'label'        => __( 'Link Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_link_color'
	)));
	
	// Link hover
	$wp_customize->add_setting( 'nodistractions_link_hover_color', array(
		'default' => NODISTRACTIONS_LINK_HOVER_COLOR,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nodistractions_link_hover_color', array(
		'label'        => __( 'Link Hover Color', 'nodistractions' ),
		'section'    => 'colors',
		'settings'   => 'nodistractions_link_hover_color'
	)));
	
	/* Mobile site settings */
	$wp_customize->add_section( 'nodistractions_mobile' , array(
		'title'      => __( 'Mobile Site Settings', 'nodistractions' ),
		'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'nodistractions_mobile_header_icon', array(
		'default' => '',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nodistractions_mobile_header_icon', array(
		'label'        => __( 'Header Icon', 'nodistractions' ),
		'section'    => 'nodistractions_mobile',
		'settings'   => 'nodistractions_mobile_header_icon'
	)));
	
	/* Menu settings */
	$wp_customize->add_section( 'nodistractions_menu' , array(
		'title'      => __( 'Menu Settings', 'nodistractions' ),
		'priority'   => 20,
	) );
	
	/* Menu orientation */
	$wp_customize->add_setting( 'nodistractions_menu_orientation', array(
		'default' => NODISTRACTIONS_MENU_ORIENTATION,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( 'nodistractions_menu_orientation', array(
		'type'		=> 'radio',
		'label'        => __( 'Menu Orientation', 'nodistractions' ),
		'section'	=> 'nodistractions_menu',
		'settings'	=> 'nodistractions_menu_orientation',
		'choices' => array(
			'horizontal' => 'Horizontal',
			'vertical' => 'Vertical'
		)	
	));
	
	/* Menu position */
	$wp_customize->add_setting( 'nodistractions_menu_float', array(
		'default' => NODISTRACTIONS_MENU_FLOAT,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( 'nodistractions_menu_float', array(
		'type'		=> 'radio',
		'label'        => __( 'Menu Float', 'nodistractions' ),
		'description' => __('Location of menu relative to the content (only relevant for vertical menus).'),
		'section'	=> 'nodistractions_menu',
		'settings'	=> 'nodistractions_menu_float',
		'choices' => array(
			'left' => 'Left',
			'right' => 'Right'
		)	
	));
	
	/* Widgets position */
	$wp_customize->add_setting( 'nodistractions_menu_widgets_location', array(
		'default' => NODISTRACTIONS_MENU_ORIENTATION,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( 'nodistractions_menu_widgets_location', array(
		'type'		=> 'radio',
		'label'        => __( 'Widgets Location', 'nodistractions' ),
		'section'	=> 'nodistractions_menu',
		'settings'	=> 'nodistractions_menu_widgets_location',
		'choices' => array(
			'sidebar' => 'In Menu',
			'footer' => 'Outside of Menu'
		)	
	));
	
	/* Widgets float */
	$wp_customize->add_setting( 'nodistractions_menu_widgets_float', array(
		'default' => NODISTRACTIONS_MENU_WIDGETS_FLOAT,
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control( 'nodistractions_menu_widgets_float', array(
		'type'		=> 'radio',
		'label'        => __( 'Widgets Float', 'nodistractions' ),
		'description' => __('Location of widgets relative to the content.'),
		'section'	=> 'nodistractions_menu',
		'settings'	=> 'nodistractions_menu_widgets_float',
		'choices' => array(
			'left' => 'Left',
			'right' => 'Right',
			'footer' => 'Footer'
		)	
	));
}
add_action( 'customize_register', 'nodistractions_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nodistractions_customize_preview_js() {
	wp_enqueue_script( 
		'nodistractions_customizer', 
		get_template_directory_uri() . '/js/customizer.js', 
		array( 'jquery', 'customize-preview' ), '20150609', 
		true 
	);
}
add_action( 'customize_preview_init', 'nodistractions_customize_preview_js' );
