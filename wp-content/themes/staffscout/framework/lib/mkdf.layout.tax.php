<?php

/*
   Class: StaffScoutMikadoClassTaxonomyField
   A class that initializes StaffScoutMikadoClass Taxonomy Field
*/
class StaffScoutMikadoClassTaxonomyField implements iStaffScoutMikadoInterfaceRender {
	private $type;
	private $name;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	
	function __construct( $type, $name, $label = "", $description = "", $options = array(), $args = array() ) {
		$this->type        = $type;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$this->options     = $options;
		$this->args        = $args;
		add_filter( 'staffscout_mikado_taxonomy_fields', array( $this, 'addFieldForEditSave' ) );
	}
	
	public function addFieldForEditSave( $names ) {

		//for icon type of field add additonal icon font family based names for saving
		if($this->type == 'icon'){
			$icons_collections = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollectionsKeys();

			foreach ($icons_collections as $icons_collection) {
				$icons_param = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollectionParamNameByKey($icons_collection);
			
				$names[] = $this->name.'_'.$icons_param;
			}
		}
		$names[] = $this->name;
		
		return $names;
	}
	
	public function render( $factory ) {
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args );
	}
}

abstract class StaffScoutMikadoClassTaxonomyFieldType {
	abstract public function render( $name, $label = "", $description = "", $options = array(), $args = array() );
}

class StaffScoutMikadoClassTaxonomyFieldText extends StaffScoutMikadoClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<input type="text" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="">
				<p class="description"><?php echo esc_html( $description ); ?></p>
			</div>
			<?php
		} else {
			$value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
				<td>
					<input type="text" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="<?php echo esc_attr($value) ? esc_attr($value) : ''; ?>">
					<p class="description"><?php echo esc_html( $description ); ?></p>
				</td>
			</tr>
			<?php
		}
	}
}

class StaffScoutMikadoClassTaxonomyFieldImage extends StaffScoutMikadoClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<input type="hidden" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" class="mkdf-tax-custom-media-url" value="">
				<div class="mkdf-tax-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary mkdf-tax-media-add" name="mkdf-tax-media-add" value="<?php esc_html_e( 'Add Image', 'staffscout' ); ?>"/>
					<input type="button" class="button button-secondary mkdf-tax-media-remove" name="mkdf-tax-media-remove" value="<?php esc_html_e( 'Remove Image', 'staffscout' ); ?>"/>
				</p>
			</div>
			<?php
		} else {
			global $taxonomy;
			$image_id = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field">
				<th scope="row">
					<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				</th>
				<td>
					<?php ?>
					<input type="hidden" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="<?php echo esc_attr($image_id); ?>" class="mkdf-tax-custom-media-url">
					<div class="mkdf-tax-image-wrapper">
						<?php if ( $image_id ) { ?>
							<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary mkdf-tax-media-add" name="mkdf-tax-media-add" value="<?php esc_html_e( 'Add Image', 'staffscout' ); ?>"/>
						<input data-termid="<?php echo esc_html( $_GET['tag_ID'] ); ?>" data-taxonomy="<?php echo esc_html( $taxonomy ); ?>" type="button" class="button button-secondary mkdf-tax-media-remove" name="mkdf-tax-media-remove" value="<?php esc_html_e( 'Remove Image', 'staffscout' ); ?>"/>
					</p>
				</td>
			</tr>
			<?php
		}
	}
}

class StaffScoutMikadoClassTaxonomyFieldSelectBlank extends StaffScoutMikadoClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<select name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" >
					<option selected='selected' value=""></option>
					<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
						<option  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
					<?php } ?>
				</select>
				<p class="description"><?php echo esc_html( $description ); ?></p>
			</div>
			<?php
		} else {
			$selected_value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
				<td>
					<select name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" >
						<option <?php if ($selected_value == "") { echo "selected='selected'"; } ?>  value=""></option>
						<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
							<option <?php if ($selected_value == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
						<?php } ?>
					</select>
					<p class="description"><?php echo esc_html( $description ); ?></p>
				</td>
			</tr>
		<?php
		}
	}
}

class StaffScoutMikadoClassTaxonomyFieldIcon extends StaffScoutMikadoClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {

		$options = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollectionsEmpty();
		$icons_collections = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollectionsKeys();

		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<label><?php esc_html_e('Icon Pack', 'staffscout'); ?></label>
				<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="dependence">
					<?php foreach ($options as $option => $key) { ?>
						<option value="<?php echo esc_attr($option); ?>"><?php echo esc_attr($key); ?></option>
					<?php } ?>
				</select>
			</div>
			<?php foreach ($icons_collections as $icons_collection) {
				$icons_param = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollectionParamNameByKey($icons_collection);
				?>
				<div class="form-field mkd-icon-collection-holder" style="display: none"
					 data-icon-collection="<?php echo esc_attr($icons_collection); ?>">
					<label for="<?php echo esc_attr( $name ).'_icon'; ?>"><?php esc_html_e('Icon', 'staffscout'); ?></label>
					<select name="<?php echo esc_attr($name.'_'.$icons_param) ?>"
							id="<?php echo esc_attr($name.'_'.$icons_param) ?>">
						<?php
						$icons = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollection($icons_collection);
						foreach ($icons->icons as $option => $key) { ?>
							<option value="<?php echo esc_attr($option); ?>"><?php echo esc_attr($key); ?></option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>
			<?php
		} else {
			$icon_pack = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field">
				<th scope="row">
					<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
					<label><?php esc_html_e('Icon Pack', 'staffscout'); ?></label>
				</th>
				<td>
					<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="dependence">
						<?php foreach ($options as $option => $key) { ?>
							<option
								value="<?php echo esc_attr($option); ?>" <?php if ($option == $icon_pack) {
								echo 'selected';
							} ?>><?php echo esc_attr($key); ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<?php foreach ($icons_collections as $icons_collection) {
				$icons_param = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollectionParamNameByKey($icons_collection);
				$style = 'display:none';
				if ($icon_pack == $icons_collection) {
					$style = 'display:table-row';
				}
				?>
				<tr class="form-field mkd-icon-collection-holder" style="<?php echo esc_attr($style); ?>"
					data-icon-collection="<?php echo esc_attr($icons_collection); ?>">
					<th scope="row"><?php esc_html_e('Icon', 'staffscout'); ?></th>
					<td>
						<select name="<?php echo esc_attr($name.'_'.$icons_param) ?>"
								id="<?php echo esc_attr($name.'_'.$icons_param) ?>">
							<?php
							$icons = \StaffScoutMikadoClassIconCollections::get_instance()->getIconCollection($icons_collection);
							$activ_icon = get_term_meta($_GET['tag_ID'], $name .'_'. $icons_param, true);
							foreach ($icons->icons as $option => $key) { ?>
								<option value="<?php echo esc_attr($option); ?>" <?php if ($option == $activ_icon) {
									echo 'selected';
								} ?>><?php echo esc_attr($key); ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			<?php } ?>
		<?php
		}
	}
}

class StaffScoutMikadoClassTaxonomyFieldColor extends StaffScoutMikadoClassTaxonomyFieldType {
	public function render( $name, $label="", $description="", $options = array(), $args = array() ) {

		if(!isset( $_GET['tag_ID'])){ ?>
            <div class="form-field">
                <label for="<?php echo esc_html($name); ?>"><?php echo esc_html($label); ?></label>
                <input type="text" name="<?php echo esc_html($name); ?>" id="<?php echo esc_html($name); ?>" value="" class="mkdf-taxonomy-color-field">
                <p class="description"><?php echo esc_html($description); ?></p>
            </div>
			<?php
		}else {
			$value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="<?php echo esc_html($name); ?>"><?php echo esc_html($label); ?></label></th>
                <td>
                    <input type="text" name="<?php echo esc_html($name); ?>" id="<?php echo esc_html($name); ?>" value="<?php echo esc_attr($value) ? esc_attr($value) : ''; ?>" class="mkdf-taxonomy-color-field">
                    <p class="description"><?php echo esc_html($description); ?></p>
                </td>
            </tr>
			<?php
		}
	}
}

class StaffScoutMikadoClassTaxonomyFieldFactory {
	public function render( $field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		
		switch ( strtolower( $field_type ) ) {
			case 'text':
				$field = new StaffScoutMikadoClassTaxonomyFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			
			case 'image':
				$field = new StaffScoutMikadoClassTaxonomyFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
				
			case 'selectblank':
				$field = new StaffScoutMikadoClassTaxonomyFieldSelectBlank();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'icon':
				$field = new StaffScoutMikadoClassTaxonomyFieldIcon();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'color':
				$field = new StaffScoutMikadoClassTaxonomyFieldColor();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			default:
				break;
		}
	}
}
