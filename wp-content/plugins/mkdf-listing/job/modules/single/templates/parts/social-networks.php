<?php
$social_networks_array = mkdf_listing_job_get_listing_social_network_array();
$networks_to_show = array();

foreach($social_networks_array as $network){

	$value = get_post_meta(get_the_ID(), '_listing_'.$network['id'].'_url', true);

	if($value && $value !== null && $value !== ''){
		$networks_to_show[$network['id']]['object'] = $network;
		$networks_to_show[$network['id']]['value'] = $value;
	}

}

if(count($networks_to_show)){ ?>

	<div class="mkdf-ls-single-social-network-holder clearfix">
        <div class="mkdf-ls-single-social-net-title-holder">
            <h5 class="mkdf-ls-single-social-net-title">
                <?php esc_html_e('Follow us', 'mkdf-listing'); ?>
            </h5>
        </div>

        <div class="mkdf-ls-single-social-net-icons-holder">
            <?php foreach($networks_to_show as $network){ ?>

                <a class="mkdf-ls-social-icon <?php echo esc_attr($network['object']['id']); ?>" href="<?php echo esc_url($network['value']); ?>" target="_blank">
                    <?php echo staffscout_mikado_icon_collections()->renderIcon( 'fa-'.$network['object']['icon'], 'font_awesome' );?>
                </a>

            <?php } ?>
        </div>
	</div>

<?php }