<?php
/*
 * this file contains pluing meta information and then shared
 * between pluging and admin classes
 * 
 * [1]
 */

$plugin_dir = 'website-contact-form-with-file-upload';

$plugin_meta		= array('name'			=> 'NM Website Contact',
							'shortname'		=> 'nm_webcontact',
							'path'			=> WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_dir,
							'url'			=> WP_PLUGIN_URL . DIRECTORY_SEPARATOR . $plugin_dir,
							'db_version'	=> 1.1,
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
	
	echo '<strong><a style="background: rgb(219, 89, 83);color: #fff;padding: 5px;text-decoration: none;" href="http://www.najeebmedia.com/n-media-website-contact-form-with-file-uploader/">'.__('GET PRO', 'nm_webcontact').'</a></strong>';
}