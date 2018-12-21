(function($) {

	var resumesSelect = {};
	mkdf.modules.resumesSelect = resumesSelect;
	resumesSelect.mkdfOnDocumentReady = mkdfOnDocumentReady;
	resumesSelect.mkdfOnWindowLoad = mkdfOnWindowLoad;
	resumesSelect.mkdfOnWindowResize = mkdfOnWindowResize;
	resumesSelect.mkdfOnWindowScroll = mkdfOnWindowScroll;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	$(window).scroll(mkdfOnWindowScroll);

	resumesSelect.mkdfSelect2Fields = mkdfSelect2Fields;
	resumesSelect.mkdfInitSelect2Field = mkdfInitSelect2Field;


	function mkdfOnDocumentReady() {
        mkdfSelect2Fields();
	}
	function mkdfOnWindowLoad() {}
	function mkdfOnWindowResize() {}
	function mkdfOnWindowScroll() {}

	function mkdfSelect2Fields(){

		var defaultSelectFields = $(
			'.mkdf-rs-adv-search-holder select, ' +
			'.mkdf-rs-main-search-holder-part select, ' +
			'.mkdf-rs-archive-holder select,' +
			'.mkdf-rs-single-comments .mkdf-rs-single-sort,' +
			'.mkdf-membership-dashboard-page select'
		);
		if(defaultSelectFields.length){
			defaultSelectFields.each(function(){
                mkdfInitSelect2Field($(this));
			});
		}

	}

	function mkdfInitSelect2Field(field){
		if(mkdf.modules.resumes.mkdfIsValidObject(field)){
            field.select2({

			});
        }
	}

})(jQuery);