<?php
/*
 * rendering product meta on product page
 */

global $nmcontact;

$single_form = $nmcontact -> get_forms( $nmcontact -> form_id );
//$nmcontact -> pa($single_form);


//setting file_meta var
echo '<script type="text/javascript">nm_webcontact_vars.file_meta='.$single_form -> file_meta.'</script>';

$existing_meta 		= json_decode( $single_form -> the_meta, true);

/* woo_pa($existing_meta); */

if($existing_meta){
	
echo '<div id="nm-webcontact-box-'.$nmcontact -> form_id.'" class="nm-webcontact-box">';

/*
 * forms extra information being sent hidden
 */
echo '<input type="hidden" name="_from_email" value="'.$single_form -> from_email.'">';
echo '<input type="hidden" name="_from_name" value="'.$single_form -> from_name.'">';
echo '<input type="hidden" name="_subject" value="'.$single_form -> subject.'">';
echo '<input type="hidden" name="_receiver_emails" value="'.$single_form -> receiver_emails.'">';
echo '<input type="hidden" name="_reply_to" value="'.$single_form -> reply_to.'">';
echo '<input type="hidden" name="_send_file_as" value="'.$single_form -> send_file_as.'">';

foreach($existing_meta as $meta)
{
	
	$name = strtolower(preg_replace("![^a-z0-9]+!i", "_", $meta['label']));
	
	
	switch($meta['type'])
	{
		case 'text':
			
			$value = stripslashes( $_POST[$name] );

?>

<p>
	<label for="<?php echo $name?>"><?php echo $meta['label']?></label>
    <br />
    	<input type="text" name="<?php echo $name?>" id="<?php echo $name?>" value="<?php echo $value?>" data-type="<?php echo $meta['type']?>" data-req="<?php echo $meta['required']?>" data-message="<?php echo $meta['message']?>" />

<span></span>	<!-- for validation message -->
</p>

<?php
	break;
	case 'email':
		
	$value = stripslashes( $_POST[$name] );

	?>

<p>
	<label for="<?php echo $name?>"><?php echo $meta['label']?></label>
    <br />
    	<input type="email" id="<?php echo $name?>" name="<?php echo $name?>" value="<?php echo $value?>" data-type="<?php echo $meta['type']?>" data-req="<?php echo $meta['required']?>" data-message="<?php echo $meta['message']?>" />

<span></span>	<!-- for validation message -->
</p>

<?php
	break;
	case 'checkbox':
		
		$value = $_POST[$name];
		
		/*
		 * variable price block
		 */
		$opts = explode("\n", $meta['options']);
		
		
?>

<p>
	<label for="<?php echo $name?>"><?php echo $meta['label']?></label>
    <br />
    	<?php foreach($opts as $opt)
		{
			if($value){
				if(in_array($opt, $value))
					$checked = 'checked="checked"';
				else 
					$checked = '';
			}
			
			$output = stripslashes(trim($opt));
			?>
            <label for="f-meta-<?php echo $opt?>">
    		<input type="checkbox" value="<?php echo $opt?>" id="f-meta-<?php echo $opt?>" name="<?php echo $name?>[]" <?php echo $checked?> data-req="<?php echo $meta['required']?>" data-message="<?php echo $meta['message']?>">
            <?php echo $output?></label>
        <?php
		}
		?>
<span></span>	<!-- for validation message -->
</p>

   <?php
	break;
	case 'select':
		$value = $_POST[$name];
		
		$opts = explode("\n", $meta['options']);
?>

<p>
	<label for="<?php echo $name?>"><?php echo $meta['label']?></label>
    <br />
    	<select id="<?php echo $name?>" name="<?php echo $name?>" data-req="<?php echo $meta['required']?>" data-message="<?php echo $meta['message']?>">
    <option value=""><?php _e('Select option')?></option>
    	<?php foreach($opts as $opt)
		{
			
			$selected = ($opt == $value) ? 'selected="selected"' : '';
			
			$output = stripslashes(trim($opt));
			
			?>
            <option value="<?php echo $opt?>" <?php echo $selected?>><?php echo $output?></option>
        <?php
		}
		?>
        </select>
        
<span></span>	<!-- for validation message -->      
</p>

   <?php
	break;
	case 'textarea':
		
		$value = stripslashes( $_POST[$name] );
?>

<p>
	<label for="<?php echo $name?>"><?php echo $meta['label']?></label>
    <br />
    	<textarea id="<?php echo $name?>" style="width:90%;height:70px" name="<?php echo $name?>" data-req="<?php echo $meta['required']?>" data-message="<?php echo $meta['message']?>"><?php echo $value?></textarea>

<span></span>	<!-- for validation message -->
</p>

<?php     
	break;
}
}

?>

<div style="clear:both"></div>
</div>
<?php
}
?>