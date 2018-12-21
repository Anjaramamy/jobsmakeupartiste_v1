<?php
do_action( 'staffscout_mikado_before_slider_action' );

$mkdf_slider_shortcode = get_post_meta( staffscout_mikado_get_page_id(), 'mkdf_page_slider_meta', true );

if ( ! empty( $mkdf_slider_shortcode ) ) { ?>
	<div class="mkdf-slider">
		<div class="mkdf-slider-inner">
			<?php echo do_shortcode( wp_kses_post( $mkdf_slider_shortcode ) ); // XSS OK ?>
		</div>
	</div>
<?php }

do_action( 'staffscout_mikado_after_slider_action' );
?>