<?php
$this_object = mkdf_listing_job_adv_search_class_instance();

$item_link = get_the_permalink();
$item_title = get_the_title();
$item_author = get_the_author();
?>
<article class="mkdf-ls-item mkdf-item-space mkdf-ls-item-type-list clearfix">

    <div class="mkdf-ls-item-image">
        <a href="<?php echo esc_attr($item_link); ?>">
            <?php echo $image = get_avatar(get_the_author_meta('ID')); ?>
        </a>
    </div>

    <div class="mkdf-ls-item-inner">

        <div class="mkdf-ls-item-title">
            <h4 class="mkdf-listing-title">
                <a href="<?php echo esc_attr($item_link); ?>">
                    <?php echo esc_attr($item_title); ?>
                </a>
            </h4>
        </div>

        <div class="mkdf-ls-item-author">

            <?php

            if(!empty($item_author)) {
                echo wp_kses_post($item_author);
            }

            ?>

        </div>

        <?php

        if (!empty($address_html)) {
            echo wp_kses_post($address_html);
        }

        if ($price_html !== '') {
            echo wp_kses_post($price_html);
        }

        if(!empty($price_rate_html)) {
            echo wp_kses_post($price_rate_html);
        }

        ?>

    </div>

    <div class="mkdf-ls-item-tax-date-holder">

        <?php

        if ($type_html !== '') {
            echo wp_kses_post($type_html);
        }

        if(!empty($expire_date_html)) {
            echo wp_kses_post($expire_date_html);
        }

        ?>
    </div>

</article>