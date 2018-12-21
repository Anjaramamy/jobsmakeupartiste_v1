<?php
use MikadoResume\Lib\Core;
if(!function_exists('mkdf_listing_resume_single_resume')){

	/**
	 * Function load single resume template
	 */

	function mkdf_listing_resume_single_resume(){
		$resume_template = 'standard'; //currently there is only one single resume type

		$params = array(
			'resume_template' => $resume_template,
			'holder_class'       => array(
				'mkdf-'.$resume_template,
				'mkdf-resume-single-holder'
			)
		);

		//update resume view count
		$view_obj = new Core\ResumeViews(get_the_ID());
		$view_obj->setCountValue();
		mkdf_listing_resume_single_template_part('holder', '', $params);
	}

}

if(!function_exists('mkdf_listing_resume_related_taxonomy_settings')){
	/**
	 * Function generate taxonomy array which will be used to generate related posts
	 * For each taxonomy need to be set priority in order to choose from which taxonomy will be taken post
	 * return array
	 */
	function mkdf_listing_resume_related_taxonomy_settings(){

		$tax_array = array(
			array(
				'id' => 'resume_type',
				'priority' => 2
			),
			array(
				'id' => 'resume_category',
				'priority' => 1
			),
			array(
				'id' => 'resume_tag',
				'priority' => 3
			)
		);

		return $tax_array;

	}

}

if(!function_exists('mkdf_listing_resume_get_resume_enquiry_form_html')){
	function mkdf_listing_resume_get_resume_enquiry_form_html(){
		echo mkdf_listing_resume_single_template_part('parts/enquiry');
	}
	add_action('wp_footer', 'mkdf_listing_resume_get_resume_enquiry_form_html');
}

if(!function_exists('mkdf_listing_resume_load_comment_template')){

    function mkdf_listing_resume_load_comment_template( $comment_template ) {
        global $post;
        if(isset($post) && $post->post_type === 'resume'){
            if ( !( is_singular() && ( have_comments() || 'open' == $post->comment_status ) ) ) {
                return;
            }
            return MIKADO_LISTING_ABS_PATH.'/resume/modules/single/templates/comments.php';
        }else{
            return $comment_template;
        }

    }
    add_filter( 'comments_template', 'mkdf_listing_resume_load_comment_template');
}