<?php

$categories_array = mkdf_listing_job_get_listing_categories_array();

?>

<div class="mkdf-ls-adv-search-category-holder">
    <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-inbox', 'dripicons'); ?>
    <select class="mkdf-ls-adv-search-category" name="mkdf-ls-adv-search-category">

        <option value=""><?php esc_html_e('All Categories', 'mkdf-listing'); ?></option>

        <?php foreach ($categories_array as $cat_id => $cat_name) : ?>

            <option value="<?php echo esc_attr($cat_id); ?>">
                <?php echo esc_html($cat_name); ?>
            </option>

        <?php endforeach; ?>

    </select>
</div>