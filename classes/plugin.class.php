<?php
/*
 * this is main plugin class
*/


/* ======= the model main class =========== */
if(!class_exists('NM_Framwork_V1')){
	$_framework = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'nm-framework.php';
	if( file_exists($_framework))
		include_once($_framework);
	else
		die('Reen, Reen, BUMP! not found '.$_framework);
}


/*
 * [1]
*/
class NM_WP_ContactForm extends NM_Framwork_V1{

	static $tbl_forms = 'nm_forms';
	/*
	 * plugin constructur
	*/
	function __construct(){

		//setting plugin meta saved in config.php
		$this -> plugin_meta = get_plugin_meta();

		//getting saved settings
		$this -> plugin_settings = get_option($this->plugin_meta['shortname'].'_settings');


		//file upload dir name
		$this -> contact_files = 'contact_files';
		
		//this will hold form form_id
		$this -> form_id = '';


		/*
		 * [2]
		* TODO: update scripts array for SHIPPED scripts
		* only use handlers
		*/
		//setting shipped scripts
		$this -> wp_shipped_scripts = array('jquery');


		/*
		 * [3]
		* TODO: update scripts array for custom scripts/styles
		*/
		//setting plugin settings
		$this -> plugin_scripts =  array(

				array(	'script_name'	=> 'scripts',
						'script_source'	=> '/js/script.js',
						'localized'		=> true,
						'type'			=> 'js'
				),

				array(	'script_name'	=> 'upload_plugin',
						'script_source'	=> '/js/upload.js',
						'localized'		=> true,
						'type'			=> 'js'
				),
				array('script_name'	=> 'flash_script',
							'script_source'	=> '/js/uploadify-v-3-1-1/jquery.uploadify-3.1.min.js',
							'localized'		=> false,
							'type'			=> 'js'),
				array(	'script_name'	=> 'flash_styles',
						'script_source'	=> '/js/uploadify-v-3-1-1/uploadify.css',
						'localized'		=> false,
						'type'			=> 'style'
				),

				array(	'script_name'	=> 'styles',
						'script_source'	=> '/plugin.styles.css',
						'localized'		=> false,
						'type'			=> 'style'
				),
		);

		/*
		 * [4]
		* Localized object will always be your pluginshortname_vars
		* e.g: pluginshortname_vars.ajaxurl
		*/
		$this -> localized_vars = array('ajaxurl' => admin_url( 'admin-ajax.php' ),
				'plugin_url' 		=> $this->plugin_meta['url'],
				'doing'				=> $this->plugin_meta['url'].'/images/loading.gif',
				'settings'			=> $this -> plugin_settings,
				'add_meta_counter'	=> 2,
				'file_upload_path'	=> $this -> get_file_dir_url(true),
				'file_meta'			=> ''
				);


		/*
		 * [5]
		* TODO: this array will grow as plugin grow
		* all functions which need to be called back MUST be in this array
		* setting callbacks
		*/
		//following array are functions name and ajax callback handlers
		$this -> ajax_callbacks = array('save_settings',		//do not change this action, is for admin
				'save_form_meta',
				'update_form_meta',
				'send_form_data',
				'upload_file',
		);

		/*
		 * plugin localization being initiated here
		*/
		add_action('init', array($this, 'wpp_textdomain'));


		/*
		 * plugin main shortcode if needed
		*/
		add_shortcode('nm-wp-contact', array($this , 'render_shortcode_template'));


		/*
		 * hooking up scripts for front-end
		*/
		add_action('wp_enqueue_scripts', array($this, 'load_scripts'));

		/*
		 * registering callbacks
		*/
		$this -> do_callbacks();
	}



	/*
	 * =============== NOW do your JOB ===========================
	*
	*/

	function list_files(){

		var_dump($this);
	}


	/*
	 * saving form meta
	* in admin call
	*/
	function save_form_meta(){

		//print_r($_REQUEST); exit;
		
		global $wpdb;

		extract($_REQUEST);

		$dt = array('form_name'			=> $form_name,
					'from_email' 		=> $from_email,
					'from_name'			=> $from_name,
					'subject' 			=> $subject,
					'receiver_emails'	=> $receiver_emails,
					'reply_to'			=> $reply_to,
					'allow_file_upload'	=> $allow_file_upload,
					'send_file_as'		=> $send_file_as,
					'file_meta'			=> json_encode($file_meta),
					'the_meta'			=> json_encode($the_meta),
					'form_created'			=> current_time('mysql')
		);

		$format = array('%s', '%s', '%s', '%s');

		$res_id = $this -> insert_table(self::$tbl_forms, $dt, $format);

		if($res_id){

			_e('Form added successfully');
		}else{

			$wpdb->show_errors();
			$wpdb->print_error();
		}

		die(0);
	}



	/*
	 * updating form meta
	* in admin call
	*/
	function update_form_meta(){

		//print_r($_REQUEST); exit;
		
		global $wpdb;

		extract($_REQUEST);

		$dt = array('form_name'			=> $form_name,
					'from_email' 		=> $from_email,
					'from_name'			=> $from_name,
					'subject' 			=> $subject,
					'receiver_emails'	=> $receiver_emails,
					'reply_to'			=> $reply_to,
					'allow_file_upload'	=> $allow_file_upload,
					'send_file_as'		=> $send_file_as,
					'file_meta'			=> json_encode($file_meta),
					'the_meta'			=> json_encode($the_meta),
		);

		$where = array('form_id'	=> $form_id);

		$format = array('%s', '%s', '%s', '%s', '%s', '%s');
		$where_format = array('%d');

		$res_id = $this -> update_table(self::$tbl_forms, $dt, $where, $format, $where_format);

		if($res_id){

			_e('Meta updated successfully');
		}else{

			$wpdb->show_errors();
			$wpdb->print_error();
		}

		die(0);
	}


	/*
	 * saving admin setting in wp option data table
	*/
	function save_settings(){

		//pa($_REQUEST);
		$existingOptions = get_option($this->plugin_meta['shortname'].'_settings');
		//pa($existingOptions);

		update_option($this->plugin_meta['shortname'].'_settings', $_REQUEST);
		_e('All options are updated', $this->plugin_meta['shortname']);
		die(0);
	}


	/*
	 * rendering template against shortcode
	*/
	function render_shortcode_template($atts){

		extract(shortcode_atts(array(
				'form_id'	=> ''
		), $atts));

		$this -> form_id = $form_id;
				
		ob_start();

		echo '<form onsubmit="return send_data(this)">';

		$this -> load_template('render.input.php');
			
		/*
		 * file upload htmls
		*/
		echo '<div id="nm-uploader-area">';
		echo '<div id="wrapper-uploadify-button">';
		echo '<input id="nm_contact_file" name="nm_contact_file" type="file" />';
		echo '</div>';
		echo '<input type="hidden" id="_contact_file_name" name="_contact_file_name">';
		echo '<span id="upload-response"></span>';
		echo '</div>';
		echo '<p id="uploaded_files"></p>';
			
		echo '<p><input type="submit" value="Submit"></p>';
		echo '<span id="nm-sending-form"></span>';
		
		
		wp_nonce_field('doing_contact','nm_webcontact_nonce');			
		echo '</form>';
			
		$output_string = ob_get_contents();
		ob_end_clean();
		
			
		return $output_string;
	}


	/*
	 * sending data to admin/others
	*/
	function send_form_data(){

		//print_r($_REQUEST); exit;
		
		if ( empty($_POST) || !wp_verify_nonce($_POST['nm_webcontact_nonce'],'doing_contact') )
		{
			print 'Sorry, You are not HUMANE.';
			exit;
		}

		$submitted_data = $_REQUEST;
		$uploaded_files = explode(',', $submitted_data['_contact_file_name'] );

		unset($submitted_data['action']);
		unset($submitted_data['_contact_file_name']);
		unset($submitted_data['nm_webcontact_nonce']);
		unset($submitted_data['_wp_http_referer']);
		unset($submitted_data['_from_email']);
		unset($submitted_data['_from_name']);
		unset($submitted_data['_subject']);
		unset($submitted_data['_receiver_emails']);
		unset($submitted_data['_reply_to']);
		unset($submitted_data['_send_file_as']);
		

		$message = "<p>Following message is being sent by User</p>";
		$message .= "<ul>";

		foreach ($submitted_data as $key => $val){


			$message .= "<li><strong>$key</strong>: $val</li>";
		}

		$message .= "</ul>";

		/* =============== FILE Attachment/Link ======================= */
		$attachments = '';
		if ($_REQUEST['_send_file_as'] == 'attachment'){

			foreach ($uploaded_files as $file){
				$attachments[] = $this -> get_file_dir_path() . $file;
			}			
			
		}else{
			
			$message .= "<h3>File(s) attached</h3>";
			
			$message .= "<ul>";
			
			foreach ($uploaded_files as $file){
			
				$file_url = $this -> get_file_dir_url() . $file;
				$message .= "<li><a href=\"$file_url\">$file</a></li>";
			}
			
			$message .= "</ul>";
		}
		
		/* =============== FILE Attachment/Link ======================= */
		

		$admin_email	= get_bloginfo('admin_email');
		$blog_name 		= get_bloginfo('name');
		
		$from_email 		= isset($_REQUEST['_from_email']) ? $_REQUEST['_from_email'] : $admin_email;
		$from_name  		= isset($_REQUEST['_from_name']) ? $_REQUEST['_from_name'] : $blog_name;
		$receiver_emails 	= $admin_email;
		$reply_to			= $admin_email;
		
		$headers[] = "From: $from_name <$from_email >";
		$headers[] = "Reply-To: $reply_to";
		$headers[] = "Content-Type: text/html";
		
	
		$subject = isset($_REQUEST['_subject']) ? $_REQUEST['_subject'] : 'Web Contact - '.date('M-d,Y', time());
		
		$receiver_emails = explode(',', $receiver_emails);

		$resp = '';
		foreach ($receiver_emails as $to){
			
			$to  = trim($to);
			if (wp_mail($to , $subject, $message, $headers, $attachments)){
				$message_sent = $this -> get_option('_message_sent');
				$message_sent = ($message_sent == '') ? __('Message sent successfully', $this->plugin_meta['shortname']) : $message_sent;
				$resp['status'] = 'success';
				$resp['message'] = $message_sent;
			}else{
				
				$resp['status'] = 'error';
				$resp['message'] = __('Error: while seding Email', $this->plugin_meta['shortname']);
			}
		}

		echo json_encode($resp);

		die(0);
	}


	/*
	 * uploading file here
	*/
	function upload_file(){

		$dirPath = $this -> setup_file_directory();
		$response = array();

		if($dirPath == 'errDirectory'){

			$response['status']		= 'error';
			$response['message']	= __('Error while creating directory', $this -> plugin_shortname);
			die(0);

		}

		if (!empty($_FILES)) {

			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $dirPath;
			$new_filename = strtotime("now").'-'.preg_replace("![^a-z0-9.]+!i", "_", $_FILES['Filedata']['name']);
			$targetFile = rtrim($targetPath,'/') . '/' .$new_filename;
			
			$thumb_size = $this -> get_option('_thumb_size');			
			$thumb_size = ($thumb_size == '') ? 75 : $thumb_size;

			$type = substr(strrchr($new_filename,'.'),1);
			$type = strtolower($type);
			
			if(move_uploaded_file($tempFile,$targetFile)){

				if (($type == "gif") || ($type == "jpeg") || ($type == "png") || ($type == "pjpeg") || ($type == "jpg") )
					$this -> create_thumb($targetPath, $new_filename, $thumb_size);

				$response['status']		= 'uploaded';
				$response['filename']	= $new_filename;
			}

			else{
				$response['status']		= 'error';
				$response['message']	= __('Error while uploading file', $this -> plugin_shortname);
			}
		}
		echo json_encode($response);
		die(0);
	}



	// ================================ SOME HELPER FUNCTIONS =========================================


	/*
	 * getting meta based on id
	*/
	function get_forms($form_id=''){

		$select = array(self::$tbl_forms	=> '*');

		if ($form_id){
			$where = array('d'	=> array('form_id'	=> $form_id)
			);

			$res = $this -> get_row_data($select, $where);
		}else{
			$where = NULL;
			$res = $this -> get_rows_data($select, $where);
		}
			
		return $res;
	}

	/*
	 * simplifying meta for admin view
	* in existing-meta.php
	*/

	function simplify_meta($meta){

		$metas = json_decode($meta);

		echo '<ul>';
		foreach ($metas as $meta => $data) {

			$req = ($data->required == 1) ? 'yes' : 'no';

			echo '<li>';
			echo '<strong>label:</strong> '.$data->label;
			echo ' | <strong>type:</strong> '.$data->type;
			echo ' | <strong>options:</strong> '.$data->options;
			echo ' | <strong>price:</strong> '.$data->price;
			echo ' | <strong>required:</strong> '.$req;
			echo '</li>';
		}

		echo '</ul>';
	}


	/*
	 * setting up user directory
	*/

	function setup_file_directory(){

		$upload_dir = wp_upload_dir();

		$dirPath = $upload_dir['basedir'].'/'.$this -> contact_files.'/';

		if(!is_dir($dirPath))
		{
			if(mkdir($dirPath, 0775, true))
				$dirThumbPath = $dirPath . 'thumbs/';
			if(mkdir($dirThumbPath, 0775, true))
				return $dirPath;
			else
				return 'errDirectory';
		}
		else
		{
			return $dirPath;
		}
	}


	/*
	 * getting file URL
	*/

	function get_file_dir_url($thumbs=false){

		$upload_dir = wp_upload_dir();

		if($thumbs)
			return $upload_dir['baseurl'].'/'.$this -> contact_files.'/thumbs/';
		else
			return $upload_dir['baseurl'].'/'.$this -> contact_files.'/';
	}

	function get_file_dir_path(){

		$upload_dir = wp_upload_dir();
		return $upload_dir['basedir'].'/'.$this -> contact_files.'/';
	}

	/*
	 * creating thumb using WideImage Library
	* Since 21 April, 2013
	*/
	function create_thumb($dest, $image_name, $thumb_size){

		$wide_image_file = $this->plugin_meta['path'].'/lib/wide-image/WideImage.php';

		if (file_exists($wide_image_file))
			include $wide_image_file;
		else
			die('File not found'.$wide_image_file);

		$image = WideImage::load($dest . $image_name);

		$dest_file = $dest.'thumbs/'.$image_name;
		$result = $image -> resize($thumb_size) -> saveToFile($dest_file);
	}
	
	
	function activate_plugin(){

		global $wpdb,$plugin_meta;

		/*
		 * NOTE: $plugin_meta is not object of this class, it is constant
		* defined in config.php
		*/
			
		/*
		 * meta_for: this is to make this table to contact more then one metas for NM plugins in future
		* in this plugin it will be populated with: forms
		*/
		$sql = "CREATE TABLE `".$wpdb->prefix . self::$tbl_forms."`
		(`form_id` INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`form_name` VARCHAR( 50 ) NOT NULL,
		`from_email` VARCHAR( 50 ),
		`from_name` VARCHAR( 50 ),
		`subject` VARCHAR( 50 ),
		`receiver_emails` VARCHAR( 250 ),
		`reply_to` VARCHAR( 50 ),
		`allow_file_upload` VARCHAR( 3 ),
		`send_file_as` VARCHAR( 15 ),
		`file_meta` MEDIUMTEXT,
		`the_meta` MEDIUMTEXT NOT NULL,
		`form_created` DATETIME NOT NULL)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option("nm_plugin_db_version", $plugin_meta['db_version']);

	}

	function deactivate_plugin(){

		//do nothing so far.
	}
}