<?php
$params_address = mkdf_listing_resume_get_address_params(get_the_ID());
extract($params_address);
?>

<div class="mkdf-rs-single-map-holder" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">

	<?php if($address_lat !== '' && $address_long !== ''){ ?>

        <h4 class="mkdf-rs-single-map-title-holder">
            <?php esc_html_e('How to Find Us', 'mkdf-listing'); ?>
        </h4>

	    <?php echo mkdf_listing_resume_get_resume_item_map($address_lat, $address_long); ?>

	<?php } ?>

</div>