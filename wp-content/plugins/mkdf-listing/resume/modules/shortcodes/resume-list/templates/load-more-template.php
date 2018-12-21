<?php
$this_object = mkdf_listing_resume_list_class_instance();
$load_more_option = $this_object->getBasicParamByKey('load_more');
$enable_load_more = ($load_more_option === 'yes') ? true : false;
if($enable_load_more){
    $button_params = array(
        'text' => esc_html__('Load More', 'mkdf-listing'),
        'custom_class' => 'mkdf-rs-list-load-more',
        'type'  => 'solid',
        'size'  => 'medium',
        'html_type' => 'button',
        'custom_attrs' => array(
            'data-loading-text' => esc_html__('Loading...', 'select-resume')
        )
    );
	$html = '<div class="mkdf-rs-list-load-more-holder">';
	$html .= staffscout_mikado_get_button_html($button_params);
	$html .= '</div>';
    print $html;
}