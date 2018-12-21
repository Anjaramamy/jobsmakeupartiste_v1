<?php

class StaffScoutMikadoClassSearchOpener extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_search_opener',
			esc_html__( 'Mikado Search Opener', 'staffscout' ),
			array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'staffscout' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_size',
				'title'       => esc_html__( 'Icon Size (px)', 'staffscout' ),
				'description' => esc_html__( 'Define size for search icon', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_color',
				'title'       => esc_html__( 'Icon Color', 'staffscout' ),
				'description' => esc_html__( 'Define color for search icon', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_hover_color',
				'title'       => esc_html__( 'Icon Hover Color', 'staffscout' ),
				'description' => esc_html__( 'Define hover color for search icon', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_margin',
				'title'       => esc_html__( 'Icon Margin', 'staffscout' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'staffscout' )
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'show_label',
				'title'       => esc_html__( 'Enable Search Icon Text', 'staffscout' ),
				'description' => esc_html__( 'Enable this option to show search text next to search icon in header', 'staffscout' ),
				'options'     => staffscout_mikado_get_yes_no_select_array()
			)
		);
	}
	
	public function widget( $args, $instance ) {
		global $theme_name_php_global_options, $theme_name_php_global_IconCollections;
		
		$search_type_class = 'mkdf-search-opener mkdf-icon-has-hover';
		$styles            = array();
		$show_search_text  = $instance['show_label'] == 'yes' || $theme_name_php_global_options['enable_search_icon_text'] == 'yes' ? true : false;
		
		if ( ! empty( $instance['search_icon_size'] ) ) {
			$styles[] = 'font-size: ' . intval( $instance['search_icon_size'] ) . 'px';
		}
		
		if ( ! empty( $instance['search_icon_color'] ) ) {
			$styles[] = 'color: ' . $instance['search_icon_color'] . ';';
		}
		
		if ( ! empty( $instance['search_icon_margin'] ) ) {
			$styles[] = 'margin: ' . $instance['search_icon_margin'] . ';';
		}
		?>
		
		<a <?php staffscout_mikado_inline_attr( $instance['search_icon_hover_color'], 'data-hover-color' ); ?> <?php staffscout_mikado_inline_style( $styles ); ?> <?php staffscout_mikado_class_attribute( $search_type_class ); ?> href="javascript:void(0)">
            <span class="mkdf-search-opener-wrapper">
                <?php if ( isset( $theme_name_php_global_options['search_icon_pack'] ) ) {
	                $theme_name_php_global_IconCollections->getSearchIcon( $theme_name_php_global_options['search_icon_pack'], false );
                } ?>
	            <?php if ( $show_search_text ) { ?>
		            <span class="mkdf-search-icon-text"><?php esc_html_e( 'Search', 'staffscout' ); ?></span>
	            <?php } ?>
            </span>
		</a>
	<?php }
}