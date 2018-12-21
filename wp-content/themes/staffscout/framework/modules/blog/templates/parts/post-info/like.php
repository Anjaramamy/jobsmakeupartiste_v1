<?php if(staffscout_mikado_core_plugin_installed()) { ?>
    <div class="mkdf-blog-like">
        <?php if( function_exists('staffscout_mikado_get_like') ) staffscout_mikado_get_like(); ?>
    </div>
<?php } ?>