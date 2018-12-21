<?php

include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.iconcollection.interface.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.fontawesome.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.fontelegant.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.ionicons.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.lineaicons.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.linearicons.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.simplelineicons.php";
include MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.icons/mkdf.dripicons.php";

/*
  Class: StaffScoutMikadoClassIconCollections
  A class that initializes Mikado Icon Collections
 */

class StaffScoutMikadoClassIconCollections
{

    private static $instance;
    public $iconCollections;
    public $VCParamsArray;
    public $iconPackParamName;

    private function __construct() {
        $this->iconPackParamName = 'icon_pack';
        $this->initIconCollections();
    }

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Method that adds individual collections to set of collections
     */
    private function initIconCollections() {
        $this->addIconCollection('font_awesome', new StaffScoutMikadoClassIconsFontAwesome("Font Awesome", "fa_icon"));
        $this->addIconCollection('font_elegant', new StaffScoutMikadoClassIconsFontElegant("Font Elegant", "fe_icon"));
        $this->addIconCollection('ion_icons', new StaffScoutMikadoClassIonIcons("Ion Icons", "ion_icon"));
        $this->addIconCollection('linea_icons', new StaffScoutMikadoClassLineaIcons('Linea Icons', 'linea_icon'));
        $this->addIconCollection('linear_icons', new StaffScoutMikadoClassLinearIcons('Linear Icons', 'linear_icon'));
        $this->addIconCollection('simple_line_icons', new StaffScoutMikadoClassSimpleLineIcons('Simple Line Icons', 'simple_line_icon'));
        $this->addIconCollection('dripicons', new StaffScoutMikadoClassDripicons('Dripicons', 'dripicon'));
    }

    public function getIconsMetaBoxOrOption($attributes) {
        $scope = '';
        $label = '';
        $parent = '';
        $name = '';
        $defaul_icon_pack = '';
        $default_icon = '';
        $type = '';
        $field_type = '';

        extract($attributes);

        $icon_hide_array = array();
        $icon_show_array = array();

        $icon_collections = $this->getCollectionsWithSocialIcons();
        $icon_collection_params = $this->getSocialIconCollectionsParams();
        if ($scope == 'regular') {
            $icon_collections = $this->getCollectionsWithIcons();
            $icon_collection_params = $this->getIconCollectionsParams();
        }

        foreach ($icon_collections as $dep_collection_key => $dep_collection_object) {
            $icon_hide_array[$dep_collection_key] = '';
            $icon_show_array[$dep_collection_key] = '#mkdf_' . $name . '_' . $dep_collection_object->param . '_container';

            foreach ($icon_collection_params as $icon_collection_param) {
                if ($icon_collection_param !== $dep_collection_object->param) {
                    $icon_hide_array[$dep_collection_key] .= '#mkdf_' . $name . '_' . $icon_collection_param . '_container,';
                }
            }

            $icon_hide_array[$dep_collection_key] = rtrim($icon_hide_array[$dep_collection_key], ',');
        }

        $options = array(
            'font_awesome'      => esc_html__('Font Awesome', 'staffscout'),
            'font_elegant'      => esc_html__('Font Elegant', 'staffscout'),
            'ion_icons'         => esc_html__('Ion Icons', 'staffscout'),
            'simple_line_icons' => esc_html__('Simple Line Icons', 'staffscout'),

        );
        if ($scope == 'regular') {
            $options = array(
                'font_awesome'      => esc_html__('Font Awesome', 'staffscout'),
                'font_elegant'      => esc_html__('Font Elegant', 'staffscout'),
                'ion_icons'         => esc_html__('Ion Icons', 'staffscout'),
                'linea_icons'       => esc_html__('Linea Icons', 'staffscout'),
                'linear_icons'      => esc_html__('Linear Icons', 'staffscout'),
                'simple_line_icons' => esc_html__('Simple Line Icons', 'staffscout'),
                'dripicons'         => esc_html__('Dripicons', 'staffscout')
            );
        }

        if ($type == 'meta-box') {
            staffscout_mikado_add_meta_box_field(
                array(
                    'parent'        => $parent,
                    'type'          => 'select' . $field_type,
                    'name'          => $name,
                    'default_value' => $defaul_icon_pack,
                    'label'         => $label,
                    'options'       => $options,
                    'args'          => array(
                        'dependence' => true,
                        'hide'       => $icon_hide_array,
                        'show'       => $icon_show_array
                    )
                )
            );
        } else if ($type == 'option') {
            staffscout_mikado_add_admin_field(
                array(
                    'parent'        => $parent,
                    'type'          => 'select' . $field_type,
                    'name'          => $name,
                    'default_value' => $defaul_icon_pack,
                    'label'         => $label,
                    'options'       => $options,
                    'args'          => array(
                        'dependence' => true,
                        'hide'       => $icon_hide_array,
                        'show'       => $icon_show_array
                    )
                )
            );
        }

        foreach ($icon_collections as $collection_key => $collection_object) {
            if ($scope == 'regular') {
                $icons_array = $collection_object->getIconsArray();
            } else {
                $icons_array = $collection_object->getSocialIconsArray();
            }

            $icon_collections_keys = array_keys($icon_collections);

            unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

            $mkd_icon_hide_values = $icon_collections_keys;

            $mkd_icon_pack_container = staffscout_mikado_add_admin_container(
                array(
                    'parent'          => $parent,
                    'name'            => $name . '_' . $collection_object->param . '_container',
                    'hidden_property' => $name,
                    'hidden_value'    => '',
                    'hidden_values'   => $mkd_icon_hide_values,
                    'simple'          => $field_type == 'simple' ? true : false
                )
            );

            if ($type == 'meta-box') {
                staffscout_mikado_add_meta_box_field(
                    array(
                        'parent'        => $mkd_icon_pack_container,
                        'type'          => 'select' . $field_type,
                        'name'          => $name . '_' . $collection_object->param,
                        'default_value' => $default_icon,
                        'label'         => $collection_object->title,
                        'options'       => $icons_array
                    )
                );
            } else if ($type == 'option') {
                staffscout_mikado_add_admin_field(
                    array(
                        'parent'        => $mkd_icon_pack_container,
                        'type'          => 'select' . $field_type,
                        'name'          => $name . '_' . $collection_object->param,
                        'default_value' => $default_icon,
                        'label'         => $collection_object->title,
                        'options'       => $icons_array
                    )
                );
            }
        }
    }

    public function getVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false) {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmpty();
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVC();
        }

        $iconPackParams = array(
            'type'        => 'dropdown',
            'heading'     => esc_html__('Icon Pack', 'staffscout'),
            'param_name'  => $this->iconPackParamName,
            'value'       => $iconCollectionsVC,
            'save_always' => true
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Icon', 'staffscout'),
                    'param_name'  => $iconCollectionPrefix . $collection->param,
                    'value'       => $collection->getIconsArray(),
                    'dependency'  => array('element' => $this->iconPackParamName, 'value' => array($key)),
                    'save_always' => true
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getSocialVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false, $exclude = '') {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmptyExclude($exclude);
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVCExclude($exclude);
        }

        $iconPackParams = array(
            'type'        => 'dropdown',
            'heading'     => esc_html__('Icon Pack', 'staffscout'),
            'param_name'  => $this->iconPackParamName,
            'value'       => $iconCollectionsVC,
            'save_always' => true
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconCollections = $this->iconCollections;
        if (is_array($exclude) && count($exclude)) {
            foreach ($exclude as $exclude_key) {
                if (array_key_exists($exclude_key, $this->iconCollections)) {
                    unset($iconCollections[$exclude_key]);
                }
            }
        } else {
            if (array_key_exists($exclude, $this->iconCollections)) {
                unset($iconCollections[$exclude]);
            }
        }

        $iconSetParams = array();
        if (is_array($iconCollections) && count($iconCollections)) {
            foreach ($iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Icon', 'staffscout'),
                    'param_name'  => $iconCollectionPrefix . $collection->param,
                    'value'       => $collection->getSocialIconsArrayVC(),
                    'dependency'  => array('element' => $this->iconPackParamName, 'value' => array($key)),
                    'save_always' => true
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getIconWidgetParamsArray() {

        $iconPackParams[] = array(
            'type'    => 'dropdown',
            'title'   => esc_html__('Icon Pack', 'staffscout'),
            'name'    => 'icon_pack',
            'options' => array(
                'font_awesome'      => esc_html__('Font Awesome', 'staffscout'),
                'font_elegant'      => esc_html__('Font Elegant', 'staffscout'),
                'ion_icons'         => esc_html__('Ion Icons', 'staffscout'),
                'linea_icons'       => esc_html__('Linea Icons', 'staffscout'),
                'linear_icons'      => esc_html__('Linear Icons', 'staffscout'),
                'simple_line_icons' => esc_html__('Simple Line Icons', 'staffscout'),
                'dripicons'         => esc_html__('Dripicons', 'staffscout')
            )
        );

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    'type'    => 'dropdown',
                    'title'   => $collection->title . ' Icon',
                    'name'    => $collection->param,
                    'options' => array_flip($collection->getIconsArray())
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getSocialIconWidgetParamsArray() {
        $iconCollectionsVC = $this->getCollectionsWithSocialIcons();

        $iconPackParams[] = array(
            'type'    => 'dropdown',
            'title'   => esc_html__('Icon Pack', 'staffscout'),
            'name'    => 'icon_pack',
            'options' => array(
                'font_awesome'      => esc_html__('Font Awesome', 'staffscout'),
                'font_elegant'      => esc_html__('Font Elegant', 'staffscout'),
                'ion_icons'         => esc_html__('Ion Icons', 'staffscout'),
                'simple_line_icons' => esc_html__('Simple Line Icons', 'staffscout')
            )
        );

        $iconSetParams = array();
        if (is_array($iconCollectionsVC) && count($iconCollectionsVC)) {
            foreach ($iconCollectionsVC as $key => $collection) {
                $iconSetParams[] = array(
                    'type'    => 'dropdown',
                    'title'   => $collection->title . ' Icon',
                    'name'    => $collection->param,
                    'options' => array_flip($collection->getSocialIconsArrayVC())
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getCollectionsWithIcons() {
        $collectionsWithIcons = array();

        foreach ($this->iconCollections as $key => $collection) {
            $collectionsWithIcons[$key] = $collection;
        }

        return $collectionsWithIcons;
    }

    public function getCollectionsWithSocialIcons() {
        $collectionsWithSocial = array();

        foreach ($this->iconCollections as $key => $collection) {
            if ($collection->hasSocialIcons()) {
                $collectionsWithSocial[$key] = $collection;
            }
        }

        return $collectionsWithSocial;
    }

    public function getIconSizesArray() {
        return array(
            "Tiny"       => "fa-lg",
            "Small"      => "fa-2x",
            "Medium"     => "fa-3x",
            "Large"      => "fa-4x",
            "Very Large" => "fa-5x"
        );
    }

    public function getIconSizeClass($iconSize) {
        switch ($iconSize) {
            case "fa-lg":
                $iconSize = "mkdf-tiny-icon";
                break;
            case "fa-2x":
                $iconSize = "mkdf-small-icon";
                break;
            case "fa-3x":
                $iconSize = "mkdf-medium-icon";
                break;
            case "fa-4x":
                $iconSize = "mkdf-large-icon";
                break;
            case "fa-5x":
                $iconSize = "mkdf-huge-icon";
                break;
            default:
                $iconSize = "mkdf-small-icon";
        }

        return $iconSize;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function getIconCollectionParamNameByKey($key) {
        $collection = $this->getIconCollection($key);

        if ($collection) {
            return $collection->param;
        }

        return false;
    }

    public function getShortcodeParams($iconCollectionPrefix = "") {
        $iconCollectionsParam = array();
        foreach ($this->iconCollections as $key => $collection) {
            $iconCollectionsParam[$iconCollectionPrefix . $collection->param] = '';
        }

        return array_merge(array($this->iconPackParamName => '',), $iconCollectionsParam);
    }

    public function addIconCollection($key, $value) {
        $this->iconCollections[$key] = $value;
    }

    public function getIconCollection($key) {
        if (array_key_exists($key, $this->iconCollections)) {
            return $this->iconCollections[$key];
        }

        return false;
    }

    public function getIconCollectionIcons(iStaffScoutMikadoInterfaceIconCollection $collection) {
        return $collection->getIconsArray();
    }

    public function getIconCollectionsVC() {
        $vc_array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }

        return $vc_array;
    }

    public function getIconCollectionsVCExclude($exclude) {
        $array = $this->getIconCollectionsVC();

        if (is_array($exclude) && count($exclude)) {
            foreach ($exclude as $key) {
                if (($x = array_search($key, $array)) !== false) {
                    unset($array[$x]);
                }
            }

        } else {
            if (($x = array_search($exclude, $array)) !== false) {
                unset($array[$x]);
            }
        }

        return $array;
    }

    public function getIconCollectionsKeys() {
        return array_keys($this->iconCollections);
    }

    /**
     * Method that returns an array of 'param' attribute of each icon collection
     * @return array array of param attributes
     */
    public function getIconCollectionsParams() {
        $paramArray = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $obj) {
                $paramArray[] = $obj->param;
            }
        }

        return $paramArray;
    }

    /**
     * Method that returns an array of 'param' attribute of each icon collection with social icons
     * @return array array of param attributes
     */
    public function getSocialIconCollectionsParams() {
        $paramArray = array();
        if (is_array($this->getCollectionsWithSocialIcons()) && count($this->getCollectionsWithSocialIcons())) {
            foreach ($this->getCollectionsWithSocialIcons() as $key => $obj) {
                $paramArray[] = $obj->param;
            }
        }
        return $paramArray;
    }

    public function getIconCollections() {
        $array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }

        return $array;
    }

    public function getIconCollectionsEmpty($no_empty_key = "") {
        $array = array();
        $array[$no_empty_key] = "No Icon";
        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }

        return $array;
    }

    public function getIconCollectionsVCEmpty() {
        $vc_array = array();
        $vc_array["No Icon"] = "";
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }

        return $vc_array;
    }

    public function getIconCollectionsVCEmptyExclude($key) {
        $array = $this->getIconCollectionsVCEmpty();
        if (($x = array_search($key, $array)) !== false) {
            unset($array[$x]);
        }

        return $array;
    }

    public function getIconCollectionsExclude($exclude) {
        $array = $this->getIconCollections();

        if (is_array($exclude) && count($exclude)) {
            foreach ($exclude as $exclude_key) {
                if (array_key_exists($exclude_key, $array)) {
                    unset($array[$exclude_key]);
                }
            }
        } else {
            if (array_key_exists($exclude, $array)) {
                unset($array[$exclude]);
            }
        }

        return $array;
    }

    public function hasIconCollection($key) {
        return array_key_exists($key, $this->iconCollections);
    }

    /**
     * Method that renders icon for given icon pack
     *
     * @param icon to render
     * @param icon pack to render icon from
     * @param parameters for icon
     *
     * @return mixed
     */
    public function renderIcon($icon, $iconPack, $params = array()) {
        if ($this->hasIconCollection($iconPack)) {
            $iconObject = $this->getIconCollection($iconPack);
            return $iconObject->render($icon, $params);
        }
    }

    public function enqueueStyles() {
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $collection_key => $collection_obj) {
                wp_enqueue_style('mkdf_' . $collection_key, $collection_obj->styleUrl);
            }
        }
    }

    # HEADER AND SIDE MENU ICONS
    public function getSearchIcon($iconPack, $return) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getSearchIcon();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    public function getSearchClose($iconPack, $return) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getSearchClose();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    public function getMenuSideIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getMenuSideIcon();

            echo wp_kses_post($iconHTML);
        }
    }

    public function getBackToTopIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getBackToTopIcon();

            echo wp_kses_post($iconHTML);
        }
    }

    public function getMobileMenuIcon($iconPack, $return = false) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getMobileMenuIcon();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    public function getQuoteIcon($iconPack, $return = false) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);
            $iconHTML = $iconsObject->getQuoteIcon();

            if ($return) {
                return $iconHTML;
            } else {
                echo wp_kses_post($iconHTML);
            }
        }
    }

    # SOCIAL SIDEBAR ICONS
    public function getFacebookIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getFacebookIcon();
        }
    }

    public function getTwitterIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getTwitterIcon();
        }
    }

    public function getGooglePlusIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getGooglePlusIcon();
        }
    }

    public function getLinkedInIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getLinkedInIcon();
        }
    }

    public function getTumblrIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getTumblrIcon();
        }
    }

    public function getPinterestIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getPinterestIcon();
        }
    }

    public function getVKIcon($iconPack) {
        if ($this->hasIconCollection($iconPack)) {
            $iconsObject = $this->getIconCollection($iconPack);

            return $iconsObject->getVKIcon();
        }
    }
}

if (!function_exists('staffscout_mikado_activate_theme_icons')) {
    function staffscout_mikado_activate_theme_icons() {
        global $theme_name_php_global_IconCollections;
        $theme_name_php_global_IconCollections = StaffScoutMikadoClassIconCollections::get_instance();
    }

    add_action('after_setup_theme', 'staffscout_mikado_activate_theme_icons');
}