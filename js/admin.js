jQuery(function($) {

	$('#tab-container').easytabs();

	// add validation message if required
	$('input:checkbox[name="meta-required"]').change(function() {

		if ($(this).is(':checked')) {
			$(this).parent().find('span').show();
		} else {
			$(this).parent().find('span').hide();
		}
	});
	
	$('input:checkbox[name="allow_file_upload"]').change(function() {

		if ($(this).is(':checked')) {
			$('#file-upload-settings').show();
		} else {
			$('#file-upload-settings').hide();
		}
	});
});

function updateOptions(options) {

	var opt = jQuery.parseJSON(options);

	/*
	 * getting action from object
	 */

	/*
	 * extractElementData defined in nm-globals.js
	 */
	var data = extractElementData(opt);

	if (data.bug) {
		// jQuery("#reply_err").html('Red are required');
		alert('bug here');
	} else {

		/*
		 * [1]
		 */
		data.action = 'nm_webcontact_save_settings';

		jQuery.post(ajaxurl, data, function(resp) {

			// jQuery("#reply_err").html(resp);
			alert(resp);
			window.location.reload(true);

		});
	}

	/*
	 * jQuery.each(res, function(i, item){
	 * 
	 * alert(i);
	 * 
	 * });
	 */
}

/* =============== file meta ==================== */
function add_another_meta() {

	jQuery(
			"#nm-file-meta-admin tr:nth-child("
					+ nm_webcontact_vars.add_meta_counter + ")").after(
			jQuery("#nm-file-meta-admin tr#add-meta-1").clone().attr("id",
					"add-meta-" + nm_webcontact_vars.add_meta_counter));

	// the remove element
	var removeHTML = '<br><img src="' + nm_webcontact_vars.plugin_url
			+ '/images/delete_16.png" onclick="javascript:remove_meta('
			+ nm_webcontact_vars.add_meta_counter + ')">';

	nm_webcontact_vars.add_meta_counter++;

	jQuery(
			"#nm-file-meta-admin tr:nth-child("
					+ nm_webcontact_vars.add_meta_counter + ") td:first")
			.append(removeHTML);

}

function remove_meta(index) {

	// alert(prev_row);

	jQuery("#nm-file-meta-admin tr#add-meta-" + index + "").remove();
	// jQuery("#nm-file-meta-admin tr:last").after(data);

	nm_webcontact_vars.add_meta_counter--;
}

/*
 * saving file meta
 */
function save_file_meta() {

	jQuery("#saving-meta").html('<img src="' + nm_webcontact_vars.doing + '">');

	var filemeta		= {
							size_limit: jQuery('input[name="size_limit"]').val(),
							button_text:  jQuery('input[name="button_text"]').val(),
							types_allowed:  jQuery('input[name="types_allowed"]').val(),
							files_allowed:  jQuery('input[name="files_allowed"]').val()
							};
	
	
	
	var all_meta = new Array();

	jQuery("#nm-file-meta-admin tr.add-meta").each(
			function(index, item) {

				var meta = new Object;

				meta.label 		= jQuery(item).find('input[name="meta-label"]').val();
				meta.type 		= jQuery(item).find('select').val();
				meta.options 	= jQuery(item).find('textarea[name="meta-options"]').val();
				meta.required 	= jQuery(item).find('input:checkbox:checked').val();
				meta.message 	= jQuery(item).find('input[name="message"]').val();

				all_meta.push(meta);

			});

	// console.log(all_meta);

	var do_action;

	var formid = jQuery('input[name="existing_form_id"]').val();
	
	if (formid != 0) {
		do_action = 'nm_webcontact_update_form_meta';
	} else {
		do_action = 'nm_webcontact_save_form_meta';
	}
	
	var allow_upload = (jQuery('input:checkbox[name="allow_file_upload"]:checked').val() == undefined) ? '' : jQuery('input:checkbox[name="allow_file_upload"]:checked').val();
	
	var data = {action : do_action,
		form_id 		: formid,
		form_name 		: jQuery('input[name="form_name"]').val(),
		from_email 		: jQuery('input[name="from_email"]').val(),
		from_name 		: jQuery('input[name="from_name"]').val(),
		subject			: jQuery('input[name="subject"]').val(),
		receiver_emails : jQuery('input[name="receiver_emails"]').val(),
		reply_to 		: jQuery('input[name="reply_to"]').val(),
		send_file_as	: jQuery('input:radio[name="send_file_as"]:checked').val(),
		allow_file_upload	: allow_upload,
		file_meta		: filemeta,
		the_meta 		: all_meta,
		};

	jQuery.post(ajaxurl, data, function(resp) {

		//console.log(resp);
		alert(resp);
		window.location.reload(true);
	});
}

function show_add_meta() {

	jQuery("#add-edit-meta").toggle();
}

function are_sure(form_id) {

	var a = confirm('Are you sure to delete this file?');
	if (a) {
		jQuery("#del-file-" + form_id).attr("src", nm_webcontact_vars.doing);

		jQuery.post(ajaxurl, {
			action : 'delete_meta',
			formid : form_id
		}, function(resp) {
			// alert(data);
			alert(resp);
			window.location.reload(true);

		});

	}

}