<?php

class StaffScoutMikadoClassIconWidget extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_icon_widget',
			esc_html__( 'Mikado Icon Widget', 'staffscout' ),
			array( 'description' => esc_html__( 'Add icons to widget areas', 'staffscout' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array_merge(
			staffscout_mikado_icon_collections()->getIconWidgetParamsArray(),
			array(
				array(
					'type'  => 'textfield',
					'name'  => 'icon_text',
					'title' => esc_html__( 'Icon Text', 'staffscout' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'staffscout' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Target', 'staffscout' ),
					'options' => staffscout_mikado_get_link_target_array()
				),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_size',
					'title' => esc_html__( 'Icon Size (px)', 'staffscout' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_color',
					'title' => esc_html__( 'Icon Color', 'staffscout' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_hover_color',
					'title' => esc_html__( 'Icon Hover Color', 'staffscout' )
				),
                array(
                    'type'        => 'textfield',
                    'name'        => 'text_padding',
                    'title'       => esc_html__( 'Text Padding', 'staffscout' ),
                    'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'staffscout' )
                ),
				array(
					'type'        => 'textfield',
					'name'        => 'icon_margin',
					'title'       => esc_html__( 'Icon Margin', 'staffscout' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'staffscout' )
				)
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$holder_classes = array( 'mkdf-icon-widget-holder' );
		if ( ! empty( $instance['icon_hover_color'] ) ) {
			$holder_classes[] = 'mkdf-icon-has-hover';
		}
		
		$data   = array();
		$data[] = ! empty( $instance['icon_hover_color'] ) ? staffscout_mikado_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ) : '';
		$data   = implode( ' ', $data );
		
		$holder_styles = array();
		if ( ! empty( $instance['icon_color'] ) ) {
			$holder_styles[] = 'color: ' . $instance['icon_color'];
		}
		
		if ( ! empty( $instance['icon_size'] ) ) {
			$holder_styles[] = 'font-size: ' . staffscout_mikado_filter_px( $instance['icon_size'] ) . 'px';
		}

        if ( $instance['icon_margin'] !== '' ) {
            $holder_styles[] = 'margin: ' . $instance['icon_margin'];
        }

        $text_styles = array();
		if ( $instance['text_padding'] !== '' ) {
			$text_styles[] = 'padding: ' . $instance['text_padding'];
		}
		
		$link   = ! empty( $instance['link'] ) ? $instance['link'] : '#';
		$target = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
		
		$icon_holder_html = '';
		if ( ! empty( $instance['icon_pack'] ) ) {
			$icon_class   = array();
			$icon_class[] = ! empty( $instance['fa_icon'] ) && $instance['icon_pack'] === 'font_awesome' ? 'fa ' . $instance['fa_icon'] : '';
			$icon_class[] = ! empty( $instance['fe_icon'] ) && $instance['icon_pack'] === 'font_elegant' ? $instance['fe_icon'] : '';
			$icon_class[] = ! empty( $instance['ion_icon'] ) && $instance['icon_pack'] === 'ion_icons' ? $instance['ion_icon'] : '';
			$icon_class[] = ! empty( $instance['linea_icon'] ) && $instance['icon_pack'] === 'linea_icons' ? $instance['linea_icon'] : '';
			$icon_class[] = ! empty( $instance['linear_icon'] ) && $instance['icon_pack'] === 'linear_icons' ? 'lnr ' . $instance['linear_icon'] : '';
			$icon_class[] = ! empty( $instance['simple_line_icon'] ) && $instance['icon_pack'] === 'simple_line_icons' ? $instance['simple_line_icon'] : '';
            $icon_class[] = ! empty( $instance['dripicon'] ) && $instance['icon_pack'] === 'dripicons' ? $instance['dripicon'] : '';
			
			$icon_class = array_filter( $icon_class, function ( $value ) {
				return $value !== '';
			} );
			
			if ( ! empty( $icon_class ) ) {
				$icon_class = implode( ' ', $icon_class );
				
				$icon_holder_html = '<span class="mkdf-icon-element ' . esc_attr( $icon_class ) . '"></span>';
			}
		}
		
		$icon_text_html  = '';
		$icon_text_class = ! empty( $icon_holder_html ) ? '' : 'mkdf-no-icon';
		if ( ! empty( $instance['icon_text'] ) ) {
			$icon_text_html = '<span class="mkdf-icon-text ' . esc_attr( $icon_text_class ) . ' " ' . staffscout_mikado_get_inline_style( $text_styles ) . ' > ' . esc_html( $instance['icon_text'] ) . '</span>';
		}
		?>
		
		<a <?php staffscout_mikado_class_attribute( $holder_classes ); ?> <?php echo wp_kses_post( $data ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php echo staffscout_mikado_get_inline_style( $holder_styles ); ?>>
			<?php echo wp_kses( $icon_holder_html, array(
				'span' => array(
					'class' => true
				)
			) ); ?>
			<?php echo wp_kses( $icon_text_html, array(
				'span' => array(
					'class' => true,
                    'style' => true
				)
			) ); ?>
		</a>
		<?php
	}
}