/*
 * NOTE: all actions are prefixed by plugin shortnam_action_name
 */

var selected_slide = 0;
var total_sections = 0;
jQuery(function($){

	//tweaking file uploader button css
	$("#uploadifive-nm_contact_file").css({'margin':'#fff'});
	
	//setting all input widht to 95% within P tags
	$(".nm-webcontact-box").find('input:text, input[type="email"], textarea, select').css({'width': '100%', 'padding': 0});
	
	/*
	 * handling date input
	 */
	$("input[data-type='date']").each(function(i, item){
		
		//console.log(item);
		$(item).datepicker({ 	changeMonth: true,
			changeYear: true,
			dateFormat: $(item).attr('data-format')
			});
	});
	
	
	
	/*
	 * all about section slides
	 * pagination
	 */
	
	if(nm_webcontact_vars.section_slides === 'on'){
		var section_titles_tds = '';
		$(".nm-webcontact-box section").each(function(i, section){
			
			//console.log(section);
			section_titles_tds += '<td>'+$(section).find('h2').html()+'</td>';		
			$(section).hide();
			
			total_sections += 1;
			
		});
		
		//now adding titles to bottom of slider
		$("#section_titles tr").html(section_titles_tds);
		
		//showing only first section at start
		$(".nm-webcontact-box section:first").slideDown(200);
		$("#section_titles tr td:first").css({'color':'#000', 'background-color': '#ccc'});
		set_arrows();
		
		$("#slide_next").click(function(e){
	
			slide_section('next');
			e.preventDefault();
		});
		$("#slide_back").click(function(e){
	
			slide_section('back');
			e.preventDefault();
		});
	}
	
	// pagination ends ==============
	
	
		
});


function is_valid_email(email) {
	var pattern = new RegExp(
			/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	return pattern.test(email);
};

function send_data(form) {

	jQuery(form).find("#nm-sending-form").html(
			'<img src="' + nm_webcontact_vars.doing + '">');
	
	var is_ok = validate_data(form);
	var file_ok = true;
	
	if (is_ok && file_ok) {

		var data = jQuery(form).serialize();
		data = data + '&action=nm_webcontact_send_form_data';

		jQuery.post(nm_webcontact_vars.ajaxurl, data, function(resp) {

			//console.log(resp); return false;
			
			if(resp.status == 'error'){
				jQuery(form).find("#nm-sending-form").html(jQuery('input:hidden[name="_error_message"]').val()).css('color', 'red');
			}else{
				if(get_option('_redirect_url') != '')
					window.location = get_option('_redirect_url');
				else
					alert(jQuery('input:hidden[name="_success_message"]').val());
				
				jQuery(form).find("#nm-sending-form").html('');
			}
		});

	} else {

		//show all sections if hidden
		jQuery(".nm-webcontact-box section").slideDown(200);
		
		jQuery(form).find("#nm-sending-form")
				.html('Please remove above Errors').css('color', 'red');
	}

	return false;
}

function validate_data(form){
	
	var form_data = jQuery.parseJSON( jQuery(form).attr('data-form') );
	var has_error = true;
	
	jQuery.each( form_data, function( key, meta ) {
		
		var type = meta['type'];
		  
		if(type === 'text' || type === 'textarea' || type === 'select' || type === 'email' || type === 'date'){
			
			var input_control = jQuery('#'+meta['data_name']);
			
			if(meta['required'] === "on" && jQuery(input_control).val() === ''){
				jQuery(input_control).closest('p').find('span.errors').html(meta['error_message']).css('color', 'red');
				has_error = false;
			}else{
				jQuery(input_control).closest('p').find('span.errors').html('').css({'border' : '','padding' : '0'});
			}
		}else if(type === 'checkbox'){
			
			if(meta['required'] === "on" && jQuery('input:checkbox[name="'+meta['data_name']+'[]"]:checked').length === 0){
				
				jQuery('input:checkbox[name="'+meta['data_name']+'[]"]').closest('p').find('span.errors').html(meta['error_message']).css('color', 'red');
				has_error = false;
			}else if(meta['min_checked'] != '' && jQuery('input:checkbox[name="'+meta['data_name']+'[]"]:checked').length < meta['min_checked']){
				jQuery('input:checkbox[name="'+meta['data_name']+'[]"]').closest('p').find('span.errors').html(meta['error_message']).css('color', 'red');
				has_error = false;
			}else if(meta['max_checked'] != '' && jQuery('input:checkbox[name="'+meta['data_name']+'[]"]:checked').length > meta['max_checked']){
				jQuery('input:checkbox[name="'+meta['data_name']+'[]"]').closest('p').find('span.errors').html(meta['error_message']).css('color', 'red');
				has_error = false;
			}else{
				
				jQuery('input:checkbox[name="'+meta['data_name']+'[]"]').closest('p').find('span.errors').html('').css({'border' : '','padding' : '0'});
				
				}
		}else if(type === 'radio'){
				
				if(meta['required'] === "on" && jQuery('input:radio[name="'+meta['data_name']+'"]:checked').length === 0){
					jQuery('input:radio[name="'+meta['data_name']+'"]').closest('p').find('span.errors').html(meta['error_message']).css('color', 'red');
					has_error = false;
				}else{
					jQuery('input:radio[name="'+meta['data_name']+'"]').closest('p').find('span.errors').html('').css({'border' : '','padding' : '0'});
				}
		}else if(type === 'file'){
				var input_control = jQuery('#files_'+meta['data_name']);
				if(meta['required'] === "on" && jQuery(input_control).val() === ''){
					jQuery(input_control).parent().parent().parent().find('span.errors').html(meta['error_message']).css('color', 'red');
					has_error = false;
				}else{
					jQuery(input_control).parent().parent().parent().find('span.errors').html('').css({'border' : '','padding' : '0'});
				}
			}
		
	});
	
	//console.log( form_data ); return false;
	return has_error;
}


function get_option(key) {

	/*
	 * TODO: change plugin shortname
	 */
	var keyprefix = 'nm_webcontact';

	key = keyprefix + key;

	var req_option = '';

	jQuery.each(nm_webcontact_vars.settings, function(k, option) {

		// console.log(k);

		if (k == key)
			req_option = option;
	});

	// console.log(req_option);
	return req_option;
}

function slide_section(move){
	
	//hiding all section first
	jQuery(".nm-webcontact-box section").hide(100);
	//setting td titles to grey back
	jQuery("#section_titles tr td").css({'color':'#ccc', 'background-color': ''});
	
	if(move === 'next'){
	
		selected_slide++;
	
		jQuery(".nm-webcontact-box section").each(function(index, section){
			
			if(index === selected_slide){
				jQuery(section).slideDown(300);
				jQuery("#section_titles tr td:nth-child("+(index+1)+")").css({'color':'#000', 'background-color': '#ccc'});
			}
		});
		
	}else{
		
		selected_slide--;
		
		jQuery(".nm-webcontact-box section").each(function(index, section){
			
			if(index === selected_slide){
				jQuery(section).slideDown(300);				
				jQuery("#section_titles tr td:nth-child("+(index+1)+")").css({'color':'#000', 'background-color': '#ccc'});
			}
		});
	}
	
	set_arrows();
}

function set_arrows(){
	
	jQuery(".webcontact-save-button").hide();
	
	if(selected_slide <= 0){		//just started
		
		jQuery("#slide_back").hide();
		jQuery("#slide_next").show();
		
	}else if(selected_slide > 0 && selected_slide < (total_sections-1)){		//somewhere between
		
		jQuery("#slide_back").show();
		jQuery("#slide_next").show();
	}else if(selected_slide >= (total_sections-1)){		// it is last section
		
		jQuery(".webcontact-save-button").show();
		
		jQuery("#slide_back").show();
		jQuery("#slide_next").hide();
	}
}