<div class="mkdf-membership-dashboard-page">
	<div>
		<form method="post" id="mkdf-membership-update-profile-form">
			<div class="mkdf-membership-input-holder">
				<label for="ID"><?php esc_html_e( 'ID', 'mkdf-membership' ); ?></label>
				<input  type="text" name="ID" id="ID"
				       value="<?php echo $id_recruteur; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo $first_name; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo $last_name; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="email" name="email" id="email"
				       value="<?php echo $email; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="url" id="url" value="<?php echo $website; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="description" id="description"
				       value="<?php echo $description; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'mkdf-membership' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo staffscout_mikado_get_button_html( array(
					'text'      => esc_html__( 'UPDATE PROFILE', 'mkdf-membership' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('UPDATING PROFILE', 'mkdf-membership'),
						'data-updated-text' => esc_html__('PROFILE UPDATED', 'mkdf-membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'UPDATE PROFILE', 'mkdf-membership' ) . '</button>';
			}
			wp_nonce_field( 'mkdf_validate_edit_profile', 'mkdf_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'mkdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>