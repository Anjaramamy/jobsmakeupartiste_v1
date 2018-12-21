<?php

if(!function_exists('mkdf_listing_job_set_listing_dashboard_navigation_pages')){

	/**
	 * Create listing dashboard navigation items
	 *
	 * @param array items - dashboard navigation items
	 * @param string dashboard_url - dashboard page url
	 *
	 * @return array
	 * see mkdf_listing_job_membership_dashboard_navigation_pages in mkdf-membership plugin
	 */

	function mkdf_listing_job_set_listing_dashboard_navigation_pages($items, $dashboard_url){

        $items['bookmarks'] = array(
            'url'  => esc_url( add_query_arg( array( 'user-action' => 'bookmarks' ), $dashboard_url ) ),
            'text' => esc_html__( 'My Bookmarks', 'mkdf-listing' ),
            'user_action' => 'bookmarks',
            'icon' => '<i class="dripicons-heart" aria-hidden="true"></i>'
        );

		$items['add-new-listing'] = array(
			'url'  => esc_url( add_query_arg( array( 'user-action' => 'add-new-listing' ), $dashboard_url ) ),
			'text' => esc_html__( 'Add Listing', 'mkdf-listing' ),
            'user_action' => 'add-new-listing',
            'icon' => '<i class="dripicons-plus" aria-hidden="true"></i>'
		);

		$items['my-listings'] = array(
			'url'  => esc_url( add_query_arg( array( 'user-action' => 'my-listings' ), $dashboard_url ) ),
			'text' => esc_html__( 'My Listings', 'mkdf-listing' ),
            'user_action' => 'my-listings',
            'icon' => '<i class="dripicons-document" aria-hidden="true"></i>'
		);

		return $items;
	}

	add_filter('mkdf_membership_dashboard_navigation_pages' , 'mkdf_listing_job_set_listing_dashboard_navigation_pages', 10 , 2);
}

if(!function_exists('mkdf_listing_job_get_listing_dashboard_pages')){

	/**
	 * Create listing dashboard pages
	 *
	 * @param array $pages - dashboard navigation pages
	 *
	 * @return array
	 * see mkdf_listing_job_membership_dashboard_pages in mkdf-membership plugin
	 */


	function mkdf_listing_job_get_listing_dashboard_pages($pages){

        $pages['bookmarks'] = mkdf_listing_job_get_listing_module_template_part('dashboard', 'bookmarks');
		$pages['add-new-listing'] = mkdf_listing_job_get_listing_module_template_part('dashboard', 'add-new-listing');
		$pages['my-listings'] = mkdf_listing_job_get_listing_module_template_part('dashboard', 'my-listings');

		return $pages;
	}
	add_filter('mkdf_membership_dashboard_pages', 'mkdf_listing_job_get_listing_dashboard_pages', 10, 1);
}