jQuery(function($) {

	$('.etabs li:last, li.pro').css({background: '#D44937'});
	$('.nm_pro').css({'background':'#D44937','color':'#fff','padding':'0.2rem','text-decoration':'none'});
	
	// ================== new meta form creator ===================

	var meta_removed;
	
	//attaching hide and delete events for existing meta data
	$("#form-meta-setting ul li").each(function(i, item){
		$(item).find(".ui-icon-carat-2-n-s").click(function(e) {
			$(item).find("table").slideToggle(300);
		});
		// for delete box
		$(item).find(".ui-icon-trash").click(function(e) {
			$("#remove-meta-confirm").dialog("open");
			meta_removed = $(item);
		});	
	});
	
	$('.ui-icon-circle-triangle-n').click(function(e){
		$("#form-meta-setting ul li").find('table').slideUp();
	});
	$('.ui-icon-circle-triangle-s').click(function(e){
		$("#form-meta-setting ul li").find('table').slideDown();
	});
	
	
	$("#nmcontact-form-generator").tabs();
	$("#tab-container").tabs()

	$("#form-meta-setting ul").sortable({
		revert : true,
		stop : function(event, ui) {
			
			//console.log($(ui.item).attr('data-for'));
			if($(ui.item).attr('data-for') === 'pro'){
				alert('It is Pro Feature');
				$(ui.item).remove();
			}
				
			
			// only attach click event when dropped from right panel
			if (ui.originalPosition.left > 20) {
				$(ui.item).find(".ui-icon-carat-2-n-s").click(function(e) {
					$(this).parent('.postbox').find("table").slideToggle(300);
				});

				// for delete box
				$(ui.item).find(".ui-icon-trash").click(function(e) {
					$("#remove-meta-confirm").dialog("open");
					meta_removed = $(ui.item);
				});
			}
		}
	});

	// =========== remove dialog ===========
	$("#remove-meta-confirm").dialog({
		resizable : false,
		height : 160,
		autoOpen : false,
		modal : true,
		buttons : {
			"Remove" : function() {
				$(this).dialog("close");
				meta_removed.remove();
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});

	$("#nm-input-types li").draggable(
			{
				connectToSortable : "#form-meta-setting ul",
				helper : "clone",
				revert : "invalid",
				stop : function(event, ui) {
					// console.log($('.ui-draggable'));

					$('.ui-sortable .ui-draggable').removeClass(
							'input-type-item').find('div').addClass('postbox');

					// now replacing the icons with arrow
					$('.postbox').find('.ui-icon-arrow-4').removeClass(
							'ui-icon-arrow-4').addClass('ui-icon-carat-2-n-s');
					$('.postbox').find('.ui-icon-placehorder').removeClass(
							'ui-icon-placehorder').addClass(
							'ui-icon ui-icon-trash');

				}
			});
	//$("ul, li").disableSelection();

	// ================== new meta form creator ===================

	// add validation message if required
	$('input:checkbox[name="meta-required"]').change(function() {

		if ($(this).is(':checked')) {
			$(this).parent().find('span').show();
		} else {
			$(this).parent().find('span').hide();
		}
	});

	// increaing/saming the width of section's element
	$(".the-section").find('input, select, textarea').css({
		'width' : '35%'
	});

	// meta table setting first colum to 20%

	$('input:checkbox[name="allow_file_upload"]').change(function() {

		if ($(this).is(':checked')) {
			$('#file-upload-settings').show();
		} else {
			$('#file-upload-settings').hide();
		}
	});

	// making table sortable
	// make table rows sortable
	$('#nm-file-meta-admin tbody').sortable(
			{
				start : function(event, ui) {
					// fix firefox position issue when dragging.
					if (navigator.userAgent.toLowerCase().match(/firefox/)
							&& ui.helper !== undefined) {
						ui.helper.css('position', 'absolute').css('margin-top',
								$(window).scrollTop());
						// wire up event that changes the margin whenever the
						// window scrolls.
						$(window).bind(
								'scroll.sortableplaylist',
								function() {
									ui.helper.css('position', 'absolute')
											.css('margin-top',
													$(window).scrollTop());
								});
					}
				},
				beforeStop : function(event, ui) {
					// undo the firefox fix.
					if (navigator.userAgent.toLowerCase().match(/firefox/)
							&& ui.offset !== undefined) {
						$(window).unbind('scroll.sortableplaylist');
						ui.helper.css('margin-top', 0);
					}
				},
				helper : function(e, ui) {
					ui.children().each(function() {
						$(this).width($(this).width());
					});
					return ui;
				},
				scroll : true,
				stop : function(event, ui) {
					// SAVE YOUR SORT ORDER
				}
			}).disableSelection();

});

// saving form meta
function save_form_meta(form_id) {

	jQuery("#nm-saving-form").show();
	
	
	//usetting the photo_editing option is api key is not set
	if(jQuery('input[name="aviary_api_key"]').val() === "")
		jQuery('input[name="photo_editing"]').attr('checked',false);
	
	var form_meta_values = new Array();		//{};		//Array();
	jQuery("#meta-input-holder li").each(
			function(i, item) {

				var inner_array = {};
				inner_array['type']	= jQuery(item).attr('data-inputtype');
				
				jQuery(this).find('td.table-column-input').each(
						function(i, col) {

							var meta_input_type = jQuery(col).attr('data-type');
							var meta_input_name = jQuery(col).attr('data-name');

							if(meta_input_type == 'checkbox'){
								if(meta_input_name === 'editing_tools'){
									inner_array[meta_input_name] = jQuery(this).find('input:checkbox[name="' + meta_input_name + '[]"]:checked').serialize();
								}else{
									inner_array[meta_input_name] = jQuery(this).find('input:checkbox[name="' + meta_input_name + '"]:checked').val();
								}
							}else if(meta_input_type == 'textarea'){
								inner_array[meta_input_name] = jQuery(this).find('textarea[name="' + meta_input_name + '"]').val();
							}else if(meta_input_type == 'select'){
								inner_array[meta_input_name] = jQuery(this).find('select[name="' + meta_input_name + '"]').val();
							}else{
								inner_array[meta_input_name] = jQuery(this).find('input[name="' + meta_input_name + '"]').val() 
								//inner_array.push(temp);	
							}
							
						});

				form_meta_values.push( inner_array );

			});
	

	//console.log(form_meta_values); return false;
	// ok data is collected, so send it to server now Huh?

	var formid = jQuery('input[name="form_id"]').val();

	if (formid != 0) {
		do_action = 'nm_webcontact_update_form_meta';
	} else {
		do_action = 'nm_webcontact_save_form_meta';
	}
	
	
	var server_data = {
		action 			: do_action,
		form_id 		: jQuery('input[name="form_id"]').val(),
		form_name 		: jQuery('input[name="form_name"]').val(),
		sender_name 	: jQuery('input[name="sender_name"]').val(),
		sender_email 	: jQuery('input[name="sender_email"]').val(),
		subject 		: jQuery('input[name="subject"]').val(),
		receiver_emails : jQuery('input[name="receiver_emails"]').val(),
		button_label 	: jQuery('input[name="button_label"]').val(),
		button_class 	: jQuery('input[name="button_class"]').val(),
		success_message : jQuery('input[name="success_message"]').val(),
		error_message 	: jQuery('input[name="error_message"]').val(),
		send_file_as 	: jQuery('input:radio[name="send_file_as"]:checked').val(),
		section_slides 	: '',
		aviary_api_key 	: '',
		form_style		: '',
		
		form_meta : form_meta_values
	}
		jQuery.post(ajaxurl, server_data, function(resp) {
	
			console.log(resp);
			jQuery("#nm-saving-form").hide();
			if(resp.status == 'success'){
				
				alert(resp.message);
				if(resp.form_id != ''){
					window.location = nm_webcontact_vars.plugin_admin_page + '&form_id=' + resp.form_id;
				}else{
					window.location.reload(true);	
				}
			}
			
		}, 'json');
}

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
			// window.location.reload(true);

		});
	}

}
