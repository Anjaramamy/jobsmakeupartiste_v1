<?php

if ( ! function_exists( 'staffscout_mikado_page_options_map' ) ) {
	function staffscout_mikado_page_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '_page_page',
				'title' => esc_html__( 'Page', 'staffscout' ),
				'icon'  => 'fa fa-file-text-o'
			)
		);
		
		/***************** Page Layout - begin **********************/
		
		$panel_sidebar = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_sidebar',
				'title' => esc_html__( 'Page Style', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'page_show_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'staffscout' ),
				'default_value' => 'yes',
				'parent'        => $panel_sidebar
			)
		);
		
		/***************** Page Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		$panel_content = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content',
				'title' => esc_html__( 'Content Style', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding for Template in Full Width', 'staffscout' ),
				'description'   => esc_html__( 'Enter top padding for content area for templates in full width. If you set this value then it\'s important to set also Content top padding for mobile header value', 'staffscout' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding_in_grid',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding for Templates in Grid', 'staffscout' ),
				'description'   => esc_html__( 'Enter top padding for content area for Templates in grid. If you set this value then it\'s important to set also Content top padding for mobile header value', 'staffscout' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding_mobile',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding for Mobile Header', 'staffscout' ),
				'description'   => esc_html__( 'Enter top padding for content area for Mobile Header', 'staffscout' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Additional Page Layout - start *****************/
		
		do_action( 'staffscout_mikado_additional_page_options_map' );
		
		/***************** Additional Page Layout - end *****************/

        $sidebar_panel = staffscout_mikado_add_admin_panel(
            array(
                'title' => esc_html__( 'Sidebar Area', 'staffscout' ),
                'name'  => 'sidebar',
                'page'  => '_page_page'
            )
        );

        staffscout_mikado_add_admin_field( array(
            'name'          => 'sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__( 'Sidebar Layout', 'staffscout' ),
            'description'   => esc_html__( 'Choose a sidebar layout for pages', 'staffscout' ),
            'parent'        => $sidebar_panel,
            'default_value' => 'no-sidebar',
            'options'       => array(
                'no-sidebar'       => esc_html__( 'No Sidebar', 'staffscout' ),
                'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'staffscout' ),
                'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'staffscout' ),
                'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'staffscout' ),
                'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'staffscout' )
            )
        ) );

        $staffscout_custom_sidebars = staffscout_mikado_get_custom_sidebars();
        if ( count( $staffscout_custom_sidebars ) > 0 ) {
            staffscout_mikado_add_admin_field( array(
                'name'        => 'custom_sidebar_area',
                'type'        => 'selectblank',
                'label'       => esc_html__( 'Sidebar to Display', 'staffscout' ),
                'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'staffscout' ),
                'parent'      => $sidebar_panel,
                'options'     => $staffscout_custom_sidebars,
                'args'        => array(
                    'select2' => true
                )
            ) );
        }
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_page_options_map', 8 );
}