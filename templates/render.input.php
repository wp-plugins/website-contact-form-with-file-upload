<?php
/*
 * rendering product meta on product page
*/

global $nmcontact;

$single_form = $nmcontact -> get_forms( $nmcontact -> form_id );
//$nmcontact -> pa($single_form);

$nmcontact -> allow_file_upload = $single_form -> allow_file_upload;

$existing_meta 		= json_decode( $single_form -> the_meta, true);

//webcontact_pa($existing_meta);

if($existing_meta){
?>

<style>
<?php
/*
 * pasting the custom css if used in form settings
 */
echo $single_form -> form_style;
?>
</style>
<form
	id="webcontact-<?php echo $nmcontact->form_id?>"
	onsubmit="return send_data(this)"
	data-form="<?php echo esc_attr( $single_form -> the_meta )?>">
	<div id="nm-webcontact-box-<?php echo $nmcontact->form_id?>"
		class="nm-webcontact-box">

		<?php
		/*
		 * forms extra information being sent hidden
		*/
		echo '<input type="hidden" name="_form_id" value="'.$nmcontact -> form_id.'">';
		echo '<input type="hidden" name="_sender_email" value="'.$single_form -> sender_email.'">';
		echo '<input type="hidden" name="_sender_name" value="'.$single_form -> sender_name.'">';
		echo '<input type="hidden" name="_subject" value="'.$single_form -> subject.'">';
		echo '<input type="hidden" name="_receiver_emails" value="'.$single_form -> receiver_emails.'">';
		//echo '<input type="hidden" name="_reply_to" value="'.$single_form -> reply_to.'">';
		echo '<input type="hidden" name="_send_file_as" value="'.$single_form -> send_file_as.'">';
		echo '<input type="hidden" name="_photo_editing" value="'.$single_form -> photo_editing.'">';
		echo '<input type="hidden" name="_aviary_api_key" value="'.$single_form -> aviary_api_key.'">';

		$row_size = 0;

		$started_section = '';

		foreach($existing_meta as $key => $meta)
		{

			$type = $meta['type'];

			$name = strtolower(preg_replace("![^a-z0-9]+!i", "_", $meta['data_name']));


			if(($row_size + intval($meta['width'])) > 100 || $type == 'section'){

				echo '<div style="clear:both; margin: 0;"></div>';

				if($type == 'section'){
					$row_size = 100;
				}else{

					$row_size = intval( $meta['width'] );
				}

			}else{

				$row_size += intval( $meta['width'] );
			}


			$show_asterisk 		= ($meta['required']) ? '<span class="show_required"> *</span>' : '';
			$show_description	= ($meta['description']) ? '<span class="show_description">'.stripslashes($meta['description']).'</span>' : '';

			$the_width = intval( $meta['width'] ) - 1 .'%';
			$the_margin = '1%';

			$field_label = $meta['title'] . $show_asterisk . $show_description;

			switch($type)
			{
				case 'hidden':

				?>

		<input type="hidden" name="<?php echo $name?>" id="<?php echo $name?>"
				value="<?php echo $meta['field_value']?>" data-type="<?php echo $type?>" />

		<?php
		break;
		
		case 'text':
		
			?>
		
				<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
					<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
					<input type="text" name="<?php echo $name?>" id="<?php echo $name?>"
						value="<?php echo $value?>" data-type="<?php echo $type?>"
						data-req="<?php echo $meta['required']?>"
						data-message="<?php echo stripslashes( $meta['error_message'] )?>" />
		
					<span class="errors"></span>
					<!-- for validation message -->
				</p>
		
		<?php
		break;
		case 'date':
	?>

		<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
			<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
			<input type="text" name="<?php echo $name?>" id="<?php echo $name?>"
				value="<?php echo $value?>" data-type="<?php echo $type?>"
				data-req="<?php echo $meta['required']?>"
				data-message="<?php echo stripslashes( $meta['error_message'] )?>"
				data-format="<?php echo stripcslashes($meta['date_formats'])?>" /> <span
				class="errors"></span>
			<!-- for validation message -->

		</p>

		<?php
		break;
case 'email':

	$value = stripslashes( $_POST[$name] );

	?>

		<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
			<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
			<input type="email" id="<?php echo $name?>" name="<?php echo $name?>"
				value="<?php echo $value?>" data-type="<?php echo $type?>"
				data-req="<?php echo $meta['required']?>"
				data-message="<?php echo stripslashes( $meta['error_message'] )?>" />

			<span class="errors"></span>
			<!-- for validation message -->
		</p>

		<?php
		break;
case 'checkbox':

	/*
	 * variable price block
	 */
	$opts = explode("\n", $meta['options']);
	$defaul_checked = explode("\n", $meta['checked']);


	?>

		<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
			<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
			<?php foreach($opts as $opt)
			{
				if($defaul_checked){
					if(in_array($opt, $defaul_checked))
						$checked = 'checked="checked"';
					else
						$checked = '';
				}
					
				$output = stripslashes(trim($opt));
				?>
			<label for="f-meta-<?php echo $opt?>"> <input type="checkbox"
				value="<?php echo $opt?>" id="f-meta-<?php echo $opt?>"
				name="<?php echo $name?>[]" <?php echo $checked?>
				data-req="<?php echo $meta['required']?>"
				data-message="<?php echo stripslashes( $meta['error_message'] )?>">
				<?php echo $output?>
			</label>
			<?php
			}
			?>
			<span class="errors"></span>
			<!-- for validation message -->
		</p>

		<?php
		break;
case 'select':

	$opts = explode("\n", $meta['options']);
	$default_selected = $meta['selected'];
	?>

		<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
			<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
			<select id="<?php echo $name?>" name="<?php echo $name?>"
				data-req="<?php echo $meta['required']?>"
				data-message="<?php echo stripslashes( $meta['error_message'] )?>">
				<option value="">
					<?php _e('Select option')?>
				</option>
				<?php foreach($opts as $opt)
				{

					$selected = ($opt == $default_selected) ? 'selected="selected"' : '';

					$output = stripslashes(trim($opt));

					?>
				<option value="<?php echo $opt?>" <?php echo $selected?>>
					<?php echo $output?>
				</option>
				<?php
				}
				?>
			</select> <span class="errors"></span>
			<!-- for validation message -->
		</p>

		<?php
		break;
case 'radio':

	$opts = explode("\n", $meta['options']);
	$default_selected = $meta['selected'];
	?>

		<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
			<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
			<?php foreach($opts as $opt)
			{
				$checked = ($opt == $default_selected) ? 'checked="checked"' : '';
					
				$output = stripslashes(trim($opt));
				?>
			<label for="f-meta-<?php echo $opt?>"> <input type="radio"
				value="<?php echo $opt?>" id="f-meta-<?php echo $opt?>"
				name="<?php echo $name?>[]" <?php echo $checked?>
				data-req="<?php echo $meta['required']?>"
				data-message="<?php echo stripslashes( $meta['error_message'] )?>">
				<?php echo $output?>
			</label>
			<?php
			}
			?>
			<span class="errors"></span>
			<!-- for validation message -->
		</p>

		<?php
		break;
case 'textarea':

	$value = stripslashes( $_POST[$name] );
	?>



		<p style="width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
			<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />
			<textarea id="<?php echo $name?>" style="width: 90%; height: 70px"
				name="<?php echo $name?>" data-req="<?php echo $meta['required']?>"
				data-message="<?php echo stripslashes( $meta['error_message'] )?>" wrap="physical"><?php echo $value?></textarea>

			<span class="errors"></span>
			<!-- for validation message -->
		</p>

		<?php     
		break;

case 'section':

	if($started_section)		//if section already started then close it first
		echo '</section>';

	$started_section = 'webcontact-section-'.$name;
	?>

		<section id="<?php echo $started_section?>">


			<div style="clear: both"></div>

			<header class="webcontact-section-header">
				<h2>
					<?php echo stripslashes( $meta['title'] ) ?>
				</h2>
				<p>
					<?php echo stripslashes( $meta['description']) ?>
				</p>
			</header>

			<div style="clear: both"></div>
			<?php     
			break;


case 'file':

	?>
			<div style="float:left; width: <?php echo $the_width?>; margin-right: <?php echo $the_margin?>">
				<label for="<?php echo $name?>"><?php echo $field_label?> </label> <br />

				<div id="nm-uploader-area-<?php echo $name?>"
					class="nm-uploader-area">
					<div id="wrapper-uploadifive-button">
						<input id="<?php echo $name?>"
							name="<?php echo $name?>" data-req="<?php echo $meta['required']?>"
						data-message="<?php echo stripslashes( $meta['error_message'] )?>" type="file" />
					</div>

					<input type="hidden" id="files_<?php echo $name?>"
						name="files_<?php echo $name?>">
					<span id="upload-response-<?php echo $name?>"></span>

					<p id="uploaded_files-<?php echo $name?>"
						style="margin-bottom: 2px;"></p>

					<span class="errors"></span>

					<script type="text/javascript">	
	<!--

	setup_uploader('<?php echo $name?>', 
			'<?php echo stripslashes($meta['button_label'])?>', 
			'<?php echo stripslashes($meta['files_allowed'])?>', 
			'<?php echo stripslashes($meta['file_types'])?>', 
			'<?php echo stripslashes($meta['file_size'])?>',
			'<?php echo stripslashes($meta['button_width'])?>',
			'<?php echo stripslashes($meta['photo_editing'])?>',
			'<?php echo get_editing_tools($meta['editing_tools'])?>');
	//--></script>
				</div>
			</div>
			<?php     
			break;

			}
		}
		
		
		?>

			<div style="clear: both"></div>
	
	</div>
	<!-- ends nm-webcontact-box -->
	<?php

	echo '<p class="webcontact-save-button"><input type="submit" class="'.$single_form -> button_class.'" value="'.$single_form -> button_label.'"></p>';
	echo '<span id="nm-sending-form"></span>';
	wp_nonce_field('doing_contact','nm_webcontact_nonce');
	echo '</form>';
}?>


	<!-- if section_slides = yes  -->
	<?php
	if($single_form -> section_slides == 'on'){
		?>

	<table>
		<tr>
			<td style="text-align: left; width: 10%"><a href="#!" id="slide_back"><img
					border="0" width="32"
					src="<?php echo $nmcontact -> plugin_meta['url']?>/images/left-arrow.png">
			</a>
			</td>
			<td></td>
			<td style="text-align: right; width: 10%"><a href="#!"
				id="slide_next"><img border="0" width="32"
					src="<?php echo $nmcontact -> plugin_meta['url']?>/images/right-arrow.png">
			</a>
			</td>
		</tr>

		<tr>
			<td colspan="3">
				<table id="section_titles">
					<tr>
					</tr>
				</table>
			</td>

		</tr>
	</table>

<?php }


function get_editing_tools($editing_tools){

	parse_str ( $editing_tools, $tools );
	if ($tools['editing_tools'])
		return implode(',', $tools['editing_tools']);
}

if ($single_form -> aviary_api_key != NULL) {
	echo '<script type="text/javascript" src="http://feather.aviary.com/js/feather.js"></script>';
}
?>


<script type="text/javascript">
<!--
nm_webcontact_vars.section_slides= '<?php echo $single_form -> section_slides?>';

/* it is setting up Aviary API */

if('<?php echo $single_form -> aviary_api_key?>' != ''){
	var featherEditor = new Aviary.Feather({
	       apiKey			: '<?php echo $single_form -> aviary_api_key?>',
	       apiVersion		: 3,
	       theme			: 'dark', // Check out our new 'light' and 'dark' themes!
	       tools			: 'crop,resize',
	       appendTo			: '',
	       postUrl			: nm_webcontact_vars.ajaxurl+'?action=nm_webcontact_save_edited_photo',
	       onSave			: function(imageID, newURL) {
	           var img = document.getElementById(imageID);
	           img.src = newURL;
	       },
	       onError			: function(errorObj) {
	           alert(errorObj.message);
	       }
	   });
}
//--></script>