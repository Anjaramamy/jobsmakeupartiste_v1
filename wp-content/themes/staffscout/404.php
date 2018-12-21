<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * staffscout_mikado_header_meta hook
	 *
	 * @see staffscout_mikado_header_meta() - hooked with 10
	 * @see staffscout_mikado_user_scalable_meta - hooked with 10
	 * @see mkdf_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'staffscout_mikado_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * staffscout_mikado_after_body_tag hook
	 *
	 * @see staffscout_mikado_get_side_area() - hooked with 10
	 * @see staffscout_mikado_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'staffscout_mikado_after_body_tag' ); ?>
	
	<div class="mkdf-wrapper mkdf-404-page">
		<div class="mkdf-wrapper-inner">
			<?php staffscout_mikado_get_header(); ?>

            <?php
            /**
             * staffscout_mikado_after_header_area hook
             *
             * @see staffscout_mikado_back_to_top_button() - hooked with 10
             * @see staffscout_mikado_get_full_screen_menu() - hooked with 10
             */
            do_action( 'staffscout_mikado_after_header_area' ); ?>
			
			<div class="mkdf-content" <?php staffscout_mikado_content_elem_style_attr(); ?>>
				<div class="mkdf-content-inner">
					<div class="mkdf-page-not-found">
						<?php
						$mkdf_title_image_404 = staffscout_mikado_options()->getOptionValue( '404_page_title_image' );
						$mkdf_title_404       = staffscout_mikado_options()->getOptionValue( '404_title' );
						$mkdf_subtitle_404    = staffscout_mikado_options()->getOptionValue( '404_subtitle' );
						$mkdf_text_404        = staffscout_mikado_options()->getOptionValue( '404_text' );
						$mkdf_button_label    = staffscout_mikado_options()->getOptionValue( '404_back_to_home' );
						$mkdf_button_style    = staffscout_mikado_options()->getOptionValue( '404_button_style' );
						
						if ( ! empty( $mkdf_title_image_404 ) ) { ?>
							<div class="mkdf-404-title-image">
								<img src="<?php echo esc_url( $mkdf_title_image_404 ); ?>" alt="<?php esc_html_e( '404 Title Image', 'staffscout' ); ?>" />
							</div>
						<?php } ?>
						
						<h1 class="mkdf-404-title">
							<?php if ( ! empty( $mkdf_title_404 ) ) {
								echo esc_html( $mkdf_title_404 );
							} else {
								esc_html_e( '404', 'staffscout' );
							} ?>
						</h1>
						
						<h2 class="mkdf-404-subtitle">
							<?php if ( ! empty( $mkdf_subtitle_404 ) ) {
								echo esc_html( $mkdf_subtitle_404 );
							} else {
								esc_html_e( 'Page not found', 'staffscout' );
							} ?>
						</h2>
						
						<p class="mkdf-404-text">
							<?php if ( ! empty( $mkdf_text_404 ) ) {
								echo esc_html( $mkdf_text_404 );
							} else {
								esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted. Go back to Main Home and try something else', 'staffscout' );
							} ?>
						</p>
						
						<?php
						$mkdf_params           = array();
						$mkdf_params['text']   = ! empty( $mkdf_button_label ) ? $mkdf_button_label : esc_html__( 'BACK TO HOMEPAGE', 'staffscout' );
						$mkdf_params['link']   = esc_url( home_url( '/' ) );
						$mkdf_params['target'] = '_self';
						$mkdf_params['size']   = 'medium';
						
						if ( $mkdf_button_style == 'light-style' ) {
							$mkdf_params['custom_class'] = 'mkdf-btn-light-style';
						}
						
						echo staffscout_mikado_execute_shortcode( 'mkdf_button', $mkdf_params ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php get_footer(); ?>
</body>
</html>