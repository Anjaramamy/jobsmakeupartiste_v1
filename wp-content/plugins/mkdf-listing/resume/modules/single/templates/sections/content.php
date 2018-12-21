<div class="mkdf-rs-single-section mkdf-rs-single-content mkdf-grid clearfix">

	<div class="mkdf-rs-single-section-inner left">

        <div class="mkdf-rs-single-content-holder">
        <?php

        echo mkdf_listing_resume_single_template_part('parts/content');
        echo mkdf_listing_resume_single_template_part('parts/social-networks', '', $params);

        ?>
        </div>

        <div class="mkdf-rs-single-share-holder">
            <?php echo mkdf_listing_resume_single_template_part('parts/info/share'); ?>
        </div>

	</div>

	<div class="mkdf-rs-single-section-inner right">
        <div class="mkdf-rs-single-details-map-holder">
            <?php
                echo mkdf_listing_resume_single_template_part('parts/candidate-details/holder', '', $params);
            ?>
        </div>
	</div>

</div>