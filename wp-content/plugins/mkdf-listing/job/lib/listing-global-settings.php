<?php
if(!function_exists('mkdf_listing_job_save_listing_custom_post_type')){
	/**
	 * Add job_listing custom post in save array
	 */
	function mkdf_listing_job_save_listing_custom_post_type($post_types){

		$post_types[] = 'job_listing';
		return $post_types;

	}

	add_filter('staffscout_mikado_meta_box_post_types_save', 'mkdf_listing_job_save_listing_custom_post_type');
}

if(!function_exists('mkdf_listing_job_remove_meta_boxes')){
	/**
	 * Remove meta boxes for job_listing post type
	 */
	function mkdf_listing_job_remove_meta_boxes($post_types){
		$post_types[] = 'job_listing';
		return $post_types;
	}
	add_filter('staffscout_mikado_meta_box_post_types_remove', 'mkdf_listing_job_remove_meta_boxes');
}


//if(!function_exists('mkdf_listing_job_remove_listing_taxonomy_meta_boxes')){
//	/**
//	 * Remove Job Listing Taxonomy Meta Boxes(Category and Type)
//	 * We have our own meta boxes for categories and types
//	 */
//	function mkdf_listing_job_remove_listing_taxonomy_meta_boxes(){
//
//		remove_meta_box('job_listing_categorydiv', 'job_listing', 'side');
//		remove_meta_box('job_listing_typediv', 'job_listing', 'side');
//		remove_meta_box('job_listing_type', 'job_listing', 'side');
//
//	}
//	add_action('admin_menu', 'mkdf_listing_job_remove_listing_taxonomy_meta_boxes');
//}

if(!function_exists('mkdf_listing_job_edit_listing_fields')){
	/**
	 * Change default wp_job_manager_fields
	 */
	function mkdf_listing_job_edit_listing_fields( $fields ) {

		//unset job category because we will reinit after user define Listing Type
		if( isset( $fields['job']['job_category'])){
			unset(  $fields['job']['job_category'] );
		};
		if(isset($fields['job']['job_title'])){
			$fields['job']['job_title']['label'] = esc_html__('Listing Title', 'mkdf-listing');
		}
		if(isset($fields['job']['job_type'])){
			$fields['job']['job_type']['label'] = esc_html__('Listing Type', 'mkdf-listing');
		}
		if(isset($fields['job']['job_region'])){
			$fields['job']['job_region']['label'] = esc_html__('Listing Region', 'mkdf-listing');
		}
		if(isset($fields['job']['job_tags'])){
			$fields['job']['job_tags']['label'] = esc_html__('Listing Tags', 'mkdf-listing');
		}

		unset( $fields['company'] );
        unset( $fields['_company_tagline'] );
        unset( $fields['_company_twitter'] );
        unset( $fields['_company_video'] );
		return $fields;

	}
	add_filter( 'job_manager_job_listing_data_fields', 'mkdf_listing_job_edit_listing_fields' );
	add_filter( 'submit_job_form_fields', 'mkdf_listing_job_edit_listing_fields' );
}

if(!function_exists('mkdf_listing_job_remove_preview_listing_steps')){
	/**
	 * Remove the preview step.
	 * @param  array $steps
	 * @return array
	 */

	function mkdf_listing_job_remove_preview_listing_steps( $steps ) {

		unset( $steps['preview'] );
		return $steps;

	}

	add_filter( 'submit_job_steps', 'mkdf_listing_job_remove_preview_listing_steps' );
}

if(!function_exists('mkdf_listing_job_change_listing_submit_review_text')){
	/**
	 * Change submit button text
	 */
	function mkdf_listing_job_change_listing_submit_review_text() {

		return esc_html__( 'Submit Listing', 'mkdf-listing' );

	}

	add_filter( 'submit_job_form_submit_button_text', 'mkdf_listing_job_change_listing_submit_review_text' );
}

if(!function_exists('mkdf_listing_job_publish_listing')){
	/**
	 * Since we removed the preview step and it's handler, we need to manually publish listings
	 * @param  int $id
	 */

	function mkdf_listing_job_publish_listing( $id ) {

		$listing = get_post( $id );
		if ( in_array( $listing->post_status, array( 'preview', 'expired' ) ) ) {
			// Reset expirey
			delete_post_meta( $listing->ID, '_job_expires' );
			// Update job listing
			$update_listing                  = array();
			$update_listing['ID']            = $listing->ID;
            $update_listing['post_name']     = $listing->name;
			$update_listing['post_status']   = get_option( 'job_manager_submission_requires_approval' ) ? 'pending' : 'publish';
			$update_listing['post_date']     = current_time( 'mysql' );
			$update_listing['post_date_gmt'] = current_time( 'mysql', 1 );
			wp_update_post( $update_listing );
		}
	}
	add_action( 'job_manager_job_submitted', 'mkdf_listing_job_publish_listing' );
}

if(!function_exists('mkdf_listing_job_published_send_email')){
	/**
	 * Send email to user if listing is approved
	 * @param  $post_id
	 */
	function mkdf_listing_job_published_send_email($post_id) {
		if( get_post_type( $post_id ) !== 'job_listing' ) {
			return;
		}
		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = esc_html__('Hi ', 'mkdf-listing').$author->display_name.', '.esc_html__('Your listing ','mkdf-listing').$post->post_title.' '. esc_html__('has just been approved at ','mkdf-listing') .get_permalink( $post_id );
		if(isset($author->user_email)){
			wp_mail($author->user_email, esc_html__('Your listing is online', 'mkdf-listing'), $message);
		}
	}
	add_action('pending_to_publish', 'mkdf_listing_job_published_send_email');
	add_action('pending_payment_to_publish', 'mkdf_listing_job_published_send_email');
}

if(!function_exists('mkdf_listing_job_expired_send_email')){

	/**
	 * Send email to user if listing is expired
	 * @param  $post_id
	 */
	function mkdf_listing_job_expired_send_email($post_id) {
		if( get_post_type( $post_id ) !== 'job_listing' ) {
			return;
		}

		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = esc_html__('Hi ', 'mkdf-listing').$author->display_name.', '.esc_html__('Your listing ','mkdf-listing').$post->post_title.' '. esc_html__('has now expired: ','mkdf-listing') .get_permalink( $post_id );

		if(isset($author->user_email)){
			wp_mail($author->user_email, esc_html__('Your listing has expired', 'mkdf-listing'), $message);
		}
	}
	add_action('expired_job_listing', 'mkdf_listing_job_expired_send_email');
}

if(!function_exists('mkdf_listing_job_resume_published_send_email')){
	/**
	 * Send email to user if listing is approved
	 * @param  $post_id
	 */
	function mkdf_listing_job_resume_published_send_email($post_id) {
		if( get_post_type( $post_id ) !== 'resume') {
			return;
		}

		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = esc_html__('Hi ', 'mkdf-listing').$author->display_name.', '.esc_html__('Your resume ','mkdf-listing').$post->post_title.' '. esc_html__('has just been approved at ','mkdf-listing') .get_permalink( $post_id );

		if(isset($author->user_email)){
			wp_mail($author->user_email, esc_html__('Your listing has expired', 'mkdf-listing'), $message);
		}

	}
	add_action('pending_to_publish', 'mkdf_listing_job_resume_published_send_email');
	add_action('pending_payment_to_publish', 'mkdf_listing_job_resume_published_send_email');
}

if(!function_exists('mkdf_listing_job_give_user_package_on_registration')) {
	/**
	 * Add free package to a new user
	 *
	 */
	function mkdf_listing_job_give_user_package_on_registration( $user_id ) {
		global $wpdb;

		if(mkdf_listing_is_wc_paid_listings_installed()){
			$free_package = mkdf_listing_job_get_free_package();

			if(count($free_package)){

				$wpdb->insert(
					"{$wpdb->prefix}wcpl_user_packages",
					array(
						'user_id'          => $user_id,
						'product_id'       => $free_package['id'],  // This should be set to the ID of a package in WooCommerce if you want it to show a package name!
						'package_count'    => 0,
						'package_duration' => $free_package['package_duration'],
						'package_limit'    => $free_package['package_limit'],
						'package_featured' => $free_package['package_featured'],
						'package_type'     => 'job_listing'
					)
				);
			}
		}

	}
	add_action( 'user_register', 'mkdf_listing_job_give_user_package_on_registration' );
}

if(!function_exists('mkdf_listing_job_override_listing_args')){
	/**
	 * Change Job Listing Args
	 *
	 */
	function mkdf_listing_job_override_listing_args($args){

		$singular  = __( 'Listing', 'mkdf-listing' );
		$plural    = __( 'Listings', 'mkdf-listing' );

		$args['labels'] = array(
			'name' 					=> $plural,
			'singular_name' 		=> $singular,
			'menu_name'             => __( 'Listings', 'mkdf-listing' ),
			'all_items'             => sprintf( __( 'All %s', 'mkdf-listing' ), $plural ),
			'add_new' 				=> __( 'Add New', 'mkdf-listing' ),
			'add_new_item' 			=> sprintf( __( 'Add %s', 'mkdf-listing' ), $singular ),
			'edit' 					=> __( 'Edit', 'mkdf-listing' ),
			'edit_item' 			=> sprintf( __( 'Edit %s', 'mkdf-listing' ), $singular ),
			'new_item' 				=> sprintf( __( 'New %s', 'mkdf-listing' ), $singular ),
			'view' 					=> sprintf( __( 'View %s', 'mkdf-listing' ), $singular ),
			'view_item' 			=> sprintf( __( 'View %s', 'mkdf-listing' ), $singular ),
			'search_items' 			=> sprintf( __( 'Search %s', 'mkdf-listing' ), $plural ),
			'not_found' 			=> sprintf( __( 'No %s found', 'mkdf-listing' ), $plural ),
			'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'mkdf-listing' ), $plural ),
			'parent' 				=> sprintf( __( 'Parent %s', 'mkdf-listing' ), $singular ),
			'featured_image'        => __( 'Featured image', 'mkdf-listing' ),
			'set_featured_image'    => __( 'Set featured image', 'mkdf-listing' ),
			'remove_featured_image' => __( 'Remove featured image', 'mkdf-listing' ),
			'use_featured_image'    => __( 'Use as featured image', 'mkdf-listing' ),
		);
		$args['show_in_nav_menus'] = true;
		return $args;
	}
	add_filter('register_post_type_job_listing', 'mkdf_listing_job_override_listing_args');
}

if(!function_exists('mkdf_listing_job_set_listing_post_type_support')){
	/**
	 * Add Listing Post Type Support(just comments for now)
	 *
	 */
	function mkdf_listing_job_set_listing_post_type_support() {
		add_post_type_support( 'job_listing', 'comments' );
	}
	add_action( 'init', 'mkdf_listing_job_set_listing_post_type_support' );
}


if(!function_exists('mkdf_listing_job_override_listing_type_args')){
	/**
	 * Change Job Listing Type Args
	 *
	 */
	function mkdf_listing_job_override_listing_type_args($args){

		$singular  = __( 'Listing type', 'mkdf-listing' );
		$plural    = __( 'Listing types', 'mkdf-listing' );

		$args['label']	= $plural;
		$args['labels'] = array(
			'name' 				=> $plural,
			'singular_name' 	=> $singular,
			'menu_name'         => ucwords( $plural ),
			'search_items' 		=> sprintf( __( 'Search %s', 'mkdf-listing' ), $plural ),
			'all_items' 		=> sprintf( __( 'All %s', 'mkdf-listing' ), $plural ),
			'parent_item' 		=> sprintf( __( 'Parent %s', 'mkdf-listing' ), $singular ),
			'parent_item_colon' => sprintf( __( 'Parent %s:', 'mkdf-listing' ), $singular ),
			'edit_item' 		=> sprintf( __( 'Edit %s', 'mkdf-listing' ), $singular ),
			'update_item' 		=> sprintf( __( 'Update %s', 'mkdf-listing' ), $singular ),
			'add_new_item' 		=> sprintf( __( 'Add New %s', 'mkdf-listing' ), $singular ),
			'new_item_name' 	=> sprintf( __( 'New %s Name', 'mkdf-listing' ),  $singular )
		);
		return $args;
	}
	add_filter('register_taxonomy_job_listing_type_args', 'mkdf_listing_job_override_listing_type_args');
}

if(!function_exists('mkdf_listing_job_override_listing_categories_args')){
	/**
	 * Change Job Listing Type Args
	 *
	 */
	function mkdf_listing_job_override_listing_categories_args($args){

		$singular  = __( 'Listing category', 'mkdf-listing' );
		$plural    = __( 'Listing categories', 'mkdf-listing' );

		$args['label']	= $plural;
		$args['labels'] = array(
			'name' 				=> $plural,
			'singular_name' 	=> $singular,
			'menu_name'         => ucwords( $plural ),
			'search_items' 		=> sprintf( __( 'Search %s', 'mkdf-listing' ), $plural ),
			'all_items' 		=> sprintf( __( 'All %s', 'mkdf-listing' ), $plural ),
			'parent_item' 		=> sprintf( __( 'Parent %s', 'mkdf-listing' ), $singular ),
			'parent_item_colon' => sprintf( __( 'Parent %s:', 'mkdf-listing' ), $singular ),
			'edit_item' 		=> sprintf( __( 'Edit %s', 'mkdf-listing' ), $singular ),
			'update_item' 		=> sprintf( __( 'Update %s', 'mkdf-listing' ), $singular ),
			'add_new_item' 		=> sprintf( __( 'Add New %s', 'mkdf-listing' ), $singular ),
			'new_item_name' 	=> sprintf( __( 'New %s Name', 'mkdf-listing' ),  $singular )
		);
		return $args;
	}
	add_filter('register_taxonomy_job_listing_category_args', 'mkdf_listing_job_override_listing_categories_args');
}
if(!function_exists('mkdf_listing_job_replace_tags_labels')){
	function mkdf_listing_job_replace_tags_labels() {

		global $wp_taxonomies;

		if ( ! isset( $wp_taxonomies['job_listing_tag'] ) ) {
			return;
		}

		// get the arguments of the already-registered taxonomy
		$job_listing_tag_args = get_taxonomy( 'job_listing_tag' ); // returns an object

		$labels = &$job_listing_tag_args->labels;

		$labels->name                       = esc_html__( 'Listing Tags', 'mkdf-listing' );
		$labels->singular_name              = esc_html__( 'Listing Tag', 'mkdf-listing' );
		$labels->search_items               = esc_html__( 'Search Listing Tags', 'mkdf-listing' );
		$labels->popular_items              = esc_html__( 'Popular Tags', 'mkdf-listing' );
		$labels->all_items                  = esc_html__( 'All Listing Tags', 'mkdf-listing' );
		$labels->parent_item                = esc_html__( 'Parent Listing Tag', 'mkdf-listing' );
		$labels->parent_item_colon          = esc_html__( 'Parent Listing Tag:', 'mkdf-listing' );
		$labels->edit_item                  = esc_html__( 'Edit Listing Tag', 'mkdf-listing' );
		$labels->view_item                  = esc_html__( 'View Tag', 'mkdf-listing' );
		$labels->update_item                = esc_html__( 'Update Listing Tag', 'mkdf-listing' );
		$labels->add_new_item               = esc_html__( 'Add New Listing Tag', 'mkdf-listing' );
		$labels->new_item_name              = esc_html__( 'New Listing Tag Name', 'mkdf-listing' );
		$labels->separate_items_with_commas = esc_html__( 'Separate tags with commas', 'mkdf-listing' );
		$labels->add_or_remove_items        = esc_html__( 'Add or remove tags', 'mkdf-listing' );
		$labels->choose_from_most_used      = esc_html__( 'Choose from the most used tags', 'mkdf-listing' );
		$labels->not_found                  = esc_html__( 'No tags found.', 'mkdf-listing' );
		$labels->no_terms                   = esc_html__( 'No tags', 'mkdf-listing' );
		$labels->menu_name                  = esc_html__( 'Listing Tags', 'mkdf-listing' );
		$labels->name_admin_bar             = esc_html__( 'Listing Tag', 'mkdf-listing' );

		$job_listing_tag_args->rewrite = array(
			'slug'       => _x( 'listing-tag', 'permalink', 'mkdf-listing' ),
			'with_front' => false,
			'ep_mask' => 0,
			'hierarchical' => false
		);


		// re-register the taxonomy
		register_taxonomy( 'job_listing_tag', array( 'job_listing' ), (array) $job_listing_tag_args );

	}
	add_action( 'init', 'mkdf_listing_job_replace_tags_labels' , 11);
}

if(!function_exists('mkdf_listing_job_replace_region_labels')){
	function mkdf_listing_job_replace_region_labels() {

		global $wp_taxonomies;

		if ( ! isset( $wp_taxonomies['job_listing_region'] ) ) {
			return;
		}

		// get the arguments of the already-registered taxonomy
		$job_listing_region_args = get_taxonomy( 'job_listing_region' ); // returns an object

		$labels = &$job_listing_region_args->labels;

		$labels->name                       = esc_html__( 'Listing Regions', 'mkdf-listing' );
		$labels->singular_name              = esc_html__( 'Listing Region', 'mkdf-listing' );
		$labels->search_items               = esc_html__( 'Search Listing Regions', 'mkdf-listing' );
		$labels->popular_items              = esc_html__( 'Popular Listing Regions', 'mkdf-listing' );
		$labels->all_items                  = esc_html__( 'All Listing Regions', 'mkdf-listing' );
		$labels->parent_item                = esc_html__( 'Parent Listing Region', 'mkdf-listing' );
		$labels->parent_item_colon          = esc_html__( 'Parent Listing Region:', 'mkdf-listing' );
		$labels->edit_item                  = esc_html__( 'Edit Listing Region', 'mkdf-listing' );
		$labels->view_item                  = esc_html__( 'View Listing Region', 'mkdf-listing' );
		$labels->update_item                = esc_html__( 'Update Listing Region', 'mkdf-listing' );
		$labels->add_new_item               = esc_html__( 'Add New Listing Region', 'mkdf-listing' );
		$labels->new_item_name              = esc_html__( 'New Listing Region Name', 'mkdf-listing' );
		$labels->separate_items_with_commas = esc_html__( 'Separate regions with commas', 'mkdf-listing' );
		$labels->add_or_remove_items        = esc_html__( 'Add or remove regions', 'mkdf-listing' );
		$labels->choose_from_most_used      = esc_html__( 'Choose from the most used regions', 'mkdf-listing' );
		$labels->not_found                  = esc_html__( 'No regions found.', 'mkdf-listing' );
		$labels->no_terms                   = esc_html__( 'No regions', 'mkdf-listing' );
		$labels->menu_name                  = esc_html__( 'Listing Regions', 'mkdf-listing' );
		$labels->name_admin_bar             = esc_html__( 'Listing Region', 'mkdf-listing' );
		$job_listing_region_args->label = esc_html__( 'Listing Regions', 'mkdf-listing' );

		$job_listing_region_args->rewrite = array(
			'slug'       => _x( 'listing-region', 'permalink', 'mkdf-listing' ),
			'with_front' => false,
			'ep_mask' => 0,
			'hierarchical' => true
		);

		// re-register the taxonomy
		register_taxonomy( 'job_listing_region', array( 'job_listing' ), (array) $job_listing_region_args );
	}
	add_action( 'init', 'mkdf_listing_job_replace_region_labels', 11 );
}

if(!function_exists('mkdf_listing_resume_override_resume_registration_params')){
    /**
     * load resume archive templates
     * @param $params - array of default params
     *
     * @return array - override params
     */
    function mkdf_listing_resume_override_resume_registration_params($params){
        $params['exclude_from_search'] = false;

        return $params;
    }

    add_filter('register_post_type_resume', 'mkdf_listing_resume_override_resume_registration_params');
}