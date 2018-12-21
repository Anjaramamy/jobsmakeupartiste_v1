<?php
use MikadoResume\Lib;
if(!function_exists('mkdf_listing_resume_get_custom_field_html')){
	/**
	 * Ajax call
	 * Function that calls render() method depending on the type of custom fields
	 */
	function mkdf_listing_resume_get_custom_field_html(){
		if(isset($_POST['type'])){
			switch($_POST['type']){
				case 'text':
					$id = 'text-'.rand();
					$field = new Lib\CustomFieldText('','',$id);
					break;
				case 'textarea':
					$id = 'textarea-'.rand();
					$field = new Lib\CustomFieldTextArea('','',$id);
					break;
				case 'checkbox':
					$id = 'checkbox-'.rand();
					$field = new Lib\CustomFieldCheckBox('',$id);
					break;
				case 'select':
					$id = 'select-'.rand();
					$field = new Lib\CustomFieldSelect('' , '' , array(), array(), $id);
					break;
				default:
			}
		}
		ob_start();
		$field->render();
		$html = ob_get_clean();

		$return_object  =  array(
			'html' => $html
		);
		echo json_encode($return_object);exit;
	}
	add_action('wp_ajax_mkdf_listing_resume_get_custom_field_html','mkdf_listing_resume_get_custom_field_html');
}

if(!function_exists('mkdf_listing_resume_get_option_field_html')){

	function mkdf_listing_resume_get_option_field_html(){

		if(isset($_POST['parentId'])){
			$id = $_POST['parentId'];
		}else{
			$id = '';
		}
		$field = new Lib\CustomOptionField('', '', $id);
		ob_start();
		$field->render();
		$html = ob_get_clean();
		$return_array = array(
			'html' => $html
		);
		echo json_encode($return_array);exit;

	}
	add_action('wp_ajax_mkdf_listing_resume_get_option_field_html','mkdf_listing_resume_get_option_field_html');
}

if(!function_exists('mkdf_listing_resume_add_repeater_option_button')){
	/**
	 * Generate html for repeater button
	 */
	function mkdf_listing_resume_add_repeater_option_button(){

		$html = '';
		$html .= '<a class="mkdf-option-repeater-button" href="javascript:void(0)">';
		$html .= esc_html__('Add new', 'mkdf-listing');
		$html .= '</a>';
		print $html;
	}
	add_action('mkdf_listing_resume_action_add_repeater_option_trigger', 'mkdf_listing_resume_add_repeater_option_button');
}

if(!function_exists('mkdf_listing_resume_delete_repeater_option_button')){
	/**
	 * Generate html for repeater button
	 */
	function mkdf_listing_resume_delete_repeater_option_button(){

		$html = '';
		$html .= '<a href="javascript:void(0)" class="mkdf-option-repeater-close-button">';
		$html .= esc_html__('Remove', 'mkdf-listing');
		$html .= '</a>';
        print $html;
	}
	add_action('mkdf_listing_resume_action_delete_repeater_option_trigger', 'mkdf_listing_resume_delete_repeater_option_button');
}

if(!function_exists('mkdf_listing_resume_taxonomy_delete_custom_row')){
	/**
	 * Generate html for row close button
	 */
	function mkdf_listing_resume_taxonomy_delete_custom_row(){
		$html = '';
		$html .= '<a href="javascript:void(0)" class="mkdf-custom-row-close-button">';
		$html .= '<span>'.esc_html('x').'</span>';
		$html .= '</a>';
        print $html;
	}
	add_action('mkdf_listing_resume_action_delete_custom_row', 'mkdf_listing_resume_taxonomy_delete_custom_row');
}

if(!function_exists('mkdf_listing_resume_expand_custom_row_trigger')){
	function mkdf_listing_resume_expand_custom_row_trigger(){
		$html = '';
		$html .= '<a href="javascript:void(0)" class="mkdf-custom-row-expand-button">';
		$html .= '<span class="mkdf-custom-row-opener mkdf-custom-row-open">'.esc_html('-').'</span>';
		$html .= '</a>';
        print $html;
	}
	add_action('mkdf_listing_resume_action_expand_custom_row', 'mkdf_listing_resume_expand_custom_row_trigger');
}