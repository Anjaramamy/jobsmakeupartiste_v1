<div class="mkdf-membership-dashboard-page">
	<div class="mkdf-membership-dashboard-page-content">
		<h2 class="mkdf-membership-dashboard-page-title">
			<?php
			    esc_html_e( 'My resumes', 'mkdf-listing' );
			?>
		</h2>
		<?php
			echo staffscout_mikado_execute_shortcode('candidate_dashboard', '');
		?>
	</div>
</div>