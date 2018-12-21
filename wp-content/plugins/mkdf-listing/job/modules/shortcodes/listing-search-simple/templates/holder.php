<?php
$this_object = mkdf_listing_job_main_search_simple_class_instance();
$classes = $this_object->getBasicParamByKey('holder_classes');
$keyword = $this_object->getBasicParamByKey('listing_search_keyword') === 'yes' ? true : false;
$keyword_text = $this_object->getBasicParamByKey('listing_search_keyword_text');
$button_text = $this_object->getBasicParamByKey('listing_search_button_text');

?>
<form method="get" action="<?php echo esc_url(get_post_type_archive_link('job_listing')); ?>">
    <div class="mkdf-lss-main-search-holder clearfix <?php echo esc_attr($classes); ?>">

        <?php if ($keyword) { ?>

            <div class="mkdf-lss-main-search-holder-part keyword">

                <div class="mkdf-lss-search-icon">
                    <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-document-edit', 'dripicons'); ?>
                </div>
                <input type="text" class="mkdf-lss-main-search-keyword" name="mkdf-lss-main-search-keyword"
                       placeholder="<?php echo esc_attr($keyword_text); ?>">

            </div>

        <?php } ?>

        <div class="mkdf-lss-main-search-holder-part submit">

            <?php echo staffscout_mikado_get_button_html(array(
                'text'                   => $button_text,
                'html_type'              => 'button',
                'type'                   => 'solid',
                'size'                   => 'medium',
                'fullwidth'              => 'no',
                'font_size'              => '',
                'border_color'           => '#ff3366',
                'hover_border_color'     => '#f42156',
                'background_color'       => '#ff3366',
                'hover_background_color' => '#f42156'
            )); ?>

        </div>

    </div>
</form>