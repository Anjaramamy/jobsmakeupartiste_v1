<li class="mkdf-bl-item mkdf-item-space clearfix">
	<div class="mkdf-bli-inner">
        <div class="mkdf-bli-heading">
            <?php if ( $post_info_image == 'yes' ) {
                staffscout_mikado_get_module_template_part( 'templates/parts/image', 'blog', '', $params );

                if ( $post_info_share == 'yes' ) {
                    staffscout_mikado_get_module_template_part( 'templates/parts/post-info/share-dropdown', 'blog', '', $params );
                }
            } ?>
        </div>
        <div class="mkdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="mkdf-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                staffscout_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php staffscout_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="mkdf-bli-excerpt">
		        <?php staffscout_mikado_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
	        </div>
            <div class="mkdf-bli-info-bottom">
                <?php
                    if ( $post_info_author == 'yes' ) {
                        staffscout_mikado_get_module_template_part( 'templates/parts/post-info/author-blog-list', 'blog', '', $params );
                    }
                    if ( $post_info_comments == 'yes' ) {
                        staffscout_mikado_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
                    }
                    if ( $post_info_like == 'yes' ) {
                        staffscout_mikado_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
                    }
                    if ( $post_info_category == 'yes' ) {
                        staffscout_mikado_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
                    }
                ?>
            </div>
        </div>
	</div>
</li>