<?php

if(!function_exists('staffscout_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function staffscout_mikado_design_styles() {
	    $font_family = staffscout_mikado_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && staffscout_mikado_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo staffscout_mikado_dynamic_css( $font_family_selector, array( 'font-family' => staffscout_mikado_get_font_option_val( $font_family ) ) );
	    }

		$first_main_color = staffscout_mikado_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
                'a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                '.mkdf-comment-holder .mkdf-comment-text .comment-edit-link',
                '.mkdf-comment-holder .mkdf-comment-text .comment-reply-link',
                '.mkdf-comment-holder .mkdf-comment-text .replay',
                '.mkdf-comment-holder .mkdf-comment-text #cancel-comment-reply-link',
                '.mkdf-owl-slider .owl-nav .owl-next:hover',
                '.mkdf-owl-slider .owl-nav .owl-prev:hover',
                '.mkdf-subscribe span.wpcf7-not-valid-tip',
                'footer .widget ul li a:hover',
                'footer .widget.widget_nav_menu ul.menu>li a:hover',
                'footer .widget #wp-calendar td#today',
                'footer .widget #wp-calendar tfoot a:hover',
                'footer .widget.widget_tag_cloud a:hover',
                'footer.mkdf-page-footer .widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text a:hover',
                'footer.mkdf-page-footer .widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text span:hover',
                'footer.mkdf-page-footer .widget a:hover',
                'footer.mkdf-page-footer .widget.widget_archive ul li a:hover:after',
                'footer.mkdf-page-footer .widget.widget_categories ul li a:hover:after',
                'footer.mkdf-page-footer .widget.widget_meta ul li a:hover:after',
                'footer.mkdf-page-footer .widget.widget_nav_menu ul li a:hover:after',
                'footer.mkdf-page-footer .widget.widget_pages ul li a:hover:after',
                'footer.mkdf-page-footer .widget.widget_recent_entries ul li a:hover:after',
                'footer.mkdf-page-footer a:hover',
                '.mkdf-side-menu .widget ul li a:hover',
                '.mkdf-side-menu .widget.widget_nav_menu ul.menu>li a:hover',
                '.mkdf-side-menu .widget #wp-calendar td#today',
                '.mkdf-side-menu .widget #wp-calendar tfoot a:hover',
                '.mkdf-side-menu .widget.widget_tag_cloud a:hover',
                '.wpb_widgetised_column .widget ul li a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul.menu>li a:hover',
                'aside.mkdf-sidebar .widget ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu>li a:hover',
                '.wpb_widgetised_column .widget #wp-calendar td#today',
                'aside.mkdf-sidebar .widget #wp-calendar td#today',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a:hover',
                'aside.mkdf-sidebar .widget #wp-calendar tfoot a:hover',
                '.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
                'aside.mkdf-sidebar .widget.widget_tag_cloud a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul.menu>li.menu-item-has-children>a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul.menu>li.menu-item-has-children>ul.sub-menu>li>a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu>li.menu-item-has-children>a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu>li.menu-item-has-children>ul.sub-menu>li>a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul.menu li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu li a:hover',
                '.wpb_widgetised_column .widget ul.job_listings .listing-bookmarked h3::before',
                '.wpb_widgetised_column .widget ul.resumes .listing-bookmarked h3::before',
                '.wpb_widgetised_column .widget.widget_text .faq-sidebar-links a:hover',
                'aside.mkdf-sidebar .widget ul.job_listings .listing-bookmarked h3::before',
                'aside.mkdf-sidebar .widget ul.resumes .listing-bookmarked h3::before',
                'aside.mkdf-sidebar .widget.widget_text .faq-sidebar-links a:hover',
                '.widget.mkdf-blog-slider-widget .mkdf-blog-slider-holder .mkdf-owl-slider .owl-nav .owl-next:hover>span',
                '.widget.mkdf-blog-slider-widget .mkdf-blog-slider-holder .mkdf-owl-slider .owl-nav .owl-prev:hover>span',
                '.widget.mkdf-blog-slider-widget .mkdf-blog-slider-holder .mkdf-blog-slider-item .mkdf-item-image .mkdf-post-info-date-on-image .mkdf-post-info-date-month:hover',
                '.widget.mkdf-blog-slider-widget .mkdf-blog-slider-holder .mkdf-blog-slider-item .mkdf-item-text-wrapper .mkdf-post-title a:hover',
                '.mkdf-icon-widget-holder',
                '.mkdf-icon-widget-holder.mkdf-link-with-href:hover .mkdf-icon-text',
                '.widget.product-list-carousel-widget .mkdf-plc-holder .mkdf-owl-slider .owl-nav .owl-next:hover span',
                '.widget.product-list-carousel-widget .mkdf-plc-holder .mkdf-owl-slider .owl-nav .owl-prev:hover span',
                '.widget.product-list-carousel-widget .mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer:hover+.mkdf-plc-text-wrapper h6>a',
                '.widget.product-list-carousel-widget .mkdf-plc-holder .mkdf-plc-title a:hover',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text a',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text span',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text a:hover',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-twitter-icon i',
                '.widget ul li a:hover',
                '.widget.widget_nav_menu ul.menu>li a:hover',
                '.widget #wp-calendar td#today',
                '.widget #wp-calendar tfoot a:hover',
                '.widget.widget_tag_cloud a:hover',
                '.mkdf-blog-holder article.sticky .mkdf-post-title a',
                '.mkdf-blog-holder.mkdf-blog-masonry article .mkdf-post-info-top .mkdf-post-info-date>a:hover',
                '.mkdf-blog-holder.mkdf-blog-masonry article.format-link .mkdf-post-mark .mkdf-link-mark',
                '.mkdf-blog-holder.mkdf-blog-masonry article.format-quote .mkdf-post-mark .mkdf-quote-mark',
                '.mkdf-blog-holder.mkdf-blog-narrow article .mkdf-post-info.mkdf-section-bottom .mkdf-post-info-author a:hover',
                '.mkdf-blog-holder.mkdf-blog-narrow article .mkdf-post-info.mkdf-section-bottom .mkdf-blog-like:hover i:first-child',
                '.mkdf-blog-holder.mkdf-blog-narrow article .mkdf-post-info.mkdf-section-bottom .mkdf-blog-like:hover span:first-child',
                '.mkdf-blog-holder.mkdf-blog-narrow article .mkdf-post-info.mkdf-section-bottom .mkdf-post-info-comments-holder:hover span:first-child',
                '.mkdf-blog-holder.mkdf-blog-standard-date-on-side article .mkdf-post-date-inner .mkdf-post-date-day',
                '.mkdf-blog-holder.mkdf-blog-standard-date-on-side article .mkdf-post-date-inner .mkdf-post-date-month',
                '.mkdf-blog-holder.mkdf-blog-standard-date-on-side article .mkdf-post-title a:hover',
                '.mkdf-blog-holder.mkdf-blog-standard-date-on-side article .mkdf-post-info>div a:hover',
                '.mkdf-blog-holder.mkdf-blog-standard-date-on-side article.format-quote .mkdf-quote-author',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-post-info-author .mkdf-post-info-author-link:hover',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-post-info-date>a:hover',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-blog-like .liked i',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-blog-like:hover i:first-child',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-blog-like:hover span:first-child',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-post-info-category .mkdf-post-info-icon i:hover i',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-post-info-category>a:hover',
                '.mkdf-blog-holder.mkdf-blog-standard article .mkdf-post-info-bottom .mkdf-post-info-comments-holder span:first-child:hover i',
                '.mkdf-blog-holder.mkdf-blog-standard article.format-link .mkdf-post-mark .mkdf-link-mark',
                '.mkdf-blog-holder.mkdf-blog-standard article.format-quote .mkdf-post-mark .mkdf-quote-mark',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-name a:hover',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-social-icons a:hover',
                '.mkdf-bl-standard-pagination ul li.mkdf-bl-pag-active a',
                '.mkdf-blog-pagination ul li a.mkdf-pag-active',
                '.mkdf-blog-pagination ul li a:hover',
                '.mkdf-blog-single-navigation .mkdf-blog-single-next:hover',
                '.mkdf-blog-single-navigation .mkdf-blog-single-prev:hover',
                '.mkdf-related-posts-holder .mkdf-related-post .mkdf-related-post-content .mkdf-post-info-date>a:hover',
                '.mkdf-blog-list-holder .mkdf-bli-info>div a:hover',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-post-info-author a:hover',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-blog-like .liked i',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-blog-like:hover i:first-child',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-blog-like:hover span:first-child',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-post-info-comments-holder .mkdf-post-info-icon:hover i',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-post-info-category .mkdf-post-info-icon i:hover i',
                '.mkdf-blog-list-holder.mkdf-bl-boxed .mkdf-bli-info-bottom .mkdf-post-info-category>a:hover',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-left>div a:hover',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-post-info-date>a:hover',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-blog-like .liked i',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-blog-like:hover i:first-child',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-blog-like:hover span:first-child',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-post-info-comments-holder .mkdf-post-info-icon:hover i',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-post-info-category .mkdf-post-info-icon i:hover i',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-right .mkdf-post-info-category>a:hover',
                '.mkdf-blog-holder.mkdf-blog-single article.format-link .mkdf-link .mkdf-post-mark',
                '.mkdf-blog-holder.mkdf-blog-single article.format-quote .mkdf-quote .mkdf-post-mark',
                '.mkdf-page-footer .mkdf-listing-widget .mkdf-ls-list-holder .mkdf-ls-list-items-holder.mkdf-ls-list-simple .mkdf-ls-adr-pin a:hover',
                '.mkdf-page-footer .mkdf-listing-widget .mkdf-ls-list-holder .mkdf-ls-list-items-holder.mkdf-ls-list-simple .mkdf-ls-adr-pin a i:hover',
                '.mkdf-page-footer .mkdf-listing-widget .mkdf-ls-list-holder .mkdf-ls-list-items-holder.mkdf-ls-list-simple .mkdf-ls-adr-city .mkdf-city:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text span:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_archive ul li a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_archive ul li a:hover:after',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_categories ul li a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_categories ul li a:hover:after',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_meta ul li a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_meta ul li a:hover:after',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_nav_menu ul li a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_nav_menu ul li a:hover:after',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_pages ul li a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_pages ul li a:hover:after',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_recent_entries ul li a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.widget_recent_entries ul li a:hover:after',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.mkdf-listing-widget .mkdf-ls-list-simple .mkdf-listing-title a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.mkdf-listing-widget .mkdf-ls-list-simple .mkdf-ls-adr-pin a:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.mkdf-listing-widget .mkdf-ls-list-simple .mkdf-ls-adr-pin a i:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin .widget.mkdf-listing-widget .mkdf-ls-list-simple .mkdf-ls-adr-city .mkdf-city:hover',
                'footer.mkdf-page-footer.mkdf-footer-dark-skin a:hover',
                '.mkdf-main-menu ul li a:hover',
                '.mkdf-main-menu>ul>li.mkdf-active-item>a',
                '.mkdf-dark-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-main-menu>ul>li.mkdf-active-item>a',
                '.mkdf-dark-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-main-menu>ul>li>a:hover',
                '.mkdf-drop-down .second .inner ul li.current-menu-ancestor>a',
                '.mkdf-drop-down .second .inner ul li.current-menu-item>a',
                '.mkdf-fullscreen-menu-opener.mkdf-fm-opened',
                'nav.mkdf-fullscreen-menu ul li ul li.current-menu-ancestor>a',
                'nav.mkdf-fullscreen-menu ul li ul li.current-menu-item>a',
                'nav.mkdf-fullscreen-menu>ul>li.mkdf-active-item>a',
                '.mkdf-mobile-header .mkdf-mobile-menu-opener.mkdf-mobile-menu-opened a',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-close-mobile-side-area-holder i',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li.current_page_item',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li.mkdf-active-item',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li.mkdf-opened',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li:hover',
                '.mkdf-top-bar .widget a:hover',
                '.mkdf-dark-header .mkdf-top-bar a:hover',
                '.mkdf-dark-header .mkdf-top-bar .widget a:hover',
                '.mkdf-top-light-header .mkdf-top-bar .mkdf-vertical-align-containers .widget ul li a:hover',
                '.mkdf-top-dark-header .mkdf-top-bar .mkdf-vertical-align-containers .widget ul li a:hover',
                '.mkdf-search-page-holder article.sticky .mkdf-post-title a',
                '.mkdf-search-cover .mkdf-search-close a:hover',
                '.mkdf-fullscreen-search-holder .mkdf-fullscreen-search-close:hover',
                '.mkdf-fullscreen-search-holder .mkdf-fullscreen-search-bottom .mkdf-icon-widget-holder:hover',
                '.mkdf-side-menu-button-opener.opened',
                '.mkdf-side-menu-button-opener:hover',
                '.mkdf-side-menu a.mkdf-close-side-menu:hover',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs .mkdf-current',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs a:hover',
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .mkdf-testimonials-author-holder:after',
                '.mkdf-banner-holder .mkdf-banner-link-text .mkdf-banner-link-hover span',
                '.mkdf-btn.mkdf-btn-simple',
                '.mkdf-btn.mkdf-btn-outline',
                '.mkdf-comparision-pricing-tables-holder .mkdf-cpt-table .mkdf-cpt-table-head-holder .mkdf-cpt-table-head-holder-inner .mkdf-cpt-icon-holder i',
                '.mkdf-iwt .mkdf-iwt-icon a:hover .mkdf-icon-shortcode',
                '.mkdf-social-share-holder.mkdf-dropdown .mkdf-social-share-dropdown-opener:hover',
                '.mkdf-tabs.mkdf-tabs-simple .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-simple .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-workflow .mkdf-workflow-item.mkdf-subtitle-custom h4',
                '.mkdf-twitter-list-holder .mkdf-twitter-icon',
                '.mkdf-twitter-list-holder .mkdf-tweet-text a:hover',
                '.mkdf-twitter-list-holder .mkdf-twitter-profile a:hover',
            );

            $woo_color_selector = array();
            if(staffscout_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.woocommerce .mkdf-onsale',
                    '.woocommerce .mkdf-out-of-stock',
                    '.woocommerce-pagination .page-numbers li a.current',
                    '.woocommerce-pagination .page-numbers li a:hover',
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.woocommerce-pagination .page-numbers li a:hover.next:before',
                    '.woocommerce-pagination .page-numbers li a:hover.prev:before',
                    '.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    '.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    'ul.products>.product .mkdf-products-inner>a:hover',
                    'ul.products>.product .mkdf-products-inner .compare-button .compare:hover:after',
                    'ul.products>.product .mkdf-products-inner .compare-button .compare.added',
                    'ul.products>.product .mkdf-products-inner .compare-button .compare.added:after',
                    'ul.products>.product .mkdf-products-inner .price ins',
                    'ul.products>.product .mkdf-products-inner .mkdf-pl-inner:hover+.mkdf-pl-text-wrapper h5>a',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .price ins',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .product_meta>span a:hover',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .product_meta>span span:hover',
                    '.widget.woocommerce.widget_layered_nav ul li.chosen a',
                    '.widget.woocommerce.widget_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_recently_viewed_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_top_rated_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_products ul li ins .amount',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-onsale',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-out-of-stock',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-price ins',
                    '.mkdf-pls-holder .mkdf-pls-text .mkdf-pls-price ins',
                    '.mkdf-pl-holder .mkdf-pli .mkdf-pli-price ins',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-onsale',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-out-of-stock',
                    '.yith-wcwl-wishlistaddedbrowse a:after',
                    '.yith-wcwl-wishlistexistsbrowse a:after',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover:after',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover:after',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover:after',
                    '.mkdf-wishlist-widget-holder a:hover',
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

	        $color_important_selector = array(
                '.widget.mkdf-blog-list-widget .mkdf-post-title a:hover',
                '.widget.mkdf-blog-list-widget .mkdf-bl-simple .mkdf-bli-content .mkdf-post-info-date a:hover',
                '.widget.mkdf-blog-list-widget .mkdf-bl-simple .mkdf-post-image:hover+.mkdf-bli-content>.mkdf-post-title>a',
                '.mkdf-top-light-header .mkdf-top-bar .mkdf-vertical-align-containers a:hover',
                '.mkdf-top-dark-header .mkdf-top-bar .mkdf-vertical-align-containers a:hover',
                '.mkdf-light-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-search-opener:hover',
                '.mkdf-light-header .mkdf-top-bar .mkdf-search-opener:hover',
                '.mkdf-dark-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-search-opener:hover',
                '.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener:hover',
                '.mkdf-light-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-side-menu-button-opener.opened',
                '.mkdf-light-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-side-menu-button-opener:hover',
                '.mkdf-light-header .mkdf-top-bar .mkdf-side-menu-button-opener.opened',
                '.mkdf-light-header .mkdf-top-bar .mkdf-side-menu-button-opener:hover',
                '.mkdf-dark-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-side-menu-button-opener.opened',
                '.mkdf-dark-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-side-menu-button-opener:hover',
                '.mkdf-dark-header .mkdf-top-bar .mkdf-side-menu-button-opener.opened',
                '.mkdf-dark-header .mkdf-top-bar .mkdf-side-menu-button-opener:hover',
                '.yith-wcwl-add-button a:hover',
                '.yith-wcwl-wishlistaddedbrowse a:hover',
                '.yith-wcwl-wishlistexistsbrowse a:hover',
	        );

            $background_color_selector = array(
                '.mkdf-st-loader .pulse',
                '.mkdf-st-loader .double_pulse .double-bounce1',
                '.mkdf-st-loader .double_pulse .double-bounce2',
                '.mkdf-st-loader .cube',
                '.mkdf-st-loader .rotating_cubes .cube1',
                '.mkdf-st-loader .rotating_cubes .cube2',
                '.mkdf-st-loader .stripes>div',
                '.mkdf-st-loader .wave>div',
                '.mkdf-st-loader .two_rotating_circles .dot1',
                '.mkdf-st-loader .two_rotating_circles .dot2',
                '.mkdf-st-loader .five_rotating_circles .container1>div',
                '.mkdf-st-loader .five_rotating_circles .container2>div',
                '.mkdf-st-loader .five_rotating_circles .container3>div',
                '.mkdf-st-loader .lines .line1',
                '.mkdf-st-loader .lines .line2',
                '.mkdf-st-loader .lines .line3',
                '.mkdf-st-loader .lines .line4',
                '#submit_comment',
                '.post-password-form input[type=submit]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.mkdf-owl-slider .owl-dots .owl-dot.active span',
                '.mkdf-owl-slider .owl-dots .owl-dot:hover span',
                '.widget.widget_search form>div .search-holder-part.submit-holder button',
                '.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
                '.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li a:hover:before',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li.current_page_item>a:before',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li.mkdf-active-item>a:before',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li.mkdf-opened>a:before',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-mobile-nav ul li ul li:hover>a:before',
                '.mkdf-fullscreen-search-holder .mkdf-search-submit',
                '.mkdf-btn.mkdf-btn-solid',
                '.mkdf-comparision-pricing-tables-holder .mkdf-comparision-table-holder .mkdf-featured-comparision-package',
                '.mkdf-icon-shortcode.mkdf-circle',
                '.mkdf-icon-shortcode.mkdf-dropcaps.mkdf-circle',
                '.mkdf-icon-shortcode.mkdf-square',
                '.mkdf-price-table .mkdf-pt-inner .mkdf-pt-label-holder .mkdf-pt-label-inner',
                '.mkdf-process-holder .mkdf-process-circle',
                '.mkdf-process-holder .mkdf-process-line',
                '.mkdf-progress-bar .mkdf-pb-content-holder .mkdf-pb-content',
                '.mkdf-tabs.mkdf-tabs-standard .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-standard .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-tabs.mkdf-tabs-boxed .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-boxed .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-icon-rocket-bg'
            );

            $woo_background_color_selector = array();
            if(staffscout_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-page .mkdf-content .wc-forward:not(.added_to_cart):not(.checkout-button)',
                    '.woocommerce-page .mkdf-content a.added_to_cart',
                    '.woocommerce-page .mkdf-content a.button',
                    '.woocommerce-page .mkdf-content button[type=submit]:not(.mkdf-woo-search-widget-button)',
                    '.woocommerce-page .mkdf-content input[type=submit]',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button)',
                    'div.woocommerce a.added_to_cart',
                    'div.woocommerce a.button',
                    'div.woocommerce button[type=submit]:not(.mkdf-woo-search-widget-button)',
                    'div.woocommerce input[type=submit]',
                    'ul.products>.product .mkdf-products-inner .mkdf-pl-text-wrapper .mkdf-pl-add-to-cart-holder .product_type_grouped:hover',
                    '.mkdf-shopping-cart-holder .mkdf-header-cart .mkdf-cart-icon .mkdf-cart-number',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-default-skin .added_to_cart',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-default-skin .button',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-light-skin .added_to_cart:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-light-skin .button:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-dark-skin .added_to_cart:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-dark-skin .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-default-skin .added_to_cart',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-default-skin .button',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-light-skin .added_to_cart:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-light-skin .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-dark-skin .added_to_cart:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-dark-skin .button:hover',
                    '.woocommerce-wishlist table.wishlist_table tbody tr td.product-add-to-cart a',
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $background_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-bg):hover',
            );

            $border_color_selector = array(
                '.mkdf-st-loader .pulse_circles .ball',
                '.widget.widget_search form>div .search-holder-part.submit-holder button',
                '.mkdf-btn.mkdf-btn-outline',
                '.mkdf-tabs.mkdf-tabs-standard .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-standard .mkdf-tabs-nav li.ui-state-hover a',
                '.woocommerce-wishlist table.wishlist_table tbody tr td.product-add-to-cart a',
                '.mkdf-staffscout-loader .mkdf-icon-rocket-bg:before'
            );

            $border_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-border-hover):hover',
            );

            echo staffscout_mikado_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo staffscout_mikado_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo staffscout_mikado_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
            echo staffscout_mikado_dynamic_css($background_color_important_selector, array('background-color' => $first_main_color.'!important'));
	        echo staffscout_mikado_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
            echo staffscout_mikado_dynamic_css($border_color_important_selector, array('border-color' => $first_main_color.'!important'));
        }
	
	    $page_background_color = staffscout_mikado_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
			    'body',
			    '.mkdf-content',
			    '.mkdf-container'
		    );
		    echo staffscout_mikado_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }
	
	    $selection_color = staffscout_mikado_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo staffscout_mikado_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo staffscout_mikado_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }
	
	    $preload_background_styles = array();
	
	    if ( staffscout_mikado_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . staffscout_mikado_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }
	
	    echo staffscout_mikado_dynamic_css( '.mkdf-preload-background', $preload_background_styles );
    }

    add_action('staffscout_mikado_style_dynamic', 'staffscout_mikado_design_styles');
}

if ( ! function_exists( 'staffscout_mikado_content_styles' ) ) {
	function staffscout_mikado_content_styles() {
		$content_style = array();
		
		$padding_top = staffscout_mikado_options()->getOptionValue( 'content_top_padding' );
		if ( $padding_top !== '' ) {
			$content_style['padding-top'] = staffscout_mikado_filter_px( $padding_top ) . 'px';
		}
		
		$content_selector = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
		);
		
		echo staffscout_mikado_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_top_in_grid = staffscout_mikado_options()->getOptionValue( 'content_top_padding_in_grid' );
		if ( $padding_top_in_grid !== '' ) {
			$content_style_in_grid['padding-top'] = staffscout_mikado_filter_px( $padding_top_in_grid ) . 'px';
		}
		
		$content_selector_in_grid = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
		);
		
		echo staffscout_mikado_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_content_styles' );
}

if ( ! function_exists( 'staffscout_mikado_h1_styles' ) ) {
	function staffscout_mikado_h1_styles() {
		$margin_top    = staffscout_mikado_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = staffscout_mikado_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = staffscout_mikado_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = staffscout_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = staffscout_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_h1_styles' );
}

if ( ! function_exists( 'staffscout_mikado_h2_styles' ) ) {
	function staffscout_mikado_h2_styles() {
		$margin_top    = staffscout_mikado_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = staffscout_mikado_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = staffscout_mikado_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = staffscout_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = staffscout_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_h2_styles' );
}

if ( ! function_exists( 'staffscout_mikado_h3_styles' ) ) {
	function staffscout_mikado_h3_styles() {
		$margin_top    = staffscout_mikado_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = staffscout_mikado_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = staffscout_mikado_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = staffscout_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = staffscout_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_h3_styles' );
}

if ( ! function_exists( 'staffscout_mikado_h4_styles' ) ) {
	function staffscout_mikado_h4_styles() {
		$margin_top    = staffscout_mikado_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = staffscout_mikado_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = staffscout_mikado_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = staffscout_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = staffscout_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_h4_styles' );
}

if ( ! function_exists( 'staffscout_mikado_h5_styles' ) ) {
	function staffscout_mikado_h5_styles() {
		$margin_top    = staffscout_mikado_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = staffscout_mikado_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = staffscout_mikado_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = staffscout_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = staffscout_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_h5_styles' );
}

if ( ! function_exists( 'staffscout_mikado_h6_styles' ) ) {
	function staffscout_mikado_h6_styles() {
		$margin_top    = staffscout_mikado_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = staffscout_mikado_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = staffscout_mikado_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = staffscout_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = staffscout_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_h6_styles' );
}

if ( ! function_exists( 'staffscout_mikado_text_styles' ) ) {
	function staffscout_mikado_text_styles() {
		$item_styles = staffscout_mikado_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_text_styles' );
}

if ( ! function_exists( 'staffscout_mikado_link_styles' ) ) {
	function staffscout_mikado_link_styles() {
		$link_styles      = array();
		$link_color       = staffscout_mikado_options()->getOptionValue( 'link_color' );
		$link_font_style  = staffscout_mikado_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = staffscout_mikado_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = staffscout_mikado_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo staffscout_mikado_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_link_styles' );
}

if ( ! function_exists( 'staffscout_mikado_link_hover_styles' ) ) {
	function staffscout_mikado_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = staffscout_mikado_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = staffscout_mikado_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo staffscout_mikado_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo staffscout_mikado_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_link_hover_styles' );
}

if ( ! function_exists( 'staffscout_mikado_smooth_page_transition_styles' ) ) {
	function staffscout_mikado_smooth_page_transition_styles( $style ) {
		$id            = staffscout_mikado_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = staffscout_mikado_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.mkdf-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= staffscout_mikado_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = staffscout_mikado_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.mkdf-st-loader .mkdf-rotate-circles > div',
			'.mkdf-st-loader .pulse',
			'.mkdf-st-loader .double_pulse .double-bounce1',
			'.mkdf-st-loader .double_pulse .double-bounce2',
			'.mkdf-st-loader .cube',
			'.mkdf-st-loader .rotating_cubes .cube1',
			'.mkdf-st-loader .rotating_cubes .cube2',
			'.mkdf-st-loader .stripes > div',
			'.mkdf-st-loader .wave > div',
			'.mkdf-st-loader .two_rotating_circles .dot1',
			'.mkdf-st-loader .two_rotating_circles .dot2',
			'.mkdf-st-loader .five_rotating_circles .container1 > div',
			'.mkdf-st-loader .five_rotating_circles .container2 > div',
			'.mkdf-st-loader .five_rotating_circles .container3 > div',
			'.mkdf-st-loader .atom .ball-1:before',
			'.mkdf-st-loader .atom .ball-2:before',
			'.mkdf-st-loader .atom .ball-3:before',
			'.mkdf-st-loader .atom .ball-4:before',
			'.mkdf-st-loader .clock .ball:before',
			'.mkdf-st-loader .mitosis .ball',
			'.mkdf-st-loader .lines .line1',
			'.mkdf-st-loader .lines .line2',
			'.mkdf-st-loader .lines .line3',
			'.mkdf-st-loader .lines .line4',
			'.mkdf-st-loader .fussion .ball',
			'.mkdf-st-loader .fussion .ball-1',
			'.mkdf-st-loader .fussion .ball-2',
			'.mkdf-st-loader .fussion .ball-3',
			'.mkdf-st-loader .fussion .ball-4',
			'.mkdf-st-loader .wave_circles .ball',
			'.mkdf-st-loader .pulse_circles .ball'
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= staffscout_mikado_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'staffscout_mikado_add_page_custom_style', 'staffscout_mikado_smooth_page_transition_styles' );
}