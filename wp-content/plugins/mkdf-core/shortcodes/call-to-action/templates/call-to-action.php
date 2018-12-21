<div class="mkdf-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="mkdf-cta-text-holder">
			<div class="mkdf-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="mkdf-cta-button-holder" <?php echo staffscout_mikado_get_inline_style($button_holder_styles); ?>>
			<div class="mkdf-cta-button"><?php echo staffscout_mikado_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>