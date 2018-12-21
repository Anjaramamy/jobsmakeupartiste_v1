<?php

class MikadofMembershipLoginRegister extends WP_Widget {
	protected $params;
	
	public function __construct() {
		parent::__construct(
			'mkdf_login_register_widget', // Base ID
			'Mikado Login',
			array( 'description' => esc_html__( 'Login and register wordpress widget', 'mkdf-membership' ), )
		);
	}
	
	public function widget( $args, $instance ) {
		$additional_class = '';
		if ( is_user_logged_in() ) {
			$additional_class .= 'mkdf-user-logged-in';
		} else {
			$additional_class .= 'mkdf-user-not-logged-in';
		}
		
		echo '<div class="widget mkdf-login-register-widget ' . esc_attr( $additional_class ) . '">';
		if ( ! is_user_logged_in() ) {
			echo '<a href="#" class="mkdf-login-opener">' . esc_html__( 'Login', 'mkdf-membership' ) . '</a>';
			
			add_action( 'wp_footer', array( $this, 'mkdf_membership_render_login_form' ) );
			
		} else {
			echo mkdf_membership_get_widget_template_part( 'login-widget', 'login-widget-template' );
		}
		echo '</div>';
		
	}
	
	public function mkdf_membership_render_login_form() {
		
		//Render modal with login and register forms
		echo mkdf_membership_get_widget_template_part( 'login-widget', 'login-modal-template' );
	}
}

function mkdf_membership_login_widget_load() {
	register_widget( 'MikadofMembershipLoginRegister' );
}

add_action( 'widgets_init', 'mkdf_membership_login_widget_load' );