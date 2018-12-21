<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * staffscout_mikado_header_meta hook
	 *
	 * @see staffscout_mikado_header_meta() - hooked with 10
	 * @see staffscout_mikado_user_scalable_meta - hooked with 10
	 * @see mkdf_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'staffscout_mikado_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * staffscout_mikado_after_body_tag hook
	 *
	 * @see staffscout_mikado_get_side_area() - hooked with 10
	 * @see staffscout_mikado_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'staffscout_mikado_after_body_tag' ); ?>

    <div class="mkdf-wrapper">
        <div class="mkdf-wrapper-inner">
            <?php staffscout_mikado_get_header(); ?>
	
	        <?php
	        /**
	         * staffscout_mikado_after_header_area hook
	         *
	         * @see staffscout_mikado_back_to_top_button() - hooked with 10
	         * @see staffscout_mikado_get_full_screen_menu() - hooked with 10
	         */
	        do_action( 'staffscout_mikado_after_header_area' ); ?>
	        
            <div class="mkdf-content" <?php staffscout_mikado_content_elem_style_attr(); ?>>
                <div class="mkdf-content-inner">