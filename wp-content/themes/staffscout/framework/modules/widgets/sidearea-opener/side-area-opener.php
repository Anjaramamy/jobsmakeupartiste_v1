<?php

class StaffScoutMikadoClassSideAreaOpener extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_side_area_opener',
			esc_html__( 'Mikado Side Area Opener', 'staffscout' ),
			array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'staffscout' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__( 'Side Area Opener Color', 'staffscout' ),
				'description' => esc_html__( 'Define color for side area opener', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__( 'Side Area Opener Hover Color', 'staffscout' ),
				'description' => esc_html__( 'Define hover color for side area opener', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__( 'Side Area Opener Margin', 'staffscout' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Side Area Opener Title', 'staffscout' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$holder_styles = array();
		
		if ( ! empty( $instance['icon_color'] ) ) {
			$holder_styles[] = 'color: ' . $instance['icon_color'] . ';';
		}
		if ( ! empty( $instance['widget_margin'] ) ) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		
		<a class="mkdf-side-menu-button-opener mkdf-icon-has-hover" <?php echo staffscout_mikado_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ); ?> href="javascript:void(0)" <?php staffscout_mikado_inline_style( $holder_styles ); ?>>
			<?php if ( ! empty( $instance['widget_title'] ) ) { ?>
				<h5 class="mkdf-side-menu-title"><?php echo esc_html( $instance['widget_title'] ); ?></h5>
			<?php } ?>
			<span class="mkdf-side-menu-icon">
        		<?php echo staffscout_mikado_icon_collections()->renderIcon( 'dripicons-menu', 'dripicons' ); ?>
        	</span>
		</a>
	<?php }
}