<?php
$this_object = mkdf_listing_job_main_search_class_instance();
$types_array = $this_object->getListingTypes();
$categories_array = $this_object->getListingCategories();
$classes = $this_object->getBasicParamByKey('holder_classes');
$keyword = $this_object->getBasicParamByKey('listing_search_keyword') === 'yes' ? true : false;
$keyword_text = $this_object->getBasicParamByKey('listing_search_keyword_text');
$type = $this_object->getBasicParamByKey('listing_search_type') === 'yes' ? true : false;
$type_text = $this_object->getBasicParamByKey('listing_search_type_text');
$category = $this_object->getBasicParamByKey('listing_search_category') === 'yes' ? true : false;
$category_text = $this_object->getBasicParamByKey('listing_search_category_text');
$region_array = $this_object->getListingRegions();
$region = $this_object->getBasicParamByKey('listing_search_region') === 'yes' ? true : false;
$button_text = $this_object->getBasicParamByKey('listing_search_button_text');

?>
<form method="get" action="<?php echo esc_url(get_post_type_archive_link('job_listing')); ?>">
    <div class="mkdf-ls-main-search-holder clearfix <?php echo esc_attr($classes); ?>">

        <?php if ($keyword) { ?>

            <div class="mkdf-ls-main-search-holder-part keyword">

                <div class="mkdf-ls-search-icon">
                    <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-document-edit', 'dripicons'); ?>
                </div>
                <input type="text" class="mkdf-ls-main-search-keyword" name="mkdf-ls-main-search-keyword"
                       placeholder="<?php echo esc_attr($keyword_text); ?>">

            </div>

        <?php }
        if ($type) { ?>

            <div class="mkdf-ls-main-search-holder-part type">

                <div class="mkdf-ls-search-icon">
                    <?php echo staffscout_mikado_icon_collections()->renderIcon('icon_briefcase', 'font_elegant'); ?>
                </div>

                <select name="mkdf-ls-main-search-listing-type"
                        data-placeholder="<?php esc_html_e('All Types', 'mkdf-listing') ?>" data-allow-clear="true"
                        data-minimum-results-for-search="5">

                    <option value="all">
                        <?php echo esc_attr($type_text); ?>
                    </option>
                    <?php foreach ($types_array as $type_key => $type_value) {

                        if ($type_key !== '') {
                            ?>
                            <option value="<?php echo esc_attr($type_key) ?>">
                                <?php echo esc_attr($type_value); ?>
                            </option>
                        <?php }

                    } ?>
                </select>
            </div>

        <?php }

        if ($region) { ?>

            <div class="mkdf-ls-main-search-holder-part region">

                <div class="mkdf-ls-search-icon">
                    <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-location', 'dripicons'); ?>
                </div>

                <select name="mkdf-ls-main-search-listing-region"
                        data-placeholder="<?php esc_html_e('Location', 'mkdf-listing') ?>"
                        data-allow-clear="true" data-minimum-results-for-search="5">

                    <option value="all">
                        <?php esc_html_e('Location', 'mkdf-listing') ?>
                    </option>

                    <?php foreach ($region_array as $region_key => $region_value) {

                        if ($region_key !== '') { ?>
                            <option value="<?php echo esc_attr($region_key) ?>">
                                <?php echo esc_attr($region_value); ?>
                            </option>
                        <?php }

                    } ?>

                </select>

            </div>

        <?php }

        if ($category) { ?>

        <div class="mkdf-ls-main-search-holder-part category">

            <div class="mkdf-ls-search-icon">
                <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-inbox', 'dripicons'); ?>
            </div>

            <select name="mkdf-ls-main-search-listing-category"
                    data-placeholder="<?php esc_html_e('All Categories', 'mkdf-listing') ?>"
                    data-allow-clear="true" data-minimum-results-for-search="1">

                <option value="all">
                    <?php echo esc_attr($category_text); ?>
                </option>
                <?php foreach ($categories_array as $category_key => $category_value) { ?>
                    <option value="<?php echo esc_attr($category_value->slug) ?>">
                        <?php echo esc_attr($category_value->name); ?>
                    </option>

                <?php } ?>
            </select>
        </div>

        <?php } ?>

        <div class="mkdf-ls-main-search-holder-part submit">

            <?php echo staffscout_mikado_get_button_html(array(
                'text'                   => $button_text,
                'html_type'              => 'button',
                'type'                   => 'solid',
                'size'                   => 'medium',
                'fullwidth'              => 'yes',
                'font_size'              => '18',
                'border_color'           => '#ff3366',
                'hover_border_color'     => '#f42156',
                'background_color'       => '#ff3366',
                'hover_background_color' => '#f42156'
            )); ?>

        </div>

    </div>
</form>