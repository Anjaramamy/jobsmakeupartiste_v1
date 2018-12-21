<?php
$this_object = mkdf_listing_resume_adv_search_class_instance();

$id = get_the_ID();
$item_link = get_the_permalink();
$item_title = get_the_title();
$item_author = get_the_author();
$item_category = get_post_meta($id, '_candidate_title', true);
$item_profession = get_post_meta($id, '_candidate_title', true);
$image = get_post_meta($id, '_candidate_photo', true);
$image_id = staffscout_mikado_get_attachment_id_from_url( $image );
?>
<article class="mkdf-rs-item mkdf-item-space mkdf-rs-item-type-list clearfix">

    <?php if(!empty($image)) : ?>
        <div class="mkdf-rs-item-image">
            <a href="<?php echo esc_attr($item_link); ?>">
                <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="mkdf-rs-item-inner">

        <div class="mkdf-rs-item-title">
            <h4 class="mkdf-resume-title">
                <a href="<?php echo esc_attr($item_link); ?>">
                    <?php echo esc_attr($item_title ); ?>
                </a>
            </h4>
        </div>

        <div class="mkdf-rs-item-profession">

            <?php

            if(!empty($item_profession)) {
                echo wp_kses_post($item_profession);
            }

            ?>

        </div>

        <?php

        if (!empty($address_html)) {
            echo wp_kses_post($address_html);
        }

        if(!empty($price_rate_html)) {
            echo wp_kses_post($price_rate_html);
        }

        if (!empty($cat_html)) {
            echo wp_kses_post($cat_html);
        }

        ?>

    </div>

</article>