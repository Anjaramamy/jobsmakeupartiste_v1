<?php

class StaffScoutMikadoClassFieldPortfolioFollow extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "portfolio_single_follow") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "portfolio_single_no_follow") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_portfoliofollow" value="portfolio_single_follow"<?php if (staffscout_mikado_option_get_value($name) == "portfolio_single_follow") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_portfoliofollow" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldZeroOne extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "1") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "0") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_zeroone" value="1"<?php if (staffscout_mikado_option_get_value($name) == "1") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_zeroone" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldImageVideo extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>
		
		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch switch-type">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "image") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Image', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "video") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Video', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_imagevideo" value="image"<?php if (staffscout_mikado_option_get_value($name) == "image") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_imagevideo" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldYesEmpty extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_yesempty" value="yes"<?php if (staffscout_mikado_option_get_value($name) == "yes") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_yesempty" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldFlagPage extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "page") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagpage" value="page"<?php if (staffscout_mikado_option_get_value($name) == "page") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpage" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldFlagPost extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "post") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagpost" value="post"<?php if (staffscout_mikado_option_get_value($name) == "post") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpost" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldFlagMedia extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "attachment") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagmedia" value="attachment"<?php if (staffscout_mikado_option_get_value($name) == "attachment") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagmedia" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldFlagPortfolio extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "portfolio_page") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagportfolio" value="portfolio_page"<?php if (staffscout_mikado_option_get_value($name) == "portfolio_page") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagportfolio" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldFlagProduct extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		
		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}
		
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"])) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}
		
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"])) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (staffscout_mikado_option_get_value($name) == "product") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'staffscout') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (staffscout_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'staffscout') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagproduct" value="product"<?php if (staffscout_mikado_option_get_value($name) == "product") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagproduct" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldRange extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$range_min = 0;
		$range_max = 1;
		$range_step = 0.01;
		$range_decimals = 2;
		if(isset($args["range_min"])) {
			$range_min = $args["range_min"];
		}
		
		if(isset($args["range_max"])) {
			$range_max = $args["range_max"];
		}
		
		if(isset($args["range_step"])) {
			$range_step = $args["range_step"];
		}
		
		if(isset($args["range_decimals"])) {
			$range_decimals = $args["range_decimals"];
		}
		?>

		<div class="mkdf-page-form-section">
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="mkdf-slider-range-wrapper">
								<div class="form-inline">
									<input type="text" class="form-control mkdf-form-element mkdf-form-element-xsmall pull-left mkdf-slider-range-value" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
									<div class="mkdf-slider-range small" data-step="<?php echo esc_attr($range_step); ?>" data-min="<?php echo esc_attr($range_min); ?>" data-max="<?php echo esc_attr($range_max); ?>" data-decimals="<?php echo esc_attr($range_decimals); ?>" data-start="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldRangeSimple extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {	?>

		<div class="col-lg-3" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-slider-range-wrapper">
				<div class="form-inline">
					<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
					<input type="text" class="form-control mkdf-form-element mkdf-form-element-xxsmall pull-left mkdf-slider-range-value" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"/>
					<div class="mkdf-slider-range xsmall" data-step="0.01" data-max="1" data-start="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>"></div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldRadio extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

        $checked = $value = "";
        $value_saved = staffscout_mikado_option_has_value($name);
        if($value_saved) {
            $value = staffscout_mikado_option_get_value($name);
            $checked = $value == 'yes' ? "checked" : "";
        }
		
		$html = '<input type="radio" name="'.$name.'" value="'.$value.'" '.$checked.' /> '.$label.'<br />';
		echo wp_kses($html, array(
			'input' => array(
				'type' => true,
				'name' => true,
				'value' => true,
				'checked' => true
			),
			'br' => true
		));
	}
}

class StaffScoutMikadoClassFieldRadioGroup extends StaffScoutMikadoClassFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        $dependence = isset($args["dependence"]) && $args["dependence"] ? true : false;
        $show = !empty($args["show"]) ? $args["show"] : array();
        $hide = !empty($args["hide"]) ? $args["hide"] : array();

        $use_images = isset($args["use_images"]) && $args["use_images"] ? true : false;
        $hide_labels = isset($args["hide_labels"]) && $args["hide_labels"] ? true : false;
        $hide_radios = $use_images ? 'display: none' : '';
        $checked_value = staffscout_mikado_option_get_value($name);
        ?>

        <div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <div class="mkdf-field-desc">
                <h4><?php echo esc_html($label); ?></h4>
                <p><?php echo esc_html($description); ?></p>
            </div>
            <div class="mkdf-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(is_array($options) && count($options)) { ?>
                                <div class="mkdf-radio-group-holder <?php if($use_images) echo "with-images"; ?>">
                                    <?php foreach($options as $key => $atts) {
                                        $selected = false;
                                        if($checked_value == $key) {
                                            $selected = true;
                                        }

                                        $show_val = "";
                                        $hide_val = "";
                                        if($dependence) {
                                            if(array_key_exists($key, $show)) {
                                                $show_val = $show[$key];
                                            }

                                            if(array_key_exists($key, $hide)) {
                                                $hide_val = $hide[$key];
                                            }
                                        }
                                    ?>
                                        <label class="radio-inline">
                                            <input <?php echo staffscout_mikado_get_inline_attr($show_val, 'data-show'); ?> <?php echo staffscout_mikado_get_inline_attr($hide_val, 'data-hide'); ?>
                                                <?php if($selected) echo "checked"; ?> <?php staffscout_mikado_inline_style($hide_radios); ?>
                                                type="radio" name="<?php echo esc_attr($name);  ?>" value="<?php echo esc_attr($key); ?>"
                                                <?php if($dependence) staffscout_mikado_class_attribute("dependence"); ?>> <?php if(!empty($atts["label"]) && !$hide_labels) echo esc_attr($atts["label"]); ?>

                                            <?php if($use_images) { ?>
                                                <img title="<?php if(!empty($atts["label"])) echo esc_attr($atts["label"]); ?>" src="<?php echo esc_url($atts['image']); ?>" alt="<?php echo esc_attr("$key image") ?>"/>
                                            <?php } ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

class StaffScoutMikadoClassFieldCheckBoxGroup extends StaffScoutMikadoClassFieldType {

    public function render($name, $label = '', $description = '', $options = array(), $args = array(), $hidden = false) {
        if(!(is_array($options) && count($options))) {
            return;
        }

        $dependence = isset($args["dependence"]) && $args["dependence"] ? true : false;
        $show = !empty($args["show"]) ? $args["show"] : array();

        $saved_value = staffscout_mikado_option_get_value($name);

        ?>

        <div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <div class="mkdf-field-desc">
                <h4><?php echo esc_html($label); ?></h4>
                <p><?php echo esc_html($description); ?></p>
            </div>
            <div class="mkdf-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mkdf-checkbox-group-holder">
                                <div class="checkbox-inline" style="display: none">
                                    <label>
                                        <input checked type="checkbox" value="" name="<?php echo esc_attr($name.'[]'); ?>">
                                    </label>
                                </div>
                                <?php foreach($options as $option_key => $option_label) : ?>
                                    <?php
                                    if($option_label !== ''){
                                        $i = 1;
                                        $checked = is_array($saved_value) && in_array($option_key, $saved_value);
                                        $checked_attr = $checked ? 'checked' : '';

                                        $show_val = "";
                                        if($dependence) {
                                            if(array_key_exists($option_key, $show)) {
                                                $show_val = $show[$option_key];
                                            }
                                        }
                                        ?>
                                        <div class="checkbox-inline">
                                            <label>
                                                <input <?php echo staffscout_mikado_get_inline_attr($show_val, 'data-show'); ?>
                                                    <?php echo esc_attr($checked_attr); ?> type="checkbox"
                                                                                           id="<?php echo esc_attr($option_key).'-'.$i; ?>"
                                                                                           value="<?php echo esc_attr($option_key); ?>" name="<?php echo esc_attr($name.'[]'); ?>"
                                                    <?php if($dependence) staffscout_mikado_class_attribute("dependence multiselect"); ?>>
                                                <label for="<?php echo esc_attr($option_key).'-'.$i; ?>"><?php echo esc_html($option_label); ?></label>
                                            </label>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

class StaffScoutMikadoClassFieldCheckBox extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

        $checked = "";

        if ('1' === staffscout_mikado_option_get_value($name)){
            $checked = "checked";
        }

        $html = '<div class ="mkdf-page-form-section">';
        $html .= '<div class="mkdf-section-content">';
        $html .= '<div class="container-fluid">';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-3">';
        $html .= '<input id="' . $name . '" class="mkdf-single-checkbox-field" type="checkbox" name="' . $name . '" value="1" ' . $checked . ' />';
        $html .= '<label for="' . $name . '"> ' . $label . '</label><br />';
        $html .= '<input class="mkdf-checkbox-single-hidden" type="hidden" name="' . $name . '" value="0"/>';
        $html .= '</div>'; //close col-lg-3
        $html .= '</div>'; //close row
        $html .= '</div>'; //close container-fluid
        $html .= '</div>'; //close mkdf-section-content
        $html .= '</div>'; //close mkdf-page-form-section

        echo wp_kses($html, array(
            'input' => array(
                'type' => true,
                'id'    => true,
                'name' => true,
                'value' => true,
                'checked' => true,
                'class'   => true,
                'disabled' => true
            ),
            'div' => array(
                'class' => true
            ),
            'br' => true,
            'label' => array(
                'for'=>true
            )
        ));
	}
}

class StaffScoutMikadoClassFieldDate extends StaffScoutMikadoClassFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$col_width = 2;
		if(isset($args["col_width"]))
			$col_width = $args["col_width"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>
				<p><?php echo esc_html($description); ?></p>
			</div>
			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr($col_width); ?>">
							<input type="text" id="portfolio_date" class="datepicker form-control mkdf-input mkdf-form-element" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(staffscout_mikado_option_get_value($name)); ?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class StaffScoutMikadoClassFieldFile extends StaffScoutMikadoClassFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        $value = staffscout_mikado_option_get_value($name);
        $has_value = staffscout_mikado_option_has_value($name);
        ?>

        <div class="mkdf-page-form-section">


            <div class="mkdf-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkdf-field-desc -->

            <div class="mkdf-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mkdf-media-uploader">
                                <div<?php if (!$has_value) { ?> style="display: none"<?php } ?>
                                    class="mkdf-media-image-holder">
                                    <img src="<?php if ($has_value) { echo esc_url(staffscout_mikado_option_get_uploaded_file_icon($value)); } ?>" alt=""
                                         class="mkdf-media-image img-thumbnail"/>
                                    <?php if ($has_value) { ?> <h4 class="mkdf-media-title"><?php echo staffscout_mikado_option_get_uploaded_file_title($value) ?></h4> <?php } ?>
                                </div>
                                <div style="display: none"
                                     class="mkdf-media-meta-fields">
                                    <input type="hidden" class="mkdf-media-upload-url"
                                           name="<?php echo esc_attr($name); ?>"
                                           value="<?php echo esc_attr($value); ?>"/>
                                </div>
                                <a class="mkdf-media-upload-btn btn btn-sm btn-primary"
                                   href="javascript:void(0)"
                                   data-frame-title="<?php esc_html_e('Select File', 'staffscout'); ?>"
                                   data-frame-button-text="<?php esc_html_e('Select File', 'staffscout'); ?>"><?php esc_html_e('Upload', 'staffscout'); ?></a>
                                <a style="display: none;" href="javascript: void(0)"
                                   class="mkdf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'staffscout'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkdf-section-content -->

        </div>
        <?php

    }

}

class StaffScoutMikadoClassFieldFactory {

	public function render( $field_type, $name, $label="", $description="", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		
		switch ( strtolower( $field_type ) ) {

			case 'text':
				$field = new StaffScoutMikadoClassFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'textsimple':
				$field = new StaffScoutMikadoClassFieldTextSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'textarea':
				$field = new StaffScoutMikadoClassFieldTextArea();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'textareasimple':
				$field = new StaffScoutMikadoClassFieldTextAreaSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'textareahtml':
				$field = new StaffScoutMikadoClassFieldTextAreaHtml();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'color':
				$field = new StaffScoutMikadoClassFieldColor();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'colorsimple':
				$field = new StaffScoutMikadoClassFieldColorSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'image':
				$field = new StaffScoutMikadoClassFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
            case 'imagesimple':
				$field = new StaffScoutMikadoClassFieldImageSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'font':
				$field = new StaffScoutMikadoClassFieldFont();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'fontsimple':
				$field = new StaffScoutMikadoClassFieldFontSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'select':
				$field = new StaffScoutMikadoClassFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'selectblank':
				$field = new StaffScoutMikadoClassFieldSelectBlank();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'selectsimple':
				$field = new StaffScoutMikadoClassFieldSelectSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'selectblanksimple':
				$field = new StaffScoutMikadoClassFieldSelectBlankSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'yesno':
				$field = new StaffScoutMikadoClassFieldYesNo();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'yesnosimple':
				$field = new StaffScoutMikadoClassFieldYesNoSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'onoff':
				$field = new StaffScoutMikadoClassFieldOnOff();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'portfoliofollow':
				$field = new StaffScoutMikadoClassFieldPortfolioFollow();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'zeroone':
				$field = new StaffScoutMikadoClassFieldZeroOne();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'imagevideo':
				$field = new StaffScoutMikadoClassFieldImageVideo();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'yesempty':
				$field = new StaffScoutMikadoClassFieldYesEmpty();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
            case 'file':
                $field = new StaffScoutMikadoClassFieldFile();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;
			case 'flagpost':
				$field = new StaffScoutMikadoClassFieldFlagPost();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagpage':
				$field = new StaffScoutMikadoClassFieldFlagPage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagmedia':
				$field = new StaffScoutMikadoClassFieldFlagMedia();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagportfolio':
				$field = new StaffScoutMikadoClassFieldFlagPortfolio();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagproduct':
				$field = new StaffScoutMikadoClassFieldFlagProduct();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'range':
				$field = new StaffScoutMikadoClassFieldRange();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'rangesimple':
				$field = new StaffScoutMikadoClassFieldRangeSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'radio':
				$field = new StaffScoutMikadoClassFieldRadio();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'checkbox':
				$field = new StaffScoutMikadoClassFieldCheckBox();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'date':
				$field = new StaffScoutMikadoClassFieldDate();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
            case 'radiogroup':
                $field = new StaffScoutMikadoClassFieldRadioGroup();
                $field->render( $name, $label, $description, $options, $args, $hidden );
                break;
            case 'checkboxgroup':
                $field = new StaffScoutMikadoClassFieldCheckBoxGroup();
                $field->render( $name, $label, $description, $options, $args, $hidden );
                break;    
			default:
				break;
		}
	}
}