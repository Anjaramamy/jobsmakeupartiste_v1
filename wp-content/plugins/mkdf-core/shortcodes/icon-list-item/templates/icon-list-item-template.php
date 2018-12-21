<?php $icon_html = staffscout_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="mkdf-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo staffscout_mikado_get_inline_style($holder_styles); ?>>
	<div class="mkdf-il-icon-holder">
        <?php if(!empty($custom_icon)) : ?>
            <div class="mkdf-il-custom-icon-holder">
                <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
            </div>
        <?php else: ?>
            <?php echo wp_kses_post($icon_html); ?>
        <?php endif; ?>
	</div>
	<p class="mkdf-il-text" <?php echo staffscout_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>
