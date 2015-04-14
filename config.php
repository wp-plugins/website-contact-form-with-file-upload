<?php
/*
 * this file contains pluing meta information and then shared
 * between pluging and admin classes
 * 
 * [1]
 */

$plugin_dir = 'website-contact-form-with-file-upload';

$plugin_meta		= array('name'			=> 'WebContact',
		'dir_name'		=> $plugin_dir,
		'shortname'		=> 'nm_webcontact',
		'path'			=> WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_dir,
		'url'			=> plugins_url( $plugin_dir , dirname(__FILE__) ),
		'db_version'	=> 3.0,
		'logo'			=> plugins_url( $plugin_dir.'/images/logo.png' , dirname(__FILE__) ),
		'men_position'	=> 62);


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