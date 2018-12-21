<?php

// Adds theme support for WooCommerce
add_theme_support( 'woocommerce' );

// Disable the default WooCommerce stylesheet
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

if ( ! function_exists( 'staffscout_mikado_disable_woocommerce_pretty_photo' ) ) {
	/**
	 * Function that disable WooCommerce pretty photo script and style
	 */
	function staffscout_mikado_disable_woocommerce_pretty_photo() {
		if ( staffscout_mikado_load_woo_assets() ) {
			
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'staffscout_mikado_disable_woocommerce_pretty_photo' );
}

if ( ! function_exists( 'staffscout_mikado_woocommerce_content' ) ) {
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function staffscout_mikado_woocommerce_content() {
		
		if ( is_singular( 'product' ) ) {
			
			while ( have_posts() ) : the_post();
				
				wc_get_template_part( 'content', 'single-product' );
			
			endwhile;
			
		} else {
			
			if ( have_posts() ) :
				
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				
				woocommerce_product_loop_start();
				
				woocommerce_product_subcategories();
				
				while ( have_posts() ) : the_post();
					
					wc_get_template_part( 'content', 'product' );
				
				endwhile; // end of the loop.
				
				woocommerce_product_loop_end();
				
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			
			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after'  => woocommerce_product_loop_end( false ) ) ) ) :
				
				wc_get_template( 'loop/no-products-found.php' );
			
			endif;
		}
	}
}

/*************** GENERAL FILTERS - begin ***************/

	//Add additional html tags around woocommerce pagination
	add_action('woocommerce_after_shop_loop', 'staffscout_mikado_woo_view_all_pagination_additional_tag_before', 9);
	add_action('woocommerce_after_shop_loop', 'staffscout_mikado_woo_view_all_pagination_additional_tag_after', 12);

    //Change the order of the sale and regular price
    add_filter( 'woocommerce_get_price_html', 'staffscout_mikado_woocommerce_price_html', 20, 2 );


/*************** GENERAL FILTERS - end ***************/

/*************** PRODUCT LISTS FILTERS - begin ***************/

	//Add additional html tags around product lists
	add_action( 'woocommerce_before_shop_loop', 'staffscout_mikado_pl_holder_additional_tag_before', 35 );
	add_action( 'woocommerce_after_shop_loop', 'staffscout_mikado_pl_holder_additional_tag_after', 5 );

    add_action('woocommerce_before_shop_loop_item', 'staffscout_mikado_product_categories', 3);
	
	//Add additional html tag around product elements
	add_action( 'woocommerce_before_shop_loop_item', 'staffscout_mikado_pl_inner_additional_tag_before', 5 );
	
	//Remove open and close link position
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	
	//Add additional html tags around image and marks
	add_action( 'woocommerce_before_shop_loop_item_title', 'staffscout_mikado_pl_image_additional_tag_before', 5 );
	add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_image_additional_tag_after', 6 );
	add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_pl_image_additional_tag_after', 1 );


	/*************** Product Info Position Is On Image Hover ***************/
	
		//Add additional html tag around product elements
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_pl_inner_additional_tag_after', 22 );
		
		//Add open and close link position
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'woocommerce_template_loop_product_link_open', 21 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'woocommerce_template_loop_product_link_close', 21 );
		
		//Add additional html around product info elements
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_pl_inner_text_additional_tag_before', 5 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_pl_inner_text_additional_tag_after', 15 );
		
		//Override product title with our own html
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_woocommerce_template_loop_product_title', 7 );
		
		//Add additional html tags around rating star element
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_pl_rating_additional_tag_before', 9 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'staffscout_mikado_pl_rating_additional_tag_after', 11 );
		
		//Change rating star position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'woocommerce_template_loop_rating', 10 );
		
		//Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'woocommerce_template_loop_price', 12 );
		
		//Change add to cart position
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'staffscout_mikado_woo_pl_info_on_image_hover', 'woocommerce_template_loop_add_to_cart', 13 );


	/*************** Product Info Position Is Below Image ***************/

		//Add additional html tag around product elements
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_inner_additional_tag_after', 21 );

        add_action('woocommerce_before_shop_loop_item', 'staffscout_mikado_woocommerce_accessories_item_additional_tag_before', 2);
        add_action('woocommerce_after_shop_loop_item', 'staffscout_mikado_woocommerce_accessories_item_additional_tag_after', 40);
		
		//Add open and close link position
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'woocommerce_template_loop_product_link_open', 20 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'woocommerce_template_loop_product_link_close', 20 );
		
		//Add additional html at the end of product info elements
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_text_wrapper_additional_tag_before', 22 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_text_wrapper_additional_tag_after', 34 );
		
		//Override product title with our own html
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_woocommerce_template_loop_product_title', 28 );

        add_action('staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_title_price_additional_tag_before', 27);
        add_action('staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_title_price_additional_tag_after', 30);
		
		//Change rating star position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'woocommerce_template_loop_rating', 25 );
		
		//Add additional html tags around rating star element
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_rating_additional_tag_before', 24 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_rating_additional_tag_after', 26 );
		
		//Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'woocommerce_template_loop_price', 29 );

		//Change add to cart position
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'staffscout_mikado_woo_pl_info_below_image', 'woocommerce_template_loop_add_to_cart', 32 );

        add_action('staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_add_to_cart_additional_tag_before', 31);
        add_action('staffscout_mikado_woo_pl_info_below_image', 'staffscout_mikado_pl_add_to_cart_additional_tag_after', 33);


/*************** PRODUCT LISTS FILTERS - end ***************/

/*************** PRODUCT SINGLE FILTERS - begin ***************/

	//Add additional html around single product summary and images
	add_action( 'woocommerce_before_single_product_summary', 'staffscout_mikado_single_product_content_additional_tag_before', 5 );
	add_action( 'woocommerce_after_single_product_summary', 'staffscout_mikado_single_product_content_additional_tag_after', 1 );
	
	//Add additional html around single product summary
	add_action( 'woocommerce_before_single_product_summary', 'staffscout_mikado_single_product_summary_additional_tag_before', 30 );
	add_action( 'woocommerce_after_single_product_summary', 'staffscout_mikado_single_product_summary_additional_tag_after', 5 );

	//Override product single thumbnails with our own html
	remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
	add_action( 'woocommerce_product_thumbnails', 'staffscout_mikado_single_product_show_product_thumbnails', 19 );

	//Change sale mark position
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 20 );
	
	//Change title position
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary', 'staffscout_mikado_woocommerce_template_single_title', 5 );
	
	//Change price position
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 8 );

    add_action('woocommerce_single_product_summary', 'staffscout_mikado_single_product_availability_additional_template', 9);

    //Add additional markup for price and stock
    add_action('woocommerce_single_product_summary', 'staffscout_mikado_single_price_stock_additional_tag_before', 7);
    add_action('woocommerce_single_product_summary', 'staffscout_mikado_single_price_stock_additional_tag_after', 11);

    //Change Rating Position
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 12);
	
	//Add social share (default woocommerce_share)
	add_action( 'woocommerce_single_product_summary', 'staffscout_mikado_woocommerce_share', 28 );


/*************** PRODUCT SINGLE FILTERS - end ***************/