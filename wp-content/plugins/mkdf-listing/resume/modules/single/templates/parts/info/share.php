<?php
$share_type = isset($share_type) ? $share_type : 'list';
$global_share_option = staffscout_mikado_options()->getOptionValue('enable_social_share');
$resume_share_option = staffscout_mikado_options()->getOptionValue('enable_social_share_on_resume');

if($global_share_option === 'yes' && $resume_share_option === 'yes') { ?>
	<div class="mkdf-rs-header-info mkdf-rs-social-share">
		<?php echo staffscout_mikado_get_social_share_html(array('type' => $share_type)) ?>
	</div>
<?php }