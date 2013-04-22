<?php

global $nmcontact;

if(isset($_REQUEST['form_id']) && $_REQUEST['form_id'] != ''){
	
	$single_form = $nmcontact -> get_forms(intval($_REQUEST['form_id']));
	//$this -> pa($single_form); 
	
	
	$form_name			= $single_form -> form_name;
	$from_email			= $single_form -> from_email;
	$from_name			= $single_form -> from_name;
	$subject			= $single_form -> subject;
	$receiver_emails	= $single_form -> receiver_emails;
	$reply_to			= $single_form -> reply_to;
	
	
	$file_meta 		= json_decode( $single_form -> file_meta, true);
	$form_meta 		= json_decode( $single_form -> the_meta, true);
	
		
}


/* woo_pa($form_meta); */

//adding an extra slot if no meta defined
if($form_meta == NULL){
	$form_meta[] = array(
					'label'	=> '_new_',
					'type'	=> '',
					'options'	=> '',
					'required'	=> '');
	
	$save_button_label = __('Save Form Meta', $nmcontact->plugin_meta['shortname']);
	
	echo '<button class="button button-primary" onclick="javascript:show_add_meta()">'.__('Add Form', $nmcontact->plugin_shortname).'</button>';
}else{
	
	
	$save_button_label = __('Update Form Meta', $nmcontact->plugin_meta['shortname']);
}
$the_i = 1;

$display_meta = isset($_REQUEST['form_id']) ? '' : 'none';
?>

<div id="add-edit-meta" style="display:<?php  echo $display_meta?>">
<input type="hidden" name="existing_form_id" value="<?php echo intval($_REQUEST['form_id'])?>" />


<table>
<tr>
<td style="width:400px;">

<h3><?php _e('Contact form Setting', $nmcontact -> plugin_meta['shortname'])?></h3>
<input type="hidden" name="existing_form_id" value="<?php echo intval($_REQUEST['form_id'])?>" />
<p>
<label for="form_name"><?php _e('Form name', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="form_name" name="form_name" value="<?php echo $form_name?>" />
</label>
</p>

<p>
<label for="from_email"><?php _e('Email (FROM)', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="from_email" name="from_email" value="<?php echo $from_email?>" />
</label>
</p>

<p>
<label for="from_name"><?php _e('Name (FROM)', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="from_name" name="from_name" value="<?php echo $from_name?>" />
</label>
</p>

<p>
<label for="subject"><?php _e('Subject', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="subject" name="subject" value="<?php echo $subject?>" />
</label>
</p>

<p>
<label for="receiver_emails"><?php _e('Receivers (separated by comma if more then one needed)', $nmcontact->plugin_meta['shortname'])?> <?php nm_webcontact_pro()?><br>
<input type="text" class="regular-text" id="receiver_emails" name="receiver_emails" value="-- admin --" disabled="disabled" />
</label>
</p>

<p>
<label for="reply_to"><?php _e('Reply to (optional)', $nmcontact->plugin_meta['shortname'])?> <?php nm_webcontact_pro()?><br>
<input type="text" class="regular-text" id="reply_to" name="reply_to" value="-- admin --" disabled="disabled" />
</label>
</p>

</td>


<?php 
if($single_form -> allow_file_upload != ''){
	$allow_upload_checked =  'checked="checked"';
	$displa_file_meta = '';
}else{
	$allow_upload_checked =  '';
	$displa_file_meta = 'none';
}

$checked_file 		= ($single_form -> send_file_as == 'file') ? 'checked="checked"' : '';
$checked_attachment = ($single_form -> send_file_as == 'attachment') ? 'checked="checked"' : '';


?>
<!-- File settings  -->
<td style="vertical-align: text-top;">

<h3><?php _e('File Setting', $nmcontact -> plugin_meta['shortname'])?></h3>

<p>
<label for="allow_file_upload"><input type="checkbox" id="allow_file_upload" name="allow_file_upload" <?php echo $allow_upload_checked?> />
<?php _e('Allow File Upload?', $nmcontact->plugin_meta['shortname'])?>
</label>
</p>

<div id="file-upload-settings" style="display:<?php echo $displa_file_meta?>">

<p>
<label for="size_limit"><?php _e('Size Limit (in KB e.g: 500)', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="size_limit" name="size_limit" value="<?php echo $file_meta['size_limit']?>" />
</label>
</p>

<p>
<label for="button_text"><?php _e('Button Text', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="button_text" name="button_text" value="<?php echo $file_meta['button_text']?>" />
</label>
</p>

<p>
<label for="types_allowed"><?php _e('File Types Allowed (separated by comma e.g: jpg,gif.pdf)', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="types_allowed" name="types_allowed" value="<?php echo $file_meta['types_allowed']?>" />
</label>
</p>

<p>
<label for="files_allowed"><?php _e('Files allowed per Upload (suggestion: keep it as low as possible)', $nmcontact->plugin_meta['shortname'])?> <?php nm_webcontact_pro()?><br>
<input type="text" class="regular-text" id="files_allowed" name="files_allowed" value="1" disabled="disabled"/>
</label>
</p>

<p>
<label for="file_send_link"><input type="radio" id="file_send_link" name="send_file_as" value="file" <?php echo $checked_file?> />
<?php _e('Send as Link (suggestion: if files sizes are big then use this)', $nmcontact->plugin_meta['shortname'])?>
</label>
<br>
<label for="file_send_attach"><input type="radio" id="file_send_attach" name="send_file_as" value="attachment" <?php echo $checked_attachment?> />
<?php _e('Send as Attachment (suggestion: if files sizes are normal)', $nmcontact->plugin_meta['shortname'])?>
</label>
</p>

<p>
<label for="file_is_required"><input type="checkbox" id="file_is_required" name="file_is_required" disabled="disabled" />
<?php _e('Set as required', $nmcontact->plugin_meta['shortname'])?> <?php nm_webcontact_pro()?>
</label>
</p>

</div>
</td>

</tr>
</table>


<h2><?php _e('Create/Manage Form fields below', $nmcontact->plugin_meta['shortname'])?></h2>

<table class="wp-list-table widefat plugins" cellspacing="0" id="nm-file-meta-admin">
	<thead>
	<tr>
		<th scope="col" id="label" class="manage-column" style=""><?php _e('Label', $nmcontact->plugin_meta['shortname'])?></th>
        <th scope="col" id="type" class="manage-column" style=""><?php _e('Type', $nmcontact->plugin_meta['shortname'])?></th>	
        <th scope="col" id="options" class="manage-column" style=""><?php _e('*Options', $nmcontact->plugin_meta['shortname'])?></th>
        <th scope="col" id="required" class="manage-column" style=""><?php _e('Required?', $nmcontact->plugin_meta['shortname'])?></th>	
        </tr>
	</thead>

	<tfoot>
	<tr>
		<th scope="col" id="label" class="manage-column" style=""><?php _e('Label', $nmcontact->plugin_meta['shortname'])?></th>
        <th scope="col" id="type" class="manage-column" style=""><?php _e('Type', $nmcontact->plugin_meta['shortname'])?></th>	
        <th scope="col" id="options" class="manage-column" style=""><?php _e('*Options', $nmcontact->plugin_meta['shortname'])?></th>
        <th scope="col" id="required" class="manage-column" style=""><?php _e('Required?', $nmcontact->plugin_meta['shortname'])?></th>	
        </tr>
        
	</tfoot>

	<tbody id="the-list">
	
	<?php
	$input_types	= array(	'text'		=> 'Text',
								'textarea'	=> 'Textarea',
								'email'		=> 'Email',
								'checkbox'	=> 'Checkbox',
								'select'	=> 'Select');
	
	foreach ($form_meta as $meta):
	//pa($meta);
	
	$is_required = ($meta['required'] == 1) ? 'checked="checked"' : '';
	$show_message = ($meta['required'] == 1) ? '' : 'none';
	?>
	
		<tr class="add-meta" id="add-meta-<?php echo $the_i?>">
        
        <td class="">
        <input type="text" name="meta-label" value="<?php echo $meta['label']?>" />
        
        <!--  DON't delete the first node -->
        <?php if($meta['label'] != '_new_' && $the_i != 1):?>
        	<br><img src="<?php echo $nmcontact->plugin_meta['url']?>/images/delete_16.png" onclick="javascript:remove_meta(<?php echo $the_i?>)">
        <?php endif;?>
        
        
        </td>
        <td><select name="meta-type">
        <option></option>
        <?php foreach ($input_types as $key => $type):
        		$selected = ($key == $meta['type']) ? 'selected="selected"' : '';
        ?>
        	<option value="<?php echo $key?>" <?php echo $selected?>><?php _e($type, $nmcontact->plugin_meta['shortname'])?></option>
        <?php endforeach;?>    
        </select>
        </td>
        
        <td><textarea name="meta-options" placeholder="<?php _e('Type each option per line', $nmcontact->plugin_meta['shortname'])?>"><?php echo $meta['options']?></textarea></td>        
        
        <td><input type="checkbox" name="meta-required" value="1" <?php echo $is_required?> />
        <span style="display:<?php echo $show_message?>"><br><input disabled="disabled" type="text" placeholder="message when error:" value="<?php echo $meta['message']?>" name="message"><?php nm_webcontact_pro()?></span></td>        
        </tr>
        
        <tr id="load-newmeta-here"></tr>	
        
    <?php 
    $the_i++;
    endforeach;?>
    	<tr class="inactive">
	        <td class="" id="">
			<button class="button" onclick="javascript:add_another_meta()"><?php _e('Add another field', $nmcontact->plugin_meta['shortname'])?></button></td>
	        <td>&nbsp;</td>
	        
	        <td>&nbsp;</td>        
	        
	        <td>&nbsp;</td>
	        
	    </tr>
    <script type="text/javascript">
    nm_webcontact_vars.add_meta_counter = '<?php echo $the_i?>';
    </script>
        
        </tbody>
</table>
<p>
<?php _e('* Options is for <strong>Select</strong> and <strong>Checkbox</strong> types. Type each option per line', $nmcontact->plugin_meta['shortname'])?><br />
</p>
<button class="button button-primary" onclick="javascript:save_file_meta()"><?php echo $save_button_label?></button>
<button class="button" onclick="javascript:show_add_meta()"><?php _e('Cancel', $nmcontact->plugin_meta['shortname'])?></button>
<span id="saving-meta"></span>
</div>	<!--  add-edit-meta -->