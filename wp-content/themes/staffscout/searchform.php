<form role="search" method="get" class="searchform" id="searchform-<?php echo esc_attr(rand(0, 1000)); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'staffscout' ); ?></label>
    <div class="fields-holder">
        <div class="search-holder-part input-holder clearfix">
            <div class="mkdf-search-icon">
                <i class="mkdf-icon-dripicons dripicon dripicons-document-edit "></i>
            </div>
            <input type="search" class="search-field" placeholder="<?php esc_html_e( 'Enter Keyword', 'staffscout' ); ?>" value="" name="s" title="<?php esc_html_e( 'Search for:', 'staffscout' ); ?>"/>
        </div>
        <div class="search-holder-part submit-holder clearfix">
            <button type="submit" class="mkdf-search-submit"><?php echo staffscout_mikado_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
        </div>
    </div>
</form>