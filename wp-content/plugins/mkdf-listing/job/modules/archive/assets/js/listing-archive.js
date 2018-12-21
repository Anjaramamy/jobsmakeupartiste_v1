(function($) {
	'use strict';

	var listingArchive = {};
	mkdf.modules.listingArchive = listingArchive;

	listingArchive.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);
	
	listingArchive.mkdfInitArchiveSearch = mkdfInitArchiveSearch;
	listingArchive.mkdfGetArchiveSearchResponse = mkdfGetArchiveSearchResponse;
	listingArchive.mkdfUpdateListingsNumber = mkdfUpdateListingsNumber;


	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
        mkdfInitArchiveSearch();
    }
	
	function mkdfInitArchiveSearch(){
		var container = $('.mkdf-ls-archive-holder');

		if(container.length){
			container.each(function(){

				var thisContainer = $(this),
					keywordSearch = thisContainer.find('.mkdf-archive-keyword-search'),
					typeSearch = thisContainer.find('.mkdf-archive-type-search'),
					typeSearchVal = typeSearch.val(),
					submitButton = thisContainer.find('.mkdf-archive-submit-button'),
					loadMoreButton = thisContainer.find('.mkdf-listing-archive-load-more'),
					availableListings = mkdfListingTitles.titles,
					currentVar = mkdfListingArchiveVar.searchParams;

				mkdfUpdateListingsNumber(thisContainer, currentVar['foundPosts']);

				keywordSearch.autocomplete({
					source: availableListings
				});


				submitButton.on('click', function(){
					mkdfGetArchiveSearchResponse(thisContainer, false);
				});
				if( typeof loadMoreButton !== 'undefined' && loadMoreButton !== null){
					loadMoreButton.on('click', function(){
						mkdfGetArchiveSearchResponse(thisContainer, true);
					});
				}

				mkdf.modules.listings.mkdfShowHideButton(loadMoreButton, currentVar['nextPage'], currentVar['maxPage']);

			});
		}
	}
	
	function mkdfUpdateListingsNumber(container, currentNumber){

		var holder = container.find('.mkdf-ls-archive-items-number span');
		holder.html(currentNumber);

	}

	function mkdfGetArchiveSearchResponse(container, loadMoreFlag){

		var	keywordSearch = container.find('.mkdf-archive-keyword-search'),
			typeSearch = container.find('.mkdf-archive-type-checkboxes'),
            locationSearch = container.find('.mkdf-archive-location'),
            categorySearch = container.find('.mkdf-archive-category'),
			loadMoreButton = container.find('.mkdf-listing-archive-load-more'),
			itemHolder = container.find('.mkdf-ls-archive-items-inner'),
			currentVar = mkdfListingArchiveVar.searchParams;


		currentVar['keyword'] = keywordSearch.val();


		//TYPE param START
        currentVar['type'] = {};
        var typeParams = {};

        if (typeSearch.length) {

            var typeCheckboxes = $('.mkdf-ls-adv-search-input');

            typeCheckboxes.each(function () {

                var typeCheckbox = $(this);

                if (typeCheckbox.is(':checked')) {
                   typeParams[typeCheckbox.val()] = typeCheckbox.next().text().trim();
                }
            });

        }

        currentVar['type'] = typeParams;

        //TYPE param END

        //LOCATION param START
        currentVar['location'] = '';

        if (mkdf.modules.listings.mkdfIsValidObject(locationSearch) && locationSearch.val() !== '') {
            currentVar['location'] = locationSearch.val();
        }

        //LOCATION param END

        //CATEGORY param START
        var categoryParams = {};

        if (mkdf.modules.listings.mkdfIsValidObject(categorySearch) && categorySearch.val() !== '') {
            categoryParams[categorySearch.val()] = categorySearch.find('option:selected').text().trim();
        }

        currentVar['category'] = categoryParams;

        //CATEGORY param END

		if(loadMoreFlag){
			currentVar['enableLoadMore'] = true;
		}else{
			currentVar['enableLoadMore'] = false;
			currentVar['nextPage'] = '2';
		}

		var ajaxData = {
			action: 'mkdf_listing_job_get_archive_search_response',
			searchParams: currentVar
		};

		$.ajax({
			type: "POST",
			url: MikadoListingAjaxUrl,
			data: ajaxData,
			success: function (data) {
				if (data === 'error') {
					//error handler
				}else{
					var response = $.parseJSON(data);

					//update current post number
					var foundPosts = response.foundPosts;
					mkdfUpdateListingsNumber(container, foundPosts);

					var mapObjs = response.mapAddresses;
					var mapAddresses = '';
					if(mapObjs !== null){
						mapAddresses = mapObjs['addresses'];
					}

					//update maxNumPages after each ajax response
					currentVar['maxPage'] = response.maxNumPages;

					//if is clicked load more button
					if(loadMoreFlag){
						//update nextPage after each ajax response
						currentVar['nextPage']++;

						//if new map objects are sent via ajax, update global map objects
						if(mapAddresses !== ''){
							mkdf.modules.listings.mkdfReinitMultipleGoogleMaps(mapAddresses, 'append');
						}
						itemHolder.append(response.html);

                        mkdf.modules.maps.mkdfGoogleMaps.initMarkerInfo();

					}
					else{
						//update multiple map addressess object
						if(mapAddresses !== ''){
							mkdf.modules.listings.mkdfReinitMultipleGoogleMaps(mapAddresses, 'replace');
						}

						//get new listings html
						itemHolder.html(response.html);
					}

                    //reinit bindTitles function
                    mkdf.modules.listings.mkdfBindTitles();

					//show button
					mkdf.modules.listings.mkdfShowHideButton(loadMoreButton, currentVar['nextPage'], currentVar['maxPage']);

					//reinit global archive var object
					mkdfListingArchiveVar.searchParams = currentVar;
				}
			}
		});

	}
})(jQuery);