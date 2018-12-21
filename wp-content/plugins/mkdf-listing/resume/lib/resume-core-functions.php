<?php
//enable resume archive template
add_theme_support( 'resume-manager-templates' );
use MikadoResume\Lib\FieldCreator;
use MikadoResume\Lib\Core;

if(!function_exists('mkdf_listing_resume_add_resume_field')){
	/**
	 * Function that add new field for job post item
	 *
	 * @param $params
	 *
	 */
	function mkdf_listing_resume_add_resume_field($params){

		$id = '';
		$type = '';
		$label = '';
		$options = '';
		$required = '';
		$placeholder = '';
		$priority = '';
		$description = '';
		$multiple = false;
		$front_end_field = true;
		$back_end_field = true;

		extract($params);
		new FieldCreator\ResumeFieldCreator($id, $type, $label, $options, $required, $placeholder, $priority, $description,$multiple, $front_end_field, $back_end_field);
	}
}

if(!function_exists('mkdf_listing_resume_get_resume_query_results')){
	/**
	 * Generates query results based on params
	 * $attributes can contain:
	 *      $resume_type_id - resume type taxonomy term id
	 *      $post_number - number of post per page. $post number can be set in Theme Options(Resumes Section), then in wp_job_manager options and also in native WordPress Options
	 *      $category_array - array of resume category slugs. We need to have array because we have cases where need to get resume from multiple categoriess
	 *      $meta_query_flag - boolean value to enable meta query flag
	 *      $checkbox_meta_params - custom resume meta fields(checkboxes) should be placed here.Note that this array will be filtered just if $meta_query_flag is true
	 *      $default_meta_params - custom resume meta fields(without checkboxes) should be placed here.Note that this array will be filtered just if $meta_query_flag is true
	 *      $next_page - next_page param is used for paginations
	 *      $user_id - get users resumess
	 *      $post_status - array or string of defined post statuses
	 *      $keyword - filter resumes by keyword
	 *      $post_in - array of resume ids to get
	 *      $post_not_in - array of resume ids to exclude
	 *      $tag - filter resumes by tag
	 *      $location - filter resumes by location
	 *
	 * @param $attributes
	 *
	 * @return WP_Query object
	 */
	function mkdf_listing_resume_get_resume_query_results($attributes = array(), $return_type = 'query'){

		$type = '';
		$tag = '';
		$location = '';
		$category_array = array();
		$tax_array = array();
		$user_id = '';
		$keyword = '';
		$post_number = '-1';
		$post_status = 'publish';
		$post_in = array();
		$post_not_in = array();
		$meta_query_flag = false;
		$checkbox_meta_params = array();
		$default_meta_params = array();
		$next_page = '';
		$location_object = array();

		extract($attributes);
		$query_object = new Core\ResumeQuery($type, $post_number, $category_array, $meta_query_flag ,$checkbox_meta_params, $default_meta_params, $next_page, $user_id, $post_status, $keyword, $post_in, $post_not_in, $tag, $location, $tax_array, $location_object);

		if($return_type === 'query'){
			return $query_object->getQueryResults();
		}
		if($return_type === 'array'){
			return $query_object->getQueryResultsArray();
		}

	}

}

if ( ! function_exists( 'mkdf_listing_resume_enqueue_scripts' ) ) {
	/**
	 * Enqueue media upload on taxonomy pages
	 */
	function mkdf_listing_resume_enqueue_scripts() {

		if(isset($_GET['taxonomy'])) {

			wp_enqueue_media();
			wp_enqueue_script('mkdf_listing_resume_taxonomy_upload_script', MIKADO_LISTING_URL_PATH.'resume/assets/js/admin/mkdf-taxonomy.js');
			wp_enqueue_style('mkdf_listing_resume_taxonomy_style', MIKADO_LISTING_URL_PATH.'resume/assets/css/admin/mkdf-taxonomy.css');

		}

		wp_enqueue_script('mkdf_listing_resume_repeater_script', MIKADO_LISTING_URL_PATH.'resume/assets/js/admin/mkdf-repeater.js');
		echo '<script type="application/javascript">var MikadoAdminAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}
	add_action( 'admin_enqueue_scripts', 'mkdf_listing_resume_enqueue_scripts' );

}

if(!function_exists('mkdf_listing_resume_item_save_custom_fields')){
	/**
	 * Save custom fields for current job(front end submit job)
	 * @param  $post_id, $post
	 */
	function mkdf_listing_resume_item_save_custom_fields($post_id, $post){

		if($post && $post !== null && $post->post_type !== 'resume'){
			return;
		}
		$enable_multi_resume = function_exists('job_manager_multi_job_type') ? job_manager_multi_job_type() : false;


		if(isset($_POST)){

			// set discount price to be equal regular price.
			// disc price need to be set if regular price is set because of search engines which always check disc price

			//this part of code is just for saving from front end
			if(is_admin()){
				return;
			}

			if(isset($_POST['job_type']) && ($_POST['job_type']) !== ''){
                if(is_array($_POST['job_type'])){
                    $resume_types = $_POST['job_type'];
                }
                else{
                    $resume_types = array($_POST['job_type']);
                }

                $ls_types_save_array = array();
                if(count($resume_types)){
                    foreach($resume_types as $id){
                        $type = mkdf_listing_resume_get_resume_type_by_id($id);
                        $ls_types_save_array[] = $type->slug;
                    }
                }

                if(count($ls_types_save_array)){
                    wp_set_object_terms($post_id, $ls_types_save_array, 'resume_type');
                }else{
                    wp_delete_object_term_relationships($post_id, 'resume_type');
                }

				$ls_cats_save_array = array();
				if(isset($_POST['job_type_categories'])){
					$selected_cats = $_POST['job_type_categories'];

					if(is_array($selected_cats) && count($selected_cats)){
						foreach($selected_cats as $cat_id => $cat_value){
							if($cat_value !== ''){
								$ls_cats_save_array[] = $cat_value;
							}
						}
					}

				}

				if(is_array($ls_cats_save_array) && count($ls_cats_save_array)){
					wp_set_object_terms($post_id, $ls_cats_save_array, 'resume_category');
					update_post_meta($post_id, 'mkdf_listing_resume_type_categories', $ls_cats_save_array);

				}else{
					delete_post_meta($post_id, 'mkdf_listing_resume_type_categories');
				}

				if(is_array($resume_types) && count($resume_types)){
					foreach($resume_types as $resume_type_id){

						$custom_fields = mkdf_listing_resume_get_resume_type_custom_fields($resume_type_id);
						if(is_array($custom_fields) && count($custom_fields)){
							foreach($custom_fields as $field){
								if(isset($_POST[$field['meta_key']])){
									if($field['field_type'] === 'checkbox'){
										update_post_meta($post_id, $field['meta_key'], '1');
									}
									else{
										update_post_meta($post_id, $field['meta_key'], $_POST[$field['meta_key']]);
									}
								}
							}
						}
					}
				}

			}
		}
	}
	add_action('save_post', 'mkdf_listing_resume_item_save_custom_fields', 25, 2);
}

if(!function_exists('mkdf_listing_resume_check_distance')){

	/**
	 * Generates the string for the Haversine function. We assume that the `zipcode`, `latitude`,
	 * and `longitude` columns are named accordingly. We are also not doing much error-checking
	 * here; this is a simple text cruncher to make things prettier.
	 * We may also be integrating some extra SQL in, passed in via the $extra parameter
	 *
	 * @param   string      $table      The table to search in
	 * @param   float       $lat        The latitude part of the reference coordinates
	 * @param   float       $lng        The longitude part of the reference coordinates
	 * @param   int         $radius     The radius to search within
	 * @param   string      $extra      Some extra SQL for the city/state part of the search
	 *
	 * @return  string      Returns an SQL query as a string
	 *
	 **/

	function mkdf_listing_resume_check_distance( $lat, $long, $radius, $posts = array()){

		$resumes_array = $posts;

		$current_lat = $current_long = $miles = '' ;
		$return_array = array();
		if(count($resumes_array)){
			foreach($resumes_array as $resume_key => $resume_title){

				$current_lat = get_post_meta($resume_key, 'geolocation_lat', true);
				$current_long = get_post_meta($resume_key, 'geolocation_long', true);

				if($current_lat !== '' && $current_long !== ''){

					$theta = $long - $current_long;
					$dist = sin(deg2rad($lat)) * sin(deg2rad($current_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($current_lat)) * cos(deg2rad($theta));
					$dist = acos($dist);
					$dist = rad2deg($dist);
					$miles = $dist * 60 * 1.1515;
					$km = 1.609344*$miles;

					if($km <= $radius){
						$return_array['show_items'][] = $resume_key;
					}else{
						$return_array['hide_items'][] = $resume_key;
					}
				}else{
					$return_array['hide_items'][]  = $resume_key;
				}

			}
		}

		return $return_array;
	}

}

if(!function_exists('mkdf_listing_resume_check_resume_location')){

	function mkdf_listing_resume_check_resume_location($id, $location_array){

		$current_lat = get_post_meta($id, 'geolocation_lat', true);
		$current_long = get_post_meta($id, 'geolocation_long', true);
		$show_item = false;

		$lat = $location_array['lat'];
		$long = $location_array['long'];
		$distance = $location_array['distance'];

		if($current_lat !== '' && $current_long !== ''){

			$theta = $long - $current_long;
			$dist = sin(deg2rad($lat)) * sin(deg2rad($current_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($current_lat)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;

			if($miles <= $distance){
				$show_item = true;
			}

		}

		return $show_item;

	}

}