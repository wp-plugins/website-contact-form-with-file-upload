<?php
/*
 * This our new world, Inshallah 29 aug, 2013
 */
global $nmcontact;

// text, password, textarea types settings

$section_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will as section heading wrapped in h2', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type description, it will be diplay under section heading.', $nmcontact->plugin_meta ['shortname'] ) 
		) 
);

$text_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will be shown as field label', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert the error message for validation.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if it must be required.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type field width in % e.g: 50%', $nmcontact->plugin_meta ['shortname'] ) 
		) 
);

$hidden_settings = array (
		
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] )
		),
		'field_value' => array (
				'type' => 'text',
				'title' => __ ( 'Field value', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'you can pre-set the value of this hidden input.', $nmcontact->plugin_meta ['shortname'] )
		),
);

$date_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will be shown as field label', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert the error message for validation.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if it must be required.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type field width in % e.g: 50%', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'date_formats' => array (
				'type' => 'select',
				'title' => __ ( 'Date formats', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select date format.', $nmcontact->plugin_meta ['shortname'] ),
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
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will be shown as field label', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert the error message for validation.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if it must be required.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type field width in % e.g: 50%', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'send_email' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Send email', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if you want user get this form.', $nmcontact->plugin_meta ['shortname'] ),
				'for'	=> 'pro'
		)
)
;

// checkbox settings
$check_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will be shown as field label', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert the error message for validation.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'options' => array (
				'type' => 'textarea',
				'title' => __ ( 'Add options', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type each option per line', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if it must be required.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type field width in % e.g: 50%', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'checked' => array (
				'type' => 'textarea',
				'title' => __ ( 'Checked option(s)', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type option(s) name (given above) if you want already checked.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'min_checked' => array (
				'type' => 'text',
				'title' => __ ( 'Min. Checked option(s)', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'How many options can be checked by user e.g: 2. Leave blank for default.', $nmcontact->plugin_meta ['shortname'] ),
				'for'	=> 'pro',
		),
		
		
		'max_checked' => array (
				'type' => 'text',
				'title' => __ ( 'Max. Checked option(s)', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'How many options can be checked by user e.g: 3. Leave blank for default.', $nmcontact->plugin_meta ['shortname'] ),
				'for'	=> 'pro',
		) 
);

// select settings
$select_radio_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will be shown as field label', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert the error message for validation.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'options' => array (
				'type' => 'textarea',
				'title' => __ ( 'Add options', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type each option per line', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'selected' => array (
				'type' => 'text',
				'title' => __ ( 'Selected option', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type option name (given above) if you want already selected.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if it must be required.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type field width in % e.g: 50%', $nmcontact->plugin_meta ['shortname'] ) 
		) 
);

// checkbox settings
$file_settings = array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'It will be shown as field label', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert the error message for validation.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select this if it must be required.', $nmcontact->plugin_meta ['shortname'] ),
				'for'	=> 'pro',
		),
		
		
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'width' => array (
				'type' => 'text',
				'title' => __ ( 'Width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type field width in % e.g: 50%', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'button_label' => array (
				'type' => 'text',
				'title' => __ ( 'Button label', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type button label e.g: Upload Photos', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'button_width' => array (
				'type' => 'text',
				'title' => __ ( 'Button width', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type button width in px e.g: 150 (for 150px)', $nmcontact->plugin_meta ['shortname'] ) 
		),
		'files_allowed' => array (
				'type' => 'text',
				'title' => __ ( 'Files allowed', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type number of files allowed per upload by user, e.g: 3', $nmcontact->plugin_meta ['shortname'] ),
				'for'	=> 'pro',
		),
		'file_types' => array (
				'type' => 'text',
				'title' => __ ( 'File types', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'File types allowed seperated by comma, e.g: jpg,pdf,zip', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'file_size' => array (
				'type' => 'text',
				'title' => __ ( 'File size', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Type size in KB per file uploaded by user, e.g: 5000 (5 MB)', $nmcontact->plugin_meta ['shortname'] ) 
		),
		
		'photo_editing' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Enable photo editing', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Allow users to edit photos by Aviary API, make sure that Aviary API Key is set in previous tab.', $nmcontact->plugin_meta ['shortname'] ),
				'for'	=> 'pro',
		),
		
		'editing_tools' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Editing Options', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'Select editing options', $nmcontact->plugin_meta ['shortname'] ),
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
				'title' => __ ( 'Text Input', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'regular text input', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $text_settings 
		),
		'email' => array (
				'title' => __ ( 'Email Input', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'email input', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $email_settings 
		),
		'checkbox' => array (
				'title' => __ ( 'Checkbox', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'checkbox options', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $check_settings 
		),
		'select' => array (
				'title' => __ ( 'Select', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'select options', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $select_radio_settings 
		),
		'textarea' => array (
				'title' => __ ( 'Textarea', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'textrea for large input', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $text_settings 
		),
		'radio' => array (
				'title' => __ ( 'Radio buttons', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'radio buttons', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $select_radio_settings 
		),
		
		'file' => array (
				'title' => __ ( 'File upload', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'file uploader', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $file_settings
		),
		
		'date' => array (
				'title' => __ ( 'Date', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'date', $nmcontact->plugin_meta ['shortname'] ),
				'settings' => $date_settings,
				'for'	=> 'pro',
		),
		
		'section' => array (
				'title' => __ ( 'Section (Heading)', $nmcontact->plugin_meta ['shortname'] ),
				'desc' => __ ( 'file uploader', $nmcontact->plugin_meta ['shortname'] ),
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
		<li><a href="#formbox-1"><?php _e('Form Settings', $nmcontact -> plugin_meta['shortname'])?></a></li>
		<li><a href="#formbox-2"><?php _e('Form Fields', $nmcontact -> plugin_meta['shortname'])?></a></li>
		<li style="float: right"><button class="button-primary button"
				onclick="save_form_meta(<?php echo $form_id?>)"><?php _e('Save settings', $nmcontact -> plugin_meta['shortname'])?></button>
			<span id="nm-saving-form" style="display:none"><img alt="saving..." src="<?php echo $nmcontact->plugin_meta['url']?>/images/loading.gif"></span></li>
	</ul>

	<div id="formbox-1">

		<table id="form-main-settings" border="0" bordercolor=""
			style="background-color: #F8F8F8; padding: 10px" width="100%"
			cellpadding="0" cellspacing="0">
			<tr>
				<td class="headings"><?php _e('Form name', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="form_name"
					value="<?php echo $form_name?>" /> <br />
					<p class="s-font"><?php _e('For your reference', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Receiver(s)', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="receiver_emails"
					value="<?php echo get_bloginfo ( 'admin_email' )?>" disabled="disabled"/> <?php echo nm_webcontact_pro()?><br />
					<p class="s-font"><?php _e('Define the emails used (separeted by comma) to receive emails.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Sender Email', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="email" name="sender_email"
					value="<?php echo $sender_email?>" /> <br />
					<p class="s-font"><?php _e('Define from what email send the message.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Sender Name', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="sender_name"
					value="<?php echo $sender_name?>" /> <br />
					<p class="s-font"><?php _e('Define the name of email that send the message.', $nmcontact -> plugin_meta['shortname'])?></p>
				</td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Subject', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="subject" value="<?php echo $subject?>" />
					<br />
					<p class="s-font"><?php _e('Define the subject of the email sent to you.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>

			<tr>
				<td class="headings"><?php _e('Submit Button Label', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="button_label"
					value="<?php echo $button_label?>" /> <br />
					<p class="s-font"><?php _e('Define the label of submit button.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Submit Button Class', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="button_class"
					value="<?php echo $button_class?>" /> <br />
					<p class="s-font"><?php _e('Define the class of submit button.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			
			<tr>
				<td class="headings"><?php _e('Success Message', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="success_message"
					value="<?php echo $success_message?>" /> <br />
					<p class="s-font"><?php _e('Define the message when form is submitted successfully.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Error Message', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><input type="text" name="error_message"
					value="<?php echo $error_message?>" /> <br />
					<p class="s-font"><?php _e('Define the message when there is an error on send of email.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			<tr>
				<td class="headings"><?php _e('Receive file mode', $nmcontact -> plugin_meta['shortname'])?></td>
				<td><label for="file_send_link"><input type="radio"
						id="file_send_link" name="send_file_as" value="file"
						<?php echo $checked_file?> />
						<?php _e('Send as Link (suggestion: if files sizes are big then use this)', $nmcontact->plugin_meta['shortname'])?>
					</label> <br> <label for="file_send_attach"><input type="radio"
						id="file_send_attach" name="send_file_as" value="attachment"
						<?php echo $checked_attachment?> />
						<?php _e('Send as Attachment (suggestion: if files sizes are normal)', $nmcontact->plugin_meta['shortname'])?>
					</label> <br />
					<p class="s-font"><?php _e('Select whether file uploaded by user will be recieved to admin as attachment or link', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr>
			
			<tr>
				<td class="headings"><?php _e('Slide sections using jquery?', $nmcontact->plugin_meta['shortname'])?></td>
				<td><input type="checkbox" disabled="disabled" id="section_slides" name="section_slides" <?php echo $section_slides?> /> <?php echo nm_webcontact_pro()?><br>
				<p class="s-font"><?php _e('Not all section will be shown at once, it add a nice sliding effect.', $nmcontact -> plugin_meta['shortname'])?></p>
				</td>
				
			</tr>

			<!-- Photo editing with Aviary -->
			<tr>
				<td class="headings"><?php _e('Aviary API Key (Photo Editing)', $nmcontact -> plugin_meta['shortname'])?>
				<a class="button" href="http://aviary.com/web" target="_blank"><?php _e('Learn about Aviary', $nmcontact -> plugin_meta['shortname'])?></a></td>
				<td>
				
				<?php if ($nmcontact -> is_aviary_installed()) {?>
				<input type="text" name="aviary_api_key"
					value="<?php echo $aviary_api_key?>" disabled="disabled" /> <?php echo nm_webcontact_pro()?><br />
					<p class="s-font"><?php _e('Enter Aviary API Key.', $nmcontact -> plugin_meta['shortname'])?>
					<br><?php _e('You need to get your API key from Aviary to use this. It is free as long as you need paid features', $nmcontact -> plugin_meta['shortname'])?></p>
				<?php }else{?>
					<p class="s-font">
						<a href="#" class="button-primary" target="_blank"><?php _e('See Demo', $nmcontact -> plugin_meta['shortname'])?></a>
						<?php echo nm_webcontact_pro()?>
					</p>
					
					<?php }?>
						
					</td>
			</tr>
			
			<tr>
				<td class="headings"><?php _e('Form styling/css', $nmcontact -> plugin_meta['shortname'])?> <?php echo nm_webcontact_pro()?></td>
				<td><textarea disabled="disabled" rows="7" cols="25" name="form_style"></textarea><br />
					<p class="s-font"><?php _e('Form styling/css.', $nmcontact -> plugin_meta['shortname'])?></p></td>
			</tr> 
		</table>

	</div>
	<!--------------------- END formbox-1 ---------------------------------------->

	<div id="formbox-2">
		<div id="form-meta-bttons">
			<p>
		<?php _e('select input type below and drag it on right side. Then set more options', $nmcontact -> plugin_meta['shortname'])?>
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
					<span style="float: left"><?php _e('Drage form fields here', $nmcontact -> plugin_meta['shortname'])?></span>
					<span style="float: right"><span style="float: right"
						title="<?php _e('Collapse all', $nmcontact -> plugin_meta['shortname'])?>"
						class="ui-icon ui-icon-circle-triangle-n"></span><span
						title="<?php _e('Expand all', $nmcontact -> plugin_meta['shortname'])?>"
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
	title="<?php _e('Are you sure?', $nmcontact -> plugin_meta['shortname'])?>">
	<p>
		<span class="ui-icon ui-icon-alert"
			style="float: left; margin: 0 7px 20px 0;"></span>
  <?php _e('Are you sure to remove this input field?', $nmcontact -> plugin_meta['shortname'])?></p>
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