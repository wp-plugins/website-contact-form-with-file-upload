<?php
/*
 * this file contains pluing meta information and then shared
 * between pluging and admin classes
 * 
 * [1]
 */

$plugin_dir = 'website-contact-form-with-file-upload';

$plugin_meta		= array('name'			=> 'WebContact',
							'shortname'		=> 'nm_webcontact',
							'path'			=> WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_dir,
							'url'			=> WP_PLUGIN_URL . DIRECTORY_SEPARATOR . $plugin_dir,
							'db_version'	=> 1.3,
							'logo'			=> WP_PLUGIN_URL . DIRECTORY_SEPARATOR . $plugin_dir . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'logo.png',
							'men_position'	=> 60);


function get_plugin_meta(){
	
	global $plugin_meta;
	
	//print_r($plugin_meta);
	
	return $plugin_meta;
}


/*
 * rendering that It is Pro
 */
function nm_webcontact_pro(){
	
	return '<a class="nm_pro" href="#">'.__('It is PRO', 'nm_webcontact').'</a>';
}


function webcontact_pa($arr){
	
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}