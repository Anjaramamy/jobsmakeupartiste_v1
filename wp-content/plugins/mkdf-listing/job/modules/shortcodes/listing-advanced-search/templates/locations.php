<?php

$locations_array = mkdf_listing_job_get_listing_locations_array();

?>

<div class="mkdf-ls-adv-search-location-holder">
    <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-location', 'dripicons'); ?>
    <select class="mkdf-ls-adv-search-location" name="mkdf-ls-adv-search-location">

        <option value=""><?php esc_html_e('Location', 'mkdf-listing'); ?></option>

        <?php foreach ($locations_array as $loc_id => $loc_name) : ?>

            <option value="<?php echo esc_attr($loc_id); ?>">
                <?php echo esc_html($loc_name); ?>
            </option>

        <?php endforeach; ?>

    </select>
</div>