(function ($) {
    "use strict";

    var header = {};
    mkdf.modules.header = header;

    header.mkdfSetDropDownMenuPosition = mkdfSetDropDownMenuPosition;
    header.mkdfSetDropDownWideMenuPosition = mkdfSetDropDownWideMenuPosition;

    header.mkdfOnDocumentReady = mkdfOnDocumentReady;
    header.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfSetDropDownMenuPosition();
        mkdfDropDownMenu();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfSetDropDownWideMenuPosition();
    }

    /**
     * Set dropdown position
     */
    function mkdfSetDropDownMenuPosition() {
        var menuItems = $('.mkdf-drop-down > ul > li.narrow.menu-item-has-children');

        if (menuItems.length) {
            menuItems.each(function (i) {
                var thisItem = $(this),
                    menuItemPosition = thisItem.offset().left,
                    dropdownHolder = thisItem.find('.second'),
                    dropdownMenuItem = dropdownHolder.find('.inner ul'),
                    dropdownMenuWidth = dropdownMenuItem.outerWidth(),
                    menuItemFromLeft = mkdf.windowWidth - menuItemPosition;

                if (mkdf.body.hasClass('mkdf-boxed')) {
                    menuItemFromLeft = mkdf.boxedLayoutWidth - (menuItemPosition - (mkdf.windowWidth - mkdf.boxedLayoutWidth ) / 2);
                }

                var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

                if (thisItem.find('li.sub').length > 0) {
                    dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
                }

                dropdownHolder.removeClass('right');
                dropdownMenuItem.removeClass('right');
                if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
                    dropdownHolder.addClass('right');
                    dropdownMenuItem.addClass('right');
                }
            });
        }
    }

    /**
     * Set dropdown wide position
     */
    function mkdfSetDropDownWideMenuPosition() {
        var menuAreaHolder = $('.mkdf-menu-area .mkdf-vertical-align-containers'),
            menuArea = $('.mkdf-drop-down'),
            menuItems = menuArea.find('> ul > li.wide'),
            menuGrid = $('.mkdf-menu-area').find('.mkdf-grid'),
            menuAreaHolderWidth = menuAreaHolder.outerWidth();

        menuItems.each(function () {
            var menuItem = $(this);
            var menuItemOffset = menuItem[0].offsetLeft;
            var menuItemWidth = menuItem.outerWidth();
            var browserWidth = mkdf.windowWidth - 16; // 16 is width of scroll bar

            var dropDown = menuItem.find('.second');

            var dropDownWidth = dropDown.outerWidth();

            var dropDownOffset = -dropDownWidth / 2 + menuItemWidth / 2;

            var gridMargin = 0;


            //initial dropdown position
            dropDown.css('left', dropDownOffset);

            //check for additional move
            if ( menuGrid.length ) {
                gridMargin = parseInt( menuGrid.css('margin-right'), 10 );

                dropDown.css('left', dropDownOffset - gridMargin + 38);
            }

            //recalculate dd position in case it goes over the left bound
            if (Math.abs(menuItemOffset) < dropDownWidth / 2) {
                dropDown.css({'left': -menuItemOffset});
            }
            //recalculate dd position in case it goes over the right bound
            else if(Math.abs(menuItemOffset + dropDownWidth/2 + menuItemWidth/2) > Math.abs(menuAreaHolderWidth)){
                dropDown.css({'left': -dropDownWidth - menuItemOffset + menuAreaHolderWidth - gridMargin - parseInt(menuAreaHolder.css('padding-left'))});
            }

            //check for additional move

            if(dropDown.parents('.mkdf-position-left').length > 0){
                var mainMenuLeftOffset = menuItem.closest(".mkdf-position-left").offset().left;
                var leftDiff = mainMenuLeftOffset - dropDown.offset().left;

                if (leftDiff > 100) {
                    dropDown.css('margin-left', leftDiff * 2 / 3);
                }
            }

            if(dropDown.parents('.mkdf-position-right').length > 0){
                var mainMenuRightOffset = menuItem.closest(".mkdf-position-right").offset().left;
                var mainMenuRightWidth = menuItem.closest(".mkdf-position-right").width();
                var rightDiff = (browserWidth - mainMenuRightOffset - mainMenuRightWidth) - (browserWidth - dropDown.offset().left - dropDownWidth);

                if (rightDiff > 100) {
                    dropDown.css('margin-left', -rightDiff);
                }
            }

        });
    }

    function mkdfDropDownMenu() {
        var menu_items_holders = $('.mkdf-drop-down .wide .inner > ul');
        var menu_items = $('.mkdf-drop-down > ul > li');

        //dropdown wide width
        menu_items_holders.each(function () {
            var menu_items_holder = $(this);

            var menu_items_wide = menu_items_holder.children(),
                menu_items_count = menu_items_wide.length > 4 ? 4 : menu_items_wide.length,
                menu_items_width = menu_items_wide.first().outerWidth();

            menu_items_holders.width(menu_items_width * menu_items_count);
        });

        menu_items.each(function (i) {
            if ($(menu_items[i]).find('.second').length > 0) {
                var thisItem = $(menu_items[i]),
                    dropDownSecondDiv = thisItem.find('.second');

                if (thisItem.hasClass('wide')) {
                    //set columns to be same height - start
                    var tallest = 0,
                        dropDownSecondItem = $(this).find('.second > .inner > ul > li');

                    dropDownSecondItem.each(function () {

                        var thisHeight = $(this).outerHeight();

                        if (thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });

                    dropDownSecondItem.css('height', ''); // delete old inline css - via resize
                    //dropDownSecondItem.height(tallest);
                    //set columns to be same height - end
                }

                if (!mkdf.menuDropdownHeightSet) {
                    thisItem.data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    thisItem.on("touchstart mouseenter", function () {
                        dropDownSecondDiv.css({
                            'height': thisItem.data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function () {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });
                } else {
                    if (mkdf.body.hasClass('mkdf-dropdown-animate-height')) {
                        thisItem.mouseenter(function () {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': thisItem.data('original_height'),
                                opacity: 1
                            }, 300, function () {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function () {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 150, function () {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function () {
                                setTimeout(function () {
                                    dropDownSecondDiv.addClass('mkdf-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': thisItem.data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function () {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('mkdf-drop-down-start');
                            }
                        };
                        thisItem.hoverIntent(config);
                    }
                }
            }
        });

        $('.mkdf-drop-down ul li.wide ul li a').on('click', function (e) {
            if (e.which == 1) {
                var $this = $(this);
                setTimeout(function () {
                    $this.mouseleave();
                }, 500);
            }
        });

        mkdf.menuDropdownHeightSet = true;
    }

})(jQuery);