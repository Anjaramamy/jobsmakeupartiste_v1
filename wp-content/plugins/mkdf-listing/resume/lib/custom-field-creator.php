<?php
namespace MikadoResume\Lib;
class CustomFieldCreator{
	public function __construct() {}
	public function render(){ ?>
		<tr class="form-field term-description-wrap">
			<th>
				<h2>
					<?php echo esc_html_e('Custom Field Creator' , 'mkdf-listing'); ?>
				</h2>
			</th>
			<td class="mkdf-custom-field-wrapper-outer">

				<div class="mkdf-taxonomy-add-custom-field">
					<a class="mkdf-add-custom-field" data-type="text"><?php esc_html_e('Text','mkdf-listing') ?></a>
				</div>
				<div class="mkdf-taxonomy-add-custom-field">
					<a class="mkdf-add-custom-field" data-type="textarea"><?php esc_html_e('Textarea','mkdf-listing') ?></a>
				</div>
				<div class="mkdf-taxonomy-add-custom-field">
					<a class="mkdf-add-custom-field" data-type="select"><?php esc_html_e('Select','mkdf-listing') ?></a>
				</div>
				<div class="mkdf-taxonomy-add-custom-field">
					<a class="mkdf-add-custom-field" data-type="checkbox"><?php esc_html_e('Checkbox','mkdf-listing') ?></a>
				</div>

			</td>

		</tr>

	<?php }
}

class CustomFieldText{

	private $name;
	private $default_value;
	private $id;

	public function __construct( $name = '', $default_value = '', $id){
		$this->name = $name;
		$this->default_value = $default_value;
		$this->id = $id;
	}

	public function render(){ ?>

		<tr class="form-field term-description-wrap custom-term-row">
			<th>
				<label><?php esc_html_e('Text field','mkdf-listing') ?></label>
			</th>
			<td class="form-field term-description-wrap-inner custom-term-row-inner">
				<div class="mkdf-custom-field-wrapper mkdf-custom-text-field">

					<div class="mkdf-custom-field-inner">
						<h3><?php esc_html_e('Text field','mkdf-listing') ?></h3>
						<div class="mkdf-custom-field-title">

							<label for="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]">
								<?php esc_html_e('Title','mkdf-listing'); ?>
							</label>

							<input type="text" name="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]" value="<?php echo esc_attr($this->name); ?>"/>

						</div>

						<div class="mkdf-custom-field-default-value">

							<label for="mkdf_listing_resume_custom_field_default_value[<?php echo esc_attr($this->id); ?>]">
								<?php esc_html_e('Default value','mkdf-listing'); ?>
							</label>

							<input type="text" name="mkdf_listing_resume_custom_field_default_value[<?php echo esc_attr($this->id); ?>]" value="<?php echo esc_attr($this->default_value); ?>"/>

						</div>

					</div>
					<?php do_action('mkdf_listing_resume_action_delete_custom_row'); ?>
					<?php do_action('mkdf_listing_resume_action_expand_custom_row'); ?>
					<input type="hidden" value="text_<?php echo esc_attr($this->id); ?>" name="mkdf_listing_resume_custom_field_taxonomy_type[]">
				</div>
			</td>

		</tr>

	<?php }

}
class CustomFieldSelect{

	private $name;
	private $default_value;
	private $option_labels;
	private $option_values;
	private $id;

	public function __construct( $name = '', $default_value = '', $option_labels = array(), $option_values = array(), $id ){

		$this->name = $name;
		$this->default_value = $default_value;
		$this->option_labels = $option_labels;
		$this->option_values = $option_values;
		$this->id = $id;

	}

	public function render(){ ?>

		<tr class="form-field term-description-wrap custom-term-row">
			<th>
				<label>
                    <?php esc_html_e('Select field','mkdf-listing') ?>
                </label>
			</th>

			<td class="form-field term-description-wrap-inner custom-term-row-inner">

				<div class="mkdf-custom-field-wrapper mkdf-custom-select-field" data-select-field-id = "<?php echo esc_attr($this->id); ?>">

					<div class="mkdf-custom-field-inner">

						<div class="mkdf-custom-field-title">
							<label for="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]">
								<?php esc_html_e('Title','mkdf-listing'); ?>
							</label>
							<input type="text" name="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]" value="<?php echo esc_attr($this->name); ?>"/>
						</div>

						<div class="mkdf-custom-select-field-option-holder" >
							<h4>
								<?php esc_html_e('Options','mkdf-listing'); ?>
							</h4>
							<div class="mkdf-custom-select-field-option-wrapper">

								<?php
								//check if are set repeater options and list them
								if(is_array($this->option_values) && count($this->option_values)){
									for($i=0 ; $i < count($this->option_values); $i++){
										$option_builder = new CustomOptionField($this->option_values[$i],$this->option_labels[$i],$this->id);
										$option_builder->render();
									}
								}?>

							</div>
							<?php do_action('mkdf_listing_resume_action_add_repeater_option_trigger');?>

						</div>
					</div>
					<?php
                        do_action('mkdf_listing_resume_action_delete_custom_row');
                        do_action('mkdf_listing_resume_action_expand_custom_row');
					?>
					<input type="hidden" value="select_<?php echo esc_attr($this->id); ?>" name="mkdf_listing_resume_custom_field_taxonomy_type[]">
				</div>
			</td>
		</tr>
	<?php }
}

class CustomOptionField{

	private $label;
	private $name;
	private $id;

	public function __construct($name = '', $label = '', $id) {

		$this->label = $label;
		$this->name = $name;
		$this->id = $id;

	}

	public function render(){?>

		<div class="mkdf-option-repeater-field-row clearfix">

			<div class="mkdf-option-repeater-field-row-inner">
				<label for="mkdf_listing_resume_repeater_option_label[<?php echo esc_attr($this->id); ?>][]"><?php esc_html_e('Label(*)', 'mkdf-listing') ?></label>
				<input type="text" name="mkdf_listing_resume_repeater_option_label[<?php echo esc_attr($this->id); ?>][]" value="<?php echo esc_attr($this->label) ?>"/>
			</div>

			<div class="mkdf-option-repeater-field-row-inner">
				<?php
					do_action('mkdf_listing_resume_action_delete_repeater_option_trigger');
				?>
			</div>

		</div>

	<?php }

}
class CustomFieldTextArea{

	private $name;
	private $default_value;
	private $id;

	public function __construct( $name = '', $default_value = '', $id){
		$this->name = $name;
		$this->default_value = $default_value;
		$this->id = $id;
	}

	public function render(){ ?>

		<tr class="form-field term-description-wrap custom-term-row">
			<th>
				<label>
                    <?php esc_html_e('Textarea field','mkdf-listing') ?>
                </label>
			</th>

			<td class="form-field term-description-wrap-inner custom-term-row-inner">
				<div class="mkdf-custom-field-wrapper mkdf-custom-text-field">

					<div class="mkdf-custom-field-inner">
						<div class="mkdf-custom-field-title">

							<label for="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]">
								<?php esc_html_e('Title','mkdf-listing'); ?>
							</label>

							<input type="text" name="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]" value="<?php echo esc_attr($this->name); ?>"/>

						</div>

						<div class="mkdf-custom-field-default-value">

							<label for="mkdf_listing_resume_custom_field_default_value[<?php echo esc_attr($this->id); ?>]">
								<?php esc_html_e('Default value','mkdf-listing'); ?>
							</label>

							<textarea name="mkdf_listing_resume_custom_field_default_value[<?php echo esc_attr($this->id); ?>]"><?php echo esc_attr($this->default_value); ?></textarea>

						</div>

					</div>
					<?php
                        do_action('mkdf_listing_resume_action_delete_custom_row');
                        do_action('mkdf_listing_resume_action_expand_custom_row');
                     ?>
					<input type="hidden" value="textarea_<?php echo esc_attr($this->id); ?>" name="mkdf_listing_resume_custom_field_taxonomy_type[]">
				</div>
			</td>

		</tr>

	<?php }

}

class CustomFieldCheckBox{

	private $name;
	private $id;

	public function __construct( $name = '', $id){
		$this->name = $name;
		$this->id = $id;
	}

	public function render(){ ?>

		<tr class="form-field term-description-wrap custom-term-row">
			<th>
				<label><?php esc_html_e('Checkbox field','mkdf-listing') ?></label>
			</th>
			<td class="form-field term-description-wrap-inner custom-term-row-inner">
				<div class="mkdf-custom-field-wrapper mkdf-custom-text-field">

					<div class="mkdf-custom-field-inner">
						<div class="mkdf-custom-field-title">

							<label for="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]">
								<?php esc_html_e('Title','mkdf-listing'); ?>
							</label>

							<input type="text" name="mkdf_listing_resume_custom_field_title[<?php echo esc_attr($this->id); ?>]" value="<?php echo esc_attr($this->name); ?>"/>

						</div>

					</div>
					<?php do_action('mkdf_listing_resume_action_delete_custom_row'); ?>
					<?php do_action('mkdf_listing_resume_action_expand_custom_row'); ?>
					<input type="hidden" value="checkbox_<?php echo esc_attr($this->id); ?>" name="mkdf_listing_resume_custom_field_taxonomy_type[]">
				</div>
			</td>

		</tr>

	<?php }

}