<div class="mkdf-workflow-item">
    <span class="line" style="<?php echo esc_attr($line_color); ?>"></span>
    <?php if(!empty($label)){ ?>
        <span class="circle" style="<?php echo esc_attr($label_text_color.$label_border_color.$label_background_color); ?>">
            <?php echo esc_attr($label) ?>
        </span>
    <?php } ?>
    <div class="mkdf-workflow-item-inner <?php echo esc_attr($image_on_right_class) ?>">
        <div class="mkdf-workflow-image <?php echo esc_attr($image_alignment); ?>">
            <div class="mkdf-workflow-image-inner">
                <?php if(!empty($image)){
                    echo wp_get_attachment_image($image, 'full');
                } ?>
                <?php if(!empty($custom_link)){ ?>
                    <a class="mkdf-workflow-custom-link" itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>"></a>
                <?php } ?>
            </div>
        </div>
        <div class="mkdf-workflow-text">
            <?php if(!empty($title)){ ?>
                <h2 <?php echo staffscout_mikado_get_inline_style($title_styles) ?>><?php echo esc_attr($title) ?></h2>
            <?php } ?>
            <?php if(!empty($text)){ ?>
                <p class="text"><?php echo esc_attr($text) ?></p>
            <?php } ?>

        </div>
    </div>
</div>