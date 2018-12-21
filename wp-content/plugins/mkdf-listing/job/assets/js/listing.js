(function($) {

	var listingsSelect = {};
	mkdf.modules.listingsSelect = listingsSelect;
	listingsSelect.mkdfOnDocumentReady = mkdfOnDocumentReady;
	listingsSelect.mkdfOnWindowLoad = mkdfOnWindowLoad;
	listingsSelect.mkdfOnWindowResize = mkdfOnWindowResize;
	listingsSelect.mkdfOnWindowScroll = mkdfOnWindowScroll;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	$(window).scroll(mkdfOnWindowScroll);

	listingsSelect.mkdfSelect2Fields = mkdfSelect2Fields;
	listingsSelect.mkdfInitSelect2Field = mkdfInitSelect2Field;


	function mkdfOnDocumentReady() {
        mkdfSelect2Fields();
	}
	function mkdfOnWindowLoad() {}
	function mkdfOnWindowResize() {}
	function mkdfOnWindowScroll() {}

	function mkdfSelect2Fields(){

		var defaultSelectFields = $(
			'.mkdf-ls-adv-search-holder select, ' +
			'.mkdf-ls-main-search-holder-part select, ' +
			'.mkdf-ls-archive-holder select,' +
			'.mkdf-ls-single-comments .mkdf-ls-single-sort,' +
			'.mkdf-membership-dashboard-page select'
		);
		if(defaultSelectFields.length){
			defaultSelectFields.each(function(){
                mkdfInitSelect2Field($(this));
			});
		}

	}

	function mkdfInitSelect2Field(field){
		if(mkdf.modules.listings.mkdfIsValidObject(field)){
            field.select2({

			});
        }
	}

})(jQuery);
(function($) {

	var listings = {};
	mkdf.modules.listings = listings;
	listings.mkdfOnDocumentReady = mkdfOnDocumentReady;
	listings.mkdfOnWindowLoad = mkdfOnWindowLoad;
	listings.mkdfOnWindowResize = mkdfOnWindowResize;
	listings.mkdfOnWindowScroll = mkdfOnWindowScroll;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	$(window).scroll(mkdfOnWindowScroll);

	listings.mkdfInitListingTypeCustomFields = mkdfInitListingTypeCustomFields;
	listings.mkdfGetListingTypeCustomFieldsOnChange = mkdfGetListingTypeCustomFieldsOnChange;
	listings.mkdfInitListingMainSearch = mkdfInitListingMainSearch;
	listings.mkdfBindTitles = mkdfBindTitles;
	listings.mkdfShowHideButton = mkdfShowHideButton;
	listings.mkdfReinitMultipleGoogleMaps = mkdfReinitMultipleGoogleMaps;
	listings.mkdfIsValidObject = mkdfIsValidObject;

	function mkdfOnDocumentReady() {
		mkdfInitListingTypeCustomFields();
		mkdfGetListingTypeCustomFieldsOnChange();
		mkdfInitListingMainSearch();
		mkdfBindTitles();
	}
	function mkdfOnWindowLoad() {}
	function mkdfOnWindowResize() {}
	function mkdfOnWindowScroll() {}

	function mkdfInitListingMainSearch(){
		var container = $('.mkdf-ls-main-search-holder');
		if(container.length){
			container.each(function(){
				var thisContainer = $(this),
					keywordSearch = thisContainer.find('.mkdf-ls-main-search-keyword'),
					availableListings = mkdfListingTitles.titles;

					keywordSearch.autocomplete({
						source: availableListings
					});

			});
		}
	}

	function mkdfInitListingTypeCustomFields(){

		var typeField = $('.job-manager-form fieldset #job_type');

		var typeFieldVal = typeField.val();
		mkdfAddListingTypeItems(typeFieldVal);
		mkdfDeleteListingTypeItems(typeFieldVal);

	}
	
	function mkdfGetListingTypeCustomFieldsOnChange(){

		var typeField = $('.job-manager-form fieldset #job_type');
       	typeField.on('change', function(){
			var thisField = $(this);
			var thisFieldVal = thisField.val();
			mkdfAddListingTypeItems(thisFieldVal);
			mkdfDeleteListingTypeItems(thisFieldVal);
		});

	}

	function mkdfAddListingTypeItems(types){

        if(typeof types !== 'undefined' && types !== null && types.length){
            //there is minimum one selected type
            if(types instanceof Array) {
                var i;
                for (i = 0; i < types.length; i++) {
                    if ($.inArray(types[i], mkdfListingGlobalVars.vars.selectedTypes) > -1) {
                    }
                    else {
                        //element is in not in array, add it
                        mkdfGetListingTypeField(types[i]);
                    }
                }
            } else {
                if ($.inArray(types, mkdfListingGlobalVars.vars.selectedTypes) > -1) {

                }
                else {
                    //element is in not in array, add it
                    mkdfGetListingTypeField(types);
                }
            }
        }else{
            //there is no selected types
            mkdfDeleteAllListingTypeFields();
        }

	}

	function mkdfDeleteListingTypeItems(types){
		if(typeof types !== 'undefined' && types !== null && types.length){

			//there is minimum one selected type
			var i;
			for(i = 0; i < mkdfListingGlobalVars.vars.selectedTypes.length; i++){
				if($.inArray(mkdfListingGlobalVars.vars.selectedTypes[i],types) > -1){
				}
				else{
					//element is in not in array, add it
					mkdfDeleteListingTypeField(mkdfListingGlobalVars.vars.selectedTypes[i]);
				}
			}

		}else{
			//there is no selected types
			mkdfDeleteAllListingTypeFields();
		}
	}

	function mkdfGetListingTypeField(itemId){
		var form = $('.job-manager-form');
		var formAction = form.attr('action');
        var field = $('.job-manager-form fieldset #job_type');
        var container = field.parent().parent();

		//get current post id if is set
		// this id is set on edit job pages and we need it to get custom field values
		var actionArray = formAction.split('=');
        var userAction = actionArray[1];

        var currentPostId = false;

        if(userAction !== null && typeof userAction !== 'undefined' && userAction !== 'add-new-listing'){
            currentPostId = actionArray[actionArray.length - 1];
        }

		var data = {
			selectedType: itemId,
			action: 'mkdf_listing_type_get_custom_fields',
            currentPostId: currentPostId
		};

		$.ajax({
			type: "POST",
			url: MikadoListingAjaxUrl,
			data: data,
			success: function (data) {
				if (data === 'error') {
					//error handler
				}else{
					//set new item in global var
					mkdfListingGlobalVars.vars.selectedTypes.push(itemId);
                    var response = $.parseJSON(data);
                    var responseHtml = response.html;
                    container.after(responseHtml);
                    mkdfReinitAdditionalSelectFields();
 				}
			}
		});
	}
	
	function mkdfReinitAdditionalSelectFields() {
        var selectFields = $('.job-manager-form .mkdf-ls-type-field-wrapper select');
        if(selectFields.length){
        	selectFields.each(function () {
				$(this).select2();
            });
		}
    }

	function mkdfDeleteListingTypeField(itemId){

		var typeFieldWrappers = $('.mkdf-ls-type-field-wrapper');

		if(typeFieldWrappers.length){
			typeFieldWrappers.each(function(){
				var thisFieldWrapper = $(this);
				var id = thisFieldWrapper.attr('id');

				if(id === itemId) {
					setTimeout(function(){
						thisFieldWrapper.remove();
						//remove current element from global array
						var index = mkdfListingGlobalVars.vars.selectedTypes.indexOf(itemId);
						mkdfListingGlobalVars.vars.selectedTypes.splice(index, 1);
					},300);
				}

			});
		}
	}

	function mkdfDeleteAllListingTypeFields(){
		var typeFieldWrappers = $('.mkdf-ls-type-field-wrapper ');

		if(typeFieldWrappers.length){
			typeFieldWrappers.each(function() {
				var thisFieldWrapper = $(this);
                //empty selected types arrray
                mkdfListingGlobalVars.vars.selectedTypes = [];
                //empty selected types html
				thisFieldWrapper.remove();
			});
		}
	}
	
	function mkdfReinitMultipleGoogleMaps(addresses, action){

		if(action === 'append'){

			var mapObjs = mkdfMultipleMapVars.multiple.addresses;
			mapObjs = mkdfMultipleMapVars.multiple.addresses.concat(addresses);
			mkdfMultipleMapVars.multiple.addresses = mapObjs;

			mkdf.modules.maps.mkdfGoogleMaps.getDirectoryItemsAddresses({
				addresses: mapObjs
			});
		}
		else if(action === 'replace'){

			mkdfMultipleMapVars.multiple.addresses = addresses;
			mkdf.modules.maps.mkdfGoogleMaps.getDirectoryItemsAddresses({
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
	
	function mkdfListingArchiveInitBack() {

		window.addEventListener("popstate", function(e) { // if a back or forward button is clicked
			location.reload();
		});

	}

	function mkdfBindTitles() {
		
		var maps = $('.mkdf-ls-archive-map-holder'),
			lists = $('.mkdf-ls-archive-items');

		if (maps.length && lists.length){
			maps.each(function(){
				var  listItems = lists.find('.mkdf-ls-item');

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
var j = jQuery.noConflict();
function CustomMarker( options ) {
    this.latlng = new google.maps.LatLng({lat: options.position.lat, lng: options.position.lng});
    this.setMap(options.map);
    this.templateData = options.templateData;
    this.markerData = {
        pin : options.markerPin,
        pinClass : options.markerClass
    };
}


CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {

    var self = this;

    var div = this.div;

    if (!div) {

        div = this.div = document.createElement('div');
        var title = this.templateData.title,
            title = title.toLowerCase(),
            title = title.replace(/ /g,'-');
        div.className = 'mkdf-map-marker-holder';
        div.setAttribute("id", title);

        var markerInfoTemplate = _.template( j('.mkdf-info-window-template').html() );
        markerInfoTemplate = markerInfoTemplate( self.templateData );

        var markerTemplate = _.template( j('.mkdf-marker-template').html() );
        markerTemplate = markerTemplate( self.markerData );

        j(div).append(markerInfoTemplate);
        j(div).append(markerTemplate);

        div.style.position = 'absolute';
        div.style.cursor = 'pointer';

        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
    }

    var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

    if (point) {
        div.style.left = (point.x) + 'px';
        div.style.top = (point.y) + 'px';
    }
};

CustomMarker.prototype.remove = function() {
    if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
    }
};

CustomMarker.prototype.getPosition = function() {
    return this.latlng;
};
(function($) {
    "use strict";

    var maps = {};
    mkdf.modules.maps = maps;
    mkdf.modules.maps.mkdfInitMultipleListingMap = mkdfInitMultipleListingMap;
    mkdf.modules.maps.mkdfInitSingleListingMap = mkdfInitSingleListingMap;
    mkdf.modules.maps.mkdfInitMobileMap = mkdfInitMobileMap;
    mkdf.modules.maps.mkdfGoogleMaps = {};

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    function mkdfOnDocumentReady() {}

    function mkdfOnWindowLoad() {
        mkdfInitSingleListingMap();
        mkdfInitMultipleListingMap();
        mkdfInitMobileMap();
    }

    function mkdfOnWindowResize() {}

    function mkdfOnWindowScroll() {}

    function mkdfInitSingleListingMap() {
        var mapHolder = $('#mkdf-ls-single-map-holder');
        if ( mapHolder.length ) {
            mkdf.modules.maps.mkdfGoogleMaps.getDirectoryItemAddress({
                mapHolder: 'mkdf-ls-single-map-holder'
            });
        }
    }

    function mkdfInitMultipleListingMap() {
        var mapHolder = $('#mkdf-ls-multiple-map-holder');
        if ( mapHolder.length ) {
            mkdf.modules.maps.mkdfGoogleMaps.getDirectoryItemsAddresses({
                mapHolder: 'mkdf-ls-multiple-map-holder',
                hasFilter: true
            });
        }
    }

    mkdf.modules.maps.mkdfGoogleMaps = {

        //Object varibles
        mapHolder : {},
        map : {},
        markers : {},
        radius : {},

        /**
         * Returns map with single address
         *
         * @param options
         */
        getDirectoryItemAddress : function( options ) {
            /**
             * use mkdfMapsVars to get variables for address, latitude, longitude by default
             */
            var defaults = {
                location : mkdfSingleMapVars.single['currentListing'].location,
                type : mkdfSingleMapVars.single['currentListing'].listingType,
                zoom : 16,
                mapHolder : '',
                draggable : mkdfMapsVars.global.draggable,
                mapTypeControl : mkdfMapsVars.global.mapTypeControl,
                scrollwheel : mkdfMapsVars.global.scrollable,
                streetViewControl : mkdfMapsVars.global.streetViewControl,
                zoomControl : mkdfMapsVars.global.zoomControl,
                title : mkdfSingleMapVars.single['currentListing'].title,
                content : '',
                styles: mkdfMapsVars.global.mapStyle,
                markerPin : mkdfSingleMapVars.single['currentListing'].markerPin,
                featuredImage : mkdfSingleMapVars.single['currentListing'].featuredImage,
                itemUrl : mkdfSingleMapVars.single['currentListing'].itemUrl,
                itemAuthor : mkdfSingleMapVars.single['currentListing'].itemAuthor,
                markerClass : mkdfSingleMapVars.single['currentListing'].markerClass
            };
            var settings = $.extend( {}, defaults, options );

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;

            //Get map holder
            var mapHolder = document.getElementById( settings.mapHolder );

            //Initialize map
            var map = new google.maps.Map( mapHolder, {
                zoom : settings.zoom,
                draggable : settings.draggable,
                mapTypeControl : settings.mapTypeControl,
                scrollwheel : settings.scrollwheel,
                streetViewControl : settings.streetViewControl,
                zoomControl : settings.zoomControl
            });

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //Try to locate by latitude and longitude
            if ( typeof settings.location !== 'undefined' && settings.location !== null) {
                var latLong = {
                    lat : parseFloat(settings.location.latitude),
                    lng : parseFloat(settings.location.longitude)
                };
                //Set map center to location
                map.setCenter(latLong);
                //Add marker to map

                var templateData = {
                    title : settings.title,
                    address : settings.location.address,
                    featuredImage : settings.featuredImage,
                    itemUrl : settings.itemUrl,
                    itemAuthor : settings.itemAuthor
                };

                var customMarker = new CustomMarker({
                    map : map,
                    position : latLong,
                    templateData : templateData,
                    markerPin : settings.markerPin,
                    markerClass : settings.markerClass
                });

                this.initMarkerInfo();

            }

        },

        /**
         * Returns map with multiple addresses
         *
         * @param options
         */
        getDirectoryItemsAddresses : function( options ) {
            var defaults = {
                geolocation : false,
                mapHolder : 'mkdf-ls-multiple-map-holder',
                addresses : mkdfMultipleMapVars.multiple.addresses,
                draggable : mkdfMapsVars.global.draggable,
                mapTypeControl : mkdfMapsVars.global.mapTypeControl,
                scrollwheel : mkdfMapsVars.global.scrollable,
                streetViewControl : mkdfMapsVars.global.streetViewControl,
                zoomControl : mkdfMapsVars.global.zoomControl,
                zoom : 16,
                styles: mkdfMapsVars.global.mapStyle,
                radius : 50, //radius for marker visibility, in km
                hasFilter : false
            };
            var settings = $.extend({}, defaults, options );

            //Get map holder
            var mapHolder = document.getElementById( settings.mapHolder );

            //Initialize map
            var map = new google.maps.Map( mapHolder, {
                zoom : settings.zoom,
                draggable : settings.draggable,
                mapTypeControl : settings.mapTypeControl,
                scrollwheel : settings.scrollwheel,
                streetViewControl : settings.streetViewControl,
                zoomControl : settings.zoomControl
            });

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;
            this.map = map;
            this.radius = settings.radius;

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //If geolocation enabled set map center to user location
            if ( navigator.geolocation && settings.geolocation ) {
                this.centerOnCurrentLocation();
            }

            //Filter addresses, remove items without latitude and longitude
            var addresses = [],
                addressesLength = settings.addresses.length;
            if(settings.addresses.length !== null){
                for ( var i = 0; i < addressesLength; i++ ) {
                    var location = settings.addresses[i].location;
                    if ( typeof location !== 'undefined' && location !== null ) {

                        if ( location.latitude !== '' && location.longitude !== '' ) {
                            addresses.push(settings.addresses[i]);
                        }
                    }
                }
            }


            //Center map and set borders of map
            this.setMapBounds( addresses );

            //Add markers to the map
            this.addMultipleMarkers( addresses );

        },

        /**
         * Add multiple markers to map
         */
        addMultipleMarkers : function( markersData ) {

            var map = this.map;

            var markers = [];
            //Loop through markers
            var len = markersData.length;
            for ( var i = 0; i < len; i++ ) {

                var latLng = {
                    lat: parseFloat(markersData[i].location.latitude),
                    lng: parseFloat(markersData[i].location.longitude)
                };

                //Custom html markers
                //Insert marker data into info window template
                var templateData = {
                    title : markersData[i].title,
                    address : markersData[i].location.address,
                    featuredImage : markersData[i].featuredImage,
                    itemUrl : markersData[i].itemUrl,
                    itemAuthor : markersData[i].itemAuthor
                };

                var customMarker = new CustomMarker({
                    position : latLng,
                    map : map,
                    templateData : templateData,
                    markerPin : markersData[i].markerPin,
                    markerClass : markersData[i].markerClass
                });

                markers.push(customMarker);

            }

            this.markers = markers;

            //Init map clusters ( Grouping map markers at small zoom values )
            this.initMapClusters();

            //Init marker info
            this.initMarkerInfo();

            //Init visible circle area around center of map
            var that = this;
            google.maps.event.addListener(map, 'idle', function(){
                var visibleRadius = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0,
                    strokeWeight: 0,
                    fillColor: '#FF0000',
                    fillOpacity: 0,
                    map: map,
                    center: map.getCenter(),
                    radius: that.radius * 1000 //in meters
                });
                //Display only markers in circle
                //that.refreshCircleAreaMarkers( visibleRadius.getBounds() );
            });

        },

        /**
         * Set map bounds for Map with multiple markers
         *
         * @param addressesArray
         */
        setMapBounds : function( addressesArray ) {

            var bounds = new google.maps.LatLngBounds();
            for ( var i = 0; i < addressesArray.length; i++ ) {
                bounds.extend( new google.maps.LatLng( parseFloat(addressesArray[i].location.latitude), parseFloat(addressesArray[i].location.longitude) ) );
            }

            this.map.fitBounds( bounds );

        },

        /**
         * Init map clusters for grouping markers on small zoom values
         */
        initMapClusters : function() {

            //Activate clustering on multiple markers
            var markerClusteringOptions = {
                minimumClusterSize: 2,
                maxZoom: 12,
                styles : [{
                    width: 47,
                    height: 47,
                    url: '',
                    textSize: 28
                }]
            };
            var markerClusterer = new MarkerClusterer(this.map, this.markers, markerClusteringOptions);

        },

        initMarkerInfo : function() {

            $(document).on('click', '.mkdf-map-marker', function() {
                var self = $(this),
                    markerHolders = $('.mkdf-map-marker-holder'),
                    infoWindows = $('.mkdf-info-window'),
                    markerHolder = self.parent('.mkdf-map-marker-holder'),
                    infoWindow = self.siblings('.mkdf-info-window');

                if ( markerHolder.hasClass('active') ) {
                    markerHolder.removeClass( 'active' );
                    infoWindow.fadeOut(0);
                } else {
                    markerHolders.removeClass('active');
                    infoWindows.fadeOut(0);
                    markerHolder.addClass('active');
                    infoWindow.fadeIn(300);
                }

            });

        },
        /**
         * Info Window for displaying data on map markers
         *
         * @returns {google.maps.InfoWindow}
         */
        addInfoWindow : function() {

            var contentString = '';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });
            return infoWindow;

        },

        /**
         * If geolocation enabled center map on users current position
         */
        centerOnCurrentLocation : function() {
            var map = this.map;
            navigator.geolocation.getCurrentPosition(
                function(position){
                    var center = {
                        lat : position.coords.latitude,
                        lng : position.coords.longitude
                    };
                    map.setCenter(center);
                }
            );
        },

        /**
         * Refresh area for visible markers
         *
         * @param circleArea
         */
        refreshCircleAreaMarkers : function( circleArea ) {

            var length = this.markers.length;
            for ( var i = 0; i < length; i++ ) {
                if ( circleArea.contains( this.markers[i].getPosition() ) ) {
                    this.markers[i].setVisible(true);
                } else {
                    this.markers[i].setVisible(false);
                }
            }

        },

    };

    function mkdfInitMobileMap() {

        var mapOpener = $('.mkdf-listing-view-larger-map a'),
            mapOpenerIcon = mapOpener.children('i'),
            mapHolder = $('.mkdf-map-holder');
        if (mapOpener.length) {
            mapOpener.click(function(e){
                e.preventDefault();
                if (mapHolder.hasClass('mkdf-fullscreen-map')) {
                    mapHolder.removeClass('mkdf-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-minus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-plus');
                } else {
                    mapHolder.addClass('mkdf-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-plus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-minus');
                }
                mkdf.modules.maps.mkdfGoogleMaps.getDirectoryItemsAddresses();
            });
        }
    }

})(jQuery);
/**
 * @name MarkerClusterer for Google Maps v3
 * @version version 1.0
 * @author Luke Mahe
 * @fileoverview
 * The library creates and manages per-zoom-level clusters for large amounts of
 * markers.
 * <br/>
 * This is a v3 implementation of the
 * <a href="http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/"
 * >v2 MarkerClusterer</a>.
 */

/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * A Marker Clusterer that clusters markers.
 *
 * @param {google.maps.Map} map The Google map to attach to.
 * @param {Array.<google.maps.Marker>=} opt_markers Optional markers to add to
 *   the cluster.
 * @param {Object=} opt_options support the following options:
 *     'gridSize': (number) The grid size of a cluster in pixels.
 *     'maxZoom': (number) The maximum zoom level that a marker can be part of a
 *                cluster.
 *     'zoomOnClick': (boolean) Whether the default behaviour of clicking on a
 *                    cluster is to zoom into it.
 *     'averageCenter': (boolean) Wether the center of each cluster should be
 *                      the average of all markers in the cluster.
 *     'minimumClusterSize': (number) The minimum number of markers to be in a
 *                           cluster before the markers are hidden and a count
 *                           is shown.
 *     'styles': (object) An object that has style properties:
 *       'url': (string) The image url.
 *       'height': (number) The image height.
 *       'width': (number) The image width.
 *       'anchor': (Array) The anchor position of the label text.
 *       'textColor': (string) The text color.
 *       'textSize': (number) The text size.
 *       'backgroundPosition': (string) The position of the backgound x, y.
 *       'iconAnchor': (Array) The anchor position of the icon x, y.
 * @constructor
 * @extends google.maps.OverlayView
 */
function MarkerClusterer(map, opt_markers, opt_options) {
    // MarkerClusterer implements google.maps.OverlayView interface. We use the
    // extend function to extend MarkerClusterer with google.maps.OverlayView
    // because it might not always be available when the code is defined so we
    // look for it at the last possible moment. If it doesn't exist now then
    // there is no point going ahead :)
    this.extend(MarkerClusterer, google.maps.OverlayView);
    this.map_ = map;

    /**
     * @type {Array.<google.maps.Marker>}
     * @private
     */
    this.markers_ = [];

    /**
     *  @type {Array.<Cluster>}
     */
    this.clusters_ = [];

    this.sizes = [53, 56, 66, 78, 90];

    /**
     * @private
     */
    this.styles_ = [];

    /**
     * @type {boolean}
     * @private
     */
    this.ready_ = false;

    var options = opt_options || {};

    /**
     * @type {number}
     * @private
     */
    this.gridSize_ = options['gridSize'] || 47;

    /**
     * @private
     */
    this.minClusterSize_ = options['minimumClusterSize'] || 2;


    /**
     * @type {?number}
     * @private
     */
    this.maxZoom_ = options['maxZoom'] || null;

    this.styles_ = options['styles'] || [];

    /**
     * @type {string}
     * @private
     */
    this.imagePath_ = options['imagePath'] ||
        this.MARKER_CLUSTER_IMAGE_PATH_;

    /**
     * @type {string}
     * @private
     */
    this.imageExtension_ = options['imageExtension'] ||
        this.MARKER_CLUSTER_IMAGE_EXTENSION_;

    /**
     * @type {boolean}
     * @private
     */
    this.zoomOnClick_ = true;

    if (options['zoomOnClick'] != undefined) {
        this.zoomOnClick_ = options['zoomOnClick'];
    }

    /**
     * @type {boolean}
     * @private
     */
    this.averageCenter_ = false;

    if (options['averageCenter'] != undefined) {
        this.averageCenter_ = options['averageCenter'];
    }

    this.setupStyles_();

    this.setMap(map);

    /**
     * @type {number}
     * @private
     */
    this.prevZoom_ = this.map_.getZoom();

    // Add the map event listeners
    var that = this;
    google.maps.event.addListener(this.map_, 'zoom_changed', function() {
        var zoom = that.map_.getZoom();

        if (that.prevZoom_ != zoom) {
            that.prevZoom_ = zoom;
            that.resetViewport();
        }
    });

    google.maps.event.addListener(this.map_, 'idle', function() {
        that.redraw();
    });

    // Finally, add the markers
    if (opt_markers && opt_markers.length) {
        this.addMarkers(opt_markers, false);
    }
}


/**
 * The marker cluster image path.
 *
 * @type {string}
 * @private
 */
MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_ =
    'https://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/' +
    'images/m';


/**
 * The marker cluster image path.
 *
 * @type {string}
 * @private
 */
MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_ = 'png';


/**
 * Extends a objects prototype by anothers.
 *
 * @param {Object} obj1 The object to be extended.
 * @param {Object} obj2 The object to extend with.
 * @return {Object} The new extended object.
 * @ignore
 */
MarkerClusterer.prototype.extend = function(obj1, obj2) {
    return (function(object) {
        for (var property in object.prototype) {
            this.prototype[property] = object.prototype[property];
        }
        return this;
    }).apply(obj1, [obj2]);
};


/**
 * Implementaion of the interface method.
 * @ignore
 */
MarkerClusterer.prototype.onAdd = function() {
    this.setReady_(true);
};

/**
 * Implementaion of the interface method.
 * @ignore
 */
MarkerClusterer.prototype.draw = function() {};

/**
 * Sets up the styles object.
 *
 * @private
 */
MarkerClusterer.prototype.setupStyles_ = function() {
    if (this.styles_.length) {
        return;
    }

    for (var i = 0, size; size = this.sizes[i]; i++) {
        this.styles_.push({
            url: this.imagePath_ + (i + 1) + '.' + this.imageExtension_,
            height: size,
            width: size
        });
    }
};

/**
 *  Fit the map to the bounds of the markers in the clusterer.
 */
MarkerClusterer.prototype.fitMapToMarkers = function() {
    var markers = this.getMarkers();
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, marker; marker = markers[i]; i++) {
        bounds.extend(marker.getPosition());
    }

    this.map_.fitBounds(bounds);
};


/**
 *  Sets the styles.
 *
 *  @param {Object} styles The style to set.
 */
MarkerClusterer.prototype.setStyles = function(styles) {
    this.styles_ = styles;
};


/**
 *  Gets the styles.
 *
 *  @return {Object} The styles object.
 */
MarkerClusterer.prototype.getStyles = function() {
    return this.styles_;
};


/**
 * Whether zoom on click is set.
 *
 * @return {boolean} True if zoomOnClick_ is set.
 */
MarkerClusterer.prototype.isZoomOnClick = function() {
    return this.zoomOnClick_;
};

/**
 * Whether average center is set.
 *
 * @return {boolean} True if averageCenter_ is set.
 */
MarkerClusterer.prototype.isAverageCenter = function() {
    return this.averageCenter_;
};


/**
 *  Returns the array of markers in the clusterer.
 *
 *  @return {Array.<google.maps.Marker>} The markers.
 */
MarkerClusterer.prototype.getMarkers = function() {
    return this.markers_;
};


/**
 *  Returns the number of markers in the clusterer
 *
 *  @return {Number} The number of markers.
 */
MarkerClusterer.prototype.getTotalMarkers = function() {
    return this.markers_.length;
};


/**
 *  Sets the max zoom for the clusterer.
 *
 *  @param {number} maxZoom The max zoom level.
 */
MarkerClusterer.prototype.setMaxZoom = function(maxZoom) {
    this.maxZoom_ = maxZoom;
};


/**
 *  Gets the max zoom for the clusterer.
 *
 *  @return {number} The max zoom level.
 */
MarkerClusterer.prototype.getMaxZoom = function() {
    return this.maxZoom_;
};


/**
 *  The function for calculating the cluster icon image.
 *
 *  @param {Array.<google.maps.Marker>} markers The markers in the clusterer.
 *  @param {number} numStyles The number of styles available.
 *  @return {Object} A object properties: 'text' (string) and 'index' (number).
 *  @private
 */
MarkerClusterer.prototype.calculator_ = function(markers, numStyles) {
    var index = 0;
    var count = markers.length;
    var dv = count;
    while (dv !== 0) {
        dv = parseInt(dv / 10, 10);
        index++;
    }

    index = Math.min(index, numStyles);
    return {
        text: count,
        index: index
    };
};


/**
 * Set the calculator function.
 *
 * @param {function(Array, number)} calculator The function to set as the
 *     calculator. The function should return a object properties:
 *     'text' (string) and 'index' (number).
 *
 */
MarkerClusterer.prototype.setCalculator = function(calculator) {
    this.calculator_ = calculator;
};


/**
 * Get the calculator function.
 *
 * @return {function(Array, number)} the calculator function.
 */
MarkerClusterer.prototype.getCalculator = function() {
    return this.calculator_;
};


/**
 * Add an array of markers to the clusterer.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to add.
 * @param {boolean=} opt_nodraw Whether to redraw the clusters.
 */
MarkerClusterer.prototype.addMarkers = function(markers, opt_nodraw) {
    for (var i = 0, marker; marker = markers[i]; i++) {
        this.pushMarkerTo_(marker);
    }
    if (!opt_nodraw) {
        this.redraw();
    }
};


/**
 * Pushes a marker to the clusterer.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @private
 */
MarkerClusterer.prototype.pushMarkerTo_ = function(marker) {
    marker.isAdded = false;
    if (marker['draggable']) {
        // If the marker is draggable add a listener so we update the clusters on
        // the drag end.
        var that = this;
        google.maps.event.addListener(marker, 'dragend', function() {
            marker.isAdded = false;
            that.repaint();
        });
    }
    this.markers_.push(marker);
};


/**
 * Adds a marker to the clusterer and redraws if needed.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @param {boolean=} opt_nodraw Whether to redraw the clusters.
 */
MarkerClusterer.prototype.addMarker = function(marker, opt_nodraw) {
    this.pushMarkerTo_(marker);
    if (!opt_nodraw) {
        this.redraw();
    }
};


/**
 * Removes a marker and returns true if removed, false if not
 *
 * @param {google.maps.Marker} marker The marker to remove
 * @return {boolean} Whether the marker was removed or not
 * @private
 */
MarkerClusterer.prototype.removeMarker_ = function(marker) {
    var index = -1;
    if (this.markers_.indexOf) {
        index = this.markers_.indexOf(marker);
    } else {
        for (var i = 0, m; m = this.markers_[i]; i++) {
            if (m == marker) {
                index = i;
                break;
            }
        }
    }

    if (index == -1) {
        // Marker is not in our list of markers.
        return false;
    }

    marker.setMap(null);

    this.markers_.splice(index, 1);

    return true;
};


/**
 * Remove a marker from the cluster.
 *
 * @param {google.maps.Marker} marker The marker to remove.
 * @param {boolean=} opt_nodraw Optional boolean to force no redraw.
 * @return {boolean} True if the marker was removed.
 */
MarkerClusterer.prototype.removeMarker = function(marker, opt_nodraw) {
    var removed = this.removeMarker_(marker);

    if (!opt_nodraw && removed) {
        this.resetViewport();
        this.redraw();
        return true;
    } else {
        return false;
    }
};


/**
 * Removes an array of markers from the cluster.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to remove.
 * @param {boolean=} opt_nodraw Optional boolean to force no redraw.
 */
MarkerClusterer.prototype.removeMarkers = function(markers, opt_nodraw) {
    var removed = false;

    for (var i = 0, marker; marker = markers[i]; i++) {
        var r = this.removeMarker_(marker);
        removed = removed || r;
    }

    if (!opt_nodraw && removed) {
        this.resetViewport();
        this.redraw();
        return true;
    }
};


/**
 * Sets the clusterer's ready state.
 *
 * @param {boolean} ready The state.
 * @private
 */
MarkerClusterer.prototype.setReady_ = function(ready) {
    if (!this.ready_) {
        this.ready_ = ready;
        this.createClusters_();
    }
};


/**
 * Returns the number of clusters in the clusterer.
 *
 * @return {number} The number of clusters.
 */
MarkerClusterer.prototype.getTotalClusters = function() {
    return this.clusters_.length;
};


/**
 * Returns the google map that the clusterer is associated with.
 *
 * @return {google.maps.Map} The map.
 */
MarkerClusterer.prototype.getMap = function() {
    return this.map_;
};


/**
 * Sets the google map that the clusterer is associated with.
 *
 * @param {google.maps.Map} map The map.
 */
MarkerClusterer.prototype.setMap = function(map) {
    this.map_ = map;
};


/**
 * Returns the size of the grid.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getGridSize = function() {
    return this.gridSize_;
};


/**
 * Sets the size of the grid.
 *
 * @param {number} size The grid size.
 */
MarkerClusterer.prototype.setGridSize = function(size) {
    this.gridSize_ = size;
};


/**
 * Returns the min cluster size.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getMinClusterSize = function() {
    return this.minClusterSize_;
};

/**
 * Sets the min cluster size.
 *
 * @param {number} size The grid size.
 */
MarkerClusterer.prototype.setMinClusterSize = function(size) {
    this.minClusterSize_ = size;
};


/**
 * Extends a bounds object by the grid size.
 *
 * @param {google.maps.LatLngBounds} bounds The bounds to extend.
 * @return {google.maps.LatLngBounds} The extended bounds.
 */
MarkerClusterer.prototype.getExtendedBounds = function(bounds) {
    var projection = this.getProjection();

    // Turn the bounds into latlng.
    var tr = new google.maps.LatLng(bounds.getNorthEast().lat(),
        bounds.getNorthEast().lng());
    var bl = new google.maps.LatLng(bounds.getSouthWest().lat(),
        bounds.getSouthWest().lng());

    // Convert the points to pixels and the extend out by the grid size.
    var trPix = projection.fromLatLngToDivPixel(tr);
    trPix.x += this.gridSize_;
    trPix.y -= this.gridSize_;

    var blPix = projection.fromLatLngToDivPixel(bl);
    blPix.x -= this.gridSize_;
    blPix.y += this.gridSize_;

    // Convert the pixel points back to LatLng
    var ne = projection.fromDivPixelToLatLng(trPix);
    var sw = projection.fromDivPixelToLatLng(blPix);

    // Extend the bounds to contain the new bounds.
    bounds.extend(ne);
    bounds.extend(sw);

    return bounds;
};


/**
 * Determins if a marker is contained in a bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @param {google.maps.LatLngBounds} bounds The bounds to check against.
 * @return {boolean} True if the marker is in the bounds.
 * @private
 */
MarkerClusterer.prototype.isMarkerInBounds_ = function(marker, bounds) {
    return bounds.contains(marker.getPosition());
};


/**
 * Clears all clusters and markers from the clusterer.
 */
MarkerClusterer.prototype.clearMarkers = function() {
    this.resetViewport(true);

    // Set the markers a empty array.
    this.markers_ = [];
};


/**
 * Clears all existing clusters and recreates them.
 * @param {boolean} opt_hide To also hide the marker.
 */
MarkerClusterer.prototype.resetViewport = function(opt_hide) {
    // Remove all the clusters
    for (var i = 0, cluster; cluster = this.clusters_[i]; i++) {
        cluster.remove();
    }

    // Reset the markers to not be added and to be invisible.
    for (var i = 0, marker; marker = this.markers_[i]; i++) {
        marker.isAdded = false;
        if (opt_hide) {
            marker.setMap(null);
        }
    }

    this.clusters_ = [];
};

/**
 *
 */
MarkerClusterer.prototype.repaint = function() {
    var oldClusters = this.clusters_.slice();
    this.clusters_.length = 0;
    this.resetViewport();
    this.redraw();

    // Remove the old clusters.
    // Do it in a timeout so the other clusters have been drawn first.
    window.setTimeout(function() {
        for (var i = 0, cluster; cluster = oldClusters[i]; i++) {
            cluster.remove();
        }
    }, 0);
};


/**
 * Redraws the clusters.
 */
MarkerClusterer.prototype.redraw = function() {
    this.createClusters_();
};


/**
 * Calculates the distance between two latlng locations in km.
 * @see http://www.movable-type.co.uk/scripts/latlong.html
 *
 * @param {google.maps.LatLng} p1 The first lat lng point.
 * @param {google.maps.LatLng} p2 The second lat lng point.
 * @return {number} The distance between the two points in km.
 * @private
 */
MarkerClusterer.prototype.distanceBetweenPoints_ = function(p1, p2) {
    if (!p1 || !p2) {
        return 0;
    }

    var R = 6371; // Radius of the Earth in km
    var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
    var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
};


/**
 * Add a marker to a cluster, or creates a new cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @private
 */
MarkerClusterer.prototype.addToClosestCluster_ = function(marker) {
    var distance = 40000; // Some large number
    var clusterToAddTo = null;
    var pos = marker.getPosition();
    for (var i = 0, cluster; cluster = this.clusters_[i]; i++) {
        var center = cluster.getCenter();
        if (center) {
            var d = this.distanceBetweenPoints_(center, marker.getPosition());
            if (d < distance) {
                distance = d;
                clusterToAddTo = cluster;
            }
        }
    }

    if (clusterToAddTo && clusterToAddTo.isMarkerInClusterBounds(marker)) {
        clusterToAddTo.addMarker(marker);
    } else {
        var cluster = new Cluster(this);
        cluster.addMarker(marker);
        this.clusters_.push(cluster);
    }
};


/**
 * Creates the clusters.
 *
 * @private
 */
MarkerClusterer.prototype.createClusters_ = function() {
    if (!this.ready_) {
        return;
    }

    // Get our current map view bounds.
    // Create a new bounds object so we don't affect the map.
    var mapBounds = new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(),
        this.map_.getBounds().getNorthEast());
    var bounds = this.getExtendedBounds(mapBounds);

    for (var i = 0, marker; marker = this.markers_[i]; i++) {
        if (!marker.isAdded && this.isMarkerInBounds_(marker, bounds)) {
            this.addToClosestCluster_(marker);
        }
    }
};


/**
 * A cluster that contains markers.
 *
 * @param {MarkerClusterer} markerClusterer The markerclusterer that this
 *     cluster is associated with.
 * @constructor
 * @ignore
 */
function Cluster(markerClusterer) {
    this.markerClusterer_ = markerClusterer;
    this.map_ = markerClusterer.getMap();
    this.gridSize_ = markerClusterer.getGridSize();
    this.minClusterSize_ = markerClusterer.getMinClusterSize();
    this.averageCenter_ = markerClusterer.isAverageCenter();
    this.center_ = null;
    this.markers_ = [];
    this.bounds_ = null;
    this.clusterIcon_ = new ClusterIcon(this, markerClusterer.getStyles(),
        markerClusterer.getGridSize());
}

/**
 * Determins if a marker is already added to the cluster.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker is already added.
 */
Cluster.prototype.isMarkerAlreadyAdded = function(marker) {
    if (this.markers_.indexOf) {
        return this.markers_.indexOf(marker) != -1;
    } else {
        for (var i = 0, m; m = this.markers_[i]; i++) {
            if (m == marker) {
                return true;
            }
        }
    }
    return false;
};


/**
 * Add a marker the cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @return {boolean} True if the marker was added.
 */
Cluster.prototype.addMarker = function(marker) {
    if (this.isMarkerAlreadyAdded(marker)) {
        return false;
    }

    if (!this.center_) {
        this.center_ = marker.getPosition();
        this.calculateBounds_();
    } else {
        if (this.averageCenter_) {
            var l = this.markers_.length + 1;
            var lat = (this.center_.lat() * (l-1) + marker.getPosition().lat()) / l;
            var lng = (this.center_.lng() * (l-1) + marker.getPosition().lng()) / l;
            this.center_ = new google.maps.LatLng(lat, lng);
            this.calculateBounds_();
        }
    }

    marker.isAdded = true;
    this.markers_.push(marker);

    var len = this.markers_.length;
    if (len < this.minClusterSize_ && marker.getMap() != this.map_) {
        // Min cluster size not reached so show the marker.
        marker.setMap(this.map_);
    }

    if (len == this.minClusterSize_) {
        // Hide the markers that were showing.
        for (var i = 0; i < len; i++) {
            this.markers_[i].setMap(null);
        }
    }

    if (len >= this.minClusterSize_) {
        marker.setMap(null);
    }

    this.updateIcon();
    return true;
};


/**
 * Returns the marker clusterer that the cluster is associated with.
 *
 * @return {MarkerClusterer} The associated marker clusterer.
 */
Cluster.prototype.getMarkerClusterer = function() {
    return this.markerClusterer_;
};


/**
 * Returns the bounds of the cluster.
 *
 * @return {google.maps.LatLngBounds} the cluster bounds.
 */
Cluster.prototype.getBounds = function() {
    var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
    var markers = this.getMarkers();
    for (var i = 0, marker; marker = markers[i]; i++) {
        bounds.extend(marker.getPosition());
    }
    return bounds;
};


/**
 * Removes the cluster
 */
Cluster.prototype.remove = function() {
    this.clusterIcon_.remove();
    this.markers_.length = 0;
    delete this.markers_;
};


/**
 * Returns the center of the cluster.
 *
 * @return {number} The cluster center.
 */
Cluster.prototype.getSize = function() {
    return this.markers_.length;
};


/**
 * Returns the center of the cluster.
 *
 * @return {Array.<google.maps.Marker>} The cluster center.
 */
Cluster.prototype.getMarkers = function() {
    return this.markers_;
};


/**
 * Returns the center of the cluster.
 *
 * @return {google.maps.LatLng} The cluster center.
 */
Cluster.prototype.getCenter = function() {
    return this.center_;
};


/**
 * Calculated the extended bounds of the cluster with the grid.
 *
 * @private
 */
Cluster.prototype.calculateBounds_ = function() {
    var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
    this.bounds_ = this.markerClusterer_.getExtendedBounds(bounds);
};


/**
 * Determines if a marker lies in the clusters bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker lies in the bounds.
 */
Cluster.prototype.isMarkerInClusterBounds = function(marker) {
    return this.bounds_.contains(marker.getPosition());
};


/**
 * Returns the map that the cluster is associated with.
 *
 * @return {google.maps.Map} The map.
 */
Cluster.prototype.getMap = function() {
    return this.map_;
};


/**
 * Updates the cluster icon
 */
Cluster.prototype.updateIcon = function() {
    var zoom = this.map_.getZoom();
    var mz = this.markerClusterer_.getMaxZoom();

    if (mz && zoom > mz) {
        // The zoom is greater than our max zoom so show all the markers in cluster.
        for (var i = 0, marker; marker = this.markers_[i]; i++) {
            marker.setMap(this.map_);
        }
        return;
    }

    if (this.markers_.length < this.minClusterSize_) {
        // Min cluster size not yet reached.
        this.clusterIcon_.hide();
        return;
    }

    var numStyles = this.markerClusterer_.getStyles().length;
    var sums = this.markerClusterer_.getCalculator()(this.markers_, numStyles);
    this.clusterIcon_.setCenter(this.center_);
    this.clusterIcon_.setSums(sums);
    this.clusterIcon_.show();
};


/**
 * A cluster icon
 *
 * @param {Cluster} cluster The cluster to be associated with.
 * @param {Object} styles An object that has style properties:
 *     'url': (string) The image url.
 *     'height': (number) The image height.
 *     'width': (number) The image width.
 *     'anchor': (Array) The anchor position of the label text.
 *     'textColor': (string) The text color.
 *     'textSize': (number) The text size.
 *     'backgroundPosition: (string) The background postition x, y.
 * @param {number=} opt_padding Optional padding to apply to the cluster icon.
 * @constructor
 * @extends google.maps.OverlayView
 * @ignore
 */
function ClusterIcon(cluster, styles, opt_padding) {
    cluster.getMarkerClusterer().extend(ClusterIcon, google.maps.OverlayView);

    this.styles_ = styles;
    this.padding_ = opt_padding || 0;
    this.cluster_ = cluster;
    this.center_ = null;
    this.map_ = cluster.getMap();
    this.div_ = null;
    this.sums_ = null;
    this.visible_ = false;

    this.setMap(this.map_);
}


/**
 * Triggers the clusterclick event and zoom's if the option is set.
 *
 * @param {google.maps.MouseEvent} event The event to propagate
 */
ClusterIcon.prototype.triggerClusterClick = function(event) {
    var markerClusterer = this.cluster_.getMarkerClusterer();

    // Trigger the clusterclick event.
    google.maps.event.trigger(markerClusterer, 'clusterclick', this.cluster_, event);

    if (markerClusterer.isZoomOnClick()) {
        // Zoom into the cluster.
        this.map_.fitBounds(this.cluster_.getBounds());
    }
};


/**
 * Adding the cluster icon to the dom.
 * @ignore
 */
ClusterIcon.prototype.onAdd = function() {
    this.div_ = document.createElement('DIV');
    this.div_.className = 'mkdf-cluster-marker';
    if (this.visible_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(pos);
        this.div_.innerHTML = '<div class="mkdf-cluster-marker-inner">' +
            '<span class="mkdf-cluster-marker-number">' + this.sums_.text + '</span>' +
            '<span class="mkdf-cluster-marker-spiner"></span>' +
            '</div>';
    }

    var panes = this.getPanes();
    panes.overlayMouseTarget.appendChild(this.div_);

    var that = this;
    google.maps.event.addDomListener(this.div_, 'click', function(event) {
        that.triggerClusterClick(event);
    });
};


/**
 * Returns the position to place the div dending on the latlng.
 *
 * @param {google.maps.LatLng} latlng The position in latlng.
 * @return {google.maps.Point} The position in pixels.
 * @private
 */
ClusterIcon.prototype.getPosFromLatLng_ = function(latlng) {
    var pos = this.getProjection().fromLatLngToDivPixel(latlng);

    if (typeof this.iconAnchor_ === 'object' && this.iconAnchor_.length === 2) {
        pos.x -= this.iconAnchor_[0];
        pos.y -= this.iconAnchor_[1];
    } else {
        pos.x -= parseInt(this.width_ / 2, 10);
        pos.y -= parseInt(this.height_ / 2, 10);
    }
    return pos;
};


/**
 * Draw the icon.
 * @ignore
 */
ClusterIcon.prototype.draw = function() {
    if (this.visible_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.top = pos.y + 'px';
        this.div_.style.left = pos.x + 'px';
    }
};


/**
 * Hide the icon.
 */
ClusterIcon.prototype.hide = function() {
    if (this.div_) {
        this.div_.style.display = 'none';
    }
    this.visible_ = false;
};


/**
 * Position and show the icon.
 */
ClusterIcon.prototype.show = function() {
    if (this.div_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(pos);
        this.div_.style.display = '';
    }
    this.visible_ = true;
};


/**
 * Remove the icon from the map
 */
ClusterIcon.prototype.remove = function() {
    this.setMap(null);
};


/**
 * Implementation of the onRemove interface.
 * @ignore
 */
ClusterIcon.prototype.onRemove = function() {
    if (this.div_ && this.div_.parentNode) {
        this.hide();
        this.div_.parentNode.removeChild(this.div_);
        this.div_ = null;
    }
};


/**
 * Set the sums of the icon.
 *
 * @param {Object} sums The sums containing:
 *   'text': (string) The text to display in the icon.
 *   'index': (number) The style index of the icon.
 */
ClusterIcon.prototype.setSums = function(sums) {
    this.sums_ = sums;
    this.text_ = sums.text;
    this.index_ = sums.index;
    if (this.div_) {
        this.div_.innerHTML = sums.text;
    }

    this.useStyle();
};


/**
 * Sets the icon to the the styles.
 */
ClusterIcon.prototype.useStyle = function() {
    var index = Math.max(0, this.sums_.index - 1);
    index = Math.min(this.styles_.length - 1, index);
    var style = this.styles_[index];
    this.url_ = style['url'];
    this.height_ = style['height'];
    this.width_ = style['width'];
    this.textColor_ = style['textColor'];
    this.anchor_ = style['anchor'];
    this.textSize_ = style['textSize'];
    this.backgroundPosition_ = style['backgroundPosition'];
    this.iconAnchor_ = style['iconAnchor'];
};


/**
 * Sets the center of the icon.
 *
 * @param {google.maps.LatLng} center The latlng to set as the center.
 */
ClusterIcon.prototype.setCenter = function(center) {
    this.center_ = center;
};


/**
 * Create the css text based on the position of the icon.
 *
 * @param {google.maps.Point} pos The position.
 * @return {string} The css style text.
 */
ClusterIcon.prototype.createCss = function(pos) {
    var style = [];
    style.push('background-image:url(' + this.url_ + ');');
    var backgroundPosition = this.backgroundPosition_ ? this.backgroundPosition_ : '0 0';
    style.push('background-position:' + backgroundPosition + ';');

    if (typeof this.anchor_ === 'object') {
        if (typeof this.anchor_[0] === 'number' && this.anchor_[0] > 0 &&
            this.anchor_[0] < this.height_) {
            style.push('height:' + (this.height_ - this.anchor_[0]) +
                'px; padding-top:' + this.anchor_[0] + 'px;');
        } else if (typeof this.anchor_[0] === 'number' && this.anchor_[0] < 0 &&
            -this.anchor_[0] < this.height_) {
            style.push('height:' + this.height_ + 'px; line-height:' + (this.height_ + this.anchor_[0]) +
                'px;');
        } else {
            style.push('height:' + this.height_ + 'px; line-height:' + this.height_ +
                'px;');
        }
        if (typeof this.anchor_[1] === 'number' && this.anchor_[1] > 0 &&
            this.anchor_[1] < this.width_) {
            style.push('width:' + (this.width_ - this.anchor_[1]) +
                'px; padding-left:' + this.anchor_[1] + 'px;');
        } else {
            style.push('width:' + this.width_ + 'px; text-align:center;');
        }
    } else {
        style.push('height:' + this.height_ + 'px; line-height:' +
            this.height_ + 'px; width:' + this.width_ + 'px; text-align:center;');
    }

    var txtColor = this.textColor_ ? this.textColor_ : 'black';
    var txtSize = this.textSize_ ? this.textSize_ : 11;

    style.push('cursor:pointer; top:' + pos.y + 'px; left:' +
        pos.x + 'px; color:' + txtColor + '; position:absolute; font-size:' +
        txtSize + 'px; font-family:Arial,sans-serif; font-weight:bold');
    return style.join('');
};


// Export Symbols for Closure
// If you are not going to compile with closure then you can remove the
// code below.
window['MarkerClusterer'] = MarkerClusterer;
MarkerClusterer.prototype['addMarker'] = MarkerClusterer.prototype.addMarker;
MarkerClusterer.prototype['addMarkers'] = MarkerClusterer.prototype.addMarkers;
MarkerClusterer.prototype['clearMarkers'] =
    MarkerClusterer.prototype.clearMarkers;
MarkerClusterer.prototype['fitMapToMarkers'] =
    MarkerClusterer.prototype.fitMapToMarkers;
MarkerClusterer.prototype['getCalculator'] =
    MarkerClusterer.prototype.getCalculator;
MarkerClusterer.prototype['getGridSize'] =
    MarkerClusterer.prototype.getGridSize;
MarkerClusterer.prototype['getExtendedBounds'] =
    MarkerClusterer.prototype.getExtendedBounds;
MarkerClusterer.prototype['getMap'] = MarkerClusterer.prototype.getMap;
MarkerClusterer.prototype['getMarkers'] = MarkerClusterer.prototype.getMarkers;
MarkerClusterer.prototype['getMaxZoom'] = MarkerClusterer.prototype.getMaxZoom;
MarkerClusterer.prototype['getStyles'] = MarkerClusterer.prototype.getStyles;
MarkerClusterer.prototype['getTotalClusters'] =
    MarkerClusterer.prototype.getTotalClusters;
MarkerClusterer.prototype['getTotalMarkers'] =
    MarkerClusterer.prototype.getTotalMarkers;
MarkerClusterer.prototype['redraw'] = MarkerClusterer.prototype.redraw;
MarkerClusterer.prototype['removeMarker'] =
    MarkerClusterer.prototype.removeMarker;
MarkerClusterer.prototype['removeMarkers'] =
    MarkerClusterer.prototype.removeMarkers;
MarkerClusterer.prototype['resetViewport'] =
    MarkerClusterer.prototype.resetViewport;
MarkerClusterer.prototype['repaint'] =
    MarkerClusterer.prototype.repaint;
MarkerClusterer.prototype['setCalculator'] =
    MarkerClusterer.prototype.setCalculator;
MarkerClusterer.prototype['setGridSize'] =
    MarkerClusterer.prototype.setGridSize;
MarkerClusterer.prototype['setMaxZoom'] =
    MarkerClusterer.prototype.setMaxZoom;
MarkerClusterer.prototype['onAdd'] = MarkerClusterer.prototype.onAdd;
MarkerClusterer.prototype['draw'] = MarkerClusterer.prototype.draw;

Cluster.prototype['getCenter'] = Cluster.prototype.getCenter;
Cluster.prototype['getSize'] = Cluster.prototype.getSize;
Cluster.prototype['getMarkers'] = Cluster.prototype.getMarkers;

ClusterIcon.prototype['onAdd'] = ClusterIcon.prototype.onAdd;
ClusterIcon.prototype['draw'] = ClusterIcon.prototype.draw;
ClusterIcon.prototype['onRemove'] = ClusterIcon.prototype.onRemove;
(function($) {
	'use strict';

	var listingSingle = {};
	mkdf.modules.listingSingle = listingSingle;

	listingSingle.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);
	
	
	listingSingle.mkdfInitCommentRating = mkdfInitCommentRating;
	listingSingle.mkdfInitCommentSorting = mkdfInitCommentSorting;
	listingSingle.mkdfInitNewCommentShowHide = mkdfInitNewCommentShowHide;
	listingSingle.mkdfShowHideEnquiryForm = mkdfShowHideEnquiryForm;
	listingSingle.mkdfSubmitEnquiryForm = mkdfSubmitEnquiryForm;

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCommentRating();
		mkdfInitCommentSorting();
		mkdfInitNewCommentShowHide();
		mkdfShowHideEnquiryForm();
		mkdfSubmitEnquiryForm();
	}
	
	function mkdfInitCommentRating() {

		var article = $('.mkdf-listing-single-holder .mkdf-ls-single-item'),
			ratingInput = article.find('#mkdf-rating'),
			ratingValue = ratingInput.val(),
			stars = article.find('.mkdf-star-rating');

		var addActive = function() {
			for ( var i = 0; i < stars.length; i++ ) {
				var star = stars[i];
				if ( i < ratingValue ) {
					$(star).addClass('active');
				} else {
					$(star).removeClass('active');
				}
			}
		};

		addActive();

		stars.click(function(){
			ratingInput.val( $(this).data('value')).trigger('change');
		});

		ratingInput.change(function(){
			ratingValue = ratingInput.val();
			addActive();
		});

	}

	function mkdfInitCommentSorting(){

		var articles = $('.mkdf-ls-single-item');

		if(articles.length){
			articles.each(function(){
				var article = $(this),
					postId = article.attr('id'),
					selectButton = article.find('.mkdf-ls-single-comments .mkdf-ls-single-sort'),
					holder = article.find('.mkdf-ls-single-comments .mkdf-comment-list');

					selectButton.on('change', function(){
						var value = $(this).val();
						if(mkdf.modules.listings.mkdfIsValidObject(value)){
							holder.fadeOut(300);
							var result = value.split('-'),
								orderBy = result[0],
								order = result[1],
								ajaxData = {
									action: 'mkdf_listing_get_post_reviews_ajax',
									order : order,
									orderBy : orderBy,
									postId : postId
								};

							$.ajax({
								type: "POST",
								url: MikadoListingAjaxUrl,
								data: ajaxData,
								success: function (data) {
									if (data === 'error') {
										//error handler
									}else{
										//set new item in global var
										var response = $.parseJSON(data);
										var responseHtml = response.html;
										holder.fadeIn(300, function(){
											holder.html(responseHtml);
										});
									}
								}
							});
						}
					});

			});
		}
	}

	function mkdfInitNewCommentShowHide(){
		var articles = $('.mkdf-ls-single-item');

		if(articles.length) {
			articles.each(function() {
				var article = $(this),
					panelHolderTrigger = article.find('.mkdf-rating-form-trigger'),
					panelHolder = article.find('.mkdf-comment-form .comment-respond');

				panelHolderTrigger.on('click', function(){
					panelHolder.slideToggle('slow');
				});
			});
		}
	}

	function mkdfShowHideEnquiryForm(){
		var article = $('.mkdf-ls-single-item'),
			enquiryHolder = $('.mkdf-ls-enquiry-holder'),
			button = article.find('.mkdf-ls-single-contact-listing'),
			buttonClose = $('.mkdf-ls-enquiry-close');

		button.on('click', function() {
			enquiryHolder.fadeIn(300);
			enquiryHolder.addClass('opened');
		});

		enquiryHolder.add(buttonClose).on('click', function() {
			if(enquiryHolder.hasClass('opened')){
				enquiryHolder.fadeOut(300);
				enquiryHolder.removeClass('opened');
			}
		});

		$(".mkdf-ls-enquiry-inner").click(function(e) {
			e.stopPropagation();
		});
		// on esc too
		$(window).on('keyup', function(e){
			if ( enquiryHolder.hasClass( 'opened' ) && e.keyCode == 27 ) {
				enquiryHolder.fadeOut(300);
				enquiryHolder.removeClass('opened');
			}
		});

	}

	function mkdfSubmitEnquiryForm(){
		var enquiryHolder = $('.mkdf-ls-enquiry-holder'),
			enquiryMessageHolder = $('.mkdf-listing-enquiry-response'),
			enquiryForm = enquiryHolder.find('.mkdf-ls-enquiry-form');


		enquiryForm.on('submit', function(){
			enquiryMessageHolder.empty();
			var enquiryData = {
				name: enquiryForm.find('#enquiry-name').val(),
				email: enquiryForm.find('#enquiry-email').val(),
				message: enquiryForm.find('#enquiry-message').val(),
				itemId: enquiryForm.find('#enquiry-item-id').val(),
				nonce: enquiryForm.find('#mkdf_listing_nonce_listing_item_enquiry').val()
			};

			var requestData = {
				action: 'mkdf_listing_send_listing_item_enquiry',
				data: enquiryData
			};

			$.ajax({
				type: "POST",
				url: MikadoListingAjaxUrl,
				data: requestData,
				success: function (response) {
					if (data === 'error') {
						enquiryMessageHolder.html(response.data);
						//error handler
					}else{
						enquiryMessageHolder.html(response.data);
						enquiryForm.fadeOut(300);
						setTimeout(function(){
							enquiryForm.remove();
						}, 300);
					}
				}
			});
		});

	}
	

})(jQuery);
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
(function($) {
    'use strict';

    var listingList = {};
    mkdf.modules.listingList = listingList;

    listingList.mkdfOnDocumentReady = mkdfOnDocumentReady;
    listingList.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);

    listingList.mkdfInitListingList = mkdfInitListingList;
    listingList.mkdfGetListResponse = mkdfGetListResponse;


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitListingList();
    }

    function mkdfOnWindowLoad() {
        mkdfInitListingListShortcodeAppear();
    }

    function mkdfInitListingList(){

        var container = $('.mkdf-ls-list-items-holder');

        if(container.length){
            container.each(function(){

                var thisContainer = $(this),
                    nextPage = thisContainer.data('next-page'),
                    maxNumPages = thisContainer.data('max-num-pages'),
                    loadMoreButton = thisContainer.find('.mkdf-ls-list-load-more');

                if(typeof loadMoreButton !== 'undefined' && loadMoreButton !=='false'){
                    mkdf.modules.listings.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);

                    loadMoreButton.on('click', function(){
                        mkdfGetListResponse(thisContainer, true, $(this));
                    });
                }

            });
        }

    }

    function mkdfGetListResponse(container, loadMoreFlag, button){

        var number = container.data('listing_list_number'),
            loadMoreData,
            loadMoreButton = container.find('.mkdf-ls-list-load-more'),
            itemsHolder = container.find('.mkdf-ls-list-items-holder-inner'),
            clickedButtonText = button.text(),
            clickedButtonLoadingText = button.data('loading-text') !== 'undefined' ? button.data('loading-text') : "Loading...",
            nextPage,
            data = {};

        if(loadMoreFlag){
            loadMoreData = mkdf.modules.common.getLoadMoreData(container);
        }else{
            container.data('next-page', '2');
        }

        button.text(clickedButtonLoadingText);

        //always get value from holder
        nextPage = container.data('next-page');
        data = {
            action: 'mkdf_listing_job_list_load_more_response',
            postPerPage : number,
            enableLoadMore: loadMoreFlag,
            loadMoreData: loadMoreData,
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

                    if(typeof maxNumPages !== 'undefined' && maxNumPages !== 'false'){
                        container.data('max-num-pages', maxNumPages);
                    }

                    if(loadMoreFlag) {
                        nextPage++;
                        container.data('next-page', nextPage);
                    }
                    mkdfListInitContent(itemsHolder, responseHtml, loadMoreFlag);
                }

                //show button
                button.text(clickedButtonText);
                mkdf.modules.listings.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);
            }
        });

        function mkdfListInitContent(itemsHolder, responseHtml, loadMoreFlag) {
            itemsHolder.waitForImages({
                finished: function() {
                    if(loadMoreFlag) {
                        itemsHolder.append(responseHtml);
                    } else {
                        itemsHolder.html(responseHtml);
                    }
                    mkdfInitListingListShortcodeAppear();
                },
                waitForAll: true
            });
        }
    }

    /**
     *  Animate listing list shortcode
     */
    function mkdfInitListingListShortcodeAppear() {
        var listingList = $('.mkdf-ls-list-holder');

        if(listingList.length && !mkdf.htmlEl.hasClass('touch')){
            listingList.each(function(){
                var thisListingList = $(this),
                    item = thisListingList.find('.mkdf-ls-item'),
                    animateCycle = 0, // rewind delay
                    animateCycleCounter = 0;

                item.each(function(){
                    if ($(this).offset().top == item.first().offset().top) { //find the number of articles in the same row
                        animateCycle ++
                    }
                });
                item.appear(function(){
                    var currentItem = $(this);

                    if (animateCycleCounter == animateCycle) {
                        animateCycleCounter = 0;
                    }

                    setTimeout(function(){
                        currentItem.addClass('mkdf-appear');

                        currentItem.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
                            currentItem.addClass('mkdf-appeared');
                        });
                    },animateCycleCounter * 250);

                    animateCycleCounter++;
                });

            });
        }
    }

})(jQuery);