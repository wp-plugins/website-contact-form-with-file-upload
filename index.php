<?php 

/*
 Plugin Name: N-Media Website Contact Form with File Uploader
Plugin URI: http://www.najeebmedia.com
Description: This plugin is simple website contact form with Awesome File Uploader. Create Unlimited Forms using Meta Manager
Version: 1.3.3
Author: Najeeb Ahmad
Author URI: http://www.najeebmedia.com/
*/


/*
 * Lets start from here
*/

/*
 * loading plugin config file
 */
$_config = dirname(__FILE__).'/config.php';
if( file_exists($_config))
	include_once($_config);
else
	die('Reen, Reen, BUMP! not found '.$_config);


/* ======= the plugin main class =========== */
$_plugin = dirname(__FILE__).'/classes/plugin.class.php';
if( file_exists($_plugin))
	include_once($_plugin);
else
	die('Reen, Reen, BUMP! not found '.$_plugin);

/*
 * [1]
 */
$nmcontact = new NM_WP_ContactForm();


if( is_admin() ){

	$_admin = dirname(__FILE__).'/classes/admin.class.php';
	if( file_exists($_admin))
		include_once($_admin );
	else
		die('file not found! '.$_admin);

	$nmcontact_admin = new NM_WP_ContactForm_Admin();
}


/*
 * activation/install the plugin data
*/
register_activation_hook( __FILE__, array('NM_WP_ContactForm', 'activate_plugin'));
register_deactivation_hook( __FILE__, array('NM_WP_ContactForm', 'deactivate_plugin'));


