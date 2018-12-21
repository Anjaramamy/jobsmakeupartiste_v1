<?php
use MikadoListing\Lib\Front;

$types_obj = mkdf_listing_job_get_listing_types();
$types_array = $types_obj['key_value'];
$submit_button = array(
    'type'         => 'solid',
    'size'         => 'medium',
    'custom_class' => 'mkdf-archive-submit-button',
    'text'         => esc_html__('SEARCH', 'mkdf-listing'),
    'html_type'    => 'button',
    'fullwidth'    => 'yes',
    'background_color'       => '#323a45',
    'hover_background_color' => '#404a59',
    'border_color'           => '#323a45',
    'hover_border_color'     => '#404a59',
);

$selected_type = '';
if (isset($_GET['mkdf-ls-main-search-listing-type'])) {
    $selected_type = $_GET['mkdf-ls-main-search-listing-type'];
} elseif (is_tax('job_listing_type')) {
    $selected_type = get_queried_object_id();
}

$selected_category = '';
if (isset($_GET['mkdf-ls-main-search-listing-category'])) {
    $selected_category = $_GET['mkdf-ls-main-search-listing-category'];
} elseif (is_tax('job_listing_category')) {
    $selected_category = get_queried_object_id();
}

$keyword = '';
if (isset($_GET['mkdf-ls-main-search-keyword'])) {
    $keyword = $_GET['mkdf-ls-main-search-keyword'];
}

?>

<div class="mkdf-listing-archive-filter-holder clearfix">

    <div class="mkdf-listing-archive-filter-holder-inner">

        <div class="mkdf-listing-archive-filter-item keyword">
            <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-document-edit', 'dripicons'); ?>
            <input type="text" name="mkdf-archive-keyword-search"
                   class="mkdf-listing-search-input mkdf-archive-keyword-search" placeholder="Keywords" value="<?php echo esc_attr($keyword) ?>">
        </div>

        <div class="mkdf-listing-archive-filter-item region">

            <?php echo mkdf_listing_job_get_archive_module_template_part('locations'); ?>

        </div>

        <div class="mkdf-listing-archive-filter-item category">

            <?php echo mkdf_listing_job_get_archive_module_template_part('categories'); ?>

        </div>

        <div class="mkdf-listing-archive-filter-item submit">

        <?php echo staffscout_mikado_get_button_html($submit_button); ?>

        </div>

    </div>

    <div class="mkdf-listing-archive-filter-type-holder">

        <?php

        $types_array = mkdf_listing_job_get_listing_types();
        $object = new Front\ListingTypeFieldCreator('all');

        ?>

        <div class="mkdf-archive-type-checkboxes">
            <?php $object->getSearchTypes(); ?>
        </div>

    </div>

</div>