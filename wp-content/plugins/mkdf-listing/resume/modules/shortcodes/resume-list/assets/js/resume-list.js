(function($) {
    'use strict';

    var resumeList = {};
    mkdf.modules.resumeList = resumeList;

    resumeList.mkdfOnDocumentReady = mkdfOnDocumentReady;
    resumeList.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);

    resumeList.mkdfInitResumeList = mkdfInitResumeList;
    resumeList.mkdfGetListResponse = mkdfGetListResponse;


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitResumeList();
    }

    function mkdfOnWindowLoad() {
        mkdfInitResumeListShortcodeAppear();
    }

    function mkdfInitResumeList(){

        var container = $('.mkdf-rs-list-items-holder');

        if(container.length){
            container.each(function(){

                var thisContainer = $(this),
                    nextPage = thisContainer.data('next-page'),
                    maxNumPages = thisContainer.data('max-num-pages'),
                    loadMoreButton = thisContainer.find('.mkdf-rs-list-load-more');

                if(typeof loadMoreButton !== 'undefined' && loadMoreButton !=='false'){
                    mkdf.modules.resumes.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);

                    loadMoreButton.on('click', function(){
                        mkdfGetListResponse(thisContainer, true, $(this));
                    });
                }

            });
        }

    }

    function mkdfGetListResponse(container, loadMoreFlag, button){

        var number = container.data('resume_list_number'),
            loadMoreData,
            loadMoreButton = container.find('.mkdf-rs-list-load-more'),
            itemsHolder = container.find('.mkdf-rs-list-items-holder-inner'),
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
            action: 'mkdf_listing_resume_list_load_more_response',
            postPerPage : number,
            enableLoadMore: loadMoreFlag,
            loadMoreData: loadMoreData
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
                mkdf.modules.resumes.mkdfShowHideButton(loadMoreButton, nextPage, maxNumPages);
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
                    mkdfInitResumeListShortcodeAppear();
                },
                waitForAll: true
            });
        }
    }

    /**
     *  Animate resume list shortcode
     */
    function mkdfInitResumeListShortcodeAppear() {
        var resumeList = $('.mkdf-rs-list-holder');

        if(resumeList.length && !mkdf.htmlEl.hasClass('touch')){
            resumeList.each(function(){
                var thisResumeList = $(this),
                    item = thisResumeList.find('.mkdf-rs-item'),
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