<div class="mkdf-membership-dashboard-page">
	<div class="mkdf-membership-dashboard-page-content">
		<div class="mkdf-profile-image">
            <?php echo mkdf_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'ID', 'mkdf-membership' ); ?>:</span>
		<?php echo $id_recruteur; ?> 
		</p>
		<p>
			<span><?php esc_html_e( 'Nom de contact :', 'mkdf-membership' ); ?></span>
			<?php echo $name_contact; ?>
		</p>
		
		<p>
			<span><?php esc_html_e( 'Nom de societe :', 'mkdf-membership' ); ?></span>
			<?php echo $name_societe; ?>
		</p>
		
		
		
		<p>
			<span><?php esc_html_e( 'First Name', 'mkdf-membership' ); ?>:</span>
			<?php echo $first_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'mkdf-membership' ); ?>:</span>
			<?php echo $last_name; ?> <?php //echo $user_login; ?> <?php //echo esc_attr($profileuser->user_login); ?>
		
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'mkdf-membership' ); ?>:</span>
			<?php echo $email; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'mkdf-membership' ); ?>:</span>
			<?php echo $description; ?>
		
		</p>
<p>
			<span><?php esc_html_e( 'display_name', 'mkdf-membership' ); ?>:</span>
						<?php echo $display_name; ?>   <?php //echo $name_societe; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'mkdf-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo $website; ?></a>
		</p>
		
	</div>
</div>
