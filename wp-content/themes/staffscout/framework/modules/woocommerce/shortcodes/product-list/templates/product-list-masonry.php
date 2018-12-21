<div class="mkdf-pl-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="mkdf-pl-outer mkdf-outer-space">
		<div class="mkdf-pl-sizer"></div>
		<div class="mkdf-pl-gutter"></div>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post();
			echo staffscout_mikado_get_woo_shortcode_module_template_part( 'templates/parts/' . $info_position, 'product-list', '', $params );
		endwhile;
		else:
			staffscout_mikado_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>