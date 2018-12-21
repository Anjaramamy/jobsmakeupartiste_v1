<?php

class StaffScoutMikadoClassLinearIcons implements iStaffScoutMikadoInterfaceIconCollection {

	public $icons;
	public $title;
	public $param;
	public $styleUrl;

	function __construct($title = "", $param = "") {
		$this->icons = array();
		$this->title = $title;
		$this->param = $param;
		$this->setIconsArray();
		$this->styleUrl = MIKADO_ASSETS_ROOT . "/css/linear-icons/style.css";
	}

	private function setIconsArray() {
		$this->icons = array(
			'' => '',
			'lnr-alarm' => 'lnr-alarm',
			'lnr-apartment' => 'lnr-apartment',
			'lnr-arrow-down' => 'lnr-arrow-down',
			'lnr-arrow-down-circle' => 'lnr-arrow-down-circle',
			'lnr-arrow-left' => 'lnr-arrow-left',
			'lnr-arrow-left-circle' => 'lnr-arrow-left-circle',
			'lnr-arrow-right' => 'lnr-arrow-right',
			'lnr-arrow-right-circle' => 'lnr-arrow-right-circle',
			'lnr-arrow-up' => 'lnr-arrow-up',
			'lnr-arrow-up-circle' => 'lnr-arrow-up-circle',
			'lnr-bicycle' => 'lnr-bicycle',
			'lnr-bold' => 'lnr-bold',
			'lnr-book' => 'lnr-book',
			'lnr-bookmark' => 'lnr-bookmark',
			'lnr-briefcase' => 'lnr-briefcase',
			'lnr-bubble' => 'lnr-bubble',
			'lnr-bug' => 'lnr-bug',
			'lnr-bullhorn' => 'lnr-bullhorn',
			'lnr-bus' => 'lnr-bus',
			'lnr-calendar-full' => 'lnr-calendar-full',
			'lnr-camera' => 'lnr-camera',
			'lnr-camera-video' => 'lnr-camera-video',
			'lnr-car' => 'lnr-car',
			'lnr-cart' => 'lnr-cart',
			'lnr-chart-bars' => 'lnr-chart-bars',
			'lnr-checkmark-circle' => 'lnr-checkmark-circle',
			'lnr-chevron-down' => 'lnr-chevron-down',
			'lnr-chevron-down-circle' => 'lnr-chevron-down-circle',
			'lnr-chevron-left' => 'lnr-chevron-left',
			'lnr-chevron-left-circle' => 'lnr-chevron-left-circle',
			'lnr-chevron-right' => 'lnr-chevron-right',
			'lnr-chevron-right-circle' => 'lnr-chevron-right-circle',
			'lnr-chevron-up' => 'lnr-chevron-up',
			'lnr-chevron-up-circle' => 'lnr-chevron-up-circle',
			'lnr-circle-minus' => 'lnr-circle-minus',
			'lnr-clock' => 'lnr-clock',
			'lnr-cloud' => 'lnr-cloud',
			'lnr-cloud-check' => 'lnr-cloud-check',
			'lnr-cloud-download' => 'lnr-cloud-download',
			'lnr-cloud-sync' => 'lnr-cloud-sync',
			'lnr-cloud-upload' => 'lnr-cloud-upload',
			'lnr-code' => 'lnr-code',
			'lnr-coffee-cup' => 'lnr-coffee-cup',
			'lnr-cog' => 'lnr-cog',
			'lnr-construction' => 'lnr-construction',
			'lnr-crop' => 'lnr-crop',
			'lnr-cross' => 'lnr-cross',
			'lnr-cross-circle' => 'lnr-cross-circle',
			'lnr-database' => 'lnr-database',
			'lnr-diamond' => 'lnr-diamond',
			'lnr-dice' => 'lnr-dice',
			'lnr-dinner' => 'lnr-dinner',
			'lnr-direction-ltr' => 'lnr-direction-ltr',
			'lnr-direction-rtl' => 'lnr-direction-rtl',
			'lnr-download' => 'lnr-download',
			'lnr-drop' => 'lnr-drop',
			'lnr-earth' => 'lnr-earth',
			'lnr-enter' => 'lnr-enter',
			'lnr-enter-down' => 'lnr-enter-down',
			'lnr-envelope' => 'lnr-envelope',
			'lnr-exit' => 'lnr-exit',
			'lnr-exit-up' => 'lnr-exit-up',
			'lnr-eye' => 'lnr-eye',
			'lnr-file-add' => 'lnr-file-add',
			'lnr-file-empty' => 'lnr-file-empty',
			'lnr-film-play' => 'lnr-film-play',
			'lnr-flag' => 'lnr-flag',
			'lnr-frame-contract' => 'lnr-frame-contract',
			'lnr-frame-expand' => 'lnr-frame-expand',
			'lnr-funnel' => 'lnr-funnel',
			'lnr-gift' => 'lnr-gift',
			'lnr-graduation-hat' => 'lnr-graduation-hat',
			'lnr-hand' => 'lnr-hand',
			'lnr-heart' => 'lnr-heart',
			'lnr-heart-pulse' => 'lnr-heart-pulse',
			'lnr-highlight' => 'lnr-highlight',
			'lnr-history' => 'lnr-history',
			'lnr-home' => 'lnr-home',
			'lnr-hourglass' => 'lnr-hourglass',
			'lnr-inbox' => 'lnr-inbox',
			'lnr-indent-decrease' => 'lnr-indent-decrease',
			'lnr-indent-increase' => 'lnr-indent-increase',
			'lnr-italic' => 'lnr-italic',
			'lnr-keyboard' => 'lnr-keyboard',
			'lnr-laptop' => 'lnr-laptop',
			'lnr-laptop-phone' => 'lnr-laptop-phone',
			'lnr-layers' => 'lnr-layers',
			'lnr-leaf' => 'lnr-leaf',
			'lnr-license' => 'lnr-license',
			'lnr-lighter' => 'lnr-lighter',
			'lnr-line-spacing' => 'lnr-line-spacing',
			'lnr-linearicons' => 'lnr-linearicons',
			'lnr-link' => 'lnr-link',
			'lnr-list' => 'lnr-list',
			'lnr-location' => 'lnr-location',
			'lnr-lock' => 'lnr-lock',
			'lnr-magic-wand' => 'lnr-magic-wand',
			'lnr-magnifier' => 'lnr-magnifier',
			'lnr-map' => 'lnr-map',
			'lnr-map-marker' => 'lnr-map-marker',
			'lnr-menu' => 'lnr-menu',
			'lnr-menu-circle' => 'lnr-menu-circle',
			'lnr-mic' => 'lnr-mic',
			'lnr-moon' => 'lnr-moon',
			'lnr-move' => 'lnr-move',
			'lnr-music-note' => 'lnr-music-note',
			'lnr-mustache' => 'lnr-mustache',
			'lnr-neutral' => 'lnr-neutral',
			'lnr-page-break' => 'lnr-page-break',
			'lnr-paperclip' => 'lnr-paperclip',
			'lnr-paw' => 'lnr-paw',
			'lnr-pencil' => 'lnr-pencil',
			'lnr-phone' => 'lnr-phone',
			'lnr-phone-handset' => 'lnr-phone-handset',
			'lnr-picture' => 'lnr-picture',
			'lnr-pie-chart' => 'lnr-pie-chart',
			'lnr-pilcrow' => 'lnr-pilcrow',
			'lnr-plus-circle' => 'lnr-plus-circle',
			'lnr-pointer-down' => 'lnr-pointer-down',
			'lnr-pointer-left' => 'lnr-pointer-left',
			'lnr-pointer-right' => 'lnr-pointer-right',
			'lnr-pointer-up' => 'lnr-pointer-up',
			'lnr-poop' => 'lnr-poop',
			'lnr-power-switch' => 'lnr-power-switch',
			'lnr-printer' => 'lnr-printer',
			'lnr-pushpin' => 'lnr-pushpin',
			'lnr-question-circle' => 'lnr-question-circle',
			'lnr-redo' => 'lnr-redo',
			'lnr-rocket' => 'lnr-rocket',
			'lnr-sad' => 'lnr-sad',
			'lnr-screen' => 'lnr-screen',
			'lnr-select' => 'lnr-select',
			'lnr-shirt' => 'lnr-shirt',
			'lnr-smartphone' => 'lnr-smartphone',
			'lnr-smile' => 'lnr-smile',
			'lnr-sort-alpha-asc' => 'lnr-sort-alpha-asc',
			'lnr-sort-amount-asc' => 'lnr-sort-amount-asc',
			'lnr-spell-check' => 'lnr-spell-check',
			'lnr-star' => 'lnr-star',
			'lnr-star-empty' => 'lnr-star-empty',
			'lnr-star-half' => 'lnr-star-half',
			'lnr-store' => 'lnr-store',
			'lnr-strikethrough' => 'lnr-strikethrough',
			'lnr-sun' => 'lnr-sun',
			'lnr-sync' => 'lnr-sync',
			'lnr-tablet' => 'lnr-tablet',
			'lnr-tag' => 'lnr-tag',
			'lnr-text-align-center' => 'lnr-text-align-center',
			'lnr-text-align-justify' => 'lnr-text-align-justify',
			'lnr-text-align-left' => 'lnr-text-align-left',
			'lnr-text-align-right' => 'lnr-text-align-right',
			'lnr-text-format' => 'lnr-text-format',
			'lnr-text-format-remove' => 'lnr-text-format-remove',
			'lnr-text-size' => 'lnr-text-size',
			'lnr-thumbs-down' => 'lnr-thumbs-down',
			'lnr-thumbs-up' => 'lnr-thumbs-up',
			'lnr-train' => 'lnr-train',
			'lnr-trash' => 'lnr-trash',
			'lnr-underline' => 'lnr-underline',
			'lnr-undo' => 'lnr-undo',
			'lnr-unlink' => 'lnr-unlink',
			'lnr-upload' => 'lnr-upload',
			'lnr-user' => 'lnr-user',
			'lnr-users' => 'lnr-users',
			'lnr-volume' => 'lnr-volume',
			'lnr-volume-high' => 'lnr-volume-high',
			'lnr-volume-low' => 'lnr-volume-low',
			'lnr-volume-medium' => 'lnr-volume-medium',
			'lnr-warning' => 'lnr-warning',
			'lnr-wheelchair' => 'lnr-wheelchair'
		);
	}

	/**
	 * Checks if icon collection has social icons
	 * @return mixed
	 */
	public function hasSocialIcons() {
		return false;
	}

	public function getIconsArray() {
		return $this->icons;
	}


	public function render($icon, $params = array()) {
		$html = '';
		extract($params);
		$iconAttributesString = '';
		$iconClass = '';
		if (isset($icon_attributes) && count($icon_attributes)) {
			foreach ($icon_attributes as $icon_attr_name => $icon_attr_val) {
				if ($icon_attr_name === 'class') {
					$iconClass = $icon_attr_val;
					unset($icon_attributes[$icon_attr_name]);
				} else {
					$iconAttributesString .= $icon_attr_name . '="' . $icon_attr_val . '" ';
				}
			}
		}

		if (isset($before_icon) && $before_icon !== '') {
			$beforeIconAttrString = '';
			if (isset($before_icon_attributes) && count($before_icon_attributes)) {
				foreach ($before_icon_attributes as $before_icon_attr_name => $before_icon_attr_val) {
					$beforeIconAttrString .= $before_icon_attr_name . '="' . $before_icon_attr_val . '" ';
				}
			}

			$html .= '<' . $before_icon . ' ' . $beforeIconAttrString . '>';
		}

		$html .= '<span aria-hidden="true" class="mkdf-icon-linear-icons lnr ' . $icon . ' ' . $iconClass . '" ' . $iconAttributesString . '></span>';

		if (isset($before_icon) && $before_icon !== '') {
			$html .= '</' . $before_icon . '>';
		}

		return $html;
	}

	public function getSearchIcon() {

		return $this->render('lnr-magnifier');
	}

	public function getSearchClose() {

		return $this->render('lnr-cross');
	}

	public function getMenuSideIcon() {

		return $this->render('lnr-menu');
	}

	public function getBackToTopIcon() {

		return $this->render('lnr-arrow-up');
	}

	public function getMobileMenuIcon() {

		return $this->render('lnr-menu');
	}

}
