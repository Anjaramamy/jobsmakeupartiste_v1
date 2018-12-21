<?php

if ( ! function_exists( 'staffscout_mikado_centered_title_type_options_meta_boxes' ) ) {
	function staffscout_mikado_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'staffscout' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'staffscout' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'staffscout_mikado_additional_title_area_meta_boxes', 'staffscout_mikado_centered_title_type_options_meta_boxes', 5 );
}