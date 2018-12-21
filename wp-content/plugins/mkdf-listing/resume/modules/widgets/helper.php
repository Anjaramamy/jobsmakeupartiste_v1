<?php
if ( ! function_exists( 'mkdf_listing_resume_load_widgets' ) ) {
    /**
     * Loades widget class file.
     */
    function mkdf_listing_resume_load_widgets() {
        require_once 'resume_widget.php';
        require_once 'resume_slider.php';
    }

    add_action( 'staffscout_mikado_before_options_map', 'mkdf_listing_resume_load_widgets', 11 );
}

if(!function_exists('mkdf_listing_resume_register_widget')){
    
    function mkdf_listing_resume_register_widget(){

        if(mkdf_listing_theme_installed()) {
            register_widget('MikadoResumeWidget');
            register_widget('StaffScoutMikadoClassResumeSliderWidget');
        }

    }
    
    add_action('widgets_init', 'mkdf_listing_resume_register_widget');
    
}