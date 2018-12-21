(function($) {
	'use strict';

	var resumeSingle = {};
	mkdf.modules.resumeSingle = resumeSingle;

	resumeSingle.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);
	
	
	resumeSingle.mkdfInitCommentRating = mkdfInitCommentRating;
	resumeSingle.mkdfInitCommentSorting = mkdfInitCommentSorting;
	resumeSingle.mkdfInitNewCommentShowHide = mkdfInitNewCommentShowHide;
	resumeSingle.mkdfShowHideEnquiryForm = mkdfShowHideEnquiryForm;
	resumeSingle.mkdfSubmitResumeEnquiryForm = mkdfSubmitResumeEnquiryForm;

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCommentRating();
		mkdfInitCommentSorting();
		mkdfInitNewCommentShowHide();
		mkdfShowHideEnquiryForm();
		mkdfSubmitResumeEnquiryForm();
	}
	
	function mkdfInitCommentRating() {

		var article = $('.mkdf-resume-single-holder .mkdf-rs-single-item'),
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

		var articles = $('.mkdf-rs-single-item');

		if(articles.length){
			articles.each(function(){
				var article = $(this),
					postId = article.attr('id'),
					selectButton = article.find('.mkdf-rs-single-comments .mkdf-rs-single-sort'),
					holder = article.find('.mkdf-rs-single-comments .mkdf-comment-list');

					selectButton.on('change', function(){
						var value = $(this).val();
						if(mkdf.modules.resumes.mkdfIsValidObject(value)){
							holder.fadeOut(300);
							var result = value.split('-'),
								orderBy = result[0],
								order = result[1],
								ajaxData = {
									action: 'mkdf_listing_resume_get_post_reviews_ajax',
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
		var articles = $('.mkdf-rs-single-item');

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
		var article = $('.mkdf-rs-single-item'),
			enquiryHolder = $('.mkdf-rs-enquiry-holder'),
			button = article.find('.mkdf-rs-single-contact-resume'),
			buttonClose = $('.mkdf-rs-enquiry-close');

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

		$(".mkdf-rs-enquiry-inner").click(function(e) {
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

	function mkdfSubmitResumeEnquiryForm(){
		var enquiryHolder = $('.mkdf-rs-enquiry-holder'),
			enquiryMessageHolder = $('.mkdf-resume-enquiry-response'),
			enquiryForm = enquiryHolder.find('.mkdf-rs-enquiry-form');


		enquiryForm.on('submit', function(){
			enquiryMessageHolder.empty();
			var enquiryData = {
				name: enquiryForm.find('#resume-enquiry-name').val(),
				email: enquiryForm.find('#resume-enquiry-email').val(),
				message: enquiryForm.find('#resume-enquiry-message').val(),
				itemId: enquiryForm.find('#resume-enquiry-item-id').val(),
				nonce: enquiryForm.find('#mkdf_listing_resume_nonce_resume_item_enquiry').val()
			};

			var requestData = {
				action: 'mkdf_listing_resume_send_resume_item_enquiry',
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