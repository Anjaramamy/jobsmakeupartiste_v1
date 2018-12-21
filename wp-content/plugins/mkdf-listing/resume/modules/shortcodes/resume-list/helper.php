<?php
use MikadoResume\Lib\Shortcodes;
use MikadoResume\Lib\Core;

if(!function_exists('mkdf_listing_resume_list_shortcode_helper')) {
	function mkdf_listing_resume_list_shortcode_helper($shortcodes_class_name) {

		$shortcodes = array(
			'MikadoResume\Lib\Shortcodes\ResumeList'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('mkdf_listing_resume_filter_add_vc_shortcode', 'mkdf_listing_resume_list_shortcode_helper');
}

if(!function_exists('mkdf_listing_resume_list_class_instance')){

	function mkdf_listing_resume_list_class_instance(){
		return Shortcodes\ResumeList::getInstance();
	}

}

if( !function_exists('mkdf_listing_resume_set_ls_list_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_listing_resume_set_ls_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-ls-list';

		return $shortcodes_icon_class_array;
	}

	add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_listing_resume_set_ls_list_icon_class_name_for_vc_shortcodes');
}

if(!function_exists('mkdf_listing_resume_list_class_instance')){

    function mkdf_listing_resume_list_class_instance(){
        return Shortcodes\ResumeList::getInstance();
    }

}

if(!function_exists('mkdf_listing_resume_list_load_more_response')){

    function mkdf_listing_resume_list_load_more_response(){

        $params = array();
        $sc_params = array();
        $html = '';
        $max_num_pages = '';

        if(isset($_POST)) {
            foreach ($_POST as $key => $value) {
                if($key !== '') {
                    $addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
                    $setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);
                    $params[$setAllLettersToLowercase] = $value;
                }
            }

            extract($params);
            $next_page = '';

            foreach($load_more_data as $key => $value) {
                if($key !== '') {
                    $addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
                    $setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);
                    $sc_params[$setAllLettersToLowercase] = $value;
                }
            }

            //make a new instance of adv search shortcode
            $resume_list_obj = mkdf_listing_resume_list_class_instance();
            //set basic params for new shortcode instance
            $resume_list_obj->setBasicParams($sc_params);

            if($enable_load_more){
                $next_page = $load_more_data['nextPage'];
            }

            $query_array = $resume_list_obj->getQueryArray();
            $query_array['next_page'] = $next_page;
            $query_results = mkdf_listing_resume_get_resume_query_results($query_array);

            //set query results for new shortcode instance
            $resume_list_obj->setQueryResults($query_results);

            $max_num_pages = $query_results->max_num_pages;

            if($query_results->have_posts()){
                while ( $query_results->have_posts() ) {
                    $query_results->the_post();
                    $article_obj = new Core\ResumeArticle(get_the_ID());

                    $params  = array(
                        'type_html'         => $article_obj->getTaxHtml('resume_type', 'mkdf-resume-type-wrapper'),
                        'cat_html'          => $article_obj->getTaxHtml('resume_category', 'mkdf-resume-cat-wrapper'),
                        'rating_html'       => $article_obj->getResumeAverageRating(),
                        'address_html'      => $article_obj->getAddressIconHtml(),
                        'article_obj'       => $article_obj
                    );

                    $html .= mkdf_listing_resume_get_shortcode_module_template_part('templates/item', 'resume-list','',$params);

                }
                wp_reset_postdata();
            }
            else{
                ob_start();
                $html = mkdf_listing_resume_get_shortcode_module_template_part('templates/post-not-found', 'resume-advanced-search');
                $html .= ob_get_clean();
            }

            $return_obj = array(
                'html' => $html,
                'maxNumPages' => $max_num_pages
            );

            echo json_encode($return_obj); exit;
        }

    }
    add_action('wp_ajax_nopriv_mkdf_listing_resume_list_load_more_response', 'mkdf_listing_resume_list_load_more_response');
    add_action( 'wp_ajax_mkdf_listing_resume_list_load_more_response', 'mkdf_listing_resume_list_load_more_response' );
}