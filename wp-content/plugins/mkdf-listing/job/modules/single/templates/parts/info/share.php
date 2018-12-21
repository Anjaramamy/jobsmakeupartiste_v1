<?php
$share_type = isset($share_type) ? $share_type : 'list';
$global_share_option = staffscout_mikado_options()->getOptionValue('enable_social_share');
$listing_share_option = staffscout_mikado_options()->getOptionValue('enable_social_share_on_job_listing');

if($global_share_option === 'yes' && $listing_share_option === 'yes') { ?>
	<div class="mkdf-ls-header-info mkdf-ls-social-share">
		<?php echo staffscout_mikado_get_social_share_html(array('type' => $share_type)) ?>
	</div>
<?php }