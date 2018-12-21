(function($) {
	'use strict';
	
	var workflow = {};
	mkdf.modules.workflow = workflow;
	
	workflow.mkdfWorkflow = mkdfWorkflow;
	
	
	workflow.mkdfOnDocumentReady = mkdfOnDocumentReady;

	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
        mkdfWorkflow();
	}

    /*
     * Animate Workflow shortcode
     */
    function mkdfWorkflow() {
        var workflowShortcodes = $('.mkdf-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('mkdf-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.mkdf-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('mkdf-appeared');
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

                    workflowItems.each(function (i) {
                        var workflowItem = $(this);
                        workflowItem.appear(function () {
                            setTimeout(function(){
                                workflowItem.addClass('mkdf-appeared');
                            },100);
                        });
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

                }
            });
        }
    }
	
})(jQuery);