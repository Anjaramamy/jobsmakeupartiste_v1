<?php

if ( ! function_exists( 'staffscout_mikado_map_sidebar_meta' ) ) {
	function staffscout_mikado_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'staffscout_mikado_set_scope_for_meta_boxes', array( 'page' ) ),
				'title' => esc_html__( 'Sidebar', 'staffscout' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Layout', 'staffscout' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'staffscout' ),
				'parent'      => $mkdf_sidebar_meta_box,
				'options'     => array(
					''                 => esc_html__( 'Default', 'staffscout' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'staffscout' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'staffscout' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'staffscout' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'staffscout' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'staffscout' )
				)
			)
		);
		
		$mkdf_custom_sidebars = staffscout_mikado_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			staffscout_mikado_add_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'staffscout' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'staffscout' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);

            staffscout_mikado_add_meta_box_field(
                array(
                    'name'        => 'mkdf_custom_listing_search_sidebar_meta',
                    'type'        => 'selectblank',
                    'label'       => esc_html__( 'Choose Widget Area for Listing Advanced Search Sidebar', 'staffscout' ),
                    'description' => esc_html__( 'Choose Custom Widget area to display in Listing Advanced Search Sidebar when Sidebar Option is enabled.', 'staffscout' ),
                    'parent'      => $mkdf_sidebar_meta_box,
                    'options'     => $mkdf_custom_sidebars,
                )
            );

            staffscout_mikado_add_meta_box_field(
                array(
                    'name'        => 'mkdf_custom_resume_search_sidebar_meta',
                    'type'        => 'selectblank',
                    'label'       => esc_html__( 'Choose Widget Area for Resume Advanced Search Sidebar', 'staffscout' ),
                    'description' => esc_html__( 'Choose Custom Widget area to display in Resume Advanced Search Sidebar when Sidebar Option is enabled.', 'staffscout' ),
                    'parent'      => $mkdf_sidebar_meta_box,
                    'options'     => $mkdf_custom_sidebars,
                )
            );
		}
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_sidebar_meta', 31 );
}