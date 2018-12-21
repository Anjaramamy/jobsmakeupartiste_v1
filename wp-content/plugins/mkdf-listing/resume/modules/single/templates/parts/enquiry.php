<div class="mkdf-rs-enquiry-holder">
	<div class="mkdf-rs-enquiry-inner">
        <a class="mkdf-rs-enquiry-close">
            <?php if(mkdf_listing_theme_installed()) {
                echo staffscout_mikado_icon_collections()->renderIcon('icon_close_alt', 'font_elegant');
            } else { ?>
                <span aria-hidden="true" class="icon_close"></span>
            <?php } ?>
        </a>
		<form class="mkdf-rs-enquiry-form" method="POST">
            
            <label>Full Name</label>
			<input type="text" name="resume-enquiry-name" id="resume-enquiry-name" placeholder="<?php esc_html_e( 'Your Full Name', 'mkdf-listing' );?>" required pattern=".{6,}">
            <label>E-mail Address</label>
			<input type="email" name="resume-enquiry-email" id="resume-enquiry-email" placeholder="<?php esc_html_e( 'Your E-mail Address', 'mkdf-listing' );?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
            <label>Your Message</label>
			<textarea name="resume-enquiry-message" id="resume-enquiry-message" placeholder="<?php esc_html_e( 'Your Message', 'mkdf-listing' );?>" required></textarea>

            <?php echo staffscout_mikado_get_button_html(array(
				'text' => esc_html__('Send Your Message', 'mkdf-listing'),
				'html_type' => 'button',
				'type' => 'solid',
				'custom_class' => 'mkdf-rs-single-enquiry-submit'
			)); ?>

			<input type="hidden" id="resume-enquiry-item-id" value="<?php echo get_the_ID(); ?>">
			<?php wp_nonce_field('mkdf_listing_resume_validate_resume_item_enquiry', 'mkdf_listing_resume_nonce_resume_item_enquiry'); ?>
		</form>
		<div class="mkdf-resume-enquiry-response"></div>
	</div>
</div>