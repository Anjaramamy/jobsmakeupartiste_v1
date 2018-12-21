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