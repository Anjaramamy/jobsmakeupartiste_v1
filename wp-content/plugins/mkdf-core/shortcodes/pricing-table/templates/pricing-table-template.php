<div class="mkdf-price-table mkdf-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-pt-inner" <?php echo staffscout_mikado_get_inline_style($holder_styles); ?>>
        <?php if($show_label === 'yes') : ?>
            <div class="mkdf-pt-label-holder">
                <div class="mkdf-pt-label-inner" <?php echo staffscout_mikado_get_inline_style($label_styles); ?>>
                    <div class="mkdf-pt-label-content">
                        <span><?php echo esc_html($label); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
		<ul>
			<li class="mkdf-pt-title-holder">
				<span class="mkdf-pt-title" <?php echo staffscout_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="mkdf-pt-prices">
				<span class="mkdf-pt-value" <?php echo staffscout_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="mkdf-pt-price" <?php echo staffscout_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<h6 class="mkdf-pt-mark" <?php echo staffscout_mikado_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</li>
			<li class="mkdf-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="mkdf-pt-button">
					<?php echo staffscout_mikado_get_button_html(array(
						'link'              => $link,
						'text'              => $button_text,
						'type'              => $button_type,
                        'size'              => 'medium',
                        'color'             => $button_styles['color'],
                        'border_color'      => $button_styles['border-color'],
                        'background_color'  => $button_styles['background-color']
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>