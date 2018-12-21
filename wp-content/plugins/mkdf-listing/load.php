<?php

if(mkdf_listing_is_wp_job_manager_installed()){
    require_once 'job/admin/meta-box/map.php';
    require_once 'job/admin/options-map/map.php';

    require_once 'job/modules/archive/functions.php';
    require_once 'job/modules/archive/classes.php';
    require_once 'job/modules/dashboard/dashboard-functions.php';
    require_once 'job/modules/maps/map-functions.php';
    require_once 'job/modules/maps/map-classes.php';
    require_once 'job/modules/single/functions.php';
    require_once 'job/modules/widgets/helper.php';

    require_once 'job/lib/shortcodes/shortcode-interface.php';
    require_once 'job/lib/listing-core-functions.php';
    require_once 'job/lib/listing-core-classes.php';
    require_once 'job/lib/listing-global-settings.php';
    require_once 'job/lib/listing-field-creator.php';
    require_once 'job/lib/custom-field-creator.php';
    require_once 'job/lib/front-end-field-creator.php';
    require_once 'job/lib/listing-repeater-field-functions.php';

    require_once 'job/helpers/listing-helper-functions.php';
    require_once 'job/helpers/helper-functions.php';
    require_once 'job/helpers/listing-review-functions.php';
    require_once 'job/helpers/listing-ajax-helper-functions.php';
    require_once 'job/helpers/taxonomy-meta-fields.php';
}

if(mkdf_listing_is_wp_job_manager_installed() && mkdf_listing_is_wp_job_manager_resumes_installed()){
    require_once 'resume/admin/meta-box/map.php';
    require_once 'resume/admin/options-map/map.php';

    require_once 'resume/modules/archive/functions.php';
    require_once 'resume/modules/archive/classes.php';
    require_once 'resume/modules/dashboard/dashboard-functions.php';
    require_once 'resume/modules/maps/map-functions.php';
    require_once 'resume/modules/maps/map-classes.php';
    require_once 'resume/modules/single/functions.php';
    require_once 'resume/modules/widgets/helper.php';

    require_once 'resume/lib/shortcodes/shortcode-interface.php';
    require_once 'resume/lib/resume-core-functions.php';
    require_once 'resume/lib/resume-core-classes.php';
    require_once 'resume/lib/resume-global-settings.php';
    require_once 'resume/lib/resume-field-creator.php';
    require_once 'resume/lib/custom-field-creator.php';
    require_once 'resume/lib/front-end-field-creator.php';
    require_once 'resume/lib/resume-repeater-field-functions.php';

    require_once 'resume/helpers/resume-helper-functions.php';
    require_once 'resume/helpers/helper-functions.php';
    require_once 'resume/helpers/resume-review-functions.php';
    require_once 'resume/helpers/resume-ajax-helper-functions.php';
    require_once 'resume/helpers/taxonomy-meta-fields.php';
}