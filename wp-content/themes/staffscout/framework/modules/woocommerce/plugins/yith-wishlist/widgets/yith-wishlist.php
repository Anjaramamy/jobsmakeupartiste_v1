<?php
class StaffScoutMikadoClassYithWishlist extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'mkdf_woocommerce_yith_wishlist',
			esc_html__('Mikado Woocommerce Wishlist', 'staffscout'),
			array( 'description' => esc_html__( 'Display a wishlist icon with number of products that are in the wishlist', 'staffscout' ), )
		);
	}

    /**
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach($this->params as $param) {
            $param_name = $param['name'];

            $instance[$param_name] = sanitize_text_field($new_instance[$param_name]);
        }

        return $instance;
    }

	public function widget( $args, $instance ) {
		extract( $args );
		
		global $yith_wcwl;

		?>
		<div class="widget mkdf-wishlist-widget-holder">
            <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="mkdf-wishlist-widget-link">
                <span class="mkdf-wishlist-widget-icon"><i class="dripicons-heart"></i></span>
            </a>
		</div>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', 'register_widget( "StaffScoutMikadoClassYithWishlist" );' ) );
?>