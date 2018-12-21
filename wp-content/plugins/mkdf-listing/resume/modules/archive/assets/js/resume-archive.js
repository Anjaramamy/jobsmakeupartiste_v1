(function($) {
	'use strict';

	var resumeArchive = {};
	mkdf.modules.resumeArchive = resumeArchive;

	resumeArchive.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);
	
	resumeArchive.mkdfInitResumeArchiveSearch = mkdfInitResumeArchiveSearch;
	resumeArchive.mkdfGetResumeArchiveSearchResponse = mkdfGetResumeArchiveSearchResponse;
	resumeArchive.mkdfUpdateResumesNumber = mkdfUpdateResumesNumber;


	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
        mkdfInitResumeArchiveSearch();
    }
	
	function mkdfInitResumeArchiveSearch(){
		var container = $('.mkdf-rs-archive-holder');

		if(container.length){
			container.each(function(){

				var thisContainer = $(this),
					keywordSearch = thisContainer.find('.mkdf-archive-keyword-search'),
					typeSearch = thisContainer.find('.mkdf-archive-type-search'),
					typeSearchVal = typeSearch.val(),
					submitButton = thisContainer.find('.mkdf-archive-submit-button'),
					loadMoreButton = thisContainer.find('.mkdf-resume-archive-load-more'),
					availableResumes = mkdfResumeTitles.titles,
					currentVar = mkdfResumeArchiveVar.searchParams;

				mkdfUpdateResumesNumber(thisContainer, currentVar['foundPosts']);

				keywordSearch.autocomplete({
					source: availableResumes
				});


				submitButton.on('click', function(){
					mkdfGetResumeArchiveSearchResponse(thisContainer, false);
				});
				if( typeof loadMoreButton !== 'undefined' && loadMoreButton !== null){
					loadMoreButton.on('click', function(){
						mkdfGetResumeArchiveSearchResponse(thisContainer, true);
					});
				}

				mkdf.modules.resumes.mkdfShowHideButton(loadMoreButton, currentVar['nextPage'], currentVar['maxPage']);

			});
		}
	}
	
	function mkdfUpdateResumesNumber(container, currentNumber){

		var holder = container.find('.mkdf-rs-archive-items-number span');
		holder.html(currentNumber);

	}

	function mkdfGetResumeArchiveSearchResponse(container, loadMoreFlag){

		var	keywordSearch = container.find('.mkdf-archive-keyword-search'),
			typeSearch = container.find('.mkdf-archive-type-checkboxes'),
            locationSearch = container.find('.mkdf-archive-location'),
            categorySearch = container.find('.mkdf-archive-category'),
			loadMoreButton = container.find('.mkdf-resume-archive-load-more'),
			itemHolder = container.find('.mkdf-rs-archive-items-inner'),
			currentVar = mkdfResumeArchiveVar.searchParams;


		currentVar['keyword'] = keywordSearch.val();


		//TYPE param START
        currentVar['type'] = {};
        var typeParams = {};

        if (typeSearch.length) {

            var typeCheckboxes = $('.mkdf-rs-adv-search-input');

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

        if (mkdf.modules.resumes.mkdfIsValidObject(locationSearch) && locationSearch.val() !== '') {
            currentVar['location'] = locationSearch.val();
        }

        //LOCATION param END

        //CATEGORY param START
        var categoryParams = {};

        if (mkdf.modules.resumes.mkdfIsValidObject(categorySearch) && categorySearch.val() !== '') {
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
			action: 'mkdf_listing_resume_get_archive_search_response',
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
					mkdfUpdateResumesNumber(container, foundPosts);

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
							mkdf.modules.resumes.mkdfReinitResumeMultipleGoogleMaps(mapAddresses, 'append');
						}
						itemHolder.append(response.html);

                        mkdf.modules.rsmaps.mkdfResumeGoogleMaps.initResumeMarkerInfo();

					}
					else{
						//update multiple map addressess object
						if(mapAddresses !== ''){
							mkdf.modules.resumes.mkdfReinitResumeMultipleGoogleMaps(mapAddresses, 'replace');
						}

						//get new resumes html
						itemHolder.html(response.html);
					}

                    //reinit bindTitles function
                    mkdf.modules.resumes.mkdfResumeBindTitles();

					//show button
					mkdf.modules.resumes.mkdfShowHideButton(loadMoreButton, currentVar['nextPage'], currentVar['maxPage']);

					//reinit global archive var object
					mkdfResumeArchiveVar.searchParams = currentVar;
				}
			}
		});

	}
})(jQuery);