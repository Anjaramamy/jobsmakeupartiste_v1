<?php
$this_object = mkdf_listing_resume_adv_search_class_instance();
$load_more_option = $this_object->getBasicParamByKey('load_more');
$enable_load_more = ($load_more_option === 'yes') ? true : false;
if($enable_load_more){
	$button_params = array(
		'text' => esc_html__('Load More Resumes', 'mkdf-listing'),
		'custom_class' => 'mkdf-rs-adv-search-load-more',
		'type' => 'solid',
        'size' => 'small',
		'html_type' => 'button',
		'color'     => '#ff3366',
		'background_color'     => '#ffeaef',
		'border_color'     => '#ffeaef'
	);
	$html = '<div class="mkdf-rs-adv-load-more-holder">';
	$html .= staffscout_mikado_get_button_html($button_params);
	$html .= '</div>';
    print $html;
}