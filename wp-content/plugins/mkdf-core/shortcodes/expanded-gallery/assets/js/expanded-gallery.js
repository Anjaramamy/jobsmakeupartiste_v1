(function($) {
	'use strict';
	
	var expandedGallery = {};
	mkdf.modules.expandedGallery = expandedGallery;

	expandedGallery.mkdfInitExpandedGallery = mkdfInitExpandedGallery;


	expandedGallery.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitExpandedGallery();
	}

	/*
	 **	Init Expanded Gallery shortcode
	 */
	function mkdfInitExpandedGallery(){
		var holder = $('.mkdf-expanded-gallery');

		if(holder.length){
			holder.each(function() {
				var thisHolder = $(this),
					thisHolderImages = thisHolder.find('.mkdf-eg-image');

				thisHolder.find('.mkdf-eg-image:nth-child('+Math.ceil(thisHolderImages.length / 2)+')').addClass('mkdf-eg-middle-item');

				thisHolder.appear(function() {
					thisHolder.find('.mkdf-eg-middle-item').addClass('mkdf-eg-show');

					setTimeout(function(){
						thisHolder.find('.mkdf-eg-middle-item').prev().addClass('mkdf-eg-show');
						thisHolder.find('.mkdf-eg-middle-item').next().addClass('mkdf-eg-show');
					},250);

					if (thisHolder.hasClass('mkdf-eg-five')) {
						setTimeout(function(){
							thisHolder.find('.mkdf-eg-middle-item').prev().prev().addClass('mkdf-eg-show');
							thisHolder.find('.mkdf-eg-middle-item').next().next().addClass('mkdf-eg-show');
						},500);
					}
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);