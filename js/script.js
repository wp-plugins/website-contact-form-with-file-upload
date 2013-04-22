/*
 * NOTE: all actions are prefixed by plugin shortnam_action_name
 */
jQuery(function($){

	//tweaking file uploader button css
	$("#uploadifive-nm_contact_file").css({'width':'300px','height':'38px','text-align':'left','padding-left':'18px','color':'#fff'});
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

	if (is_ok) {

		var data = jQuery(form).serialize();
		data = data + '&action=nm_webcontact_send_form_data';

		jQuery.post(nm_webcontact_vars.ajaxurl, data, function(resp) {

			//console.log(resp);
			resp = jQuery.parseJSON(resp);			
			if(resp.status == 'error'){
				jQuery(form).find("#nm-sending-form").html(resp.message).css('color', 'red');
			}else{
				jQuery(form).find("#nm-sending-form").html(resp.message).css('color', 'green');
				if(get_option('_redirect_url') != '')
					window.location = get_option('_redirect_url');
			}
			
		});

	} else {

		jQuery(form).find("#nm-sending-form")
				.html('Please remove above Errors').css('color', 'red');
	}

	return false;
}

function validate_data(form) {

	var err_flag = true;

	jQuery(form).find('input, select, textarea, checkbox, email').each(
			function() {

				var child = jQuery(this);
				// console.log(child);
				if (child.is(":checkbox")) {
					var the_cb = jQuery('input:checkbox[name="'+child.attr('name')+'"]');
										
					if (the_cb.data('req') === 1 && jQuery('input:checkbox[name="'+child.attr('name')+'"]:checked').length == 0){
						the_cb.parent().parent().css({'border' : 'red 1px solid','padding' : '5px'});
							the_cb.parent().parent().find('span').html(the_cb.data('message')).css('color', 'red');
					}else{
						the_cb.parent().parent().css({'border' : '','padding' : '0'});
						the_cb.parent().parent().find('span').html('');
					}

				} else if (child.data('type') === 'email') {

					if (!is_valid_email(child.val())) {
						child.parent().css({
							'border' : 'red 1px solid',
							'padding' : '5px'
						});
						child.parent().find('span').html(child.data('message'))
								.css('color', 'red');
						err_flag = false;
					}else{
						child.parent().css({
							'border' : '',
							'padding' : '0'
						});
						child.parent().find('span').html('');
						
					}
				} else if(child.is(":text") || child.is("textarea") || child.is("select")) { // if text, select, textarea
					console.log(child.data('message'));
					if (child.data('req') === 1 && child.val() === '') {
						child.parent().css({
							'border' : 'red 1px solid',
							'padding' : '5px'
						});
						child.parent().find('span').html(child.data('message'))
								.css('color', 'red');
						err_flag = false;
					} else {
						child.parent().css({
							'border' : '',
							'padding' : '0'
						});
						child.parent().find('span').html('');
					}
				}

			});

	return err_flag;
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