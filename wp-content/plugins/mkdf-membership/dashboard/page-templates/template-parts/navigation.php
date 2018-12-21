<ul class="mkdf-membership-dashboard-nav clearfix">
	<?php
	$nav_items = mkdf_membership_get_dashboard_navigation_items();
	$user_action = isset($_GET['user-action']) ? $_GET['user-action'] : 'profile';
	foreach ( $nav_items as $nav_item ) { ?>
		<li <?php if($user_action == $nav_item['user_action']){ echo 'class="mkdf-active-dash"'; } ?>>
			<a href="<?php echo $nav_item['url']; ?>">
                <?php if(isset($nav_item['icon'])){ ?>
                    <span class="mkdf-dash-icon">
						<?php print $nav_item['icon']; ?>
					</span>
                <?php } ?>
                <span class="mkdf-dash-label">
				    <?php echo $nav_item['text']; ?>
                </span>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
             <span class="mkdf-dash-icon">
                <i class="dripicons-exit" aria-hidden="true"></i>
            </span>
			<?php esc_html_e( 'Log out', 'mkdf-membership' ); ?>
		</a>
	</li>
</ul>