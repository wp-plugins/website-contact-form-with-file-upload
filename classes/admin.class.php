<?php
/*
 * working behind the seen
*/


class NM_WP_ContactForm_Admin extends NM_WP_ContactForm{


	var $menu_pages, $plugin_scripts_admin, $plugin_settings;


	function __construct(){


		//setting plugin meta saved in config.php
		$this -> plugin_meta = get_plugin_meta();

		//getting saved settings
		$this -> plugin_settings = get_option($this->plugin_meta['shortname'].'_settings');


		/*
		 * [1]
		* TODO: change this for plugin admin pages
		*/
		$this -> menu_pages		= array(array('page_title'	=> $this->plugin_meta['name'],
				'menu_title'	=> $this->plugin_meta['name'],
				'cap'			=> 'edit_plugins',
				'slug'			=> $this->plugin_meta['shortname'],
				'callback'		=> 'main_settings',
				'parent_slug'		=> '',),
				array('page_title'	=> 'Create Forms',
						'menu_title'	=> 'CreateForms',
						'cap'			=> 'edit_plugins',
						'slug'			=> 'nm-create-form',
						'callback'		=> 'set_meta',
						'parent_slug'		=> $this->plugin_meta['shortname']),
		);


		/*
		 * [2]
		* TODO: Change this for admin related scripts
		* JS scripts and styles to loaded
		* ADMIN
		*/
		$this -> plugin_scripts_admin =  array(array(	'script_name'	=> 'scripts-global',
				'script_source'	=> '/js/nm-global.js',
				'localized'		=> false,
				'type'			=> 'js',
				'page_slug'		=> $this->plugin_meta['shortname']
		),
				array(	'script_name'	=> 'scripts-admin',
						'script_source'	=> '/js/admin.js',
						'localized'		=> true,
						'type'			=> 'js',
						'page_slug'		=> array($this->plugin_meta['shortname'], 'nm-create-form'),
				),
				array(	'script_name'	=> 'tabs',
						'script_source'	=> '/js/easytabs/jquery.easytabs.js',
						'localized'		=> false,
						'type'			=> 'js',
						'page_slug'		=> $this->plugin_meta['shortname']
							
				),
				array(	'script_name'	=> 'tabs-css',
						'script_source'	=> '/js/easytabs/tabs.css',
						'localized'		=> false,
						'type'			=> 'style',
						'page_slug'		=> $this->plugin_meta['shortname']
				),
					
		);


		add_action('admin_menu', array($this, 'add_menu_pages'));
	}

	function load_scripts_admin(){

		//localized vars in js
		$arrLocalizedVars = array(	'plugin_url' 		=> $this -> plugin_meta['url'],
									'doing'				=> $this->plugin_meta['url'].'/images/loading.gif',
		);

		//admin end scripts

		if($this -> plugin_scripts_admin){
			foreach($this -> plugin_scripts_admin as $script){

				//checking if it is style
				if( $script['type'] == 'js'){
					wp_enqueue_script($this -> plugin_meta['shortname'].'-'.$script['script_name'], $this -> plugin_meta['url'].$script['script_source'], __FILE__);

					//if localized
					if( $script['localized'] )
						wp_localize_script( $this -> plugin_meta['shortname'].'-'.$script['script_name'], $this -> plugin_meta['shortname'].'_vars', $arrLocalizedVars);
				}else{

					wp_enqueue_style($this -> plugin_meta['shortname'].'-'.$script['script_name'], $this -> plugin_meta['url'].$script['script_source'], __FILE__);
				}
			}
		}

	}



	/*
	 * creating menu page for this plugin
	*/

	function add_menu_pages(){

		foreach ($this -> menu_pages as $page){
				
			if ($page['parent_slug'] == ''){

				$menu = add_menu_page(__($page['page_title'].' Settings', $this->plugin_meta['shortname']),
						__($page['menu_title'].' Settings', $this->plugin_meta['shortname']),
						$page['cap'],
						$page['slug'],
						array($this, $page['callback']),
						$this->plugin_meta['logo'],
						$this->plugin_meta['menu_position']);
			}else{

				$menu = add_submenu_page($page['parent_slug'],
						__($page['page_title'].' Settings', $this->plugin_meta['shortname']),
						__($page['menu_title'].' Settings', $this->plugin_meta['shortname']),
						$page['cap'],
						$page['slug'],
						array($this, $page['callback'])
				);

			}
				
			//loading script for only plugin optios pages
			// page_slug is key in $plugin_scripts_admin which determine the page
			foreach ($this -> plugin_scripts_admin as $script){

				if (is_array($script['page_slug'])){
					
					if (in_array($page['slug'], $script['page_slug']))
						add_action('admin_print_scripts-'.$menu, array($this, 'load_scripts_admin'));
				}else if ($script['page_slug'] == $page['slug']){
					add_action('admin_print_scripts-'.$menu, array($this, 'load_scripts_admin'));
				}
			}
		}


	}


	//====================== CALLBACKS =================================
	function main_settings(){

		$this -> load_template('admin/settings.php');

	}

	function set_meta(){

		echo '<h2>'.__('N-Media Websit Contact Form Setting', $nmcontact->plugin_shortname).'</h2>';
		echo '<p>'.__('Here you can create Forms. These forms can be used on any pages/posts. Some field/options are Disabled as these part of PRO version', $nmcontact->plugin_shortname).'</p>';
		
		$this -> load_template('admin/create-meta.php');
		$this -> load_template('admin/existing-meta.php');
		

	}
}