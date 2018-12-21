<?php

if ( ! function_exists( 'staffscout_mikado_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function staffscout_mikado_woocommerce_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'staffscout' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'mkdf_woo_product_list_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Product List Columns', 'staffscout' ),
				'default_value' => 'mkdf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for product listing and related products on single product', 'staffscout' ),
				'options'       => array(
					'mkdf-woocommerce-columns-3' => esc_html__( '3 Columns', 'staffscout' ),
					'mkdf-woocommerce-columns-4' => esc_html__( '4 Columns', 'staffscout' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'mkdf_woo_product_list_columns_space',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'staffscout' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'staffscout' ),
				'default_value' => 'normal',
				'options'       => staffscout_mikado_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'mkdf_woo_product_list_info_position',
				'type'          => 'select',
				'label'         => esc_html__( 'Product Info Position', 'staffscout' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'staffscout' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'staffscout' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'staffscout' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'mkdf_woo_products_per_page',
				'type'          => 'text',
				'label'         => esc_html__( 'Number of products per page', 'staffscout' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'staffscout' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'mkdf_products_list_title_tag',
				'type'          => 'select',
				'label'         => esc_html__( 'Products Title Tag', 'staffscout' ),
				'default_value' => 'h4',
				'options'       => staffscout_mikado_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'staffscout' ),
				'parent'        => $panel_single_product,
				'options'       => staffscout_mikado_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'mkdf_single_product_title_tag',
				'type'          => 'select',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'staffscout' ),
				'options'       => staffscout_mikado_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'default_value' => 'below-image',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'staffscout' ),
				'options'       => array(
					'below-image'  => esc_html__( 'Below Featured Image', 'staffscout' ),
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'staffscout' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'staffscout' ),
				'parent'        => $panel_single_product,
				'options'       => staffscout_mikado_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'woo_set_single_images_behavior',
				'type'          => 'select',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'staffscout' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'staffscout' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'staffscout' )
				),
				'parent'        => $panel_single_product
			)
		);
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_woocommerce_options_map', 21 );
}