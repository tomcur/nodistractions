/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function( $ ) {
	// Add dropdown toggle that display child menu items.
	$( '.main-navigation .menu-item-has-children > a' ).after( '<div><button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button></div>' );
	
	// Toggle buttons and submenu items with active children menu items.
	if ($('.main-navigation').width() < $('#page').width() - 2)
	{
		$( '.main-navigation .current-menu-ancestor > div > button' ).addClass( 'toggle-on' );
		$( '.main-navigation .current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );
	}
	
	$('.dropdown-toggle').click(function(e) 
	{
		var button = $( this );
		var ul = $( this ).parent().next('.children, .sub-menu');
		
		e.preventDefault();
		
		if(nodistractionsParams.menuOrientation == "horizontal" && $(window).width() > 890)
		{
			// Close all other menus at this level
			var topParent = button.parent().parent().parent();
			var children = topParent.children('.menu-item-has-children');
			children.find('ul').not(ul).removeClass('toggled-on').attr('aria-expanded', 'false');
			children.find('button').not(button).removeClass('toggle-on').attr('aria-expanded', 'false');
		}
		
		ul.toggleClass( 'toggled-on' );
		ul.attr( 'aria-expanded', ul.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		
		button.toggleClass( 'toggle-on' );
		button.attr( 'aria-expanded', button.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		button.html( button.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		
		e.stopPropagation();
	});
	
	$('html').click(function(e) 
	{
		if(nodistractionsParams.menuOrientation == "horizontal" && $(window).width() > 890)
		{
			$('.main-navigation').find('button').removeClass('toggle-on').attr('aria-expanded', 'false');
			$('.main-navigation').find('ul').removeClass('toggled-on').attr('aria-expanded', 'false');
		}
	});
	
	var container, button, menu, links, subMenus, widgets;
	container = $("#sidebar");
	
	button = $(".secondary-toggle");
	if ('undefined' === typeof button) 
	{
		return;
	}
	
	/**
	Fix issue where mobile users have to click twice on navigation links
	*/
	container.find('a').on('click touchend', function(e) 
	{
		var el = $(this);
		var link = el.attr('href');
		window.location = link;
	});
	
	menu = $(".menu ul");
	widgets = $(".widget-area");

	// Enable menu toggle for small screens.
	(function() {
		
		button.on('click.nodistractions', function() 
		{
			$( this ).toggleClass( 'toggled-on' );
			container.toggleClass( 'toggled-on' );
			if ( $( this, menu, widgets ).hasClass( 'toggled-on' ) ) 
			{
				$( this ).attr( 'aria-expanded', 'true' );
				menu.attr( 'aria-expanded', 'true' );
				widgets.attr( 'aria-expanded', 'true' );
			} 
			else 
			{
				$( this ).attr( 'aria-expanded', 'false' );
				menu.attr( 'aria-expanded', 'false' );
				widgets.attr( 'aria-expanded', 'true' );
			}
		});
	})();
	

	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu)
	{
		button.style.display = 'none';
		return;
	}

	menu.attr( 'aria-expanded', 'false' );
	if (!menu.hasClass( 'nav-menu' )) 
	{
		menu.addClass( 'nav-menu' );
	}

	// Get all the link elements within the menu.
	links    = menu.find( 'a' );
	subMenus = menu.find( 'ul' );
	
	// Set menu items with submenus to aria-haspopup="true".
	for (var i = 0, len = subMenus.length; i < len; i++) 
	{
		$(subMenus[i]).parent().attr( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for (i = 0, len = links.length; i < len; i++) {
		links.on( 'focus', toggleFocus );
		links.on( 'blur', toggleFocus );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() 
	{
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while (-1 === self.className.indexOf( 'nav-menu' )) 
		{

			// On li elements toggle the class .focus.
			if ('li' === self.tagName.toLowerCase()) 
			{
				if (-1 !== self.className.indexOf( 'focus' )) 
				{
					self.className = self.className.replace( ' focus', '' );
				} 
				else 
				{
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
	
	/**
	 * Make mobile sidebar fill entire screen height 
	 */
	function sizeSidebar()
	{
		// Get viewport size
		var e = window, a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        viewport = {width : e[ a+'Width' ], height : e[ a+'Height' ]};
		
		if(viewport.width < 890)
		{
			console.log('test');
			container.css('height', $(window).height() - (container.position().top + container.parent().position().top));
			if(!container.hasClass('mobile'))
			{
				container.addClass('mobile');
			}
		}
		else
		{
			container.css('height', 'auto');
			
			if(container.hasClass('mobile'))
			{
				container.removeClass('mobile');
				
				// Close menus
				$( '.main-navigation .current-menu-ancestor > div > button' ).removeClass('toggle-on').attr('aria-expanded', 'false');
				$( '.main-navigation .current-menu-ancestor > .sub-menu' ).removeClass('toggled-on').attr('aria-expanded', 'false');
			}
		}
	}
	
	/** 
	 * Masthead scroll on small screens
	 */
	var bar;
	var mast = $('.admin-bar .sidebar-wrapper');
	function scrollSidebar()
	{
		if(!bar)
		{
			bar = $("#wpadminbar")
		}
		
		if(container.hasClass('mobile'))
		{
			if(bar.css('position') == 'absolute')
			{
				var top = Math.max(0, bar.height() - $(window).scrollTop());
				mast.css({'top': top, 'padding-bottom': top});
			}
			else
			{
				mast.css({'top': bar.height(), 'padding-bottom': bar.height()});
			}
		}
		else
		{
			mast.css({'top': 0, 'padding-bottom': 0});
		}
	}
	
	sizeSidebar();
	
	$(window).resize(function()
	{
		sizeSidebar();
		scrollSidebar();
	});
	
	$(window).scroll(function()
	{
		scrollSidebar();
	});
	
	/**
	 * Better sidebar scroll handling
	 */
	$(document).on('DOMMouseScroll mousewheel', '#sidebar', function(ev) 
	{
		var prevent = function() 
		{
			ev.stopPropagation();
			ev.preventDefault();
			ev.returnValue = false;
			return false;
		}
		
		/* Prevent document form scrolling when edges are reached */
		var $this = $(this),
			scrollTop = this.scrollTop,
			scrollHeight = this.scrollHeight,
			height = $this.height(),
			delta = (ev.type == 'DOMMouseScroll' ?
				ev.originalEvent.detail * -40 :
				ev.originalEvent.wheelDelta),
			up = delta > 0;
		
		if(!$this.hasClass('mobile'))
		{
			return;
		}
		
		var prevent = function() 
		{
			ev.stopPropagation();
			ev.preventDefault();
			ev.returnValue = false;
			return false;
		}

		if (!up && -delta > scrollHeight - height - scrollTop) 
		{
			// Scrolling down, but this will take us past the bottom.
			$this.scrollTop(scrollHeight);
			return prevent();
		} 
		else if (up && delta > scrollTop) 
		{
			// Scrolling up, but this will take us past the top.
			$this.scrollTop(0);
			return prevent();
		}
	});
} )(jQuery);
