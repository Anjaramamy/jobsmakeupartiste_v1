<?php

$search_title = staffscout_mikado_get_search_title();
$search_subtitle = staffscout_mikado_get_search_subtitle();

?>

<div class="mkdf-fullscreen-search-holder">
	<a class="mkdf-fullscreen-search-close" href="javascript:void(0)">
		<?php echo staffscout_mikado_icon_collections()->renderIcon( 'dripicons-cross', 'dripicons' ); ?>
	</a>
	<div class="mkdf-fullscreen-search-table">
		<div class="mkdf-fullscreen-search-cell">
			<div class="mkdf-fullscreen-search-inner">
                <?php if($search_title !=='' || $search_subtitle !=='' ) : ?>
                    <div class="mkdf-fullscreen-search-text-holder">
                        <?php if($search_title !== '') : ?>
                            <div class="mkdf-fullscreen-search-title">
                                <h1><?php echo esc_html($search_title); ?></h1>
                            </div>
                        <?php endif; ?>
                        <?php if($search_subtitle !== '') : ?>
                            <div class="mkdf-fullscreen-search-subtitle">
                                <p><?php echo esc_html($search_subtitle); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-fullscreen-search-form" method="get">
					<div class="mkdf-form-holder">
						<div class="mkdf-form-holder-inner">
							<div class="mkdf-field-holder">
                                <div class="mkdf-field-icon"><?php echo staffscout_mikado_icon_collections()->renderIcon( 'dripicons-document-edit', 'dripicons' ); ?></div>
								<input type="text" placeholder="<?php esc_html_e( 'Keywords', 'staffscout' ); ?>" name="s" class="mkdf-search-field" autocomplete="off"/>
							</div>
							<button type="submit" class="mkdf-search-submit"><?php echo staffscout_mikado_icon_collections()->renderIcon( 'dripicons-search', 'dripicons' ); ?></button>
<!--							<div class="mkdf-line"></div>-->
						</div>
					</div>
				</form>
                <div class="mkdf-fullscreen-search-bottom">
                    <div class="mkdf-fullscreen-search-bottom-inner">
                        <?php
                        if(is_active_sidebar('fullscreen_search_botom')) {
                            dynamic_sidebar('fullscreen_search_botom');
                        }
                        ?>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>