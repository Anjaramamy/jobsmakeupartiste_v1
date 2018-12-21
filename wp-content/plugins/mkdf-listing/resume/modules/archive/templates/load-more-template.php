<?php
$load_more_option = staffscout_mikado_options()->getOptionValue('resumes_archive_load_more');
$enable_load_more = $load_more_option === 'yes' ? true : false;
$button_params = array(
	'custom_class' => 'mkdf-resume-archive-load-more',
	'type'  => 'solid',
	'size'  => 'medium',
	'text'  => esc_html__('Load More','mkdf-listing'),
	'html_type' => 'button',
    'color'     => '#ff3366',
    'background_color'     => '#ffeaef',
    'border_color'     => '#ffeaef'
);
if($enable_load_more){
    $html = '<div class="mkdf-resume-archive-load-more-holder">';
    $html .= staffscout_mikado_get_button_html($button_params);
    $html .= '</div>';
    print $html;
}