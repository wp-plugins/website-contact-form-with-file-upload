<?php
/*
 * This our new world, Inshallah 29 aug, 2013
 */
global $nmcontact;

// text, password, textarea types settings

$section_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will as section heading wrapped in h2', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Type description, it will be diplay under section heading.', 'nm_webcontact' ) 
		) 
);

$text_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will be shown as field label', 'nm_webcontact' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm_webcontact' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'nm_webcontact' ),
				'desc' => __ ( 'Insert the error message for validation.', 'nm_webcontact' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if it must be required.', 'nm_webcontact' ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'nm_webcontact' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm_webcontact' ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', 'nm_webcontact' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'nm_webcontact' ) 
		) 
);

$hidden_settings = array (
		
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' )
		),
		'field_value' => array (
				'type' => 'text',
				'title' => __ ( 'Field value', 'nm_webcontact' ),
				'desc' => __ ( 'you can pre-set the value of this hidden input.', 'nm_webcontact' )
		),
);

$date_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will be shown as field label', 'nm_webcontact' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm_webcontact' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'nm_webcontact' ),
				'desc' => __ ( 'Insert the error message for validation.', 'nm_webcontact' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if it must be required.', 'nm_webcontact' ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'nm_webcontact' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm_webcontact' ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', 'nm_webcontact' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'nm_webcontact' ) 
		),
		'date_formats' => array (
				'type' => 'select',
				'title' => __ ( 'Date formats', 'nm_webcontact' ),
				'desc' => __ ( 'Select date format.', 'nm_webcontact' ),
				'options' => array (
						'mm/dd/yy' => 'Default - mm/dd/yy',
						'yy-mm-dd' => 'ISO 8601 - yy-mm-dd',
						'd M, y' => 'Short - d M, y',
						'd MM, y' => 'Medium - d MM, y',
						'DD, d MM, yy' => 'Full - DD, d MM, yy',
						'\'day\' d \'of\' MM \'in the year\' yy' => 'With text - \'day\' d \'of\' MM \'in the year\' yy' 
				) 
		) 
);

$email_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will be shown as field label', 'nm_webcontact' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm_webcontact' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'nm_webcontact' ),
				'desc' => __ ( 'Insert the error message for validation.', 'nm_webcontact' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if it must be required.', 'nm_webcontact' ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'nm_webcontact' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm_webcontact' ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', 'nm_webcontact' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'nm_webcontact' ) 
		),
		
		'send_email' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Send email', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if you want user get this form.', 'nm_webcontact' ),
				'for'	=> 'pro'
		)
)
;

// checkbox settings
$check_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will be shown as field label', 'nm_webcontact' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm_webcontact' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'nm_webcontact' ),
				'desc' => __ ( 'Insert the error message for validation.', 'nm_webcontact' ) 
		),
		'options' => array (
				'type' => 'textarea',
				'title' => __ ( 'Add options', 'nm_webcontact' ),
				'desc' => __ ( 'Type each option per line', 'nm_webcontact' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if it must be required.', 'nm_webcontact' ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'nm_webcontact' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm_webcontact' ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', 'nm_webcontact' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'nm_webcontact' ) 
		),
		'checked' => array (
				'type' => 'textarea',
				'title' => __ ( 'Checked option(s)', 'nm_webcontact' ),
				'desc' => __ ( 'Type option(s) name (given above) if you want already checked.', 'nm_webcontact' ) 
		),
		
		'min_checked' => array (
				'type' => 'text',
				'title' => __ ( 'Min. Checked option(s)', 'nm_webcontact' ),
				'desc' => __ ( 'How many options can be checked by user e.g: 2. Leave blank for default.', 'nm_webcontact' ),
				'for'	=> 'pro',
		),
		
		
		'max_checked' => array (
				'type' => 'text',
				'title' => __ ( 'Max. Checked option(s)', 'nm_webcontact' ),
				'desc' => __ ( 'How many options can be checked by user e.g: 3. Leave blank for default.', 'nm_webcontact' ),
				'for'	=> 'pro',
		) 
);

// select settings
$select_radio_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will be shown as field label', 'nm_webcontact' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm_webcontact' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'nm_webcontact' ),
				'desc' => __ ( 'Insert the error message for validation.', 'nm_webcontact' ) 
		),
		
		'options' => array (
				'type' => 'textarea',
				'title' => __ ( 'Add options', 'nm_webcontact' ),
				'desc' => __ ( 'Type each option per line', 'nm_webcontact' ) 
		),
		'selected' => array (
				'type' => 'text',
				'title' => __ ( 'Selected option', 'nm_webcontact' ),
				'desc' => __ ( 'Type option name (given above) if you want already selected.', 'nm_webcontact' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if it must be required.', 'nm_webcontact' ) 
		),
		
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'nm_webcontact' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm_webcontact' ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', 'nm_webcontact' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'nm_webcontact' ) 
		) 
);

// checkbox settings
$file_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'nm_webcontact' ),
				'desc' => __ ( 'It will be shown as field label', 'nm_webcontact' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'nm_webcontact' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm_webcontact' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'nm_webcontact' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm_webcontact' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'nm_webcontact' ),
				'desc' => __ ( 'Insert the error message for validation.', 'nm_webcontact' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'nm_webcontact' ),
				'desc' => __ ( 'Select this if it must be required.', 'nm_webcontact' ),
				'for'	=> 'pro',
		),
		
		
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'nm_webcontact' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm_webcontact' ) 
		),
		
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', 'nm_webcontact' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'nm_webcontact' ) 
		),
		
		'button_label' => array (
				'type' => 'text',
				'title' => __ ( 'Button label', 'nm_webcontact' ),
				'desc' => __ ( 'Type button label e.g: Upload Photos', 'nm_webcontact' ) 
		),
		'button_width' => array (
				'type' => 'text',
				'title' => __ ( 'Button width', 'nm_webcontact' ),
				'desc' => __ ( 'Type button width in px e.g: 150 (for 150px)', 'nm_webcontact' ) 
		),
		'files_allowed' => array (
				'type' => 'text',
				'title' => __ ( 'Files allowed', 'nm_webcontact' ),
				'desc' => __ ( 'Type number of files allowed per upload by user, e.g: 3', 'nm_webcontact' ),
				'for'	=> 'pro',
		),
		'file_types' => array (
				'type' => 'text',
				'title' => __ ( 'File types', 'nm_webcontact' ),
				'desc' => __ ( 'File types allowed seperated by comma, e.g: jpg,pdf,zip', 'nm_webcontact' ) 
		),
		
		'file_size' => array (
				'type' => 'text',
				'title' => __ ( 'File size', 'nm_webcontact' ),
				'desc' => __ ( 'Type size in KB per file uploaded by user, e.g: 5000 (5 MB)', 'nm_webcontact' ) 
		),
		
		'photo_editing' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Enable photo editing', 'nm_webcontact' ),
				'desc' => __ ( 'Allow users to edit photos by Aviary API, make sure that Aviary API Key is set in previous tab.', 'nm_webcontact' ),
				'for'	=> 'pro',
		),
		
		'editing_tools' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Editing Options', 'nm_webcontact' ),
				'desc' => __ ( 'Select editing options', 'nm_webcontact' ),
				'options' => array (
						'enhance' => 'Enhancements',
						'effects' => 'Filters',
						'frames' => 'Frames',
						'stickers' => 'Stickers',
						'orientation' => 'Orientation',
						'focus' => 'Focus',
						'resize' => 'Resize',
						'crop' => 'Crop',
						'warmth' => 'Warmth',
						'brightness' => 'Brightness',
						'contrast' => 'Contrast',
						'saturation' => 'Saturation',
						'sharpness' => 'Sharpness',
						'colorsplash' => 'Colorsplash',
						'draw' => 'Draw',
						'text' => 'Text',
						'redeye' => 'Red-Eye',
						'whiten' => 'Whiten teeth',
						'blemish' => 'Remove skin blemishes' 
				),
				'for'	=> 'pro',
		) 
);

$types = array (
		'text' => array (
				'title' => __ ( 'Text Input', 'nm_webcontact' ),
				'desc' => __ ( 'regular text input', 'nm_webcontact' ),
				'settings' => $text_settings 
		),
		'email' => array (
				'title' => __ ( 'Email Input', 'nm_webcontact' ),
				'desc' => __ ( 'email input', 'nm_webcontact' ),
				'settings' => $email_settings 
		),
		'checkbox' => array (
				'title' => __ ( 'Checkbox', 'nm_webcontact' ),
				'desc' => __ ( 'checkbox options', 'nm_webcontact' ),
				'settings' => $check_settings 
		),
		'select' => array (
				'title' => __ ( 'Select', 'nm_webcontact' ),
				'desc' => __ ( 'select options', 'nm_webcontact' ),
				'settings' => $select_radio_settings 
		),
		'textarea' => array (
				'title' => __ ( 'Textarea', 'nm_webcontact' ),
				'desc' => __ ( 'textrea for large input', 'nm_webcontact' ),
				'settings' => $text_settings 
		),
		'radio' => array (
				'title' => __ ( 'Radio buttons', 'nm_webcontact' ),
				'desc' => __ ( 'radio buttons', 'nm_webcontact' ),
				'settings' => $select_radio_settings 
		),
		
		'file' => array (
				'title' => __ ( 'File upload', 'nm_webcontact' ),
				'desc' => __ ( 'file uploader', 'nm_webcontact' ),
				'settings' => $file_settings
		),
		
		'date' => array (
				'title' => __ ( 'Date', 'nm_webcontact' ),
				'desc' => __ ( 'date', 'nm_webcontact' ),
				'settings' => $date_settings,
				'for'	=> 'pro',
		),
		
		'section' => array (
				'title' => __ ( 'Section (Heading)', 'nm_webcontact' ),
				'desc' => __ ( 'file uploader', 'nm_webcontact' ),
				'settings' => $section_settings,
				'for'	=> 'pro',
		)
);

if (isset ( $_REQUEST ['form_id'] ) && $_REQUEST ['form_id'] != '') {
	
	$single_form = $nmcontact->get_forms ( intval ( $_REQUEST ['form_id'] ) );
	// $nmcontact -> pa($single_form);
	
	$form_name = $single_form->form_name;
	$sender_email = $single_form->sender_email;
	$sender_name = $single_form->sender_name;
	$subject = $single_form->subject;
	$receiver_emails = $single_form->receiver_emails;
	$button_label = $single_form->button_label;
	$button_class = $single_form->button_class;
	$success_message = $single_form->success_message;
	$error_message = $single_form->error_message;
	$aviary_api_key = $single_form->aviary_api_key;
	$form_style = $single_form->form_style;
	
	$checked_file = ($single_form->send_file_as == 'file') ? 'checked="checked"' : '';
	$checked_attachment = ($single_form->send_file_as == 'attachment') ? 'checked="checked"' : '';
	$form_meta = json_decode ( $single_form->the_meta, true );
	$section_slides = ($single_form -> section_slides == 'on') ? 'checked="checked"' : '';
	
	//$nmcontact->pa ( $form_meta );
}


$url_cancel = $this -> nm_plugin_fix_request_uri(array('action'=>'','form_id'=>''));
echo '<p><a class="button" href="'.$url_cancel.'">'.__('&laquo; Existing forms', $nmcontact->plugin_shortname).'</a></p>';
?>

<input type="hidden" name="form_id" value="<?php echo $_REQUEST['form_id']?>">
<div id="nmcontact-form-generator">
	<ul>
		<li><a href="#formbox-1"><?php _e('Form Settings', 'nm_webcontact')?></a></li>
		<li><a href="#formbox-2"><?php _e('Form Fields', 'nm_webcontact')?></a></li>
		<li style="float: right"><button class="button-primary button"
				onclick="save_form_meta(<?php echo $form_id?>)"><?php _e('Save settings', 'nm_webcontact')?></button>
			<span id="nm-saving-form" style="display:none"><img alt="saving..." src="<?php echo $nmcontact->plugin_meta['url']?>/images/loading.gif"></span></li>
	</ul>

	<div id="formbox-1">

		<table id="form-main-settings" border="0" bordercolor=""
			style="background-color: #F8F8F8; padding: 10px" width="100%"
			cellpadding="0" cellspacing="0">
			<tr>
				<td class="headings"><?php _e('Form name', 'nm_webcontact')?></td>
				<td><input type="text" name="form_name"
					value="<?php echo $form_name?>" /> <br />
					<p class="s-font"><?php _e('For your reference', 'nm_webcontact')?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Receiver(s)', 'nm_webcontact')?></td>
				<td><input type="text" name="receiver_emails"
					value="<?php echo get_bloginfo ( 'admin_email' )?>" disabled="disabled"/> <?php echo nm_webcontact_pro()?><br />
					<p class="s-font"><?php _e('Define the emails used (separeted by comma) to receive emails.', 'nm_webcontact')?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Sender Email', 'nm_webcontact')?></td>
				<td><input type="email" name="sender_email"
					value="<?php echo $sender_email?>" /> <br />
					<p class="s-font"><?php _e('Define from what email send the message.', 'nm_webcontact')?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Sender Name', 'nm_webcontact')?></td>
				<td><input type="text" name="sender_name"
					value="<?php echo $sender_name?>" /> <br />
					<p class="s-font"><?php _e('Define the name of email that send the message.', 'nm_webcontact')?></p>
				</td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Subject', 'nm_webcontact')?></td>
				<td><input type="text" name="subject" value="<?php echo $subject?>" />
					<br />
					<p class="s-font"><?php _e('Define the subject of the email sent to you.', 'nm_webcontact')?></p></td>
			</tr>

			<tr>
				<td class="headings"><?php _e('Submit Button Label', 'nm_webcontact')?></td>
				<td><input type="text" name="button_label"
					value="<?php echo $button_label?>" /> <br />
					<p class="s-font"><?php _e('Define the label of submit button.', 'nm_webcontact')?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Submit Button Class', 'nm_webcontact')?></td>
				<td><input type="text" name="button_class"
					value="<?php echo $button_class?>" /> <br />
					<p class="s-font"><?php _e('Define the class of submit button.', 'nm_webcontact')?></p></td>
			</tr>
			
			<tr>
				<td class="headings"><?php _e('Success Message', 'nm_webcontact')?></td>
				<td><input type="text" name="success_message"
					value="<?php echo $success_message?>" /> <br />
					<p class="s-font"><?php _e('Define the message when form is submitted successfully.', 'nm_webcontact')?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Error Message', 'nm_webcontact')?></td>
				<td><input type="text" name="error_message"
					value="<?php echo $error_message?>" /> <br />
					<p class="s-font"><?php _e('Define the message when there is an error on send of email.', 'nm_webcontact')?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Receive file mode', 'nm_webcontact')?></td>
				<td><label for="file_send_link"><input type="radio"
						id="file_send_link" name="send_file_as" value="file"
						<?php echo $checked_file?> />
						<?php _e('Send as Link (suggestion: if files sizes are big then use this)', 'nm_webcontact')?>
					</label> <br> <label for="file_send_attach"><input type="radio"
						id="file_send_attach" name="send_file_as" value="attachment"
						<?php echo $checked_attachment?> />
						<?php _e('Send as Attachment (suggestion: if files sizes are normal)', 'nm_webcontact')?>
					</label> <br />
					<p class="s-font"><?php _e('Select whether file uploaded by user will be recieved to admin as attachment or link', 'nm_webcontact')?></p></td>
			</tr>
			
			<tr>
				<td class="headings"><?php _e('Slide sections using jquery?', 'nm_webcontact')?></td>
				<td><input type="checkbox" disabled="disabled" id="section_slides" name="section_slides" <?php echo $section_slides?> /> <?php echo nm_webcontact_pro()?><br>
				<p class="s-font"><?php _e('Not all section will be shown at once, it add a nice sliding effect.', 'nm_webcontact')?></p>
				</td>
				
			</tr>

			<!-- Photo editing with Aviary -->
			<tr>
				<td class="headings"><?php _e('Aviary API Key (Photo Editing)', 'nm_webcontact')?>
				<a class="button" href="http://aviary.com/web" target="_blank"><?php _e('Learn about Aviary', 'nm_webcontact')?></a></td>
				<td>
				
				<?php if ($nmcontact -> is_aviary_installed()) {?>
				<input type="text" name="aviary_api_key"
					value="<?php echo $aviary_api_key?>" disabled="disabled" /> <?php echo nm_webcontact_pro()?><br />
					<p class="s-font"><?php _e('Enter Aviary API Key.', 'nm_webcontact')?>
					<br><?php _e('You need to get your API key from Aviary to use this. It is free as long as you need paid features', 'nm_webcontact')?></p>
				<?php }else{?>
					<p class="s-font">
						<a href="#" class="button-primary" target="_blank"><?php _e('See Demo', 'nm_webcontact')?></a>
						<?php echo nm_webcontact_pro()?>
					</p>
					
					<?php }?>
						
					</td>
			</tr>
			
			<tr>
				<td class="headings"><?php _e('Form styling/css', 'nm_webcontact')?> <?php echo nm_webcontact_pro()?></td>
				<td><textarea disabled="disabled" rows="7" cols="25" name="form_style"></textarea><br />
					<p class="s-font"><?php _e('Form styling/css.', 'nm_webcontact')?></p></td>
			</tr> 
		</table>

	</div>
	<!--------------------- END formbox-1 ---------------------------------------->

	<div id="formbox-2">
		<div id="form-meta-bttons">
			<p>
		<?php _e('select input type below and drag it on right side. Then set more options', 'nm_webcontact')?>
		</p>

			<ul id="nm-input-types">
		<?php
		foreach ( $types as $type => $data ) {
			
			echo '<li class="input-type-item '.$data['for'].'" data-inputtype="' . $type . '" data-for="' . $data['for'] . '">';
			echo '<div><h3><span class="top-heading-text">' . $data ['title'] . '</span>';
			echo '<span class="top-heading-icons ui-icon ui-icon-arrow-4"></span>';
			echo '<span class="top-heading-icons ui-icon-placehorder"></span>';
			echo '<span style="clear:both;display:block"></span>';
			echo '</h3>';
			
			// this function Defined below
			echo render_input_settings ( $data ['settings'] );
			
			echo '</div></li>';
			// echo '<div><p>'.$data['desc'].'</p></div>';
		}
		?>
		</ul>
		</div>


		<div id="form-meta-setting" class="postbox-container">

			<div id="postcustom" class="postbox">
				<h3>
					<span style="float: left"><?php _e('Drage form fields here', 'nm_webcontact')?></span>
					<span style="float: right"><span style="float: right"
						title="<?php _e('Collapse all', 'nm_webcontact')?>"
						class="ui-icon ui-icon-circle-triangle-n"></span><span
						title="<?php _e('Expand all', 'nm_webcontact')?>"
						class="ui-icon ui-icon-circle-triangle-s"></span></span> <span
						class="clearfix"></span>
				</h3>
				<div class="inside" style="background-color: #fff;">
					<ul id="meta-input-holder">
					<?php render_existing_form_meta($form_meta, $types)?>
					</ul>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

<!-- ui dialogs -->
<div id="remove-meta-confirm"
	title="<?php _e('Are you sure?', 'nm_webcontact')?>">
	<p>
		<span class="ui-icon ui-icon-alert"
			style="float: left; margin: 0 7px 20px 0;"></span>
  <?php _e('Are you sure to remove this input field?', 'nm_webcontact')?></p>
</div>

<?php
function render_input_settings($settings, $values = '') {
	$setting_html = '<table>';
	foreach ( $settings as $meta_type => $data ) {
		
		$setting_html .= '<tr>';
		$setting_html .= '<td class="table-column-title">' . $data ['title'] . '</td>';
		
		if ($values)
			$setting_html .= '<td class="table-column-input" data-type="' . $data ['type'] . '" data-name="' . $meta_type . '">' . render_input_types ( $data ['type'], $meta_type, $values [$meta_type], $data ['options'], $data['for'] ) . '</td>';
		else
			$setting_html .= '<td class="table-column-input" data-type="' . $data ['type'] . '" data-name="' . $meta_type . '">' . render_input_types ( $data ['type'], $meta_type, null, $data ['options'], $data['for'] ) . '</td>';
		
		if ($data['for'] == 'pro') {
			$setting_html .= '<td class="table-column-desc">' . $data ['desc'] . nm_webcontact_pro().'</td>';
		}else{
			$setting_html .= '<td class="table-column-desc">' . $data ['desc'] . '</td>';
		}
		
		$setting_html .= '</tr>';
	}
	
	$setting_html .= '</table>';
	
	return $setting_html;
}

/*
 * this function is rendring input field for settings
 */
function render_input_types($type, $name, $value = '', $options = '', $for = 'free') {
	$html_input = '';
	
	$disabled = ($for == 'pro') ? 'disabled="disabled"' : '';
	stripslashes($value);
	
	switch ($type) {
		
		case 'text' :
			$html_input .= '<input type="text" name="' . $name . '" value="' . $value . '" '.$disabled.'>';
			break;
		
		case 'textarea' :
			$html_input .= '<textarea name="' . $name . '" '.$disabled.'>' . $value . '</textarea>';
			break;
		
		case 'select' :
			$html_input .= '<select name="' . $name . '" '.$disabled.'>';
			foreach ( $options as $key => $val ) {
				$selected = ($key == $value) ? 'selected="selected"' : '';
				$html_input .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
			}
			$html_input .= '</select>';
			break;
		
		case 'checkbox' :
			
			if ($options) {
				foreach ( $options as $key => $val ) {
					
					parse_str ( $value, $saved_data );
					if ($saved_data ['editing_tools']) {
						if (in_array($key, $saved_data['editing_tools'])) {
							$checked = 'checked="checked"';
						}else{
							$checked = '';
						}
					}
					// $html_input .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
					$html_input .= '<input '.$disabled.' type="checkbox" value="' . $key . '" name="' . $name . '[]" ' . $checked . '> ' . $val . '<br>';
				}
			} else {
				if ($value)
					$checked = 'checked = "checked"';
				$html_input .= '<input '.$disabled.' type="checkbox" name="' . $name . '" ' . $checked . '>';
			}
			break;
	}
	
	return $html_input;
}

/*
 * this function is rendering the existing form meta
 */
function render_existing_form_meta($form_meta, $types) {
	if ($form_meta) {
		foreach ( $form_meta as $key => $meta ) {
			
			$type = $meta ['type'];
			
			/*
			 * echo '<pre>'; print_r($meta_data); echo '</pre>';
			 */
			
			echo '<li data-inputtype="' . $type . '"><div class="postbox">';
			echo '<h3><span class="top-heading-text">' . $meta ['title'] . ' (' . $type . ')</span>';
			echo '<span class="top-heading-icons ui-icon ui-icon-carat-2-n-s"></span>';
			echo '<span class="top-heading-icons ui-icon ui-icon-trash"></span>';
			echo '<span style="clear:both;display:block"></span></h3>';
			
			echo render_input_settings ( $types [$type] ['settings'], $meta );
			
			echo '</div></li>';
		}
	}
}

?>