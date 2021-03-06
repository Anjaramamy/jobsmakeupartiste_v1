<?php
namespace MikadoResume\Archive;
use MikadoResume\Lib\Core;

class ArchiveGlobalVar{

	private $vars;

	public function __construct($posts_per_page = '-1' ,$max_num_pages = '', $found_posts = '',  $type = '', $cat = '', $keyword = '', $next_page = '', $custom_fields = array(), $tag = '', $location = '') {

		$this->vars['number'] = $posts_per_page;
		$this->vars['maxPage'] = $max_num_pages;
		$this->vars['foundPosts'] = $found_posts;
		$this->vars['type'] = $type;
		$this->vars['cat'] = $cat;
		$this->vars['keyword'] = $keyword;
		$this->vars['nextPage'] = $next_page;
		$this->vars['customFields'] = $custom_fields;
		$this->vars['tag'] = $tag;
		$this->vars['location'] = $location;

		add_action('wp_footer', array($this, 'setArchiveGlobalVars'));

	}
	private function getVars(){
		return $this->vars;
	}
	public function setArchiveGlobalVars(){

		$archive_global_var = $this->getVars();
		$archive_global_var = apply_filters('mkdf_listing_resume_filter_resume_archive_var', $archive_global_var);

		wp_localize_script('staffscout_mikado_modules', 'mkdfResumeArchiveVar', array(
			'searchParams' => $archive_global_var
		));

	}

}

class ArchiveTemplateLoader {

	public function __construct() {
		$this->base = 'resume';
		$this->taxBaseArray = array(
			'resume_category',
			'resume_type',
			'resume_region',
			'resume_tag'
		);

		add_filter('single_template', array($this, 'registerSingleTemplate'));
		add_filter('archive_template', array($this, 'registerArchiveTemplate'));

	}

	/**
	 * Registers wp_job_manager single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 * @param $single string current template
	 * @return string string changed template
	 */
	public function registerSingleTemplate($single) {
		global $post;

		if($post->post_type == $this->base) {
			//update resume view count
			//Cookie for resume views need to be set here
			//if try to set cookie in resume single template, headers will be crashed because header are already sent in that moment
			//see headers_sent() functon

			$view_obj = new Core\ResumeViews($post->ID);
			$view_obj->setCookie();


			if(!file_exists(get_template_directory().'/single-'.$this->base.'.php')) {
				return MIKADO_LISTING_ABS_PATH.'/resume/modules/single/single-'.$this->base.'.php';
			}
		}

		return $single;
	}


	/**
	 * Registers wp_job_manager archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 * @param $archive string current template
	 * @return string string changed template
	 */
	public function registerArchiveTemplate($archive) {
		global $post;

		if($post && $post !== null && $post->post_type == $this->base) {


			foreach($this->taxBaseArray as $tax){
				if(!file_exists(get_template_directory().'/archive-'.$tax.'.php')) {
					return MIKADO_LISTING_ABS_PATH.'/resume/modules/archive/archive-'.$tax.'.php';
				}
			}
		}

		return $archive;
	}

}