<div class="mkdf-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="mkdf-tab-content">
				<h2 class="mkdf-page-title"><?php esc_html_e('Backup Options', 'staffscout'); ?></h2>
				<form method="post" class="mkdf_ajax_form mkdf-backup-options-page-holder">
					<div class="mkdf-page-form">
						<div class="mkdf-page-form-section-holder">
							<h3 class="mkdf-page-section-title"><?php esc_html_e('Export/Import Options', 'staffscout'); ?></h3>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<h4><?php esc_html_e('Export', 'staffscout'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'staffscout'); ?></p>
								</div>
								<div class="mkdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control mkdf-form-element" rows="10" readonly><?php echo mkdf_core_export_options(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<h4><?php esc_html_e('Import', 'staffscout'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'staffscout'); ?></p>
								</div>
								<div class="mkdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control mkdf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="mkdf-import-theme-options-btn"><?php esc_html_e('Import', 'staffscout'); ?></button>
									<?php wp_nonce_field('mkdf_import_theme_options_secret_value', 'mkdf_import_theme_options_secret', false); ?>
									<span class="mkdf-bckp-message"></span>
								</div>
							</div>
							<div class="mkdf-page-form-section mkdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'staffscout') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will overide all your existing options.', 'staffscout'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="mkdf-page-form-section-holder">
							<h3 class="mkdf-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'staffscout'); ?></h3>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<h4><?php esc_html_e('Export', 'staffscout'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'staffscout'); ?></p>
								</div>
								<div class="mkdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control mkdf-form-element" rows="10" readonly><?php echo mkdf_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<h4><?php esc_html_e('Import', 'staffscout'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'staffscout'); ?></p>
								</div>
								<div class="mkdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control mkdf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="mkdf-import-custom-sidebars-btn"><?php esc_html_e('Import', 'staffscout'); ?></button>
									<?php wp_nonce_field('mkdf_import_custom_sidebars_secret_value', 'mkdf_import_custom_sidebars_secret', false); ?>
									<span class="mkdf-bckp-message"></span>
								</div>
							</div>
							<div class="mkdf-page-form-section mkdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'staffscout') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'staffscout'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="mkdf-page-form-section-holder">
							<h3 class="mkdf-page-section-title"><?php esc_html_e('Export/Import Widgets', 'staffscout'); ?></h3>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<h4><?php esc_html_e('Export', 'staffscout'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'staffscout'); ?></p>
								</div>
								<div class="mkdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control mkdf-form-element" rows="10" readonly><?php echo mkdf_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<h4><?php esc_html_e('Import', 'staffscout'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'staffscout'); ?></p>
								</div>
								<div class="mkdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control mkdf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-page-form-section">
								<div class="mkdf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="mkdf-import-widgets-btn"><?php esc_html_e('Import', 'staffscout'); ?></button>
									<?php wp_nonce_field('mkdf_import_widgets_secret_value', 'mkdf_import_widgets_secret', false); ?>
									<span class="mkdf-bckp-message"></span>
								</div>
							</div>
							<div class="mkdf-page-form-section mkdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'staffscout') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'staffscout'); ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>