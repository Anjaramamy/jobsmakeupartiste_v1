<li class="mkdf-bl-item mkdf-item-space clearfix">
	<div class="mkdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			staffscout_mikado_get_module_template_part( 'templates/parts/image', 'blog', '', $params );
		} ?>
		<div class="mkdf-bli-content">
            <?php staffscout_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params ); ?>
			<?php staffscout_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
		</div>
	</div>
</li>