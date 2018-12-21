(function($) {
	"use strict";

    var common = {};
    mkdf.modules.common = common;

    common.mkdfFluidVideo = mkdfFluidVideo;
    common.mkdfEnableScroll = mkdfEnableScroll;
    common.mkdfDisableScroll = mkdfDisableScroll;
    common.mkdfOwlSlider = mkdfOwlSlider;
    common.mkdfInitParallax = mkdfInitParallax;
    common.mkdfInitSelfHostedVideoPlayer = mkdfInitSelfHostedVideoPlayer;
    common.mkdfSelfHostedVideoSize = mkdfSelfHostedVideoSize;
    common.mkdfPrettyPhoto = mkdfPrettyPhoto;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;

    common.mkdfOnDocumentReady = mkdfOnDocumentReady;
    common.mkdfOnWindowLoad = mkdfOnWindowLoad;
    common.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfIconWithHover().init();
	    mkdfDisableSmoothScrollForMac();
	    mkdfInitAnchor().init();
	    mkdfInitBackToTop();
	    mkdfBackButtonShowHide();
	    mkdfInitSelfHostedVideoPlayer();
	    mkdfSelfHostedVideoSize();
	    mkdfFluidVideo();
	    mkdfOwlSlider();
	    mkdfPreloadBackgrounds();
	    mkdfPrettyPhoto();
	    mkdfSearchPostTypeWidget();
        mkdInitCustomMenuDropdown();
        mkdSidebarCustomMenu();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
	    mkdfInitParallax();
        mkdfSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdfSelfHostedVideoSize();
    }
	
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function mkdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && mkdf.body.hasClass('mkdf-smooth-scroll')) {
			mkdf.body.removeClass('mkdf-smooth-scroll');
		}
	}
	
	function mkdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', mkdfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = mkdfWheel;
		document.onkeydown = mkdfKeydown;
	}
	
	function mkdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', mkdfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function mkdfWheel(e) {
		mkdfPreventDefaultValue(e);
	}
	
	function mkdfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				mkdfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function mkdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var mkdfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			
			$('.mkdf-main-menu .mkdf-active-item, .mkdf-mobile-nav .mkdf-active-item, .mkdf-fullscreen-menu .mkdf-active-item').removeClass('mkdf-active-item');
			anchor.parent().addClass('mkdf-active-item');
			
			$('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-fullscreen-menu a').removeClass('current');
			anchor.addClass('current');
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			var anchorData = $('[data-mkdf-anchor]');
			
			anchorData.waypoint( function(direction) {
				if(direction === 'down') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
				}
			}, { offset: '50%' });
			
			anchorData.waypoint( function(direction) {
				if(direction === 'up') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
			
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-mkdf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-mkdf-anchor="' + hash + '"]') : '';
			
			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - mkdfGlobalVars.vars.mkdfAddForAdminBar;
				
				setActiveState(anchor);
				
				mkdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {
			
			if (mkdf.modules.stickyHeader.behaviour === 'mkdf-sticky-header-on-scroll-down-up') {
				mkdf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > mkdf.modules.header.stickyAppearAmount);
			}
			
			if (mkdf.modules.stickyHeader.behaviour === 'mkdf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > mkdf.scroll)) {
					mkdf.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = mkdf.modules.stickyHeader.isStickyVisible ? mkdfGlobalVars.vars.mkdfStickyHeaderTransparencyHeight : mkdfPerPageVars.vars.mkdfHeaderTransparencyHeight;
			
			if (mkdf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			mkdf.document.on("click", ".mkdf-main-menu a, .mkdf-fullscreen-menu a, .mkdf-btn, .mkdf-anchor, .mkdf-mobile-nav a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-mkdf-anchor="' + hash + '"]') : '';
				
				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - mkdfGlobalVars.vars.mkdfAddForAdminBar;
					
					setActiveState(anchor);
					
					mkdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});
					return false;
				}
			});
		};
		
		return {
			init: function () {
				if ($('[data-mkdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).load(function () {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};
	
	function mkdfInitBackToTop() {
		var backToTopButton = $('#mkdf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			mkdf.html.animate({scrollTop: 0}, mkdf.window.scrollTop() / 3, 'linear');
		});
	}
	
	function mkdfBackButtonShowHide() {
		mkdf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;
			
			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}
			
			if (d < 1e3) {
				mkdfToTopButton('off');
			} else {
				mkdfToTopButton('on');
			}
		});
	}
	
	function mkdfToTopButton(a) {
		var b = $("#mkdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}
	
	function mkdfInitSelfHostedVideoPlayer() {
		var players = $('.mkdf-self-hosted-video');
		
		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function mkdfSelfHostedVideoSize(){
		var selfVideoHolder = $('.mkdf-self-hosted-video-holder .mkdf-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.mkdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / mkdf.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function mkdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function mkdfSmoothTransition() {

		if (mkdf.body.hasClass('mkdf-smooth-page-transitions')) {

			//check for preload animation
			if (mkdf.body.hasClass('mkdf-smooth-page-transitions-preloader')) {
				var loader = $('body > .mkdf-smooth-transition-loader.mkdf-mimic-ajax');
				if($('.mkdf-staffscout-loader').length){
					$('.mkdf-staffscout-loader').addClass('mkdf-staffscout-loader-loaded');

					loader.addClass('mkdf-staffscout-loader-loaded');

					setTimeout(function(){
						loader.fadeOut(500);
					},1500);
				}
				else {

					loader.fadeOut(500);

					$(window).bind('pageshow', function (event) {
						if (event.originalEvent.persisted) {
							loader.fadeOut(500);
						}
					});
				}
			}

			//check for fade out animation
			if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.click(function (e) {
					var a = $(this);

					if ((a.parents('.mkdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.mkdf-wrapper-inner').fadeOut(1000, function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'mkdf-preload-background' class
	 */
	function mkdfPreloadBackgrounds(){
		var preloadBackHolder = $('.mkdf-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('mkdf-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('mkdf-preload-background'); }); //make sure that mkdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function mkdfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

    function mkdfSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.mkdf-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.mkdf-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.mkdf-post-type-search-results'),
                    searchLoading = thisSearch.find('.mkdf-search-loading'),
                    searchIcon = thisSearch.find('.mkdf-search-icon');

                searchLoading.addClass('mkdf-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function() {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('mkdf-hidden');
                    searchIcon.addClass('mkdf-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('mkdf-hidden');
                            searchIcon.removeClass('mkdf-hidden');
                        } else {
                            var ajaxData = {
                                action: 'staffscout_mikado_search_post_types',
                                term: searchTerm,
                                postType: postType
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status === 'success') {
                                        searchLoading.addClass('mkdf-hidden');
                                        searchIcon.removeClass('mkdf-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('mkdf-hidden');
                                    searchIcon.removeClass('mkdf-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('mkdf-hidden');
                    searchIcon.removeClass('mkdf-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfIconWithHover = function() {
		//get all icons on page
		var icons = $('.mkdf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function mkdfInitParallax(){
		var parallaxHolder = $('.mkdf-parallax-row-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					image = parallaxElement.data('parallax-bg-image'),
					speed = parallaxElement.data('parallax-bg-speed') * 0.4,
					height = 0;
				
				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}
				
				parallaxElement.css({'background-image': 'url('+image+')'});
				
				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}

    /**
     * Init Owl Carousel
     */
    function mkdfOwlSlider() {
        var sliders = $('.mkdf-owl-slider');
        var sliderHolder = $('.mkdf-testimonials-holder');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
	                slideItemsNumber = slider.children().length,
	                numberOfItems = 1,
	                loop = true,
	                autoplay = true,
	                autoplayHoverPause = true,
	                sliderSpeed = 5000,
	                sliderSpeedAnimation = 600,
	                margin = 0,
	                responsiveMargin = 0,
	                responsiveMargin1 = 0,
	                stagePadding = 0,
	                stagePaddingEnabled = false,
	                center = false,
	                autoWidth = false,
	                animateIn = false, // keyframe css animation
	                animateOut = false, // keyframe css animation
	                navigation = true,
	                pagination = false,
                    paginationData = false,
                    mouseDrag = true,
                    touchDrag = true,
	                sliderIsPortfolio = !!slider.hasClass('mkdf-pl-is-slider'),
	                sliderDataHolder = sliderIsPortfolio ? slider.parent() : slider;  // this is condition for portfolio slider
	
	            if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsPortfolio) {
		            numberOfItems = slider.data('number-of-items');
	            }
	            if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsPortfolio) {
		            numberOfItems = sliderDataHolder.data('number-of-columns');
	            }
	            if (sliderDataHolder.data('enable-loop') === 'no') {
		            loop = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay') === 'no') {
		            autoplay = false;
	            }
                if (sliderDataHolder.data('enable-mouse-drag') === 'no') {
                    mouseDrag = false;
                }
                if (sliderDataHolder.data('enable-touch-drag') === 'no') {
                    touchDrag = false;
                }
	            if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
		            autoplayHoverPause = false;
	            }
	            if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
		            sliderSpeed = sliderDataHolder.data('slider-speed');
	            }
	            if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
		            sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
	            }
	            if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
		            if (sliderDataHolder.data('slider-margin') === 'no') {
			            margin = 0;
		            } else {
			            margin = sliderDataHolder.data('slider-margin');
		            }
	            } else {
		            if(slider.parent().hasClass('mkdf-huge-space')) {
			            margin = 60;
		            } else if (slider.parent().hasClass('mkdf-large-space')) {
			            margin = 50;
		            } else if (slider.parent().hasClass('mkdf-medium-space')) {
			            margin = 40;
		            } else if (slider.parent().hasClass('mkdf-normal-space')) {
			            margin = 30;
		            } else if (slider.parent().hasClass('mkdf-small-space')) {
			            margin = 20;
		            } else if (slider.parent().hasClass('mkdf-tiny-space')) {
			            margin = 10;
		            }
	            }
	            if (sliderDataHolder.data('slider-padding') === 'yes') {
		            stagePaddingEnabled = true;
		            stagePadding = parseInt(slider.outerWidth() * 0.28);
		            margin = 50;
	            }
	            if (sliderDataHolder.data('enable-center') === 'yes') {
		            center = true;
	            }
	            if (sliderDataHolder.data('enable-auto-width') === 'yes') {
		            autoWidth = true;
	            }
	            if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
		            animateIn = sliderDataHolder.data('slider-animate-in');
	            }
	            if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
		            animateOut = sliderDataHolder.data('slider-animate-out');
	            }
	            if (sliderDataHolder.data('enable-navigation') === 'no') {
		            navigation = false;
	            }

                if (sliderDataHolder.data('enable-pagination-data') === 'yes') {
                    paginationData = true;
                }

	            if (sliderDataHolder.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }
	            
	            if(navigation && pagination) {
		            slider.addClass('mkdf-slider-has-both-nav');
	            }


	
	            if (slideItemsNumber <= 1) {
		            loop       = false;
		            autoplay   = false;
		            navigation = false;
		            pagination = false;
	            }
	
	            var responsiveNumberOfItems1 = 1,
		            responsiveNumberOfItems2 = 2,
		            responsiveNumberOfItems3 = 3,
		            responsiveNumberOfItems4 = numberOfItems;
	
	            if (numberOfItems < 3) {
		            responsiveNumberOfItems2 = numberOfItems;
		            responsiveNumberOfItems3 = numberOfItems;
	            }
	
	            if (numberOfItems > 4) {
		            responsiveNumberOfItems4 = 4;
	            }
	
	            if (stagePaddingEnabled || margin > 30) {
		            responsiveMargin = 20;
		            responsiveMargin1 = 30;
	            }

                if (sliderDataHolder.data('enable-ipad-2') === 'yes') {
                    responsiveNumberOfItems3 = 2;
                }
	
	            if (margin > 0 && margin <= 30) {
		            responsiveMargin = margin;
		            responsiveMargin1 = margin;
	            }
	
	            slider.owlCarousel({
		            items: numberOfItems,
		            loop: loop,
		            autoplay: autoplay,
		            autoplayHoverPause: autoplayHoverPause,
		            autoplayTimeout: sliderSpeed,
		            smartSpeed: sliderSpeedAnimation,
		            margin: margin,
		            stagePadding: stagePadding,
		            center: center,
		            autoWidth: autoWidth,
		            animateIn: animateIn,
		            animateOut: animateOut,
		            dots: pagination,
                    dotsData: paginationData,
		            nav: navigation,
					mouseDrag: mouseDrag,
					touchDrag: touchDrag,
		            navText: [
			            '<span class="mkdf-prev-icon dripicons-chevron-left"></span>',
			            '<span class="mkdf-next-icon dripicons-chevron-right"></span>'
		            ],
		            responsive: {
			            0: {
				            items: responsiveNumberOfItems1,
				            margin: responsiveMargin,
				            stagePadding: 0,
				            center: false,
				            autoWidth: false
			            },
			            681: {
				            items: responsiveNumberOfItems2,
				            margin: responsiveMargin1
			            },
			            769: {
				            items: responsiveNumberOfItems3,
				            margin: responsiveMargin1
			            },
			            1025: {
				            items: responsiveNumberOfItems4
			            },
			            1281: {
				            items: numberOfItems
			            }
		            },
		            onInitialize: function () {
			            slider.css('visibility', 'visible');
			            mkdfInitParallax();
		            },
                    onInitialized: function () {
                        if(slider.parents('.mkdf-testimonials-holder').hasClass('mkdf-testimonials-standard')) {
                            mkdfInitTestimonialsThumbs(slider);
                        }
                    },
		            onDrag: function (e) {
			            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
				            var sliderIsMoving = e.isTrigger > 0;
				
				            if (sliderIsMoving) {
					            slider.addClass('mkdf-slider-is-moving');
				            }
			            }
		            },
		            onDragged: function () {
			            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && slider.hasClass('mkdf-slider-is-moving')) {
				
				            setTimeout(function () {
					            slider.removeClass('mkdf-slider-is-moving');
				            }, 500);
			            }
		            }
                });
            });
        }
    }

	/*
	 ** Init Testimonials Thumbs
	 */
    function mkdfInitTestimonialsThumbs(slider){
        var dotcount = 1;

        var owlDot = slider.find('.owl-dot');
        var owlStandardItem = slider.find('.owl-item');

        owlDot.each(function() {
            $( this ).addClass( 'dotnumber' + dotcount);
            $( this ).attr('data-info', dotcount);
            dotcount=dotcount+1;
        });

        var slidecount = 1;

        owlStandardItem.not('.cloned').each(function() {
            $( this ).addClass( 'slidenumber' + slidecount);
            slidecount=slidecount+1;
        });

        owlDot.each(function() {

            var grab = $(this).data('info');

            var imagesDataHolder = slider.find('.slidenumber'+ grab +' .mkdf-testimonial-bullets-holder');

            var slidegrab = imagesDataHolder.data('bullet-image');
            var slidegrab2 = imagesDataHolder.data('bullet-company');

            $(this).find("span").addClass("mkdf-testimonial-image").css("background-image", "url("+slidegrab+")");

            $(this).append("<div class='mkdf-testimonial-company-holder'><img src ='"+ slidegrab2+ "' class= 'mkdf-testimonial-company-logo'/></div>").find(".mkdf-testimonial-company-logo");

        });
    }

    function mkdInitCustomMenuDropdown() {
        var menus = $('.mkdf-sidebar .widget_nav_menu .menu');

        var dropdownOpeners,
            currentMenu;

        if(menus.length) {
            menus.each(function() {
                currentMenu = $(this);

                dropdownOpeners = currentMenu.find('> li.menu-item-has-children > a');

                if(dropdownOpeners.length) {
                    dropdownOpeners.each(function() {
                        var currentDropdownOpener = $(this);

                        currentDropdownOpener.on('click', function(e) {
                            e.preventDefault();

                            var dropdownToOpen = currentDropdownOpener.parent().children('.sub-menu');

                            if(dropdownToOpen.is(':visible')) {
                                dropdownToOpen.slideUp();
                                currentDropdownOpener.removeClass('mkdf-custom-menu-active');
                            } else {
                                dropdownToOpen.slideDown();
                                currentDropdownOpener.addClass('mkdf-custom-menu-active');
                            }
                        });
                    });
                }
            });
        }
    }
    function mkdSidebarCustomMenu() {
        var menuItems = $('.mkdf-sidebar .widget_nav_menu .menu > li > a');

        menuItems.each(function() {
            var menuItem = this;

            $(menuItem).append("<span class='mkdf-item-outer'></span>");

        });
    }

})(jQuery);