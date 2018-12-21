<?php if(comments_open()) { ?>
	<div class="mkdf-post-info-comments-holder">
		<a itemprop="url" class="mkdf-post-info-comments" href="<?php comments_link(); ?>" target="_self">
            <span class="mkdf-post-info-icon mkdf-post-info-comments-icon">
                <i class="mkdf-icon-dripicons dripicon dripicons-message mkdf-icon-element" style=""></i>
            </span>
            <span><?php comments_number('0', '1', '%'); ?></span>
		</a>
	</div>
<?php } ?>

