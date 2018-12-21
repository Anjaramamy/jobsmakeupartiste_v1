(function($) {
    "use strict";

    var sidearea = {};
    mkdf.modules.sidearea = sidearea;

    sidearea.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSideArea();
	    mkdfSideAreaScroll();
    }
	
	/**
	 * Show/hide side area
	 */
	function mkdfSideArea() {
		var wrapper = $('.mkdf-wrapper'),
			sideMenuButtonOpen = $('a.mkdf-side-menu-button-opener'),
			cssClass = 'mkdf-right-side-menu-opened';
		
		wrapper.prepend('<div class="mkdf-cover"/>');
		
		$('a.mkdf-side-menu-button-opener, a.mkdf-close-side-menu').click( function(e) {
			e.preventDefault();
			
			if(!sideMenuButtonOpen.hasClass('opened')) {
				sideMenuButtonOpen.addClass('opened');
				mkdf.body.addClass(cssClass);
				
				$('.mkdf-wrapper .mkdf-cover').click(function() {
					mkdf.body.removeClass('mkdf-right-side-menu-opened');
					sideMenuButtonOpen.removeClass('opened');
				});
				
				var currentScroll = $(window).scrollTop();
				$(window).scroll(function() {
					if(Math.abs(mkdf.scroll - currentScroll) > 400){
						mkdf.body.removeClass(cssClass);
						sideMenuButtonOpen.removeClass('opened');
					}
				});
			} else {
				sideMenuButtonOpen.removeClass('opened');
				mkdf.body.removeClass(cssClass);
			}
		});
	}
	
	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function mkdfSideAreaScroll(){
		var sideMenu = $('.mkdf-side-menu');
		
		if(sideMenu.length){
			sideMenu.niceScroll({
				scrollspeed: 60,
				mousescrollstep: 40,
				cursorwidth: 0,
				cursorborder: 0,
				cursorborderradius: 0,
				cursorcolor: "transparent",
				autohidemode: false,
				horizrailenabled: false
			});
		}
	}

})(jQuery);
