<?php
use MikadoResume\Archive;

if ( ! function_exists( 'mkdf_listing_resume_generate_resume_map_archive_vars' ) ) {
	/**
	 * Generates archive map variables based on sent attributes
	 * $attributes can contain:
	 *      $posts_per_page - number of post per page. $post number can be set in Theme Options(Resumes Section), then in wp_job_manager options and also in native WordPress Options
	 *      $max_num_pages - value from Wp_Query object. Needed for pagination params(for example, show/hide load more button)
	 *      $found_posts - value from Wp_Query object. Shows how many items are in current query
	 *      $type - resume type taxonomy term id
	 *      $cat - resume category taxonomy term slug
	 *      $keyword - keyword search param
	 *      $next_page - next page param
	 *      $custom_fields - resume post meta params set in search
	 *
	 * @param $attributes
	 *
	 */
	function mkdf_listing_resume_generate_resume_map_archive_vars( $attributes ) {
		$posts_per_page = '-1';
		$max_num_pages  = '';
		$found_posts    = '';
		$type           = '';
		$cat            = '';
		$keyword        = '';
		$next_page      = '';
		$custom_fields  = array();
		$tag            = '';
		$location       = '';
		
		extract( $attributes );
		
		new Archive\ArchiveGlobalVar( $posts_per_page, $max_num_pages, $found_posts, $type, $cat, $keyword, $next_page, $custom_fields, $tag, $location );
	}
}

if ( ! function_exists( 'mkdf_listing_resume_get_resume_archive_pages' ) ) {
	function mkdf_listing_resume_get_resume_archive_pages() {
		$params = mkdf_listing_resume_get_resume_archive_search_params();
		extract( $params );
		
		$meta_query_flag = false;
		if ( count( $custom_fields ) ) {
			$meta_query_flag = true;
		}
		
		$query_params = array(
			'type'                => $type,
			'location'            => $location,
			'tag'                 => $tag,
			'keyword'             => $keyword,
			'user_id'             => $user_id,
			'post_number'         => $post_per_page,
			'category_array'      => $cat_array,
			'meta_query_flag'     => $meta_query_flag,
			'default_meta_params' => $custom_fields
		);
		
		$params['query_results'] = mkdf_listing_resume_get_resume_query_results( $query_params );
		
		//generate multiple map global vars from current query results
		$map_array = array(
			'type'              => 'multiple',
			'query'             => $params['query_results'],
			'init_multiple_map' => true
		);
		mkdf_listing_resume_generate_resume_map_vars( $map_array );
		
		//generate archive search vars from current query results
		$archive_var_array = array(
			'posts_per_page' => $post_per_page,
			'max_num_pages'  => $params['query_results']->max_num_pages,
			'found_posts'    => $params['query_results']->found_posts,
			'type'           => $type,
			'cat'            => $cat_slug,
			'location'       => $location,
			'tag'            => $tag,
			'keyword'        => $keyword,
			'next_page'      => '2',
			'custom_fields'  => $custom_fields
		);
		mkdf_listing_resume_generate_resume_map_archive_vars( $archive_var_array );
		
		//generate html for current query_results
		mkdf_listing_resume_get_archive_module_template_part( 'holder', '', $params );
	}
}

if(!function_exists('mkdf_listing_resume_get_resume_archive_search_params')){
	function mkdf_listing_resume_get_resume_archive_search_params(){
		$params = array();
		//post per page param
		$params['post_per_page'] = $post_per_page = mkdf_listing_resume_get_resume_number_per_page();

		//type param
		$params['type'] = '';

		$params['user_id'] = '';
		if(isset($_GET['mkdf-rs-user-id']) && $_GET['mkdf-rs-user-id'] !== ''){
			$params['user_id'] = $_GET['mkdf-rs-user-id'];
		}

		if(isset($_GET['mkdf-rs-main-search-resume-type']) && $_GET['mkdf-rs-main-search-resume-type'] !== ''){
			if($_GET['mkdf-rs-main-search-resume-type'] === 'all'){
				$_GET['mkdf-rs-main-search-resume-type'] = '';
			}
			$params['type'] = $_GET['mkdf-rs-main-search-resume-type'];
		}
		elseif(is_tax( 'resume_type' )){
			$params['type'] = get_queried_object_id();
		}

		$params['location'] = '';
        if(isset($_GET['mkdf-rs-main-search-resume-region']) && $_GET['mkdf-rs-main-search-resume-region'] !== ''){
	        if($_GET['mkdf-rs-main-search-resume-region'] === 'all'){
		        $_GET['mkdf-rs-main-search-resume-region'] = '';
	        }
			$params['location'] = $_GET['mkdf-rs-main-search-resume-region'];
		}
		elseif(is_tax( 'resume_region' )){
			$params['location'] = get_queried_object_id();
		}

		$params['tag'] = '';
		if(is_tax( 'resume_tag' )){
			$params['tag'] = get_queried_object_id();
		}

		//keyword param
		$params['keyword'] = '';
		if(isset($_GET['mkdf-rs-main-search-keyword']) && $_GET['mkdf-rs-main-search-keyword'] !== ''){
			$params['keyword'] = $_GET['mkdf-rs-main-search-keyword'];
		}

        //category param
        $params['cat_slug'] = '';
        $params['cat_array'] = array();


        if(isset($_GET['mkdf-rs-main-search-resume-category']) && $_GET['mkdf-rs-main-search-resume-category'] !== ''){
            if($_GET['mkdf-rs-main-search-resume-category'] === 'all'){
                $_GET['mkdf-rs-main-search-resume-category'] = '';
            }
            if($_GET['mkdf-rs-main-search-resume-category'] !== '') {
                $params['cat_array'][] =  $_GET['mkdf-rs-main-search-resume-category'];
            }
            $params['cat_slug'] =  $_GET['mkdf-rs-main-search-resume-category'];
        }
        else if(is_tax( 'resume_category' )){
            $cat = get_term_by( 'id', get_queried_object_id(), 'resume_category');
            $params['cat_array'][] = $cat->slug;
            $params['cat_slug'] = $cat->slug;
        }

		$params['custom_fields'] = array();

		$max_price = $min_price = '';
		if(isset($_GET['mkdf-rs-main-search-price-max'])){
			$max_price = $_GET['mkdf-rs-main-search-price-max'];
		}
		if(isset($_GET['mkdf-rs-main-search-price-min'])){
			$min_price = $_GET['mkdf-rs-main-search-price-min'];
		}

		if($max_price !== '' && $min_price !== ''){
			$params['custom_fields']['price_both_values']['min'] = $min_price;
			$params['custom_fields']['price_both_values']['max'] = $max_price;
		}
		if($max_price !== '' && $min_price === ''){
			$params['custom_fields']['price_max'] = $max_price;
		}
		if($min_price !== '' && $max_price === ''){
			$params['custom_fields']['price_min'] = $min_price;
		}

		return $params;
	}
}

if ( ! function_exists( 'mkdf_listing_resume_load_archive_templates' ) ) {
	/**
	 * load resume archive templates
	 */
	function mkdf_listing_resume_load_archive_templates() {
		new Archive\ArchiveTemplateLoader();
	}
	
	add_action( 'init', 'mkdf_listing_resume_load_archive_templates' );
}