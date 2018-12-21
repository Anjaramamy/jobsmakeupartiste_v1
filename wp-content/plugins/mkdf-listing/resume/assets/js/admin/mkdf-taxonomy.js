(function($){

    $(document).ready(function() {
        mkdfInitMediaUploader();
        mkdfInitIconSelectDependency();
    });

    function mkdfInitMediaUploader() {
        if($('.mkdf-media-uploader').length) {
            $('.mkdf-media-uploader').each(function() {
                var fileFrame;
                var uploadUrl;
                var uploadHeight;
                var uploadWidth;
                var uploadImageHolder;
                var attachment;
                var removeButton;

                //set variables values
                uploadUrl           = $(this).find('.mkdf-media-upload-url');
                uploadHeight        = $(this).find('.mkdf-media-upload-height');
                uploadWidth        = $(this).find('.mkdf-media-upload-width');
                uploadImageHolder   = $(this).find('.mkdf-media-image-holder');
                removeButton        = $(this).find('.mkdf-media-remove-btn');

                if (uploadImageHolder.find('img').attr('src') != "") {
                    removeButton.show();
                    mkdfInitMediaRemoveBtn(removeButton);
                }

                $(this).on('click', '.mkdf-media-upload-btn', function() {
                    //if the media frame already exists, reopen it.
                    if (fileFrame) {
                        fileFrame.open();
                        return;
                    }

                    //create the media frame
                    fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: $(this).data('frame-title'),
                        button: {
                            text: $(this).data('frame-button-text')
                        },
                        multiple: false
                    });

                    //when an image is selected, run a callback
                    fileFrame.on( 'select', function() {
                        attachment = fileFrame.state().get('selection').first().toJSON();
                        removeButton.show();
                        mkdfInitMediaRemoveBtn(removeButton);
                        //write to url field and img tag
                        if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                            uploadUrl.val(attachment.url);
                            if (attachment.sizes.thumbnail)
                                uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                            else
                                uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        } else if (attachment.hasOwnProperty('url')) {
                            uploadUrl.val(attachment.url);
                            uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        }

                        //write to hidden meta fields
                        if(attachment.hasOwnProperty('height')) {
                            uploadHeight.val(attachment.height);
                        }

                        if(attachment.hasOwnProperty('width')) {
                            uploadWidth.val(attachment.width);
                        }
                        $('.mkdf-input-change').addClass('yes');
                    });

                    //open media frame
                    fileFrame.open();
                });
            });
        }

        function mkdfInitMediaRemoveBtn(btn) {
            btn.on('click', function() {
                //remove image src and hide it's holder
                btn.siblings('.mkdf-media-image-holder').hide();
                btn.siblings('.mkdf-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.mkdf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    function mkdfInitIconSelectDependency() {

        var iconPack = $('#icon_pack'),
            holders = $('.term-icons-wrap .icon-collection');

        var checkDependency = function() {
            holders.each(function(){
                var value = iconPack.val(),
                    holder = $(this);
                if ( holder.hasClass( value ) ) {
                    holder.fadeIn(300);
                } else {
                    holder.fadeOut(300);
                }
            });
        };
        checkDependency();

        iconPack.change( function() {
            checkDependency();
        });
    }

})(jQuery);