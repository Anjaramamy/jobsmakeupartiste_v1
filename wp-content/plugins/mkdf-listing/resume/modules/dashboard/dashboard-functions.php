<?php

if(!function_exists('mkdf_listing_resume_set_resume_dashboard_navigation_pages')){

	/**
	 * Create resume dashboard navigation items
	 *
	 * @param array items - dashboard navigation items
	 * @param string dashboard_url - dashboard page url
	 *
	 * @return array
	 * see mkdf_listing_resume_membership_dashboard_navigation_pages in mkdf-membership plugin
	 */

	function mkdf_listing_resume_set_resume_dashboard_navigation_pages($items, $dashboard_url){

		$items['add-new-resume'] = array(
			'url'  => esc_url( add_query_arg( array( 'user-action' => 'add-new-resume' ), $dashboard_url ) ),
			'text' => esc_html__( 'Add Resume', 'mkdf-listing' ),
            'user_action' => 'add-new-resume',
            'icon' => '<i class="dripicons-plus" aria-hidden="true"></i>'
		);

		$items['my-resumes'] = array(
			'url'  => esc_url( add_query_arg( array( 'user-action' => 'my-resumes' ), $dashboard_url ) ),
			'text' => esc_html__( 'My Resumes', 'mkdf-listing' ),
            'user_action' => 'my-resumes',
            'icon' => '<i class="dripicons-user-id" aria-hidden="true"></i>'
		);

		return $items;
	}

	add_filter('mkdf_membership_dashboard_navigation_pages' , 'mkdf_listing_resume_set_resume_dashboard_navigation_pages', 10 , 2);
}

if(!function_exists('mkdf_listing_resume_get_resume_dashboard_pages')){

	/**
	 * Create resume dashboard pages
	 *
	 * @param array $pages - dashboard navigation pages
	 *
	 * @return array
	 * see mkdf_listing_resume_membership_dashboard_pages in mkdf-membership plugin
	 */


	function mkdf_listing_resume_get_resume_dashboard_pages($pages){

		$pages['add-new-resume'] = mkdf_listing_resume_get_resume_module_template_part('dashboard', 'add-new-resume');
		$pages['my-resumes'] = mkdf_listing_resume_get_resume_module_template_part('dashboard', 'my-resumes');

		return $pages;
	}
	add_filter('mkdf_membership_dashboard_pages', 'mkdf_listing_resume_get_resume_dashboard_pages', 10, 1);
}