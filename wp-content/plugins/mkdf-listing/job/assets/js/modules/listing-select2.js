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