(function($){
	$(document).ready(function() {
		mkdfCreateCustomField();
		mkdfOptionRepeater();
		mkdfOptionRepeaterDeleteRow();
		mkdfToggleRow();
		mkdfDeleteRow();
	});
	function mkdfCreateCustomField(){

		var customField = $('.mkdf-add-custom-field');
		if(customField.length){
			customField.on('click',function(){
				var thisField = $(this);
				var parent = thisField.parents('.term-description-wrap');
				var data = {
					type: thisField.data('type'),
					action: 'mkdf_listing_resume_get_custom_field_html'
				};
				$.ajax({
					type: "POST",
					url: MikadoAdminAjaxUrl,
					data: data,
					success: function (data) {
						if (data === 'error') {
							//error handler
						}else{
							response = $.parseJSON(data);
							parent.after(response.html);
							mkdfOptionRepeater();
							mkdfOptionRepeaterDeleteRow();
							mkdfToggleRow();
							mkdfDeleteRow();
						}
					}
				});
				return false;
			});
		}
	}

	function mkdfOptionRepeater(){
		var button = $('.mkdf-option-repeater-button');
		var counter = 0;
		if(button.length){
			button.each(function(){
				var currentButton = $(this);
				currentButton.on('click', function(){
					counter ++;
					var thisButton = $(this);
					var parent = thisButton.siblings('.mkdf-custom-select-field-option-wrapper');
					var selectFieldId = '';
					var customFieldWrapper = parent.parents('.mkdf-custom-field-wrapper');
					if(customFieldWrapper.hasClass('mkdf-custom-select-field')){
						selectFieldId = customFieldWrapper.data('select-field-id');
					}

					var data = {
						action: 'mkdf_listing_resume_get_option_field_html',
						parentId: selectFieldId
					};
					if(counter === 1){
						$.ajax({
							type: "POST",
							url: MikadoAdminAjaxUrl,
							data: data,
							success: function (data) {
								response = $.parseJSON(data);
								if (response === 'error') {
									//error handler
								}else{
									parent.append(response.html);
									mkdfOptionRepeater();
									mkdfOptionRepeaterDeleteRow();
									mkdfToggleRow();
									mkdfDeleteRow();
								}
							}
						});
					}
				});
			});
		}

	}
	function mkdfOptionRepeaterDeleteRow(){
		var deleteButton = $('.mkdf-option-repeater-close-button');
		deleteButton.on('click', function(){
			var thisCloseButton = $(this);
			var parent = thisCloseButton.parents('.mkdf-option-repeater-field-row');
			parent.remove();
		});
	}
	function mkdfToggleRow(){

		var toggleRowTrigger = $('.mkdf-custom-row-expand-button');

		toggleRowTrigger.on('click', function(e){
			e.stopImmediatePropagation();

			var thisCloseButton = $(this);
			var content = thisCloseButton.siblings('.mkdf-custom-field-inner');
            var textContent = thisCloseButton.find('.mkdf-custom-row-opener');

			content.slideToggle();

            if(textContent.text() === '-'){
                textContent.text('+');
            }
            else{
                textContent.text('-');
            }

		});
	}

	function mkdfDeleteRow(){

		var deleteButton = $('.mkdf-custom-row-close-button');
		deleteButton.on('click', function(){
			var thisCloseButton = $(this),
				parent = thisCloseButton.parents('.form-field.custom-term-row');

			parent.remove();

		});

	}

})(jQuery);