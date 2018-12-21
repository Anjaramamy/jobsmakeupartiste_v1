<?php
use MikadoResume\Lib\Front;

$types_obj = mkdf_listing_resume_get_resume_types();
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
if (isset($_GET['mkdf-rs-main-search-resume-type'])) {
    $selected_type = $_GET['mkdf-rs-main-search-resume-type'];
} elseif (is_tax('resume_type')) {
    $selected_type = get_queried_object_id();
}

$selected_category = '';
if (isset($_GET['mkdf-rs-main-search-resume-category'])) {
    $selected_category = $_GET['mkdf-rs-main-search-resume-category'];
} elseif (is_tax('resume_category')) {
    $selected_category = get_queried_object_id();
}

$keyword = '';
if (isset($_GET['mkdf-rs-main-search-keyword'])) {
    $keyword = $_GET['mkdf-rs-main-search-keyword'];
}

?>

<div class="mkdf-resume-archive-filter-holder clearfix">

    <div class="mkdf-resume-archive-filter-holder-inner">

        <div class="mkdf-resume-archive-filter-item keyword">
            <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-document', 'dripicons'); ?>
            <input type="text" name="mkdf-archive-keyword-search"
                   class="mkdf-resume-search-input mkdf-archive-keyword-search" placeholder="All Resumes" value="<?php echo esc_attr($keyword) ?>">
        </div>

        <div class="mkdf-resume-archive-filter-item region">

            <?php echo mkdf_listing_resume_get_archive_module_template_part('locations'); ?>

        </div>

        <div class="mkdf-resume-archive-filter-item category">

            <?php echo mkdf_listing_resume_get_archive_module_template_part('categories'); ?>

        </div>

        <div class="mkdf-resume-archive-filter-item submit">

        <?php echo staffscout_mikado_get_button_html($submit_button); ?>

        </div>

    </div>

    <div class="mkdf-resume-archive-filter-type-holder">

        <?php

        $types_array = mkdf_listing_resume_get_resume_types();
        $object = new Front\ResumeTypeFieldCreator('all');

        ?>

        <div class="mkdf-archive-type-checkboxes">
            <?php $object->getSearchTypes(); ?>
        </div>

    </div>

</div>