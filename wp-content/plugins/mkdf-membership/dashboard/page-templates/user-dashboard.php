<?php
get_header();
if ( mkdf_membership_theme_installed() ) {
	staffscout_mikado_get_title();
} else { ?>
	<div class="mkdf-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="mkdf-container">
		<?php do_action( 'staffscout_mikado_after_container_open' ); ?>
		<div class="mkdf-container-inner clearfix">
            <div class="mkdf-membership-main-wrapper clearfix">
                <?php if ( is_user_logged_in() ) { ?>
                    <div class="mkdf-membership-dashboard-nav-holder clearfix">
                        <?php
                        //Include dashboard navigation
                        echo mkdf_membership_get_dashboard_template_part( 'navigation' );
                        ?>
                    </div>
                    <div class="mkdf-membership-dashboard-content-holder">
                        <?php echo mkdf_membership_get_dashboard_pages(); ?>
                    </div>
                <?php } else { ?>
                    <div class="mkdf-login-register-content mkdf-user-not-logged-in">
                        <ul>
                            <li>
                                <a href="#mkdf-login-content"><?php esc_html_e( 'Login', 'mkdf-membership' ); ?></a>
                            </li>
                            <li>
                                <a href="#mkdf-register-content"><?php esc_html_e( 'Register', 'mkdf-membership' ); ?></a>
                            </li>
                            <li>
                                <a href="#mkdf-reset-pass-content"><?php esc_html_e( 'Reset Password', 'mkdf-membership' ); ?></a>
                            </li>
                        </ul>
                        <div class="mkdf-login-content-inner" id="mkdf-login-content">
                            <div
                                class="mkdf-wp-login-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_login', array() ); ?>
                            </div>
                        </div>
                        <div class="mkdf-register-content-inner" id="mkdf-register-content">
                            <div
                                class="mkdf-wp-register-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_register', array() ) ?>
                            </div>
                        </div>
                        <div class="mkdf-reset-pass-content-inner" id="mkdf-reset-pass-content">
                            <div
                                class="mkdf-wp-reset-pass-holder"><?php echo mkdf_membership_execute_shortcode( 'mkdf_user_reset_	', array() ) ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
		</div>
		<?php do_action( 'staffscout_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>