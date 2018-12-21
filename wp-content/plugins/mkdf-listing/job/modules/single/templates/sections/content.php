<div class="mkdf-ls-single-section mkdf-ls-single-content mkdf-grid clearfix">

	<div class="mkdf-ls-single-section-inner left">

        <div class="mkdf-ls-single-content-holder">
        <?php

        echo mkdf_listing_job_single_template_part('parts/type', '', $params);
        echo mkdf_listing_job_single_template_part('parts/title');
        echo mkdf_listing_job_single_template_part('parts/content');
        echo mkdf_listing_job_single_template_part('parts/social-networks', '', $params);

        ?>
        </div>

        <div class="mkdf-ls-single-share-holder">
            <?php echo mkdf_listing_job_single_template_part('parts/info/share'); ?>
        </div>

	</div>

	<div class="mkdf-ls-single-section-inner right">
        <div class="mkdf-ls-single-details-map-holder">
            <?php
                echo mkdf_listing_job_single_template_part('parts/company-details/holder', '', $params);
                echo mkdf_listing_job_single_template_part('parts/map', '', $params);
            ?>
        </div>
	</div>

</div>