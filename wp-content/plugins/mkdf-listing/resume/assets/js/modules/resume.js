(function($) {

	var resumes = {};
	mkdf.modules.resumes = resumes;
	resumes.mkdfOnDocumentReady = mkdfOnDocumentReady;
	resumes.mkdfOnWindowLoad = mkdfOnWindowLoad;
	resumes.mkdfOnWindowResize = mkdfOnWindowResize;
	resumes.mkdfOnWindowScroll = mkdfOnWindowScroll;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	$(window).scroll(mkdfOnWindowScroll);

	resumes.mkdfInitResumeMainSearch = mkdfInitResumeMainSearch;
	resumes.mkdfResumeBindTitles = mkdfResumeBindTitles;
	resumes.mkdfShowHideButton = mkdfShowHideButton;
	resumes.mkdfReinitResumeMultipleGoogleMaps = mkdfReinitResumeMultipleGoogleMaps;
	resumes.mkdfIsValidObject = mkdfIsValidObject;

	function mkdfOnDocumentReady() {
		mkdfInitResumeMainSearch();
		mkdfResumeBindTitles();
	}
	function mkdfOnWindowLoad() {}
	function mkdfOnWindowResize() {}
	function mkdfOnWindowScroll() {}

	function mkdfInitResumeMainSearch(){
		var container = $('.mkdf-rs-main-search-holder');
		if(container.length){
			container.each(function(){
				var thisContainer = $(this),
					keywordSearch = thisContainer.find('.mkdf-rs-main-search-keyword'),
					availableResumes = mkdfResumeTitles.titles;
					keywordSearch.autocomplete({
						source: availableResumes
					});

			});
		}
	}
	
	function mkdfReinitResumeAdditionalSelectFields() {
        var selectFields = $('.job-manager-form .mkdf-rs-type-field-wrapper select');
        if(selectFields.length){
        	selectFields.each(function () {
				$(this).select2();
            });
		}
    }


	function mkdfReinitResumeMultipleGoogleMaps(addresses, action){

		if (action === 'append') {

			var mapObjs = mkdfMultipleResumeMapVars.multiple.addresses;
			mapObjs = mkdfMultipleResumeMapVars.multiple.addresses.concat(addresses);
			mkdfMultipleResumeMapVars.multiple.addresses = mapObjs;

			mkdf.modules.rsmaps.mkdfResumeGoogleMaps.getResumeDirectoryItemsAddresses({
				addresses: mapObjs
			});
		}
		else if (action === 'replace') {

			mkdfMultipleResumeMapVars.multiple.addresses = addresses;
			mkdf.modules.rsmaps.mkdfResumeGoogleMaps.getResumeDirectoryItemsAddresses({
				addresses: addresses
			});

		}
	}


	function mkdfShowHideButton(button, nextPage, maxNumPages){

		if(typeof button !== 'undefined' && button !== false && button !== null ){
			if(nextPage <= maxNumPages){
				button.show();
			}else{
				button.hide();
			}
		}

	}
	
	function mkdfResumeArchiveInitBack() {

		window.addEventListener("popstate", function(e) { // if a back or forward button is clicked
			location.reload();
		});

	}

	function mkdfResumeBindTitles() {
		
		var maps = $('.mkdf-rs-archive-map-holder'),
			lists = $('.mkdf-rs-archive-items');

		if (maps.length && lists.length){
			maps.each(function(){
				var  listItems = lists.find('.mkdf-rs-item');

				listItems.each(function(){
					var listItem = $(this);
					listItem.mouseenter(function(){
						var itemId = listItem.attr('id');
						if ($('.mkdf-map-marker-holder').length) {
							$('.mkdf-map-marker-holder').each(function(){
								var markerHolder = $(this),
									markerId = markerHolder.attr('id');
								if (itemId == markerId) {
									markerHolder.addClass('active');
									setTimeout(function(){
									},300);
								} else {
									markerHolder.removeClass('active');
								}
							});
						}
					});
				});

				lists.mouseleave(function(){
					$('.mkdf-map-marker-holder').removeClass('active');
				});
			});
		}
	}	

	function mkdfIsValidObject(object){
		if(typeof(object !== 'undefined') && object !== 'false' && object !== '' && object !== undefined){
			return true;
		}
		return false;
	}

})(jQuery);