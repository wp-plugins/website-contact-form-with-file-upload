<?php
/*
 * this is main plugin class
*/


/* ======= the model main class =========== */
if (! class_exists ( 'NM_Framwork_V1' )) {
	$_framework = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'nm-framework.php';
	if (file_exists ( $_framework ))
		include_once ($_framework);
	else
		die ( 'Reen, Reen, BUMP! not found ' . $_framework );
}

/*
 * [1]
*/
class NM_WP_ContactForm extends NM_Framwork_V1 {
	static $tbl_forms = 'nm_forms';
	var $allow_file_upload;
	/*
	 * plugin constructur
	*/
	function __construct() {

		// setting plugin meta saved in config.php
		$this->plugin_meta = get_plugin_meta ();

		// getting saved settings
		$this->plugin_settings = get_option ( $this->plugin_meta ['shortname'] . '_settings' );

		// file upload dir name
		$this->contact_files = 'contact_files';

		// this will hold form form_id
		$this->form_id = '';

		/*
		 * [2] TODO: update scripts array for SHIPPED scripts only use handlers
		*/
		// setting shipped scripts
		$this->wp_shipped_scripts = array (
				'jquery',
				'jquery-ui-datepicker'
		);

		$is_html5 = 0;
		
		/*
		 * [3] TODO: update scripts array for custom scripts/styles
		*/
		// setting plugin settings
		if ($is_html5 == 1){
			$this->plugin_scripts = array (

					array (
							'script_name' => 'scripts',
							'script_source' => '/js/script.js',
							'localized' => true,
							'type' => 'js'
					),

					array (
							'script_name' => 'upload_plugin',
							'script_source' => '/js/upload.js',
							'localized' => true,
							'type' => 'js'
					),
					array (
							'script_name' => 'uploadifive',
							'script_source' => '/js/uploadifive-v1.1.1/jquery.uploadifive.min.js',
							'localized' => false,
							'type' => 'js'
					),
					array (
							'script_name' => 'uploadifive_css',
							'script_source' => '/js/uploadifive-v1.1.1/uploadifive.css',
							'localized' => false,
							'type' => 'style'
					),

					array (
							'script_name' => 'styles',
							'script_source' => '/plugin.styles.css',
							'localized' => false,
							'type' => 'style'
					),
					array (
							'script_name' => 'nm-ui-style',
							'script_source' => '/js/ui/css/smoothness/jquery-ui-1.10.3.custom.min.css',
							'localized' => false,
							'type' => 'style',
							'page_slug' => array ('nm-new-form'
							),
					)
			);
		}else{
			$this->plugin_scripts = array (
						
					array (
							'script_name' => 'scripts',
							'script_source' => '/js/script.js',
							'localized' => true,
							'type' => 'js'
					),
						
					array (
							'script_name' => 'upload_plugin',
							'script_source' => '/js/upload.js',
							'localized' => true,
							'type' => 'js'
					),
					array(	'script_name'	=> 'uploadify',
							'script_source'	=> '/js/uploadify-v-3-1-1/jquery.uploadify-3.1.min.js',
							'localized'		=> false,
							'type'			=> 'js'
					),
					array(	'script_name'	=> 'uploadify_css',
							'script_source'	=> '/js/uploadify-v-3-1-1/uploadify.css',
							'localized'		=> false,
							'type'			=> 'style'
					),
						
					array (
							'script_name' => 'styles',
							'script_source' => '/plugin.styles.css',
							'localized' => false,
							'type' => 'style'
					),
					array (
							'script_name' => 'nm-ui-style',
							'script_source' => '/js/ui/css/smoothness/jquery-ui-1.10.3.custom.min.css',
							'localized' => false,
							'type' => 'style',
							'page_slug' => array ('nm-new-form'
							),
					)
			);
		}

		/*
		 * [4] Localized object will always be your pluginshortname_vars e.g: pluginshortname_vars.ajaxurl
		*/
		$this->localized_vars = array (
				'ajaxurl' => admin_url ( 'admin-ajax.php' ),
				'plugin_url' => $this->plugin_meta ['url'],
				'doing' => $this->plugin_meta ['url'] . '/images/loading.gif',
				'settings' => $this->plugin_settings,
				'file_upload_path_thumb' => $this->get_file_dir_url ( true ),
				'file_upload_path' => $this->get_file_dir_url (),
				'file_meta' => '',
				'section_slides' => '',
				'is_html5'		=> $is_html5,
		);

		/*
		 * [5] TODO: this array will grow as plugin grow all functions which need to be called back MUST be in this array setting callbacks
		*/
		// following array are functions name and ajax callback handlers
		$this->ajax_callbacks = array (
				'save_settings', // do not change this action, is for admin
				'save_form_meta',
				'update_form_meta',
				'send_form_data',
				'upload_file',
				'delete_file',
				'delete_meta',
				'save_edited_photo',
		);

		/*
		 * plugin localization being initiated here
		*/
		add_action ( 'init', array (
				$this,
				'wpp_textdomain'
		) );

		/*
		 * plugin main shortcode if needed
		*/
		add_shortcode ( 'nm-wp-contact', array (
				$this,
				'render_shortcode_template'
		) );

		/*
		 * hooking up scripts for front-end
		*/
		add_action ( 'wp_enqueue_scripts', array (
				$this,
				'load_scripts'
		) );

		/*
		 * registering callbacks
		*/
		$this->do_callbacks ();

		/*
		 * add custom post type support if enabled
		*/
		add_action ( 'init', array (
				$this,
				'enable_custom_post'
		) );
	}

	/*
	 * =============== NOW do your JOB ===========================
	*/
	function enable_custom_post() {
		register_post_type ( 'nm-forms', array (
				'labels' => array (
						'name' => __ ( 'Contact Forms' ),
						'singular_name' => __ ( 'Contact Form' ),
						'add_new' => 'Add New',
						'add_new_item' => 'Add Contact Form',
						'edit' => 'Edit',
						'edit_item' => 'Edit Contact Form',
						'new_item' => 'New Contact Form',
						'view' => 'View',
						'view_item' => 'View Contact Form',
						'search_items' => 'Search Contact Form',
						'not_found' => 'No Contact Form found',
						'not_found_in_trash' => 'No Contact Form found in Trash',
						'parent' => 'Parent Contact Form'
				),
				'public' => true,
				'supports' => array (
						'title',
						'editor',
						'custom-fields'
				),
				'menu_icon' => $this->plugin_meta ['logo']
		) );
	}

	/*
	 * saving form meta in admin call
	*/
	function save_form_meta() {

		// print_r($_REQUEST); exit;
		global $wpdb;

		extract ( $_REQUEST );

		$dt = array (
				'form_name' 		=> $form_name,
				'sender_email' 		=> $sender_email,
				'sender_name' 		=> $sender_name,
				'subject' 			=> $subject,
				'receiver_emails' 	=> $receiver_emails,
				'button_label' 		=> $button_label,
				'button_class'		=> $button_class,
				'success_message' 	=> stripslashes ( $success_message ),
				'error_message' 	=> stripslashes ( $error_message ),
				'send_file_as' 		=> $send_file_as,
				'aviary_api_key'	=> trim($aviary_api_key),
				'section_slides' 	=> $section_slides,
				'form_style'		=> $form_style,
				'the_meta'			=> json_encode ( $form_meta ),
				'form_created' 		=> current_time ( 'mysql' )
		);

		$format = array (
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
		);

		$res_id = $this->insert_table ( self::$tbl_forms, $dt, $format );

		$resp = array ();
		if ($res_id) {

			$resp = array (
					'message' => __ ( 'Form added successfully', $this->plugin_meta ['shortname'] ),
					'status' => 'success',
					'form_id' => $res_id
			);
		} else {

			$resp = array (
					'message' => __ ( 'Error while savign form, please try again', $this->plugin_meta ['shortname'] ),
					'status' => 'failed',
					'form_id' => ''
			);
		}

		echo json_encode ( $resp );

		/*
		 * $wpdb->show_errors(); $wpdb->print_error();
		*/

		die ( 0 );
	}

	/*
	 * updating form meta in admin call
	*/
	function update_form_meta() {

		// print_r($_REQUEST); exit;
		global $wpdb;

		extract ( $_REQUEST );

		$dt = array (
				'form_name' 		=> $form_name,
				'sender_email' 		=> $sender_email,
				'sender_name'	 	=> $sender_name,
				'subject' 			=> $subject,
				'receiver_emails' 	=> $receiver_emails,
				'button_label' 		=> $button_label,
				'button_class'		=> $button_class,
				'success_message' 	=> stripslashes ( $success_message ),
				'error_message' 	=> stripslashes ( $error_message ),
				'send_file_as' 		=> $send_file_as,
				'aviary_api_key'	=> trim($aviary_api_key),
				'form_style'		=> $form_style,
				'section_slides'	=> $section_slides,
				'the_meta' 			=> json_encode ( $form_meta ),
		);

		$where = array (
				'form_id' => $form_id
		);

		$format = array (
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
		);
		$where_format = array (
				'%d'
		);

		$res_id = $this->update_table ( self::$tbl_forms, $dt, $where, $format, $where_format );

		$resp = array ();
		if ($res_id) {

			$resp = array (
					'message' => __ ( 'Form updated successfully', $this->plugin_meta ['shortname'] ),
					'status' => 'success',
					'form_id' => $form_id
			);
		} else {

			$resp = array (
					'message' => __ ( 'Error while updating form, please try again', $this->plugin_meta ['shortname'] ),
					'status' => 'failed',
					'form_id' => $form_id
			);
		}

		echo json_encode ( $resp );

		/*
		 * $wpdb->show_errors(); $wpdb->print_error();
		*/

		die ( 0 );
	}

	/*
	 * saving admin setting in wp option data table
	*/
	function save_settings() {

		// $this -> pa($_REQUEST);
		$existingOptions = get_option ( $this->plugin_meta ['shortname'] . '_settings' );
		// pa($existingOptions);

		update_option ( $this->plugin_meta ['shortname'] . '_settings', $_REQUEST );
		_e ( 'All options are updated', $this->plugin_meta ['shortname'] );
		die ( 0 );
	}

	/*
	 * rendering template against shortcode
	*/
	function render_shortcode_template($atts) {
		extract ( shortcode_atts ( array (
				'form_id' => ''
		), $atts ) );

		$this->form_id = $form_id;

		ob_start ();

		$this->load_template ( 'render.input.php' );

		$output_string = ob_get_contents ();
		ob_end_clean ();

		return $output_string;
	}

	/*
	 * sending data to admin/others
	*/
	function send_form_data() {

		// print_r($_REQUEST);
		if (empty ( $_POST ) || ! wp_verify_nonce ( $_POST ['nm_webcontact_nonce'], 'doing_contact' )) {
			print 'Sorry, You are not HUMANE.';
			exit ();
		}

		$submitted_data = $_REQUEST;
		$uploaded_files = '';

		unset ( $submitted_data ['action'] );
		unset ( $submitted_data ['nm_webcontact_nonce'] );
		unset ( $submitted_data ['_wp_http_referer'] );
		unset ( $submitted_data ['_form_id'] );
		unset ( $submitted_data ['_sender_email'] );
		unset ( $submitted_data ['_sender_name'] );
		unset ( $submitted_data ['_subject'] );
		unset ( $submitted_data ['_receiver_emails'] );
		unset ( $submitted_data ['_reply_to'] );
		unset ( $submitted_data ['_send_file_as'] );

		$message = "<p>" . __ ( 'Following message is being sent by User', $this->plugin_meta ['shortname'] ) . "</p>";
		$message .= $this->render_email_template ();


		/* =============== FILE Attachment ======================= */
		$attachments = '';
		if ($_REQUEST ['_send_file_as'] == 'attachment') {

			foreach ( $submitted_data as $key => $val ) {

				if (preg_match ( '/^files_/', $key ) != 0) {
					$uploaded_files = explode ( ',', $val );

					foreach ( $uploaded_files as $file ) {
						if(file_exists($this->get_file_dir_path () . $file))
							$attachments [] = $this->get_file_dir_path () . $file;
					}

				}
			}

		}

		/* =============== FILE Attachment ======================= */



		$admin_email = get_bloginfo ( 'admin_email' );
		$blog_name = get_bloginfo ( 'name' );

		$from_email = isset ( $_REQUEST ['_sender_email'] ) ? $_REQUEST ['_sender_email'] : $admin_email;
		$from_name = isset ( $_REQUEST ['_sender_name'] ) ? $_REQUEST ['_sender_name'] : $blog_name;
		$receiver_emails = isset ( $_REQUEST ['_receiver_emails'] ) ? $_REQUEST ['_receiver_emails'] : $admin_email;
		$reply_to = isset ( $_REQUEST ['_reply_to'] ) ? $_REQUEST ['_reply_to'] : $admin_email;


		$headers [] = "From: $from_name <$from_email >";
		//$headers [] = "Reply-To: $reply_to";
		$headers [] = "Content-Type: text/html";

		$subject = isset ( $_REQUEST ['_subject'] ) ? $_REQUEST ['_subject'] : 'Web Contact - ' . date ( 'M-d,Y', time () );

		$receiver_emails = explode ( ',', $receiver_emails );

		$resp = '';
		foreach ( $receiver_emails as $to ) {

			$to = trim ( $to );
			if (wp_mail ( $to, $subject, $message, $headers, $attachments )) {
				$message_sent = $this->get_option ( '_message_sent' );
				$message_sent = ($message_sent == '') ? __ ( 'Message sent successfully', $this->plugin_meta ['shortname'] ) : $message_sent;
				$resp ['status'] = 'success';
				$resp ['message'] = $message_sent;

				// saving contact form if Enabled
				$save_forms = $this->get_option ( '_save_forms' );
				if ($save_forms [0] == 'yes')
					$this->save_contact_form ( $subject, $message, $uploaded_files, $submitted_data );
			} else {

				$resp ['status'] = 'error';
				$resp ['message'] = __ ( 'Error: while seding Email', $this->plugin_meta ['shortname'] );
			}
		}

		echo json_encode ( $resp );

		die ( 0 );
	}

	/*
	 * rendering email template
	*/
	function render_email_template() {
		ob_start ();
		$this->load_template ( '/render.email.php' );
		return ob_get_clean ();
	}

	/*
	 * uploading file here
	*/
	function upload_file() {

		ini_set ( 'memory_limit', '-1' );

		$dirPath = $this->setup_file_directory ();
		$response = array ();

		if ($dirPath == 'errDirectory') {

			$response ['status'] = 'error';
			$response ['message'] = __ ( 'Error while creating directory', $this->plugin_shortname );
			die ( 0 );
		}
		
		/* ========== Invalid File type checking ========== */
		$file_type = wp_check_filetype($_FILES ['Filedata'] ['name'], null );
		
		$allowed_types = array('php', 'exe');
		//var_dump($allowed_types);
		
		if( in_array($file_type['ext'], $allowed_types) ){
			$response ['status'] = 'error';
			$response ['message'] = __ ( 'File type not valid - '.$file_type, 'nm-filemanager' );
			die ( json_encode($response) );
		}
		/* ========== Invalid File type checking ========== */

		if (! empty ( $_FILES )) {

			$tempFile = $_FILES ['Filedata'] ['tmp_name'];
			$targetPath = $dirPath;
			$new_filename = strtotime ( "now" ) . '-' . preg_replace ( "![^a-z0-9.]+!i", "_", $_FILES ['Filedata'] ['name'] );
			$targetFile = rtrim ( $targetPath, '/' ) . '/' . $new_filename;

			$thumb_size = $this->get_option ( '_thumb_size' );
			$thumb_size = ($thumb_size == '') ? 75 : $thumb_size;

			$type = strtolower ( substr ( strrchr ( $new_filename, '.' ), 1 ) );

			if (move_uploaded_file ( $tempFile, $targetFile )) {

				if (($type == "gif") || ($type == "jpeg") || ($type == "png") || ($type == "pjpeg") || ($type == "jpg"))
					$this->create_thumb ( $targetPath, $new_filename, $thumb_size );

				$response ['status'] = 'uploaded';
				$response ['filename'] = $new_filename;
			}

			else {
				$response ['status'] = 'error';
				$response ['message'] = __ ( 'Error while uploading file', $this->plugin_shortname );
			}
		}
		echo json_encode ( $response );
		die ( 0 );
	}

	/*
	 * deleting uploaded file from directory
	*/
	function delete_file() {
		$dir_path = $this->setup_file_directory ();
		$file_path = $dir_path . $_REQUEST ['file_name'];

		if (unlink ( $file_path )) {
			echo __ ( 'File removed', $this->plugin_shortname );

			if ($_REQUEST ['is_image'] == "true")
				unlink ( $dir_path . 'thumbs/' . $_REQUEST ['file_name'] );
		} else {
			echo __ ( 'Error while deleting file ' . $file_path );
		}

		die ( 0 );
	}

	/*
	 * saving contact form as CPT: nm-forms
	*/
	function save_contact_form($subject, $message, $attachments, $submitted_data) {
		$allowed_html = array (
				'a' => array (
						'href' => array (),
						'title' => array ()
				),
				'br' => array (),
				'em' => array (),
				'strong' => array (),
				'p' => array (),
				'ul' => array (),
				'li' => array (),
				'h3' => array ()
		);

		$title = date ( 'D,m-Y' ) . '-' . sanitize_text_field ( $subject );
		// creating post
		$contact_form = array (
				'post_title' => $title,
				'post_content' => wp_kses ( $message, $allowed_html ),
				'post_status' => 'private',
				'post_type' => 'nm-forms',
				'post_author' => '',
				'comment_status' => 'closed',
				'ping_status' => 'closed'
		);

		// saving the post into the database
		$formid = wp_insert_post ( $contact_form );

		// now adding submitted data as form/post meta
		foreach ( $submitted_data as $key => $val ) {
			update_post_meta ( $formid, $key, $val );
		}

		// files uploaded
		update_post_meta ( $formid, 'uploaded_files', json_encode ( $attachments ) );
	}


	/*
	 * this function is saving photo returned by Aviary
	*/
	function save_edited_photo(){

		$file_path = $this -> plugin_meta['path'] . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'aviary.php';
		if (!file_exists($file_path)) {
			die('Could not find file '.$file_path);
		}
		
		if (!class_exists('NM_Aviary')) {
			die('Class not found NM_Aviary');
		}
		
		$aviary = new NM_Aviary();
		
		$aviary -> dir_path = $this -> get_file_dir_path();
		$aviary -> posted_data = json_decode( stripslashes($_REQUEST['postdata']) );
		$aviary -> image_data = file_get_contents($_REQUEST['url']);

		die(0);

	}

	// ================================ SOME HELPER FUNCTIONS =========================================

	/*
	 * getting meta based on id
	*/
	function get_forms($form_id = '') {
		$select = array (
				self::$tbl_forms => '*'
		);

		if ($form_id) {
			$where = array (
					'd' => array (
							'form_id' => $form_id
					)
			);

			$res = $this->get_row_data ( $select, $where );
		} else {
			$where = NULL;
			$res = $this->get_rows_data ( $select, $where );
		}

		return $res;
	}

	/*
	 * simplifying meta for admin view in existing-meta.php
	*/
	function simplify_meta($meta) {
		$metas = json_decode ( $meta );

		echo '<ul>';
		foreach ( $metas as $meta => $data ) {

			$req = ($data->required == 'on') ? 'yes' : 'no';

			echo '<li>';
			echo '<strong>label:</strong> ' . $data->title;
			echo ' | <strong>type:</strong> ' . $data->type;

			if (! is_object ( $data->options ))
				echo ' | <strong>options:</strong> ' . $data->options;
			echo ' | <strong>required:</strong> ' . $req;
			echo '</li>';
		}

		echo '</ul>';
	}

	/*
	 * delete meta
	*/
	function delete_meta() {
		global $wpdb;

		extract ( $_REQUEST );

		$res = $wpdb->query ( "DELETE FROM `" . $wpdb->prefix . self::$tbl_forms . "` WHERE form_id = " . $formid );

		if ($res) {

			_e ( 'Meta deleted successfully', $this->plugin_meta ['shortname'] );
		} else {
			$wpdb->show_errors ();
			$wpdb->print_error ();
		}

		die ( 0 );
	}

	/*
	 * setting up user directory
	*/
	function setup_file_directory() {
		$upload_dir = wp_upload_dir ();

		$dirPath = $upload_dir ['basedir'] . '/' . $this->contact_files . '/';

		if (! is_dir ( $dirPath )) {
			if (mkdir ( $dirPath, 0775, true ))
				$dirThumbPath = $dirPath . 'thumbs/';
			if (mkdir ( $dirThumbPath, 0775, true ))
				return $dirPath;
			else
				return 'errDirectory';
		} else {
			$dirThumbPath = $dirPath . 'thumbs/';
			if (! is_dir ( $dirThumbPath )) {
				if (mkdir ( $dirThumbPath, 0775, true ))
					return $dirPath;
				else
					return 'errDirectory';
			} else {
				return $dirPath;
			}
		}
	}

	/*
	 * getting file URL
	*/
	function get_file_dir_url($thumbs = false) {
		$upload_dir = wp_upload_dir ();

		if ($thumbs)
			return $upload_dir ['baseurl'] . '/' . $this->contact_files . '/thumbs/';
		else
			return $upload_dir ['baseurl'] . '/' . $this->contact_files . '/';
	}
	function get_file_dir_path() {
		$upload_dir = wp_upload_dir ();
		return $upload_dir ['basedir'] . '/' . $this->contact_files . '/';
	}

	/*
	 * creating thumb using WP Image Editor Since 2 June, 2015
	*/
	function create_thumb($dest, $image_name, $thumb_size) {
	
		$image = wp_get_image_editor ( $dest . $image_name );
		$dest = $dest . 'thumbs/' . $image_name;
		if (! is_wp_error ( $image )) {
			$image->resize ( 150, 150, true );
			$image->save ( $dest );
		}
	}
	
	function activate_plugin() {
		global $wpdb;
		$webcontact_db_version = "2.0.1";

		/*
		 * meta_for: this is to make this table to contact more then one metas for NM plugins in future in this plugin it will be populated with: forms
		*/
		$forms_table_name = $wpdb->prefix . self::$tbl_forms;

		$sql = "CREATE TABLE $forms_table_name (
		form_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		form_name VARCHAR(50) NOT NULL,
		sender_email VARCHAR(50),
		sender_name VARCHAR(50),
		subject VARCHAR(50),
		receiver_emails VARCHAR(250),
		button_label VARCHAR(50),
		button_class VARCHAR(50),
		success_message VARCHAR(50),
		error_message VARCHAR(50),
		send_file_as VARCHAR(15),
		aviary_api_key VARCHAR(15),
		form_style MEDIUMTEXT,
		section_slides VARCHAR(3),
		file_meta MEDIUMTEXT,
		the_meta MEDIUMTEXT NOT NULL,
		form_created DATETIME NOT NULL
		);";

		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta ( $sql );

		update_option ( "webcontact_db_version", $webcontact_db_version );
	}

	function deactivate_plugin() {

		// do nothing so far.
	}

	function if_browser_is_ie()
	{
		if (isset($_SERVER['HTTP_USER_AGENT']) &&
				(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === false))
			return false;
		else
			return true;
	}
	
	
	/*
	 * checking if aviary addon is installed or not
	 */
	function is_aviary_installed(){
		
		$aviary_file = $this->plugin_meta ['path'] . '/lib/aviary.php';
		
		if (file_exists ( $aviary_file ))
			return true;
		else
			return false;
	}
}