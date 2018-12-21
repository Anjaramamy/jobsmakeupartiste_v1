<?php
if(!function_exists('mkdf_listing_resume_save_resume_custom_post_type')){
	/**
	 * Add resume custom post in save array
	 */
	function mkdf_listing_resume_save_resume_custom_post_type($post_types){

		$post_types[] = 'resume';
		return $post_types;

	}

	add_filter('staffscout_mikado_meta_box_post_types_save', 'mkdf_listing_resume_save_resume_custom_post_type');
}

if(!function_exists('mkdf_listing_resume_remove_meta_boxes')){
	/**
	 * Remove meta boxes for resume post type
	 */
	function mkdf_listing_resume_remove_meta_boxes($post_types){
		$post_types[] = 'resume';

        remove_meta_box('resume_url_data', 'resume', 'side');

		return $post_types;
	}
	add_filter('staffscout_mikado_meta_box_post_types_remove', 'mkdf_listing_resume_remove_meta_boxes');
}

if(!function_exists('mkdf_listing_resume_remove_resume_taxonomy_meta_boxes')){


	/**
	 * Remove Job Resume Taxonomy Meta Boxes(Category and Type)
	 * We have our own meta boxes for categories and types
	 */
	function mkdf_listing_resume_remove_resume_taxonomy_meta_boxes(){
		remove_meta_box('tagsdiv-resume_skill', 'resume', 'side');

	}

	add_action('admin_menu', 'mkdf_listing_resume_remove_resume_taxonomy_meta_boxes');
}

if(!function_exists('mkdf_listing_resume_edit_resume_fields')){
	/**
	 * Change default wp_job_manager_fields
	 */
	function mkdf_listing_resume_edit_resume_fields( $fields ) {

		//unset job category because we will reinit after user define Resume Type
		if( isset( $fields['resume']['resume_category'])){
			unset(  $fields['resume']['resume_category'] );
		};
		if(isset($fields['resume']['resume_title'])){
			$fields['resume']['resume_title']['label'] = esc_html__('Resume Title', 'mkdf-listing');
		}
		if(isset($fields['resume']['resume_type'])){
			$fields['resume']['resume_type']['label'] = esc_html__('Resume Type', 'mkdf-listing');
		}
		if(isset($fields['resume']['resume_region'])){
			$fields['resume']['resume_region']['label'] = esc_html__('Resume Region', 'mkdf-listing');
		}
		if(isset($fields['resume']['resume_tags'])){
			$fields['resume']['resume_tags']['label'] = esc_html__('Resume Tags', 'mkdf-listing');
		}

		unset( $fields['company'] );
        unset( $fields['_company_tagline'] );
        unset( $fields['_company_twitter'] );
        unset( $fields['_candidate_video'] );
        unset( $fields['resume_fields']['candidate_video'] );
        unset( $fields['resume_fields']['resume_file'] );
        unset( $fields['_resume_file'] );
        unset( $fields['_company_video'] );
        unset( $fields['_filled'] );
		return $fields;

	}
	add_filter( 'resume_manager_resume_fields', 'mkdf_listing_resume_edit_resume_fields' );
	add_filter( 'submit_resume_form_fields', 'mkdf_listing_resume_edit_resume_fields' );
}

if(!function_exists('mkdf_listing_resume_remove_resume_settings_fields')){
    /**
     * Change default wp_resume_manager_settings_fields
     */
    function mkdf_listing_resume_remove_resume_settings_fields($fields) {

        unset( $fields['resume_listings'][1][4]);
        unset( $fields['resume_listings'][1][5]);

        return $fields;
    }

    add_filter( 'resume_manager_settings', 'mkdf_listing_resume_remove_resume_settings_fields' );
}

if(!function_exists('mkdf_listing_resume_remove_preview_resume_steps')){
	/**
	 * Remove the preview step.
	 * @param  array $steps
	 * @return array
	 */

	function mkdf_listing_resume_remove_preview_resume_steps( $steps ) {

		unset( $steps['preview'] );
		return $steps;

	}

	add_filter( 'submit_resume_steps', 'mkdf_listing_resume_remove_preview_resume_steps' );
}

if(!function_exists('mkdf_listing_resume_change_resume_submit_review_text')){
	/**
	 * Change submit button text
	 */
	function mkdf_listing_resume_change_resume_submit_review_text() {

		return esc_html__( 'Submit Resume', 'mkdf-listing' );

	}

	add_filter( 'submit_resume_form_submit_button_text', 'mkdf_listing_resume_change_resume_submit_review_text' );
}

if(!function_exists('mkdf_listing_resume_publish_resume')){
	/**
	 * Since we removed the preview step and it's handler, we need to manually publish resumes
	 * @param  int $id
	 */

	function mkdf_listing_resume_publish_resume( $id ) {

		$resume = get_post( $id );
		if ( in_array( $resume->post_status, array( 'preview', 'expired' ) ) ) {
			// Reset expirey
			delete_post_meta( $resume->ID, '_resume_expires' );
			// Update job resume
			$update_resume                  = array();
			$update_resume['ID']            = $resume->ID;
            $update_resume['post_name']     = $resume->name;
			$update_resume['post_status']   = get_option( 'resume_manager_submission_requires_approval' ) ? 'pending' : 'publish';
			$update_resume['post_date']     = current_time( 'mysql' );
			$update_resume['post_date_gmt'] = current_time( 'mysql', 1 );
			wp_update_post( $update_resume );
		}
	}
	add_action( 'resume_manager_resume_submitted', 'mkdf_listing_resume_publish_resume' );
}

if(!function_exists('mkdf_listing_resume_published_send_email')){
	/**
	 * Send email to user if resume is approved
	 * @param  $post_id
	 */
	function mkdf_listing_resume_published_send_email($post_id) {
		if( get_post_type( $post_id ) !== 'resume' ) {
			return;
		}
		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = esc_html__('Hi ', 'mkdf-listing').$author->display_name.', '.esc_html__('Your resume ','mkdf-listing').$post->post_title.' '. esc_html__('has just been approved at ','mkdf-listing') .get_permalink( $post_id );
		if(isset($author->user_email)){
			wp_mail($author->user_email, esc_html__('Your resume is online', 'mkdf-listing'), $message);
		}
	}
	add_action('pending_to_publish', 'mkdf_listing_resume_published_send_email');
	add_action('pending_payment_to_publish', 'mkdf_listing_resume_published_send_email');
}

if(!function_exists('mkdf_listing_resume_expired_send_email')){

	/**
	 * Send email to user if resume is expired
	 * @param  $post_id
	 */
	function mkdf_listing_resume_expired_send_email($post_id) {
		if( get_post_type( $post_id ) !== 'resume' ) {
			return;
		}

		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = esc_html__('Hi ', 'mkdf-listing').$author->display_name.', '.esc_html__('Your resume ','mkdf-listing').$post->post_title.' '. esc_html__('has now expired: ','mkdf-listing') .get_permalink( $post_id );

		if(isset($author->user_email)){
			wp_mail($author->user_email, esc_html__('Your resume has expired', 'mkdf-listing'), $message);
		}
	}
	add_action('expired_resume', 'mkdf_listing_resume_expired_send_email');
}

if(!function_exists('mkdf_listing_resume_resume_published_send_email')){
	/**
	 * Send email to user if resume is approved
	 * @param  $post_id
	 */
	function mkdf_listing_resume_resume_published_send_email($post_id) {
		if( get_post_type( $post_id ) !== 'resume') {
			return;
		}

		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = esc_html__('Hi ', 'mkdf-listing').$author->display_name.', '.esc_html__('Your resume ','mkdf-listing').$post->post_title.' '. esc_html__('has just been approved at ','mkdf-listing') .get_permalink( $post_id );

		if(isset($author->user_email)){
			wp_mail($author->user_email, esc_html__('Your resume has expired', 'mkdf-listing'), $message);
		}

	}
	add_action('pending_to_publish', 'mkdf_listing_resume_resume_published_send_email');
	add_action('pending_payment_to_publish', 'mkdf_listing_resume_resume_published_send_email');
}

if(!function_exists('mkdf_listing_resume_give_user_package_on_registration')) {
	/**
	 * Add free package to a new user
	 *
	 */
	function mkdf_listing_resume_give_user_package_on_registration( $user_id ) {
		global $wpdb;

		if(mkdf_listing_is_wc_paid_listings_installed()){
			$free_package = mkdf_listing_resume_get_free_package();

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
						'package_type'     => 'resume'
					)
				);
			}
		}

	}
	add_action( 'user_register', 'mkdf_listing_resume_give_user_package_on_registration' );
}

if(!function_exists('mkdf_listing_resume_override_resume_args')){
	/**
	 * Change Job Resume Args
	 *
	 */
	function mkdf_listing_resume_override_resume_args($args){

		$singular  = __( 'Resume', 'mkdf-listing' );
		$plural    = __( 'Resumes', 'mkdf-listing' );

		$args['labels'] = array(
			'name' 					=> $plural,
			'singular_name' 		=> $singular,
			'menu_name'             => __( 'Resumes', 'mkdf-listing' ),
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
	add_filter('register_post_type_resume', 'mkdf_listing_resume_override_resume_args');
}

if(!function_exists('mkdf_listing_resume_set_resume_post_type_support')){
	/**
	 * Add Resume Post Type Support(just comments for now)
	 *
	 */
	function mkdf_listing_resume_set_resume_post_type_support() {
		add_post_type_support( 'resume', 'comments' );
	}
	add_action( 'init', 'mkdf_listing_resume_set_resume_post_type_support' );
}


if(!function_exists('mkdf_listing_resume_override_resume_type_args')){
	/**
	 * Change Job Resume Type Args
	 *
	 */
	function mkdf_listing_resume_override_resume_type_args($args){

		$singular  = __( 'Resume type', 'mkdf-listing' );
		$plural    = __( 'Resume types', 'mkdf-listing' );

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
	add_filter('register_taxonomy_resume_type_args', 'mkdf_listing_resume_override_resume_type_args');
}

if(!function_exists('mkdf_listing_resume_override_resume_categories_args')){
	/**
	 * Change Job Resume Type Args
	 *
	 */
	function mkdf_listing_resume_override_resume_categories_args($args){

		$singular  = __( 'Resume category', 'mkdf-listing' );
		$plural    = __( 'Resume categories', 'mkdf-listing' );

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
	add_filter('register_taxonomy_resume_category_args', 'mkdf_listing_resume_override_resume_categories_args');
}
if(!function_exists('mkdf_listing_resume_replace_tags_labels')){
	function mkdf_listing_resume_replace_tags_labels() {

		global $wp_taxonomies;

		if ( ! isset( $wp_taxonomies['resume_tag'] ) ) {
			return;
		}

		// get the arguments of the already-registered taxonomy
		$resume_tag_args = get_taxonomy( 'resume_tag' ); // returns an object

		$labels = &$resume_tag_args->labels;

		$labels->name                       = esc_html__( 'Resume Tags', 'mkdf-listing' );
		$labels->singular_name              = esc_html__( 'Resume Tag', 'mkdf-listing' );
		$labels->search_items               = esc_html__( 'Search Resume Tags', 'mkdf-listing' );
		$labels->popular_items              = esc_html__( 'Popular Tags', 'mkdf-listing' );
		$labels->all_items                  = esc_html__( 'All Resume Tags', 'mkdf-listing' );
		$labels->parent_item                = esc_html__( 'Parent Resume Tag', 'mkdf-listing' );
		$labels->parent_item_colon          = esc_html__( 'Parent Resume Tag:', 'mkdf-listing' );
		$labels->edit_item                  = esc_html__( 'Edit Resume Tag', 'mkdf-listing' );
		$labels->view_item                  = esc_html__( 'View Tag', 'mkdf-listing' );
		$labels->update_item                = esc_html__( 'Update Resume Tag', 'mkdf-listing' );
		$labels->add_new_item               = esc_html__( 'Add New Resume Tag', 'mkdf-listing' );
		$labels->new_item_name              = esc_html__( 'New Resume Tag Name', 'mkdf-listing' );
		$labels->separate_items_with_commas = esc_html__( 'Separate tags with commas', 'mkdf-listing' );
		$labels->add_or_remove_items        = esc_html__( 'Add or remove tags', 'mkdf-listing' );
		$labels->choose_from_most_used      = esc_html__( 'Choose from the most used tags', 'mkdf-listing' );
		$labels->not_found                  = esc_html__( 'No tags found.', 'mkdf-listing' );
		$labels->no_terms                   = esc_html__( 'No tags', 'mkdf-listing' );
		$labels->menu_name                  = esc_html__( 'Resume Tags', 'mkdf-listing' );
		$labels->name_admin_bar             = esc_html__( 'Resume Tag', 'mkdf-listing' );

		$resume_tag_args->rewrite = array(
			'slug'       => _x( 'resume-tag', 'permalink', 'mkdf-listing' ),
			'with_front' => false,
			'ep_mask' => 0,
			'hierarchical' => false
		);


		// re-register the taxonomy
		register_taxonomy( 'resume_tag', array( 'resume' ), (array) $resume_tag_args );

	}
	add_action( 'init', 'mkdf_listing_resume_replace_tags_labels' , 11);
}

if(!function_exists('mkdf_listing_resume_replace_region_labels')){
	function mkdf_listing_resume_replace_region_labels() {

		global $wp_taxonomies;

		if ( ! isset( $wp_taxonomies['resume_region'] ) ) {
			return;
		}

		// get the arguments of the already-registered taxonomy
		$resume_region_args = get_taxonomy( 'resume_region' ); // returns an object

		$labels = &$resume_region_args->labels;

		$labels->name                       = esc_html__( 'Resume Regions', 'mkdf-listing' );
		$labels->singular_name              = esc_html__( 'Resume Region', 'mkdf-listing' );
		$labels->search_items               = esc_html__( 'Search Resume Regions', 'mkdf-listing' );
		$labels->popular_items              = esc_html__( 'Popular Resume Regions', 'mkdf-listing' );
		$labels->all_items                  = esc_html__( 'All Resume Regions', 'mkdf-listing' );
		$labels->parent_item                = esc_html__( 'Parent Resume Region', 'mkdf-listing' );
		$labels->parent_item_colon          = esc_html__( 'Parent Resume Region:', 'mkdf-listing' );
		$labels->edit_item                  = esc_html__( 'Edit Resume Region', 'mkdf-listing' );
		$labels->view_item                  = esc_html__( 'View Resume Region', 'mkdf-listing' );
		$labels->update_item                = esc_html__( 'Update Resume Region', 'mkdf-listing' );
		$labels->add_new_item               = esc_html__( 'Add New Resume Region', 'mkdf-listing' );
		$labels->new_item_name              = esc_html__( 'New Resume Region Name', 'mkdf-listing' );
		$labels->separate_items_with_commas = esc_html__( 'Separate regions with commas', 'mkdf-listing' );
		$labels->add_or_remove_items        = esc_html__( 'Add or remove regions', 'mkdf-listing' );
		$labels->choose_from_most_used      = esc_html__( 'Choose from the most used regions', 'mkdf-listing' );
		$labels->not_found                  = esc_html__( 'No regions found.', 'mkdf-listing' );
		$labels->no_terms                   = esc_html__( 'No regions', 'mkdf-listing' );
		$labels->menu_name                  = esc_html__( 'Resume Regions', 'mkdf-listing' );
		$labels->name_admin_bar             = esc_html__( 'Resume Region', 'mkdf-listing' );
		$resume_region_args->label = esc_html__( 'Resume Regions', 'mkdf-listing' );

		$resume_region_args->rewrite = array(
			'slug'       => _x( 'resume-region', 'permalink', 'mkdf-listing' ),
			'with_front' => false,
			'ep_mask' => 0,
			'hierarchical' => true
		);

		// re-register the taxonomy
		register_taxonomy( 'resume_region', array( 'resume' ), (array) $resume_region_args );
	}
	add_action( 'init', 'mkdf_listing_resume_replace_region_labels', 11 );
}