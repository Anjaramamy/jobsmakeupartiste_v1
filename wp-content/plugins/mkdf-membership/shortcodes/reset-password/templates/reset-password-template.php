<div class="mkdf-social-reset-password-holder">
	<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post" id="mkdf-lost-password-form" class="mkdf-reset-pass-form">
		<div>
			<input type="text" name="user_reset_password_login" class="mkdf-input-field" id="user_reset_password_login" placeholder="<?php esc_html_e( 'Enter username or email', 'mkdf-membership' ) ?>" value="" size="20" required>
		</div>
		<?php do_action( 'lostpassword_form' ); ?>
		<div class="mkdf-reset-password-button-holder">
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo staffscout_mikado_get_button_html( array(
					'html_type' => 'button',
					'text'      => esc_html__( 'NEW PASSWORD', 'mkdf-membership' ),
					'type'      => 'solid',
					'size'      => 'small'
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'NEW PASSWORD', 'mkdf-membership' ) . '</button>';
			}
			?>
		</div>
	</form>
	<?php do_action( 'mkdf_membership_action_login_ajax_response' ); ?>
</div>