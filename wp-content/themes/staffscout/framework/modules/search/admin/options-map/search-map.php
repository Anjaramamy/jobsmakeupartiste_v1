<?php

if ( ! function_exists( 'staffscout_mikado_search_options_map' ) ) {
	function staffscout_mikado_search_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'staffscout' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = staffscout_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'staffscout' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		staffscout_mikado_add_admin_field( array(
			'name'          => 'search_page_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Layout', 'staffscout' ),
			'default_value' => 'in-grid',
			'description'   => esc_html__( 'Set layout. Default is in grid.', 'staffscout' ),
			'parent'        => $search_page_panel,
			'options'       => array(
				'in-grid'    => esc_html__( 'In Grid', 'staffscout' ),
				'full-width' => esc_html__( 'Full Width', 'staffscout' )
			)
		) );
		
		staffscout_mikado_add_admin_field( array(
			'name'          => 'search_page_sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'staffscout' ),
			'description'   => esc_html__( "Choose a sidebar layout for search page", 'staffscout' ),
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'       => esc_html__( 'No Sidebar', 'staffscout' ),
				'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'staffscout' ),
				'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'staffscout' ),
				'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'staffscout' ),
				'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'staffscout' )
			),
			'parent'        => $search_page_panel
		) );
		
		$staffscout_custom_sidebars = staffscout_mikado_get_custom_sidebars();
		if ( count( $staffscout_custom_sidebars ) > 0 ) {
			staffscout_mikado_add_admin_field( array(
				'name'        => 'search_custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'staffscout' ),
				'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'staffscout' ),
				'parent'      => $search_page_panel,
				'options'     => $staffscout_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
		
		$search_panel = staffscout_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'staffscout' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'staffscout' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'staffscout' ),
				'options'       => array(
					'fullscreen'               => esc_html__( 'Fullscreen Search', 'staffscout' ),
					'slide-from-header-bottom' => esc_html__( 'Slide From Header Bottom', 'staffscout' ),
					'covers-header'            => esc_html__( 'Search Covers Header', 'staffscout' ),
					'slide-from-window-top'    => esc_html__( 'Slide from Window Top', 'staffscout' )
				)
			)
		);

        staffscout_mikado_add_admin_field(
            array(
                'parent'        => $search_panel,
                'type'          => 'text',
                'name'          => 'search_title',
                'default_value' => '',
                'label'         => esc_html__( 'Search Title', 'staffscout' ),
                'description'   => esc_html__( 'Only if fullscreen type is selected', 'staffscout' )
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'parent'        => $search_panel,
                'type'          => 'text',
                'name'          => 'search_subtitle',
                'default_value' => '',
                'label'         => esc_html__( 'Search Subitle', 'staffscout' ),
                'description'   => esc_html__( 'Only if fullscreen type is selected', 'staffscout' )
            )
        );
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'staffscout' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'staffscout' ),
				'options'       => staffscout_mikado_icon_collections()->getIconCollectionsExclude( array( 'linea_icons' ) )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'staffscout' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'staffscout' ),
			)
		);
		
		staffscout_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'staffscout' ),
				'description'   => esc_html__( 'Set size for icon', 'staffscout' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = staffscout_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'staffscout' ),
				'description' => esc_html__( 'Define color style for icon', 'staffscout' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = staffscout_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'staffscout' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);
		
		$enable_search_icon_text_group = staffscout_mikado_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'staffscout' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'staffscout' )
			)
		);
		
		$enable_search_icon_text_row = staffscout_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'staffscout' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'staffscout' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'staffscout' ),
				'default_value' => '',
				'options'       => staffscout_mikado_get_text_transform_array()
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'staffscout' ),
				'default_value' => '-1',
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'staffscout' ),
				'default_value' => '',
				'options'       => staffscout_mikado_get_font_style_array(),
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'staffscout' ),
				'default_value' => '',
				'options'       => staffscout_mikado_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'staffscout' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}

	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_search_options_map', 5 );
}