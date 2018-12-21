(function ($) {
    'use strict';

    var resumeAdvSearch = {};
    mkdf.modules.resumeAdvSearch = resumeAdvSearch;

    resumeAdvSearch.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    resumeAdvSearch.mkdfResumeInitAdvSearch = mkdfResumeInitAdvSearch;
    resumeAdvSearch.mkdfGetResumeAdvancedSearchResponse = mkdfGetResumeAdvancedSearchResponse;

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfResumeInitAdvSearch();
    }

    function mkdfResumeInitAdvSearch() {

        var container = $('.mkdf-rs-adv-search-holder');

        if (container.length) {
            container.each(function () {

                var thisContainer = $(this),
                    nextPage = thisContainer.data('next-page'),
                    maxNumPages = thisContainer.data('max-num-pages'),
                    submitButton = thisContainer.find('.mkdf-rs-adv-search-keyword-button'),
                    keywordField = thisContainer.find('.mkdf-rs-adv-search-keyword'),
                    availableResumes = mkdfResumeTitles.titles,
                    loadMoreButton = thisContainer.find('.mkdf-rs-adv-search-load-more');

                if (mkdf.modules.resumes.mkdfIsValidObject(keywordField)) {
                    keywordField.autocomplete({
                        source: availableResumes
                    });
                }

                submitButton.on('click', function () {
                    mkdfGetResumeAdvancedSearchResponse(thisContainer, false);
                });


                if (typeof loadMoreButton !== 'undefined' && loadMoreButton !== 'false') {
                    mkdf.modules.resumes.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);

                    loadMoreButton.on('click', function () {
                        mkdfGetResumeAdvancedSearchResponse(thisContainer, true);
                    });
                }

            });
        }

    }

    function mkdfGetResumeAdvancedSearchResponse(container, loadMoreFlag) {


        var number = container.data('number'),
            searchFields = container.find('.mkdf-rs-adv-search-input'),
            itemsHolder = container.find('.mkdf-rs-adv-search-items-holder-inner'),
            googleMap = container.data('enable-map'),
            mapFlag = false,
            loadMoreData,
            loadMoreButton = container.find('.mkdf-rs-adv-search-load-more'),
            keywordField = container.find('.mkdf-rs-adv-search-keyword'),
            locationField = container.find('.mkdf-rs-adv-search-location'),
            categoryField = container.find('.mkdf-rs-adv-search-category'),
            typeField = container.find('.mkdf-rs-adv-search-type-checkboxes'),
            keyword = '',
            defaultSearchParams = {},
            checkBoxSearchParams = {},
            categoryParams = {},
            typeParams = {},
            location = '',
            nextPage,
            itemType,
            data = {};

        if (mkdf.modules.resumes.mkdfIsValidObject(googleMap)) {
            if (googleMap === 'yes') {
                mapFlag = true;
            }
        }

        //custom fields parameters
        //if (searchFields.length) {
        //    searchFields.each(function () {
        //
        //        var thisField = $(this);
        //        var fieldNameAttr = thisField.attr('name');
        //        var fieldType = thisField.attr('type');
        //        var fieldVal;
        //
        //        //generate params for all other fields
        //        switch (fieldType) {
        //            case 'checkbox':
        //                fieldVal = thisField.is(':checked');
        //                checkBoxSearchParams[fieldNameAttr] = fieldVal;
        //                break;
        //            default :
        //                fieldVal = thisField.val();
        //                defaultSearchParams[fieldNameAttr] = fieldVal;
        //                break;
        //        }
        //    });
        //}

        //type parameter
        if (typeField.length) {

            var typeCheckboxes = $('.mkdf-rs-adv-search-input');

            typeCheckboxes.each(function () {

                var typeCheckbox = $(this);

                if (typeCheckbox.is(':checked')) {
                    typeParams[typeCheckbox.val()] = typeCheckbox.next().text();
                }
            });

        }

        //location parameter
        if (mkdf.modules.resumes.mkdfIsValidObject(locationField) && locationField.val() !== '') {
            location = locationField.val();
        }

        //category parameter
        if (mkdf.modules.resumes.mkdfIsValidObject(categoryField) && categoryField.val() !== '') {
            categoryParams[categoryField.val()] = categoryField.find('option:selected').text().trim();
        }

        //keyword parameter
        if (mkdf.modules.resumes.mkdfIsValidObject(keywordField)) {
            keyword = keywordField.val();
        }


        if (loadMoreFlag) {
            loadMoreData = mkdf.modules.common.getLoadMoreData(container);
        } else {
            container.data('next-page', '2');
        }


        //always get value from holder
        nextPage = container.data('next-page');

        itemType = container.data('item-type');


        data = {
            action: 'mkdf_listing_resume_advanced_search_response',
            postPerPage: number,
            defaultSearchParams: defaultSearchParams,
            checkBoxSearchParams: checkBoxSearchParams,
            location: location,
            catParams: categoryParams,
            typeParams: typeParams,
            keyword: keyword,
            enableLoadMore: loadMoreFlag,
            loadMoreData: loadMoreData,
            enableMap: mapFlag,
            itemType: itemType
        };

        $.ajax({
            type: "POST",
            url: MikadoListingAjaxUrl,
            data: data,
            success: function (data) {
                if (data === 'error') {

                } else {
                    var response = $.parseJSON(data);
                    var responseHtml = response.html;
                    var maxNumPages = response.maxNumPages;

                    if (typeof maxNumPages !== 'undefined' && maxNumPages !== 'false') {
                        container.data('max-num-pages', maxNumPages);
                    }

                    if (mapFlag) {

                        var mapObjs = response.mapAddresses;
                        var mapAddresses = '';


                        if (mkdf.modules.resumes.mkdfIsValidObject(mapObjs)) {
                            mapAddresses = mapObjs['addresses'];
                        }

                        if (loadMoreFlag) {
                            nextPage++;
                            container.data('next-page', nextPage);
                            //if new map objects are sent via ajax, update global map objects

                            mkdf.modules.resumes.mkdfReinitResumeMultipleGoogleMaps(mapAddresses, 'append');

                            setTimeout(function () {
                                itemsHolder.append(responseHtml);
                            }, 300);
                        } else {
                            //update multiple map addressess object

                            mkdf.modules.resumes.mkdfReinitResumeMultipleGoogleMaps(mapAddresses, 'replace');

                            setTimeout(function () {
                                itemsHolder.html(responseHtml);
                            }, 300);
                        }

                        mkdf.modules.resumes.mkdfResumeBindTitles();
                    }
                    else {

                        if (loadMoreFlag) {
                            nextPage++;
                            container.data('next-page', nextPage);

                            setTimeout(function () {
                                itemsHolder.append(responseHtml);
                            }, 300);
                        }
                        else {
                            setTimeout(function () {
                                itemsHolder.html(responseHtml);
                            }, 300);
                        }

                    }
                    //show button
                    mkdf.modules.resumes.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);
                }

            }
        });

    }

})(jQuery);