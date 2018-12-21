<?php
$social_networks_array = mkdf_listing_resume_get_resume_social_network_array();
$networks_to_show = array();

foreach($social_networks_array as $network){

	$value = get_post_meta(get_the_ID(), '_resume_'.$network['id'].'_url', true);

	if($value && $value !== null && $value !== ''){
		$networks_to_show[$network['id']]['object'] = $network;
		$networks_to_show[$network['id']]['value'] = $value;
	}
}

if(count($networks_to_show)){ ?>

	<div class="mkdf-rs-single-social-network-holder clearfix">
        <div class="mkdf-rs-single-social-net-title-holder">
            <h5 class="mkdf-rs-single-social-net-title">
                <?php esc_html_e('Follow me', 'mkdf-listing'); ?>
            </h5>
        </div>

        <div class="mkdf-rs-single-social-net-icons-holder">
            <?php foreach($networks_to_show as $network){ ?>

                <a class="mkdf-rs-social-icon <?php echo esc_attr($network['object']['id']); ?>" href="<?php echo esc_url($network['value']); ?>" target="_blank">
                    <?php echo staffscout_mikado_icon_collections()->renderIcon( 'fa-'.$network['object']['icon'], 'font_awesome' );?>
                </a>

            <?php } ?>
        </div>
	</div>

<?php }