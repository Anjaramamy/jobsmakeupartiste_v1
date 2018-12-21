<?php
use MikadoListing\Lib\Front;
use MikadoListing\Lib\Core;
$this_object = mkdf_listing_job_types_class_instance();
$query_results = $this_object->getQueryResults();
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$holder_inner_classes = $this_object->getBasicParamByKey('holder_inner_classes');
$layout = $this_object->getBasicParamByKey('layout');
$html = '';
?>

<div class="mkdf-ls-types-holder <?php echo esc_attr($holder_classes); ?> clearfix">
	<div class="mkdf-ls-types-inner <?php echo esc_attr($holder_inner_classes); ?> clearfix">
		<?php
			if(is_array($query_results) && count($query_results)){
				foreach($query_results as $tax){
                    $tax['show_type_number'] = $this_object->getBasicParamByKey('show_type_number');
				    $tax['show_type_title'] = $this_object->getBasicParamByKey('show_type_title');
				    $tax['title_tag'] = $this_object->getBasicParamByKey('title_tag');
				    $tax['show_type_desc'] = $this_object->getBasicParamByKey('show_type_desc');

					$html .= mkdf_listing_job_get_shortcode_module_template_part('templates/item', 'listing-types', $layout , $tax);
				}
			}
			else{
				$html = mkdf_listing_job_get_shortcode_module_template_part('templates/post-not-found', 'listing-types');
			}
			wp_reset_postdata();
			print $html;
		?>
	</div>
</div>