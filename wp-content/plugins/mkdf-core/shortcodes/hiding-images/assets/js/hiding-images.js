(function($) {
    'use strict';
	
	var hidingImages = {};
	mkdf.modules.hidingImages = hidingImages;

    hidingImages.mkdfInitHidingImages = mkdfInitHidingImages;


    hidingImages.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 ** All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
        mkdfInitHidingImages();
	}

    function mkdfInitHidingImages() {
        var containers = $('.mkdf-hiding-images');

        if (containers.length && !mkdf.htmlEl.hasClass('touch')) {
            containers.appear(function(){
                var container  = $(this);

                container.waitForImages(function(){
                    container.addClass('mkdf-appeared');
                });
            },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
        }
    }

})(jQuery);

