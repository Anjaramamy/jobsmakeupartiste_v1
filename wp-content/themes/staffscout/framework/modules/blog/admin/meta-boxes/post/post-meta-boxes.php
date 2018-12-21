<?php

/*** Post Settings ***/

if ( ! function_exists( 'staffscout_mikado_map_post_meta' ) ) {
	function staffscout_mikado_map_post_meta() {
		
		$post_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'staffscout' ),
				'name'  => 'post-meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'staffscout' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'staffscout' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
				'options'       => array(
					''                 => esc_html__( 'Default', 'staffscout' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'staffscout' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'staffscout' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'staffscout' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'staffscout' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'staffscout' )
				)
			)
		);
		
		$staffscout_custom_sidebars = staffscout_mikado_get_custom_sidebars();
		if ( count( $staffscout_custom_sidebars ) > 0 ) {
			staffscout_mikado_add_meta_box_field( array(
				'name'        => 'mkdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'staffscout' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'staffscout' ),
				'parent'      => $post_meta_box,
				'options'     => staffscout_mikado_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'staffscout' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'staffscout' ),
				'parent'      => $post_meta_box
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'staffscout' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'staffscout' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'staffscout' ),
					'large-width'        => esc_html__( 'Large Width', 'staffscout' ),
					'large-height'       => esc_html__( 'Large Height', 'staffscout' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'staffscout' )
				)
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'staffscout' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'staffscout' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'staffscout' ),
					'large-width' => esc_html__( 'Large Width', 'staffscout' )
				)
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'staffscout' ),
				'parent'        => $post_meta_box,
				'options'       => staffscout_mikado_get_yes_no_select_array()
			)
		);

		do_action('staffscout_mikado_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_post_meta', 20 );
}
