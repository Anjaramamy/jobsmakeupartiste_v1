<button type="submit" <?php staffscout_mikado_inline_style($button_styles); ?> <?php staffscout_mikado_class_attribute($button_classes); ?> <?php echo staffscout_mikado_get_inline_attrs($button_data); ?> <?php echo staffscout_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo staffscout_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>