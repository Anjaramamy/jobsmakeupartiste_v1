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