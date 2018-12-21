<?php
$this_object = mkdf_listing_job_adv_search_class_instance();

$enable_map = $this_object->getBasicParamByKey('enable_map') === 'yes' ? true : false;
$map_in_grid = $this_object->getBasicParamByKey('map_in_grid') === 'yes' ? true : false;
$grid_class = '';
if($map_in_grid){
    $grid_class = 'mkdf-grid';
}

$keyword_flag = $this_object->getBasicParamByKey('keyword_search') === 'yes' ? true : false ;

if($enable_map){ ?>
<div class="mkdf-ls-adv-search-map-holder <?php echo esc_attr($grid_class); ?> ">
	    <?php
		echo mkdf_listing_job_get_listing_multiple_map();
	    ?>
    </div>
<?php }