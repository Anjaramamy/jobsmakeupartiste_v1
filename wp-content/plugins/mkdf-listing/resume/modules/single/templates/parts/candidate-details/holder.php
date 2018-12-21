<?php
$params_address = mkdf_listing_resume_get_address_params(get_the_ID());
extract($params_address);
$get_directions_link = '';
if ( $address_lat !== '' && $address_long !== '' ) {
    $get_directions_link = '//maps.google.com/maps?daddr=' . $address_lat . ',' . $address_long;
}?>

<div class="mkdf-rs-single-candidate-details-holder">

    <?php echo mkdf_listing_resume_single_template_part('parts/candidate-details/author', '',$params); ?>
    <?php echo mkdf_listing_resume_single_template_part('parts/candidate-details/profession', '',$params); ?>
    <?php echo mkdf_listing_resume_single_template_part('parts/candidate-details/details', '',$params); ?>



    <div class="mkdf-rs-single-candidate-details-button-holder">

    <?php

    echo staffscout_mikado_get_button_html(array(
        'text' => esc_html__('CONTACT ME', 'mkdf-listing'),
        'custom_class' => 'mkdf-rs-single-contact-resume',
        'type' => 'solid',
        'html_type' => 'button',
        'fullwidth' => 'yes',
        'size' => 'medium'
    ));

    ?>

    </div>

    <?php echo mkdf_listing_resume_single_template_part('parts/candidate-details/login', '',$params); ?>

</div>