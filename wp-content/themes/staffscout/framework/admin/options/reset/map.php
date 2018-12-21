<?php

if ( ! function_exists( 'staffscout_mikado_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function staffscout_mikado_reset_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'staffscout' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'staffscout' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'staffscout' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_reset_options_map', 100 );
}