(function($) {
    "use strict";

    var maps = {};
    mkdf.modules.rsmaps = maps;
    mkdf.modules.rsmaps.mkdfInitMultipleResumeMap = mkdfInitMultipleResumeMap;
    mkdf.modules.rsmaps.mkdfInitSingleResumeMap = mkdfInitSingleResumeMap;
    mkdf.modules.rsmaps.mkdfInitResumeMobileMap = mkdfInitResumeMobileMap;
    mkdf.modules.rsmaps.mkdfResumeGoogleMaps = {};

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    function mkdfOnDocumentReady() {}

    function mkdfOnWindowLoad() {
        mkdfInitSingleResumeMap();
        mkdfInitMultipleResumeMap();
        mkdfInitResumeMobileMap();
    }

    function mkdfOnWindowResize() {}

    function mkdfOnWindowScroll() {}

    function mkdfInitSingleResumeMap() {
        var mapHolder = $('#mkdf-rs-single-map-holder');
        if ( mapHolder.length ) {
            mkdf.modules.rsmaps.mkdfResumeGoogleMaps.getResumeDirectoryItemAddress({
                mapHolder: 'mkdf-rs-single-map-holder'
            });
        }
    }

    function mkdfInitMultipleResumeMap() {
        var mapHolder = $('#mkdf-rs-multiple-map-holder');
        if ( mapHolder.length ) {
            mkdf.modules.rsmaps.mkdfResumeGoogleMaps.getResumeDirectoryItemsAddresses({
                mapHolder: 'mkdf-rs-multiple-map-holder',
                hasFilter: true
            });
        }
    }


    mkdf.modules.rsmaps.mkdfResumeGoogleMaps = {

        //Object varibles
        mapHolder: {},
        map: {},
        markers: {},
        radius: {},

        /**
         * Returns map with single address
         *
         * @param options
         */
        getResumeDirectoryItemAddress: function (options) {
            /**
             * use mkdfMapsVars to get variables for address, latitude, longitude by default
             */
            var defaults = {
                location: mkdfSingleResumeMapVars.single['currentResume'].location,
                type: mkdfSingleResumeMapVars.single['currentResume'].resumeType,
                zoom: 16,
                mapHolder: '',
                draggable: mkdfMapsVars.global.draggable,
                mapTypeControl: mkdfMapsVars.global.mapTypeControl,
                scrollwheel: mkdfMapsVars.global.scrollable,
                streetViewControl: mkdfMapsVars.global.streetViewControl,
                zoomControl: mkdfMapsVars.global.zoomControl,
                title: mkdfSingleResumeMapVars.single['currentResume'].title,
                content: '',
                styles: mkdfMapsVars.global.mapStyle,
                markerPin: mkdfSingleResumeMapVars.single['currentResume'].markerPin,
                featuredImage: mkdfSingleResumeMapVars.single['currentResume'].featuredImage,
                position: mkdfSingleResumeMapVars.single['currentResume'].position,
                itemUrl: mkdfSingleResumeMapVars.single['currentResume'].itemUrl,
                markerClass: mkdfSingleResumeMapVars.single['currentResume'].markerClass
            };
            var settings = $.extend({}, defaults, options);

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;

            //Get map holder
            var mapHolder = document.getElementById(settings.mapHolder);

            //Initialize map
            var map = new google.maps.Map(mapHolder, {
                zoom: settings.zoom,
                draggable: settings.draggable,
                mapTypeControl: settings.mapTypeControl,
                scrollwheel: settings.scrollwheel,
                streetViewControl: settings.streetViewControl,
                zoomControl: settings.zoomControl
            });

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //Try to locate by latitude and longitude
            if (typeof settings.location !== 'undefined' && settings.location !== null) {
                var latLong = {
                    lat: parseFloat(settings.location.latitude),
                    lng: parseFloat(settings.location.longitude)
                };
                //Set map center to location
                map.setCenter(latLong);
                //Add marker to map

                var templateData = {
                    title: settings.title,
                    address: settings.location.address,
                    featuredImage: settings.featuredImage,
                    position: settings.position,
                    itemUrl: settings.itemUrl
                };

                var customMarker = new CustomMarker({
                    map: map,
                    position: latLong,
                    templateData: templateData,
                    markerPin: settings.markerPin,
                    markerClass: settings.markerClass
                });

                this.initResumeMarkerInfo();

            }

        },

        /**
         * Returns map with multiple addresses
         *
         * @param options
         */
        getResumeDirectoryItemsAddresses: function (options) {
                var defaults = {
                geolocation: false,
                mapHolder: 'mkdf-rs-multiple-map-holder',
                addresses: mkdfMultipleResumeMapVars.multiple.addresses,
                draggable: mkdfMapsVars.global.draggable,
                mapTypeControl: mkdfMapsVars.global.mapTypeControl,
                scrollwheel: mkdfMapsVars.global.scrollable,
                streetViewControl: mkdfMapsVars.global.streetViewControl,
                zoomControl: mkdfMapsVars.global.zoomControl,
                zoom: 16,
                styles: mkdfMapsVars.global.mapStyle,
                radius: 50, //radius for marker visibility, in km
                hasFilter: false
            };
            var settings = $.extend({}, defaults, options);

            //Get map holder
            var mapHolder = document.getElementById(settings.mapHolder);

            //Initialize map
            var map = new google.maps.Map(mapHolder, {
                zoom: settings.zoom,
                draggable: settings.draggable,
                mapTypeControl: settings.mapTypeControl,
                scrollwheel: settings.scrollwheel,
                streetViewControl: settings.streetViewControl,
                zoomControl: settings.zoomControl
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
            if (navigator.geolocation && settings.geolocation) {
                this.centerResumeOnCurrentLocation();
            }

            //Filter addresses, remove items without latitude and longitude
            var addresses = [],
                addressesLength = settings.addresses.length;
            if (settings.addresses.length !== null) {
                for (var i = 0; i < addressesLength; i++) {
                    var location = settings.addresses[i].location;
                    if (typeof location !== 'undefined' && location !== null) {

                        if (location.latitude !== '' && location.longitude !== '') {
                            addresses.push(settings.addresses[i]);
                        }
                    }
                }
            }


            //Center map and set borders of map
            this.setResumeMapBounds(addresses);

            //Add markers to the map
            this.addResumeMultipleMarkers(addresses);

        },

        /**
         * Add multiple markers to map
         */
        addResumeMultipleMarkers: function (markersData) {

            var map = this.map;

            var markers = [];
            //Loop through markers
            var len = markersData.length;
            for (var i = 0; i < len; i++) {

                var latLng = {
                    lat: parseFloat(markersData[i].location.latitude),
                    lng: parseFloat(markersData[i].location.longitude)
                };

                //Custom html markers
                //Insert marker data into info window template
                var templateData = {
                    title: markersData[i].title,
                    address: markersData[i].location.address,
                    featuredImage: markersData[i].featuredImage,
                    position: markersData[i].position,
                    itemUrl: markersData[i].itemUrl
                };

                var customMarker = new CustomMarker({
                    position: latLng,
                    map: map,
                    templateData: templateData,
                    markerPin: markersData[i].markerPin,
                    markerClass: markersData[i].markerClass
                });

                markers.push(customMarker);

            }

            this.markers = markers;

            //Init map clusters ( Grouping map markers at small zoom values )
            this.initResumeMapClusters();

            //Init marker info
            this.initResumeMarkerInfo();

            //Init visible circle area around center of map
            var that = this;
            google.maps.event.addListener(map, 'idle', function () {
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
                //that.refreshResumeCircleAreaMarkers( visibleRadius.getBounds() );
            });

        },

        /**
         * Set map bounds for Map with multiple markers
         *
         * @param addressesArray
         */
        setResumeMapBounds: function (addressesArray) {

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < addressesArray.length; i++) {
                bounds.extend(new google.maps.LatLng(parseFloat(addressesArray[i].location.latitude), parseFloat(addressesArray[i].location.longitude)));
            }

            this.map.fitBounds(bounds);

        },

        /**
         * Init map clusters for grouping markers on small zoom values
         */
        initResumeMapClusters: function () {

            //Activate clustering on multiple markers
            var markerClusteringOptions = {
                minimumClusterSize: 2,
                maxZoom: 12,
                styles: [{
                    width: 47,
                    height: 47,
                    url: '',
                    textSize: 28
                }]
            };
            var markerClusterer = new MarkerClusterer(this.map, this.markers, markerClusteringOptions);

        },

        initResumeMarkerInfo: function () {

            $(document).on('click', '.mkdf-map-marker', function () {
                var self = $(this),
                    markerHolders = $('.mkdf-map-marker-holder'),
                    infoWindows = $('.mkdf-info-window'),
                    markerHolder = self.parent('.mkdf-map-marker-holder'),
                    infoWindow = self.siblings('.mkdf-info-window');

                if (markerHolder.hasClass('active')) {
                    markerHolder.removeClass('active');
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
        addResumeInfoWindow: function () {

            var contentString = '';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });
            return infoWindow;

        },

        /**
         * If geolocation enabled center map on users current position
         */
        centerResumeOnCurrentLocation: function () {
            var map = this.map;
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    var center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
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
        refreshResumeCircleAreaMarkers: function (circleArea) {

            var length = this.markers.length;
            for (var i = 0; i < length; i++) {
                if (circleArea.contains(this.markers[i].getPosition())) {
                    this.markers[i].setVisible(true);
                } else {
                    this.markers[i].setVisible(false);
                }
            }

        }

    }



    function mkdfInitResumeMobileMap() {

        var mapOpener = $('.mkdf-resume-view-larger-map a'),
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
                mkdf.modules.rsmaps.mkdfResumeGoogleMaps.getResumeDirectoryItemsAddresses();
            });
        }
    }

})(jQuery);