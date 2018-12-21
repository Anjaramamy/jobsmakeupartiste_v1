<div class="mkdf-social-register-holder">
	<form method="post" class="mkdf-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name" placeholder="<?php esc_html_e( 'User Name', 'mkdf-membership' ) ?>" value="" required
				       pattern=".{3,}" title="<?php esc_html_e( 'Three or more characters', 'mkdf-membership' ); ?>"/>
			</div>
			<div>
				<input type="text" name="user_register_name_societe" id="user_register_name_societe" placeholder="<?php esc_html_e( 'Societe', 'mkdf-membership' ) ?>" value="" />
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email" placeholder="<?php esc_html_e( 'Email', 'mkdf-membership' ) ?>" value="" required />
			</div>
			
            <div>
                <input type="password" name="user_register_password" id="user_register_password" placeholder="<?php esc_html_e('Password','mkdf-membership') ?>" value="" required />
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password" placeholder="<?php esc_html_e('Repeat Password','mkdf-membership') ?>" value="" required />
            </div>
			<div class="mkdf-register-button-holder">
				<?php
				if ( mkdf_membership_theme_installed() ) {
					echo staffscout_mikado_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'REGISTER', 'mkdf-membership' ),
						'type'      => 'solid',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'REGISTER', 'mkdf-membership' ) . '</button>';
				}
				wp_nonce_field( 'mkdf-ajax-register-nonce', 'mkdf-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'mkdf_membership_action_login_ajax_response' ); ?>
</div>