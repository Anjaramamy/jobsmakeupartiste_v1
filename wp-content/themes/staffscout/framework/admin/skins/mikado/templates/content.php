<div class="mkdf-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade<?php if ($page->slug == $tab) echo " in active"; ?>">
            <div class="mkdf-tab-content">
                <div class="mkdf-page-title-holder clearfix">
                    <h2 class="mkdf-page-title"><?php echo esc_html($page->title); ?></h2>
                    <?php
	                    if($showAnchors) {
	                        $this->getAnchors($page);
	                    }
                    ?>
                </div>
                <form method="post" class="mkdf_ajax_form">
					<?php wp_nonce_field("mkdf_ajax_save_nonce","mkdf_ajax_save_nonce") ?>
                    <div class="mkdf-page-form">
                        <?php $page->render(); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>