<?php

function mkdf_core_import_object(){
	$mkdf_core_import_object = new MikadofCoreImport();
}

add_action('init', 'mkdf_core_import_object');

if(!function_exists('mkdf_core_data_import')){
    function mkdf_core_data_import(){
		$importObject = MikadofCoreImport::getInstance();

        if ($_POST['import_attachments'] == 1)
			$importObject->attachments = true;
        else
            $importObject->attachments = false;

        $folder = "staffscout/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

		$importObject->import_content($folder.$_POST['xml']);

        die();
    }

    add_action('wp_ajax_mkdf_core_data_import', 'mkdf_core_data_import');
}

if(!function_exists('mkdf_core_widgets_import')){
    function mkdf_core_widgets_import(){
		$importObject = MikadofCoreImport::getInstance();

        $folder = "staffscout/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

		$importObject->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');

        die();
    }

    add_action('wp_ajax_mkdf_core_widgets_import', 'mkdf_core_widgets_import');
}

if(!function_exists('mkdf_core_options_import')){
    function mkdf_core_options_import(){
		$importObject = MikadofCoreImport::getInstance();

        $folder = "staffscout/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

		$importObject->import_options($folder.'options.txt');

		die();
    }

    add_action('wp_ajax_mkdf_core_options_import', 'mkdf_core_options_import');
}

if(!function_exists('mkdf_core_other_import')){
    function mkdf_core_other_import(){
		$importObject = MikadofCoreImport::getInstance();

        $folder = "staffscout/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

		$importObject->import_options($folder.'options.txt');
		$importObject->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');
		$importObject->import_menus($folder.'menus.txt');
		$importObject->import_settings_pages($folder.'settingpages.txt');

		if(mkdf_core_is_revolution_slider_installed()){
			$importObject->rev_slider_import($folder);
		}

        die();
    }

    add_action('wp_ajax_mkdf_core_other_import', 'mkdf_core_other_import');
}
