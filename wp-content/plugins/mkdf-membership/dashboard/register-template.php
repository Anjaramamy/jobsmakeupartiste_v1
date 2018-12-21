<?php

class MikadofMembershipPageTemplate {
	
	/**
	 * A Unique Identifier
	 */
	protected $plugin_slug;
	
	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;
	
	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;
	
	
	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {
		
		if ( null == self::$instance ) {
			self::$instance = new MikadofMembershipPageTemplate();
		}
		
		return self::$instance;
	}
	
	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {
		$this->templates = array();
		
		// Add your templates to this array.
		$this->templates = array(
			'user-dashboard.php' => 'User Dashboard',
		);
		
		// Add a filter to the theme page templates to assigned our custom template into the list
		add_filter( 'theme_page_templates', array( $this, 'mkdf_membership_add_user_dashboard_template' ) );
		
		// Add a filter to the template include to determine if the page has our template assigned and return it's path
		add_filter( 'template_include', array( $this, 'mkdf_membership_view_directory_template' ) );
	}
	
	/**
	 * Assign our template into the list of templates
	 */
	public function mkdf_membership_add_user_dashboard_template( $post_templates ) {
		$templates = $post_templates;
		if ( empty( $templates ) ) {
			$templates = array();
		}
		
		$templates = array_merge( $templates, $this->templates );
		
		return $templates;
	}
	
	/**
	 * Checks if the template is assigned to the page
	 */
	public function mkdf_membership_view_directory_template( $template ) {
		global $post;
		
		if ( isset( $post ) ) {
			if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
				return $template;
			}
			
			$file = plugin_dir_path( __FILE__ ) . 'page-templates/' . get_post_meta( $post->ID, '_wp_page_template', true );
			
			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo $file;
			}
			
			exit;
		}
		
		return $template;
	}
}

add_action( 'plugins_loaded', array( 'MikadofMembershipPageTemplate', 'get_instance' ) );