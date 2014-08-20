/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$('.site-description').css( {
					'color': to
				});
			}
		} );
	} );
	
	// Site title color
	wp.customize( 'nodistractions_site_title_color', function( value ) {
		value.bind( function( to ) {
			$('.site-title a').css( {
				'color': to
			});
		});
	} );
	
	// Page background color
	wp.customize( 'nodistractions_page_background_color', function( value ) {
		value.bind( function( to ) {
			$('body').css( {
				'backgroundColor': to
			});
		});
	} );
	
	// Header background color
	wp.customize( 'nodistractions_header_background_color', function( value ) {
		value.bind( function( to ) {
			$('.site-header').css( {
				'backgroundColor': to
			});
		});
	} );
	
	// Sidebar background color
	wp.customize( 'nodistractions_sidebar_background_color', function( value ) {
		value.bind( function( to ) {
			$('.menu-widget-area.widget-area-container').css( {
				'backgroundColor': to
			});
		});
	} );
	
	// Menu background color
	wp.customize( 'nodistractions_menu_background_color', function( value ) {
		value.bind( function( to ) {
			$('.main-navigation').css( {
				'backgroundColor': to
			});
			
			$('.main-navigation ul').css( {
				'backgroundColor': to
			});
		});
	} );
	
	// Widgets background color
	wp.customize( 'nodistractions_widgets_background_color', function( value ) {
		value.bind( function( to ) {
			$('.widget-area').css( {
				'backgroundColor': to
			});
		});
	} );
	
	// Content background color
	wp.customize( 'nodistractions_content_background_color', function( value ) {
		value.bind( function( to ) {
			$('#content').css( {
				'backgroundColor': to
			});
		});
	} );
	
} )( jQuery );
