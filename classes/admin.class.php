<?php
/*
 * working behind the seen
 */
class NM_WP_ContactForm_Admin extends NM_WP_ContactForm {
	var $menu_pages, $plugin_scripts_admin, $plugin_settings;
	function __construct() {
		
		// setting plugin meta saved in config.php
		$this->plugin_meta = get_plugin_meta ();
		
		// getting saved settings
		$this->plugin_settings = get_option ( $this->plugin_meta ['shortname'] . '_settings' );
		
		// file upload dir name
		$this->contact_files = 'contact_files';
		
		/*
		 * [1] TODO: change this for plugin admin pages
		 */
		$this->menu_pages = array (
				array (
						'page_title' => $this->plugin_meta ['name'],
						'menu_title' => $this->plugin_meta ['name'],
						'cap' => 'edit_plugins',
						'slug' => $this->plugin_meta ['shortname'],
						'callback' => 'main_settings',
						'parent_slug' => '' 
				),
				array (
						'page_title' => 'Create Forms',
						'menu_title' => 'CreateForms',
						'cap' => 'edit_plugins',
						'slug' => 'nm-create-form',
						'callback' => 'forms_list',
						'parent_slug' => $this->plugin_meta ['shortname'] 
				) 
		)
		;
		
		/*
		 * [2] TODO: Change this for admin related scripts JS scripts and styles to loaded ADMIN
		 */
		$this->plugin_scripts_admin = array (
				array (
						'script_name' => 'scripts-global',
						'script_source' => '/js/nm-global.js',
						'localized' => false,
						'type' => 'js',
						'page_slug' => $this->plugin_meta ['shortname'] 
				),
				array (
						'script_name' => 'scripts-admin',
						'script_source' => '/js/admin.js',
						'localized' => true,
						'type' => 'js',
						'page_slug' => array (
								$this->plugin_meta ['shortname'],
								'nm-create-form',
								'nm-new-form' 
						),
						'depends' => array (
								'jquery',
								'jquery-ui-accordion',
								'jquery-ui-draggable',
								'jquery-ui-droppable',
								'jquery-ui-sortable',
								'jquery-ui-slider',
								'jquery-ui-dialog',
								'jquery-ui-tabs' 
						) 
				),
				array (
						'script_name' => 'ui-style',
						'script_source' => '/js/ui/css/smoothness/jquery-ui-1.10.3.custom.min.css',
						'localized' => false,
						'type' => 'style',
						'page_slug' => array (
								'nm-new-form' 
						) 
				),
				
				array (
						'script_name' => 'plugin-css',
						'script_source' => '/templates/admin/style.css',
						'localized' => false,
						'type' => 'style',
						'page_slug' => array (
								$this->plugin_meta ['shortname'],
								'nm-new-form' 
						) 
				) 
		);
		
		add_action ( 'admin_menu', array (
				$this,
				'add_menu_pages' 
		) );
		add_action ( 'admin_init', array (
				$this,
				'init_admin' 
		) );
	}
	function load_scripts_admin() {
		
		// localized vars in js
		$arrLocalizedVars = array (
				'plugin_url' => $this->plugin_meta ['url'],
				'doing' => $this->plugin_meta ['url'] . '/images/loading.gif',
				'plugin_admin_page'	=> admin_url('admin.php?page=nm-create-form'),
		);
		
		// admin end scripts
		
		if ($this->plugin_scripts_admin) {
			foreach ( $this->plugin_scripts_admin as $script ) {
				
				// checking if it is style
				if ($script ['type'] == 'js') {
					wp_enqueue_script ( $this->plugin_meta ['shortname'] . '-' . $script ['script_name'], $this->plugin_meta ['url'] . $script ['script_source'], $script ['depends'] );
					
					// if localized
					if ($script ['localized'])
						wp_localize_script ( $this->plugin_meta ['shortname'] . '-' . $script ['script_name'], $this->plugin_meta ['shortname'] . '_vars', $arrLocalizedVars );
				} else {
					
					wp_enqueue_style ( $this->plugin_meta ['shortname'] . '-' . $script ['script_name'], $this->plugin_meta ['url'] . $script ['script_source'] );
				}
			}
		}
	}
	
	/*
	 * creating menu page for this plugin
	 */
	function add_menu_pages() {
		foreach ( $this->menu_pages as $page ) {
			
			if ($page ['parent_slug'] == '') {
				
				$menu = add_menu_page ( __ ( $page ['page_title'] . ' Settings', $this->plugin_meta ['shortname'] ), __ ( $page ['menu_title'] . ' Settings', $this->plugin_meta ['shortname'] ), $page ['cap'], $page ['slug'], array (
						$this,
						$page ['callback'] 
				), $this->plugin_meta ['logo'], $this->plugin_meta ['menu_position'] );
			} else {
				
				$menu = add_submenu_page ( $page ['parent_slug'], __ ( $page ['page_title'] . ' Settings', $this->plugin_meta ['shortname'] ), __ ( $page ['menu_title'] . ' Settings', $this->plugin_meta ['shortname'] ), $page ['cap'], $page ['slug'], array (
						$this,
						$page ['callback'] 
				) );
			}
			
			// loading script for only plugin optios pages
			// page_slug is key in $plugin_scripts_admin which determine the page
			foreach ( $this->plugin_scripts_admin as $script ) {
				
				if (is_array ( $script ['page_slug'] )) {
					
					if (in_array ( $page ['slug'], $script ['page_slug'] ))
						add_action ( 'admin_print_scripts-' . $menu, array (
								$this,
								'load_scripts_admin' 
						) );
				} else if ($script ['page_slug'] == $page ['slug']) {
					add_action ( 'admin_print_scripts-' . $menu, array (
							$this,
							'load_scripts_admin' 
					) );
				}
			}
		}
	}
	
	/*
	 * after init admin
	 */
	function init_admin() {
		add_meta_box ( 'contact_forms_meta_box', 'Uploaded file', array (
				$this,
				'display_contact_form_meta_box' 
		), 'nm-forms', 'normal', 'high' );
	}
	function display_contact_form_meta_box($form) {
		echo '<p>' . __ ( 'Following files are uploaded:', $this->plugin_meta ['shortname'] ) . '</p>';
		
		$uploaded_files = get_post_meta ( $form->ID, 'uploaded_files', true );
		$uploaded_files = json_decode ( $uploaded_files );
		
		echo '<table>';
		
		if ($uploaded_files) {
			foreach ( $uploaded_files as $file ) {
				
				$file_url = $this->get_file_dir_url () . $file;
				
				$type = strtolower ( substr ( strrchr ( $new_filename, '.' ), 1 ) );
				if (($type == "gif") || ($type == "jpeg") || ($type == "png") || ($type == "pjpeg") || ($type == "jpg"))
					$thumb_url = $this->get_file_dir_url ( true ) . $file;
				else 
					$thumb_url = $this -> plugin_meta['url'] .'/images/file.png';
				
				echo '<tr>';
				echo '<td style="width: 20%"><img src="' . $thumb_url . '" /></td>';
				echo '<td><a href="' . $file_url . '" target="_blank">' . __ ( 'Download file', $this->plugin_meta ['shortname'] ) . '</a></td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	}
	
	// ====================== CALLBACKS =================================
	function main_settings() {
		$this->load_template ( 'admin/settings.php' );
	}
	
	function forms_list() {
		echo '<div class="wrap">';
		echo '<h2>' . __ ( 'N-Media Websit Contact Form Setting', $nmcontact->plugin_shortname ) . '</h2>';
		echo '<p>' . __ ( 'Here you can create and edit forms. These forms can be used on any pages/posts', $nmcontact->plugin_shortname ) . '</p>';
		
		if ( (isset ( $_REQUEST ['form_id'] ) && $_REQUEST ['form_id'] != NULL) || $_REQUEST['action'] == 'new') {
			$this->load_template ( 'admin/create-form.php' );
		}else{
			$url_add = $this -> nm_plugin_fix_request_uri(array('action'=>'new'));
			echo '<a class="button button-primary" href="'.$url_add.'">'.__('Add Form', $nmcontact->plugin_shortname).'</a>';
		}
		
		$this->load_template ( 'admin/existing-meta.php' );
		
		echo '</div>';
	}
}