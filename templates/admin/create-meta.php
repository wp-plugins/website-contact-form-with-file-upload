<?php

//Yes it is to for Slider control
echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />';
//finish loading stylsheet

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
	
	
	$form_meta 		= json_decode( $single_form -> the_meta, true);
	
		
}


// $nmcontact -> pa($single_form);

//adding an extra slot if no meta defined
if($form_meta == NULL){
	$form_meta[] = array(
					'label'	=> __('First Section', $nmcontact->plugin_meta['shortname']),
					'type'	=> 'section',
					'options'	=> __('Some detail', $nmcontact->plugin_meta['shortname']),
					'required'	=> '');
	
	$save_button_label = __('Save Form Meta', $nmcontact->plugin_meta['shortname']);
	
	echo '<button class="button button-primary" onclick="javascript:show_add_meta()">'.__('Add Form', $nmcontact->plugin_shortname).'</button>';
}else{
	
	
	$save_button_label = __('Update Form Meta', $nmcontact->plugin_meta['shortname']);
}
$the_i = 1;

$display_meta = isset($_REQUEST['form_id']) ? '' : 'none';

$checked_file 		= ($single_form -> send_file_as == 'file') ? 'checked="checked"' : '';
$checked_attachment = ($single_form -> send_file_as == 'attachment') ? 'checked="checked"' : '';

$section_slides = ($single_form -> section_slides == 'yes') ? 'checked="checked"' : '';
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
<label for="receiver_emails"><?php _e('Receivers (separated by comma if more then one needed)', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="receiver_emails" name="receiver_emails" value="<?php echo $receiver_emails?>" />
</label>
</p>

<p>
<label for="reply_to"><?php _e('Reply to (optional)', $nmcontact->plugin_meta['shortname'])?><br>
<input type="text" class="regular-text" id="reply_to" name="reply_to" value="<?php echo $reply_to?>" />
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
<label for="section_slides">
<input type="checkbox" id="section_slides" name="section_slides" value="yes" <?php echo $section_slides?> />
<?php _e('Slide sections using jquery?', $nmcontact->plugin_meta['shortname'])?>
</label>
</p>

</td>

</tr>
</table>


<h2><?php _e('Create/Manage Form fields below', $nmcontact->plugin_meta['shortname'])?></h2>
<p><?php _e('Following meta can be sorted by drag and drop the row', $nmcontact->plugin_meta['shortname'])?></p>

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
								'select'	=> 'Select',
								'file'		=> 'File',
								'date'		=> 'Date',);
	
	$date_formats = array(	'mm/dd/yy'		=> 'Default - mm/dd/yy', 
							'yy-mm-dd'		=> 'ISO 8601 - yy-mm-dd', 
							'd M, y' 		=> 'Short - d M, y',
							'd MM, y'		=> 'Medium - d MM, y',
							'DD, d MM, yy'	=> 'Full - DD, d MM, yy',
							'\'day\' d \'of\' MM \'in the year\' yy'	=> 'With text - \'day\' d \'of\' MM \'in the year\' yy');
	
	foreach ($form_meta as $meta):
	
	$is_required = ($meta['required'] == 1) ? 'checked="checked"' : '';
	$show_message = ($meta['required'] == 1) ? '' : 'none';
	
	if($meta['type']  == 'section'){
	?>
	
	<!--  SECTION STARTED -->
	<tr style="background-color:#6DD0FF" class="add-meta the-section" id="add-meta-<?php echo $the_i?>">
	<td colspan="4" style="text-align: center">
	<header class="webcontact-section-header">
	<input type="text" name="meta-label" value="<?php echo stripslashes( $meta['label'])?>" /><br>
	<textarea name="meta-options"><?php echo stripslashes( $meta['options'])?></textarea><br>
	<select name="meta-type" onchange="set_field_options(this, this.value, <?php echo $the_i?>)">
	<option value="section">Section</option>
	</select><br>
	<a href="javascript:remove_meta(<?php echo $the_i?>)"><?php _e('Remove this section', $nmcontact->plugin_meta['shortname'])?></a>
	</header>
	</td>
	</tr>
	<!--  SECTION ENDED -->
	
	<?php }else{	?>
	
	<!--  OTHER TYPES -->
		<tr class="add-meta" id="add-meta-<?php echo $the_i?>">
        
        <td style="width:18%">
        
        <img src="<?php echo $nmcontact->plugin_meta['url']?>/images/delete_16.png" onclick="javascript:remove_meta(<?php echo $the_i?>)">
        <input type="text" name="meta-label" value="<?php echo $meta['label']?>" />
        
        </td>
        
        <td <td style="width:15%">
        <select name="meta-type" onchange="set_field_options(this, this.value, <?php echo $the_i?>)">
        <option></option>
        <?php foreach ($input_types as $key => $type):
        		$selected = ($key == $meta['type']) ? 'selected="selected"' : '';
        ?>
        	<option value="<?php echo $key?>" <?php echo $selected?>><?php _e($type, $nmcontact->plugin_meta['shortname'])?></option>
        <?php endforeach;?>    
        </select>
        
        </td>
        
        
        <td>
        <?php if ($meta['type'] == 'date'):?>
        	<select id="meta-options" name="meta-options">
        	<?php foreach ($date_formats as $format => $desc):?>
	    		<option value="<?php echo $format?>" <?php selected( stripcslashes($meta['options']),  $format); ?>><?php echo $desc?></option>
	    	<?php endforeach;?>
	    	</select>
        <?php elseif($meta['type'] == 'file'): 
        
        $file_options = $meta['options'];
        
        ?>
        
        	<input type="text" name="button_text" placeholder="Button Label" value="<?php echo $file_options['button_text']?>"><br>
        	<input type="text" name="files_allowed" placeholder="file alowed: 5" value="<?php echo $file_options['files_allowed']?>"><br>
        	<input type="text" name="types_allowed" placeholder="file types jpg,gif,pdf" value="<?php echo $file_options['types_allowed']?>"><br>
        	<input type="text" name="file_size_limit" placeholder="filesize(in KB): 200" value="<?php echo $file_options['size_limit']?>"><br>
        	<input type="text" name="button_width" placeholder="button width(in px): 150" value="<?php echo $file_options['button_width']?>"><br>
     
        
        <?php elseif($meta['type'] == 'select' || $meta['type'] == 'checkbox') :?>
        
        	<textarea name="meta-options" placeholder="<?php _e('Type each option per line', $nmcontact->plugin_meta['shortname'])?>"><?php echo $meta['options']?></textarea><br>
        	
        <?php endif;?>
        
        	<!-- slider control -->
            <p>
	  			<label for="size-<?php echo $the_i?>"><?php _e('Maximum size:', $nmcontact->plugin_meta['shortname'])?></label>
	  			<input type="text" name="field-size" value="<?php echo $meta['size']?>" id="size-<?php echo $the_i?>" style="border: 0; color: #f6931f; font-weight: bold;" />
			</p>
	 
			<div class="slider-range-size" id="slider-size-<?php echo $the_i?>" style="width:50%"></div>
			<script type="text/javascript">
			<!--
				jQuery( "#slider-size-<?php echo $the_i?>" ).slider({ value: <?php echo intval($meta['size'])?>,
						slide: function( event, ui ) {
							jQuery( "#size-<?php echo $the_i?>" ).val( ui.value + "%");
					      }
			      });
			//--></script>
    	   	
        </td>
        
        
        <td>
        <input type="checkbox" name="meta-required" value="1" <?php echo $is_required?> />
        <span style="display:<?php echo $show_message?>"><br>
        <input type="text" placeholder="message when error:" value="<?php echo stripslashes($meta['message'])?>" name="message"></span>
        </td>        
        </tr>
        
    
    <?php }		//if($meta['type']  == 'section'){?>
	    
	<!--  OTHER TYPES ENDS -->
        
    <?php 
    $the_i++;
    endforeach;
    ?>
    	<tr class="inactive">
	        <td colspan="4">
	        <select name="new-meta-type">
        	<option><?php _e('Select type', $nmcontact->plugin_meta['shortname'])?></option>
        	<?php 
        	$input_types['section'] = '== Section ==';
        	foreach ($input_types as $key => $type):	?>
        		<option value="<?php echo $key?>" ><?php _e($type, $nmcontact->plugin_meta['shortname'])?></option>
        	<?php endforeach;?>    
        	</select>
			<button class="button" onclick="javascript:add_another_meta()"><?php _e('Add selected field', $nmcontact->plugin_meta['shortname'])?></button></td>
	        
	</tr>
	
	
    <script type="text/javascript">
    <!--
    nm_webcontact_vars.add_meta_counter = '<?php echo $the_i?>';
    //--></script>
        
        </tbody>
</table>
<p>
<?php _e('* Options is for <strong>Select</strong> and <strong>Checkbox</strong> types. Type each option per line', $nmcontact->plugin_meta['shortname'])?><br />
</p>
<button class="button button-primary" onclick="javascript:save_file_meta()"><?php echo $save_button_label?></button>
<button class="button" onclick="javascript:show_add_meta()"><?php _e('Cancel', $nmcontact->plugin_meta['shortname'])?></button>
<span id="saving-meta"></span>
</div>	<!--  add-edit-meta -->