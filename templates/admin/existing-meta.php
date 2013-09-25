<?php
/*
 * this file showing existing meta group
* in admin
*/

global $nmcontact;
echo '<hr/>';
echo '<h3>'.__('Existing Form Meta', $nmcontact->plugin_meta['shortname']).'</h3>';
?>


<table border="0" class="wp-list-table widefat plugins">
	<thead>
		<tr>
			<th style="width: 300px;"><?php _e('Name.', $nmcontact->plugin_meta['shortname'])?></th>
			<th style="width: 500px;"><?php _e('Meta.', $nmcontact->plugin_meta['shortname'])?></th>
			<th style="width: 300px;"><?php _e('Form.', $nmcontact->plugin_meta['shortname'])?></th>
			<th><?php _e('Delete.', $nmcontact->plugin_meta['shortname'])?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Name.', $nmcontact->plugin_meta['shortname'])?></th>
			<th><?php _e('Meta.', $nmcontact->plugin_meta['shortname'])?></th>
			<th><?php _e('Shortcode.', $nmcontact->plugin_meta['shortname'])?></th>
			<th><?php _e('Delete.', $nmcontact->plugin_meta['shortname'])?></th>
		</tr>
	</tfoot>
	
	<?php 
	$all_forms = $nmcontact -> get_forms();
	
	foreach ($all_forms as $form):
	
	$url_edit = $nmcontact -> nm_plugin_fix_request_uri(array('form_id'=>$form->form_id));
	
	$form_detail = '<strong>Email (FROM):</strong> '.$form -> sender_email;
	$form_detail .= '<br><strong>Name (FROM):</strong> '.$form -> sender_name;
	$form_detail .= '<br><strong>Subject:</strong> '.$form -> subject;
	$form_detail .= '<br><strong>Receivers :</strong> '.$form -> receiver_emails;
	
	?>
	<tr>
		<td><a href="<?php echo $url_edit?>"><?php echo stripcslashes($form -> form_name)?></a><br>
		<?php echo $form_detail?>
		</td>
		<td><?php echo $nmcontact -> simplify_meta($form -> the_meta)?></td>
		<td><em>[nm-wp-contact form_id="<?php echo $form -> form_id?>"]</em></td>
		<td><a href="javascript:are_sure(<?php echo $form -> form_id?>)"><img id="del-file-<?php echo $form -> form_id?>" src="<?php echo $nmcontact -> plugin_meta['url'].'/images/delete_16.png'?>" border="0" /></a></td>
	</tr>
	<?php 
	endforeach;
	?>
</table>
