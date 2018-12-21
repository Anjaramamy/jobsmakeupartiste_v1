<?php
$share_type = isset($share_type) ? $share_type : 'dropdown';
?>
<?php if(staffscout_mikado_options()->getOptionValue('enable_social_share') === 'yes' && staffscout_mikado_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="mkdf-blog-list-share">
        <?php echo staffscout_mikado_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>