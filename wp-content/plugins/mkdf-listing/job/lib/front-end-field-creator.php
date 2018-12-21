<?php
namespace MikadoListing\Lib\Front;
class ListingTypeFieldCreator
{

    private $id;
    private $post_id;
    private $categories;
    private $custom_fields;

    public function __construct($type_id, $post_id = '') {

        $this->id = $type_id;
        $this->post_id = $post_id;
        $this->categories = $this->getCategories();
        $this->types = $this->getTypes();
        $this->custom_fields = $this->getTypeCustomFields();

    }

    private function getCategories() {
        return mkdf_listing_job_get_listing_categories_array();
    }

    private function getTypes() {
        return mkdf_listing_job_get_listing_types_array();
    }

    private function getTypeCustomFields() {
        return mkdf_listing_job_get_listing_type_custom_fields($this->id);
    }

    private function getTypeTitle() {
        $type = mkdf_listing_job_get_listing_type_by_id($this->id);
        return esc_html__('Listing Type', 'mkdf-listing') . ' "' . esc_attr($type->name) . '"';
    }

    private function contentFlag() {
        $flag = false;
        if ((is_array($this->categories) && count($this->categories)) || (is_array($this->custom_fields) && count($this->custom_fields))) {
            $flag = true;
        }
        return $flag;
    }

    public function renderListingFormFields() {
        ?>

        <div id="<?php echo esc_attr($this->id) ?>" class="mkdf-ls-type-field-wrapper"
             data-ls-type-id="mkdf-ls-type-field-wrapper-<?php echo esc_attr($this->id) ?>">
            <?php if ($this->contentFlag()) { ?>
                <h3>
                    <?php echo esc_attr($this->getTypeTitle()); ?>
                </h3>
            <?php }
            $this->renderCategoryField();
            $this->renderCustomFields();
            ?>
        </div>

    <?php }

    public function getAdvSearchHtml() {
        $html = '';
        return $html;
    }

    public function getSearchTypes() {
        $html = '';

        $html .= $this->renderTypeField('search');

        return $html;
    }

    private function renderTypeField($html_type = '') {

        if (is_array($this->types) && count($this->types)) {

            new FrontFieldCheckBoxGroup('job_listing_type', '', $this->types, $html_type);

        }
    }

    public function getSingleListingCategoryField() {
        return $this->renderCategoryField('single');
    }

    public function getSingleListingCustomFields() {
        return $this->renderCustomFields('single');
    }

    private function renderCategoryField($html_type = '') {

        if (is_array($this->categories) && count($this->categories)) { ?>

            <h4 class="mkdf-listing-field-holder-title">
                <?php esc_html_e('Categories', 'mkdf-listing'); ?>
            </h4>

            <?php
            $saved_value = '';
            if ($this->post_id !== '') {
                $saved_value = get_post_meta($this->post_id, 'mkdf_listing_job_type_categories', true);
            }
            new FrontFieldSelect('job_type_categories', '', $this->categories, $html_type, $saved_value);
        }

    }

    private function renderCustomFields($html_type = '') {

        if (is_array($this->custom_fields) && count($this->custom_fields)) { ?>
            <h4 class="mkdf-listing-field-holder-title">
                <?php esc_html_e('Custom Fields', 'mkdf-listing'); ?>
            </h4>
            <?php foreach ($this->custom_fields as $custom_field) {
                $options = array();
                if ($custom_field['field_type'] === 'select') {
                    $options = mkdf_listing_job_get_listing_type_options_array($custom_field);
                }
                $saved_value = '';
                if ($this->post_id !== '') {
                    $saved_value = get_post_meta($this->post_id, $custom_field['meta_key'], true);
                }
                switch ($custom_field['field_type']) {

                    case 'text' :
                        new FrontFieldText($custom_field['meta_key'], $custom_field['title'], $html_type, $saved_value);
                        break;
                    case 'textarea' :
                        new FrontFieldTextArea($custom_field['meta_key'], $custom_field['title'], $html_type, $saved_value);
                        break;
                    case 'select' :
                        new FrontFieldSelect($custom_field['meta_key'], $custom_field['title'], $options, $html_type, $saved_value);
                        break;
                    case 'checkbox' :
                        new FrontFieldCheckBox($custom_field['meta_key'], $custom_field['title'], $html_type, false, $saved_value);
                        break;

                }
            }
        }
    }

    private function renderSubmitButton() {

        echo staffscout_mikado_get_button_html(array(
            'size'         => 'medium',
            'type'         => 'solid',
            'custom_class' => 'mkdf-adv-search-submit',
            'text'         => esc_html__('Filter Results', 'mkdf-listing'),
            'html_type'    => 'button',
            'fullwidth'    => 'yes'
        ));

    }

}

class FrontFieldCheckBoxGroup
{


    private $name;
    private $label;
    private $options;
    private $html_type;
    private $value;

    public function __construct($name, $label, $options, $html_type, $value = '') {

        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->html_type = $html_type;
        $this->value = $value;

        switch ($html_type) {
            case 'search':
                $this->renderAdvSearchHtml();
                break;
            case 'single':
                $this->renderSingleListingHtml();
                break;
            default:
                $this->renderListingFieldHtml();
                break;
        }

    }

    private function renderListingFieldHtml() {

        if (!(is_array($this->options) && count($this->options))) {
            return;
        }
        ?>

        <fieldset class="fieldset-<?php echo esc_attr($this->name); ?>">

            <div class="field">
                <input style="display: none" checked type="checkbox" value=""
                       name="<?php echo esc_attr($this->name . '[]'); ?>">
                <?php
                foreach ($this->options as $option_key => $option_label) {
                    $checked = is_array($this->value) && in_array($option_key, $this->value);
                    $checked_attr = $checked ? 'checked' : ''; ?>

                    <div class="checkbox-inline mkdf-ls-checkbox-field">

                        <input type="checkbox" <?php echo esc_attr($checked_attr); ?>
                               value="<?php echo esc_attr($option_key); ?>"
                               name="<?php echo esc_attr($this->name . '[]'); ?>"/>

                        <label class="mkdf-checkbox-label" for="<?php echo esc_attr($option_key); ?>">
                            <span class="mkdf-label-view"></span>
                            <span class="mkdf-label-text">
                                <?php echo esc_html($option_label); ?>
                            </span>
                        </label>

                    </div>

                <?php } ?>
            </div>
        </fieldset>

    <?php }

    private function renderAdvSearchHtml() { ?>

        <div class="mkdf-ls-adv-search-field-wrapper">
            <?php foreach ($this->options as $option_key => $option_label) { ?>

                <div class="mkdf-ls-adv-search-field checkbox">

                    <input type="checkbox" id="<?php echo esc_attr($option_key); ?>" class="mkdf-ls-adv-search-input"
                           value="<?php echo esc_attr($option_key); ?>" name="<?php echo esc_attr($this->name); ?>"/>
                    <label for="<?php echo esc_attr($option_key); ?>">

                        <span class="mkdf-label-view"></span>
						<span class="mkdf-label-text">
							<?php echo esc_html($option_label); ?>
						</span>

                    </label>
                </div>

            <?php } ?>
        </div>
    <?php }

    private function renderSingleListingHtml() {

        if (is_array($this->value) && count($this->value)) {
            ?>

            <div class="mkdf-listing-single-field">

                <label for="<?php echo esc_attr($this->name); ?>">
                    <?php echo esc_attr($this->label); ?>
                </label>

                <div class="value">

                    <?php foreach ($this->value as $item_key => $item_value) {
                        if ($item_value !== '') {
                            $term = get_term_by('slug', $item_value, 'job_listing_category');
                            ?>
                            <a href="<?php echo get_term_link($item_value, 'job_listing_category') ?>">
							<span>
								<?php echo esc_attr($term->name); ?>
							</span>
                            </a>
                        <?php }
                    } ?>
                </div>
            </div>
        <?php }
    }

}

class FrontFieldSelect
{

    private $name;
    private $label;
    private $options;
    private $html_type;
    private $value;

    public function __construct($name, $label, $options, $html_type, $value = '') {

        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->html_type = $html_type;
        $this->value = $value;

        switch ($html_type) {
            case 'search':
                $this->renderAdvSearchHtml();
                break;
            case 'single':
                $this->renderSingleListingHtml();
                break;
            default:
                $this->renderListingFieldHtml();
                break;
        }

    }

    private function renderListingFieldHtml() { ?>

        <fieldset class="fieldset-<?php echo esc_attr($this->name); ?>">

            <label for="<?php echo esc_attr($this->name); ?>">

                <?php echo esc_attr($this->label); ?>
                <small>
                    <?php esc_html_e('(optional)', 'mkdf-listing') ?>
                </small>

            </label>

            <div class="field">
                <select name="<?php echo esc_attr($this->name); ?>" id="<?php echo esc_attr($this->name); ?>">

                    <?php
                    foreach ($this->options as $option_key => $option_value) {
                        $selected = '';
                        if ($this->value == $option_key) {
                            $selected = 'selected';
                        }
                        ?>
                        <option  <?php echo esc_attr($selected); ?> value="<?php echo esc_attr($option_key); ?>">
                            <?php echo esc_html($option_value); ?>
                        </option>

                    <?php } ?>

                </select>
            </div>
        </fieldset>
    <?php }

    private function renderAdvSearchHtml() { ?>

        <div class="mkdf-ls-adv-search-field select">

            <label for="<?php echo esc_attr($this->name); ?>">
                <?php echo esc_attr($this->label); ?>
            </label>

            <select class="mkdf-ls-adv-search-input" name="<?php echo esc_attr($this->name); ?>">
                <option value=""></option>
                <?php foreach ($this->options as $option_key => $option_value) { ?>
                    <option value="<?php echo esc_attr($option_key); ?>">
                        <?php echo esc_html($option_value); ?>
                    </option>
                <?php } ?>

            </select>
        </div>

    <?php }

    private function renderSingleListingHtml() {

        if ($this->value !== '') { ?>
            <div class="mkdf-listing-single-field">
                <label for="<?php echo esc_attr($this->name); ?>">
                    <?php echo esc_attr($this->label); ?>
                </label>
				<span class="value">
					<?php echo esc_attr($this->value); ?>
				</span>
            </div>
        <?php }
    }
}

class FrontFieldText
{

    private $name;
    private $label;
    private $html_type;
    private $value;

    public function __construct($name, $label, $html_type, $value = '') {

        $this->name = $name;
        $this->label = $label;
        $this->html_type = $html_type;
        $this->value = $value;

        switch ($html_type) {
            case 'search':
                $this->renderAdvSearchHtml();
                break;
            case 'single':
                $this->renderSingleListingHtml();
                break;
            default:
                $this->renderListingFieldHtml();
                break;
        }
    }

    private function renderListingFieldHtml() { ?>

        <fieldset class="fieldset-<?php echo esc_attr($this->name); ?>">

            <label for="<?php echo esc_attr($this->name); ?>">

                <?php echo esc_attr($this->label); ?>
                <small>
                    <?php esc_html_e('(optional)', 'mkdf-listing') ?>
                </small>

            </label>

            <div class="field">
                <input type="text" name="<?php echo esc_attr($this->name); ?>"
                       value="<?php echo esc_attr(htmlspecialchars($this->value)); ?>"/>
            </div>

        </fieldset>

    <?php }

    private function renderAdvSearchHtml() { ?>

        <div class="mkdf-ls-adv-search-field">

            <label for="<?php echo esc_attr($this->name); ?>">
                <?php echo esc_attr($this->label); ?>
            </label>

            <input type="text" name="<?php echo esc_attr($this->name); ?>" class="mkdf-ls-adv-search-input"/>

        </div>

    <?php }

    private function renderSingleListingHtml() {

        if ($this->value !== '') { ?>

            <div class="mkdf-listing-single-field text">

                <label for="<?php echo esc_attr($this->name); ?>">
                    <?php echo esc_attr($this->label); ?>
                </label>

				<span class="value">
					<?php echo esc_attr($this->value); ?>
				</span>

            </div>
        <?php }
    }
}

class FrontFieldTextArea
{

    private $name;
    private $label;
    private $html_type;
    private $value;

    public function __construct($name, $label, $html_type, $value = '') {

        $this->name = $name;
        $this->label = $label;
        $this->html_type = $html_type;
        $this->value = $value;

        switch ($html_type) {
            case 'search':
                $this->renderAdvSearchHtml();
                break;
            case 'single':
                $this->renderSingleListingHtml();
                break;
            default:
                $this->renderListingFieldHtml();
                break;
        }

    }

    private function renderListingFieldHtml() { ?>

        <fieldset class="fieldset-<?php echo esc_attr($this->name); ?>">

            <label for="<?php echo esc_attr($this->name); ?>">
                <?php echo esc_attr($this->label); ?>
                <small>
                    <?php esc_html_e('(optional)', 'mkdf-listing') ?>
                </small>
            </label>

            <div class="field">
				<textarea name="<?php echo esc_attr($this->name); ?>" rows="5">
					<?php echo esc_html(htmlspecialchars($this->value)); ?>
				</textarea>
            </div>
        </fieldset>

    <?php }

    private function renderAdvSearchHtml() { ?>

        <div class="mkdf-ls-adv-search-field textarea">

            <label for="<?php echo esc_attr($this->name); ?>">
                <?php echo esc_attr($this->label); ?>
            </label>

            <textarea name="<?php echo esc_attr($this->name); ?>" rows="5" class="mkdf-ls-adv-search-input"></textarea>
        </div>
    <?php }

    private function renderSingleListingHtml() {

        if ($this->value !== '') { ?>

            <div class="mkdf-listing-single-field">

                <label for="<?php echo esc_attr($this->name); ?>">
                    <?php echo esc_attr($this->label); ?>
                </label>

				<span class="value">
					<?php echo esc_attr($this->value); ?>
				</span>

            </div>

        <?php }
    }
}

class FrontFieldCheckBox
{

    private $name;
    private $label;
    private $html_type;
    private $value;
    private $icon_pack;
    private $icon;

    public function __construct($name, $label, $html_type, $value = '', $icon_pack = '', $icon = '') {

        $this->name = $name;
        $this->label = $label;
        $this->html_type = $html_type;
        $this->value = $value;
        $this->icon_pack = $icon_pack;
        $this->icon = $icon;

        switch ($this->html_type) {
            case 'search':
                $this->renderAdvSearchHtml();
                break;
            case 'archive_search_html':
                $this->renderArchiveSearchHtml();
                break;
            case 'single':
                $this->renderSingleListingHtml();
                break;
            default:
                $this->renderListingFieldHtml();
                break;
        }

    }

    private function renderListingFieldHtml() {
        $checked = "";

        if ('1' == $this->value) {
            $checked = "checked";
        }
        ?>

        <fieldset class="fieldset-<?php echo esc_attr($this->name); ?>">

            <div class="field mkdf-ls-checkbox-field">
                <input type="checkbox" <?php echo esc_attr($checked); ?> name="<?php echo esc_attr($this->name); ?>"/>

                <label class="mkdf-checkbox-label">
                    <span class="mkdf-label-view"></span>
					<span class="mkdf-label-text">
						<?php echo esc_html($this->label); ?>
					</span>
                </label>
            </div>
        </fieldset>
    <?php }

    private function renderSingleListingHtml() {
        if ($this->value === '1') { ?>

            <div class="mkdf-listing-single-field">
                <div class="mkdf-listing-single-field-inner mkdf-ls-icon">
                    <?php
                    echo staffscout_mikado_icon_collections()->renderIcon($this->icon, $this->icon_pack);
                    ?>
                </div>
                <div class="mkdf-listing-single-field-inner mkdf-ls-text">
                    <?php echo esc_attr($this->label); ?>
                </div>
            </div>

        <?php }
    }
}