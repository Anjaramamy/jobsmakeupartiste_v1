(function ($) {
    'use strict';

    var listingAdvSearch = {};
    mkdf.modules.listingAdvSearch = listingAdvSearch;

    listingAdvSearch.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    listingAdvSearch.mkdfInitAdvSearch = mkdfInitAdvSearch;
    listingAdvSearch.mkdfGetAdvancedSearchResponse = mkdfGetAdvancedSearchResponse;

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitAdvSearch();
    }

    function mkdfInitAdvSearch() {

        var container = $('.mkdf-ls-adv-search-holder');

        if (container.length) {
            container.each(function () {

                var thisContainer = $(this),
                    nextPage = thisContainer.data('next-page'),
                    maxNumPages = thisContainer.data('max-num-pages'),
                    submitButton = thisContainer.find('.mkdf-ls-adv-search-keyword-button'),
                    keywordField = thisContainer.find('.mkdf-ls-adv-search-keyword'),
                    availableListings = mkdfListingTitles.titles,
                    loadMoreButton = thisContainer.find('.mkdf-ls-adv-search-load-more');

                if (mkdf.modules.listings.mkdfIsValidObject(keywordField)) {
                    keywordField.autocomplete({
                        source: availableListings
                    });
                }

                if(thisContainer.filter("[data-enable-item-appear-animation]")){
                    thisContainer.addClass('mkdf-ls-appear-animation');
                }

                submitButton.on('click', function () {
                    mkdfGetAdvancedSearchResponse(thisContainer, false);
                });

                if (typeof loadMoreButton !== 'undefined' && loadMoreButton !== 'false') {
                    mkdf.modules.listings.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);

                    loadMoreButton.on('click', function () {
                        mkdfGetAdvancedSearchResponse(thisContainer, true);
                    });
                }

            });
        }

    }

    function mkdfGetAdvancedSearchResponse(container, loadMoreFlag) {

        var number = container.data('number'),
            searchFields = container.find('.mkdf-ls-adv-search-input'),
            itemsHolder = container.find('.mkdf-ls-adv-search-items-holder-inner'),
            googleMap = container.data('enable-map'),
            mapFlag = false,
            loadMoreData,
            loadMoreButton = container.find('.mkdf-ls-adv-search-load-more'),
            keywordField = container.find('.mkdf-ls-adv-search-keyword'),
            locationField = container.find('.mkdf-ls-adv-search-location'),
            categoryField = container.find('.mkdf-ls-adv-search-category'),
            typeField = container.find('.mkdf-ls-adv-search-type-checkboxes'),
            keyword = '',
            defaultSearchParams = {},
            checkBoxSearchParams = {},
            categoryParams = {},
            typeParams = {},
            location = '',
            nextPage,
            itemType,
            titleTag,
            data = {};

        if (mkdf.modules.listings.mkdfIsValidObject(googleMap)) {
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

            var typeCheckboxes = $('.mkdf-ls-adv-search-input');

            typeCheckboxes.each(function () {

                var typeCheckbox = $(this);

                if (typeCheckbox.is(':checked')) {
                    typeParams[typeCheckbox.val()] = typeCheckbox.next().text();
                }
            });

        }

        //location parameter
        if (mkdf.modules.listings.mkdfIsValidObject(locationField) && locationField.val() !== '') {
            location = locationField.val();
        }

        //category parameter
        if (mkdf.modules.listings.mkdfIsValidObject(categoryField) && categoryField.val() !== '') {
            categoryParams[categoryField.val()] = categoryField.find('option:selected').text().trim();
        }

        //keyword parameter
        if (mkdf.modules.listings.mkdfIsValidObject(keywordField)) {
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

        titleTag = container.data('title-tag');

        data = {
            action: 'mkdf_listing_job_advanced_search_response',
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
            itemType: itemType,
            titleTag: titleTag
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

                        if (mkdf.modules.listings.mkdfIsValidObject(mapObjs)) {
                            mapAddresses = mapObjs['addresses'];
                        }

                        if (loadMoreFlag) {
                            nextPage++;
                            container.data('next-page', nextPage);
                            //if new map objects are sent via ajax, update global map objects

                            mkdf.modules.listings.mkdfReinitMultipleGoogleMaps(mapAddresses, 'append');

                            setTimeout(function () {
                                itemsHolder.append(responseHtml);
                                if(itemsHolder.parents('.kdf-ls-adv-search-holder').filter("[data-enable-item-appear-animation]")){
                                    itemsHolder.find('.mkdf-ls-item').each(function(i){
                                        var lsItem = $(this);
                                        lsItem.addClass('mkdf-ls-item-appear');

                                        setTimeout(function () {
                                            lsItem.addClass('mkdf-ls-item-appeared');
                                        }, 150*i);
                                    });
                                }
                            }, 300);
                        } else {
                            //update multiple map addressess object

                            mkdf.modules.listings.mkdfReinitMultipleGoogleMaps(mapAddresses, 'replace');

                            setTimeout(function () {
                                itemsHolder.html(responseHtml);
                                if(itemsHolder.parents('.kdf-ls-adv-search-holder').filter("[data-enable-item-appear-animation]")){
                                    itemsHolder.find('.mkdf-ls-item').each(function(i){
                                        var lsItem = $(this);
                                        lsItem.addClass('mkdf-ls-item-appear');

                                        setTimeout(function () {
                                            lsItem.addClass('mkdf-ls-item-appeared');
                                        }, 150*i);
                                    });
                                }
                            }, 300);
                        }

                        mkdf.modules.listings.mkdfBindTitles();
                    }
                    else {

                        if (loadMoreFlag) {
                            nextPage++;
                            container.data('next-page', nextPage);

                            setTimeout(function () {
                                itemsHolder.append(responseHtml);

                                if(itemsHolder.parents('.kdf-ls-adv-search-holder').filter("[data-enable-item-appear-animation]")){
                                    itemsHolder.find('.mkdf-ls-item').each(function(i){
                                        var lsItem = $(this);
                                        lsItem.addClass('mkdf-ls-item-appear');

                                        setTimeout(function () {
                                            lsItem.addClass('mkdf-ls-item-appeared');
                                        }, 150*i);
                                    });
                                }

                            }, 300);
                        }

                        else {
                            setTimeout(function () {
                                itemsHolder.html(responseHtml);

                                if(itemsHolder.parents('.kdf-ls-adv-search-holder').filter("[data-enable-item-appear-animation]")){
                                    itemsHolder.find('.mkdf-ls-item').each(function(i){
                                        var lsItem = $(this);
                                        lsItem.addClass('mkdf-ls-item-appear');

                                        setTimeout(function () {
                                            lsItem.addClass('mkdf-ls-item-appeared');
                                        }, 150*i);
                                    });
                                }
                            }, 300);
                        }

                    }
                    //show button
                    mkdf.modules.listings.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);
                }

            }
        });

    }

})(jQuery);