<div class="mkdf-login-register-holder">
	<div class="mkdf-login-register-content">
		
		<div class="mkdf-login-content-inner" id="mkdf-login-content">
			<div class="mkdf-wp-register-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_register', array() ) ?>
			
			<div class="titlePopup">S'inscrire</div>
			
			
			</div>
		</div>
		<div class="mkdf-register-content-inner loginRegistre" id="mkdf-register-content">
			<div class="titlePopup">Connexion</div>
			<div class="mkdf-wp-login-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_login', array() ); ?></div>
			
		</div>
		<ul>
			<li>Déjà un compte ? <a href="#mkdf-register-content"> connectez-vous<?php //esc_html_e( 'Login', 'mkdf-membership' ); ?></a></li>
			<li>
				Vos n'avez pas de compte ?<a href="#mkdf-login-content"> inscrivez-vous<?php //esc_html_e( 'Register', 'mkdf-membership' ); ?></a>
				<div class="mkdf-lost-pass-remember-holder clearfix">                   
                    <a href="/wp-login.php?action=lostpassword" class="mkdf-login-action-btn" data-el="#mkdf-reset-pass-content" data-title="Lost Password?">Mot de passe oublié ?</a>
                </div>
			</li>
			
		</ul>
	</div>
</div>