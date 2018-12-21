(function($) {
    "use strict";

    var search = {};
    mkdf.modules.search = search;

    search.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSearch();
    }
	
	/**
	 * Init Search Types
	 */
	function mkdfSearch() {
		var searchOpener = $('a.mkdf-search-opener'),
			searchForm,
			searchClose;
		
		if ( searchOpener.length > 0 ) {
			//Check for type of search
			if ( mkdf.body.hasClass( 'mkdf-fullscreen-search' ) ) {
				searchClose = $( '.mkdf-fullscreen-search-close' );
				mkdfFullscreenSearch();
				
			} else if ( mkdf.body.hasClass( 'mkdf-slide-from-header-bottom' ) ) {
				mkdfSearchSlideFromHeaderBottom();
				
			} else if ( mkdf.body.hasClass( 'mkdf-search-covers-header' ) ) {
				mkdfSearchCoversHeader();
				
			} else if ( mkdf.body.hasClass( 'mkdf-search-slides-from-window-top' ) ) {
				searchForm = $('.mkdf-search-slide-window-top');
				searchClose = $('.mkdf-swt-search-close');
				mkdfSearchWindowTop();
			}
		}
		
		/**
		 * Fullscreen search fade
		 */
		function mkdfFullscreenSearch() {
			var searchHolder = $('.mkdf-fullscreen-search-holder');
			
			searchOpener.click(function (e) {
				e.preventDefault();
				
				if (searchHolder.hasClass('mkdf-animate')) {
					mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-out');
					mkdf.body.removeClass('mkdf-search-fade-in');
					searchHolder.removeClass('mkdf-animate');
					
					setTimeout(function () {
						searchHolder.find('.mkdf-search-field').val('');
						searchHolder.find('.mkdf-search-field').blur();
					}, 300);
					
					mkdf.modules.common.mkdfEnableScroll();
				} else {
					mkdf.body.addClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
					mkdf.body.removeClass('mkdf-search-fade-out');
					searchHolder.addClass('mkdf-animate');
					
					setTimeout(function () {
						searchHolder.find('.mkdf-search-field').focus();
					}, 900);
					
					mkdf.modules.common.mkdfDisableScroll();
				}
				
				searchClose.click(function (e) {
					e.preventDefault();
					mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
					mkdf.body.addClass('mkdf-search-fade-out');
					searchHolder.removeClass('mkdf-animate');
					
					setTimeout(function () {
						searchHolder.find('.mkdf-search-field').val('');
						searchHolder.find('.mkdf-search-field').blur();
					}, 300);
					
					mkdf.modules.common.mkdfEnableScroll();
				});
				
				//Close on click away
				$(document).mouseup(function (e) {
					var container = $(".mkdf-form-holder-inner");
					
					if (!container.is(e.target) && container.has(e.target).length === 0) {
						e.preventDefault();
						mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
						mkdf.body.addClass('mkdf-search-fade-out');
						searchHolder.removeClass('mkdf-animate');
						
						setTimeout(function () {
							searchHolder.find('.mkdf-search-field').val('');
							searchHolder.find('.mkdf-search-field').blur();
						}, 300);
						
						mkdf.modules.common.mkdfEnableScroll();
					}
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode == 27) { //KeyCode for ESC button is 27
						mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
						mkdf.body.addClass('mkdf-search-fade-out');
						searchHolder.removeClass('mkdf-animate');
						
						setTimeout(function () {
							searchHolder.find('.mkdf-search-field').val('');
							searchHolder.find('.mkdf-search-field').blur();
						}, 300);
						
						mkdf.modules.common.mkdfEnableScroll();
					}
				});
			});
			
			//Text input focus change
			var inputSearchField = $('.mkdf-fullscreen-search-holder .mkdf-search-field'),
				inputSearchLine = $('.mkdf-fullscreen-search-holder .mkdf-field-holder .mkdf-line');
			
			inputSearchField.focus(function () {
				inputSearchLine.css('width', '100%');
			});
			
			inputSearchField.blur(function () {
				inputSearchLine.css('width', '0');
			});
		}
		
		/**
		 * Search covers header type of search
		 */
		function mkdfSearchCoversHeader() {
			searchOpener.click(function (e) {
				e.preventDefault();
				
				var thisSearchOpener = $(this),
					searchFormHeight,
					searchFormHeaderHolder = $('.mkdf-page-header'),
					searchFormTopHeaderHolder = $('.mkdf-top-bar'),
					searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
					searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
					searchForm = $('.mkdf-search-cover'),
					searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
					searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
					searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
					searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;
				
				searchForm.removeClass('mkdf-is-active');
				
				//Find search form position in header and height
				if (searchFormIsInTopHeader) {
					searchFormHeight = mkdfGlobalVars.vars.mkdfTopBarHeight;
					searchFormTopHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');
					
				} else if (searchFormIsInFixedHeader) {
					searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
					searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');
					
				} else if (searchFormIsInStickyHeader) {
					searchFormHeight = mkdfGlobalVars.vars.mkdfStickyHeaderHeight;
					searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');
					
				} else if (searchFormIsInMobileHeader) {
					if(searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
						searchFormHeight = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight();
					} else {
						searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
					}
					
					searchFormMobileHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');
					
				} else {
					searchFormHeight = searchFormHeaderHolder.outerHeight();
					searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');
				}
				
				if(searchForm.hasClass('mkdf-is-active')) {
					searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
				}
				
				searchForm.find('.mkdf-search-close').click(function (e) {
					e.preventDefault();
					searchForm.stop(true).fadeOut(450);
				});
				
				searchForm.blur(function () {
					searchForm.stop(true).fadeOut(450);
				});
				
				$(window).scroll(function(){
					searchForm.stop(true).fadeOut(450);
				});
			});
		}
		
		/**
		 * Search slides from window top type of search
		 */
		function mkdfSearchWindowTop() {
			searchOpener.click( function(e) {
				e.preventDefault();
				
				if ( searchForm.height() == "0") {
					$('.mkdf-search-slide-window-top input[type="text"]').focus();
					//Push header bottom
					mkdf.body.addClass('mkdf-search-open');
				} else {
					mkdf.body.removeClass('mkdf-search-open');
				}
				
				$(window).scroll(function() {
					if ( searchForm.height() != '0' && mkdf.scroll > 50 ) {
						mkdf.body.removeClass('mkdf-search-open');
					}
				});
				
				searchClose.click(function(e){
					e.preventDefault();
					mkdf.body.removeClass('mkdf-search-open');
				});
			});
		}
		
		/**
		 * Search slide from header bottom type of search
		 */
		function mkdfSearchSlideFromHeaderBottom() {
			searchOpener.click( function(e) {
				e.preventDefault();
				
				var thisSearchOpener = $(this),
					searchIconPosition = parseInt(mkdf.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());
				
				if(mkdf.body.hasClass('mkdf-boxed') && mkdf.windowWidth > 1024) {
					searchIconPosition -= parseInt((mkdf.windowWidth - $('.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner').outerWidth()) / 2);
				}
				
				var searchFormHeaderHolder = $('.mkdf-page-header'),
					searchFormTopOffset = '100%',
					searchFormTopHeaderHolder = $('.mkdf-top-bar'),
					searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
					searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
					searchForm = $('.mkdf-slide-from-header-bottom-holder'),
					searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
					searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
					searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
					searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;
				
				searchForm.removeClass('mkdf-is-active');
				
				//Find search form position in header and height
				if (searchFormIsInTopHeader) {
					searchFormTopHeaderHolder.find('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
					
				} else if (searchFormIsInFixedHeader) {
					searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
					searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
					
				} else if (searchFormIsInStickyHeader) {
					searchFormTopOffset = mkdfGlobalVars.vars.mkdfStickyHeaderHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar;
					searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
					
				} else if (searchFormIsInMobileHeader) {
					if(searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
						searchFormTopOffset = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
					}
					searchFormMobileHeaderHolder.find('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
					
				} else {
					searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
				}
				
				if(searchForm.hasClass('mkdf-is-active')) {
					searchForm.css({'right': searchIconPosition, 'top': searchFormTopOffset}).stop(true).slideToggle(300, 'easeOutBack');
				}
				
				//Close on escape
				$(document).keyup(function(e){
					if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
						searchForm.stop(true).fadeOut(0);
					}
				});
				
				$(window).scroll(function(){
					searchForm.stop(true).fadeOut(0);
				});
			});
		}
	}

})(jQuery);
