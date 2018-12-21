<?php
$params_address = mkdf_listing_job_get_address_params(get_the_ID());
extract($params_address);
$get_directions_link = '';
if ( $address_lat !== '' && $address_long !== '' ) {
    $get_directions_link = '//maps.google.com/maps?daddr=' . $address_lat . ',' . $address_long;
}?>

<div class="mkdf-ls-single-company-details-holder">

    <?php echo mkdf_listing_job_single_template_part('parts/company-details/author', '',$params); ?>
    <?php echo mkdf_listing_job_single_template_part('parts/company-details/title', '',$params); ?>
    <?php echo mkdf_listing_job_single_template_part('parts/company-details/details', '',$params); ?>



    <div class="mkdf-ls-single-company-details-button-holder">

    <?php

    echo staffscout_mikado_get_button_html(array(
        'text' => esc_html__('APPLY FOR JOB', 'mkdf-listing'),
        'custom_class' => 'mkdf-ls-single-contact-listing',
        'type' => 'solid',
        'html_type' => 'button',
        'fullwidth' => 'yes',
        'size' => 'medium'
    ));

    ?>

    </div>

    <?php echo mkdf_listing_job_single_template_part('parts/company-details/login', '',$params); ?>

</div>