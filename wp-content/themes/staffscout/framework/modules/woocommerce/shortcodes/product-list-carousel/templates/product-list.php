<?php
$shader_styles          = $this_object->getShaderStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="mkdf-plc-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="mkdf-plc-outer mkdf-owl-slider" <?php echo staffscout_mikado_get_inline_attrs( $holder_data ); ?>>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post(); ?>
			<div class="mkdf-plc-item">
				<div class="mkdf-plc-image-outer">
					<div class="mkdf-plc-image">
						<?php staffscout_mikado_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
					</div>
					<div class="mkdf-plc-text" <?php echo staffscout_mikado_get_inline_style( $shader_styles ); ?>>
						<div class="mkdf-plc-text-outer">
							<div class="mkdf-plc-text-inner">
								<?php staffscout_mikado_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
								
								<?php staffscout_mikado_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
								
								<?php staffscout_mikado_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
								
								<?php staffscout_mikado_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
								
								<?php staffscout_mikado_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
								
								<?php staffscout_mikado_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
							</div>
						</div>
					</div>
					<a class="mkdf-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
			</div>
		<?php endwhile;
		else:
			staffscout_mikado_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>