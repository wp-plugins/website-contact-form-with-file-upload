var the_i=0;
files = new Array();

jQuery(function($){
	
	//setup_uploader_html5();
});

String.prototype.trunc = 
    function(n){
        return this.substr(0,n-1)+(this.length>n?'&hellip;':'');
 };

function setup_uploader_html5(file_input, button_text, files_allowed, types_allowed, file_size_limit, button_width, uploaded_files){
	
	
	var uploader_vars = new Object();
	
	uploader_vars.files = '';
	
	var input_file_name = 'nm_contact_file-'+file_input;
	var hidden_file_name = '_contact_file_name'+file_input;
		
	//console.log(file_meta.files_required);
	
	var file_size_limit = (file_size_limit == '') ? '100KB' : file_size_limit+'KB';
	var button_text 	= (button_text == '') ? 'Upload Files' : button_text;
	var types_allowed 	= (types_allowed == '') ? 'jpg,png,gif' : types_allowed;
	var files_allowed 	= (files_allowed == '') ? '1' : files_allowed;
	var button_width 	= (button_width == '') ? 100 : button_width;

	jQuery('#'+input_file_name).uploadifive(
			{
				'uploadScript' : nm_webcontact_vars.ajaxurl,
				'buttonText' : button_text,
				'fileSizeLimit' : file_size_limit,
				'formData' : {
					'action' : 'nm_webcontact_upload_file'
				},
				/*'height' : 38,*/
				'width' : button_width,
				'auto' : true,
				'buttonClass' : 'uploadifive-button-nm',
				'onUploadComplete' : function(file, data) {

					//console.log(jQuery.parseJSON(data));
		        	data = jQuery.parseJSON(data);
		        	if(data.status == 'error'){
		        		jQuery("#upload-response-"+file_input).html(data.message).css('color', 'red');	
		        	}else{
		        		jQuery("#upload-response-"+file_input).html('');
		        		
		        		uploader_vars.files.push(data.filename);
			        	jQuery('input[name="'+hidden_file_name+'"]').attr('value', files);
			        	jQuery('.uploadifive-queue-item').first().remove();
			        	
			        	console.log('uploaded_files '+uploader_vars.files);
			        	
			        }
				},
				'onError' : function(errorType) {
					//alert('The error was: ' + errorType);
					jQuery(this).uploadifive('cancel',jQuery('.uploadifive-queue-item').first().data('file'));
				},
				'onAddQueueItem' : function(file) {
					
					if (!check_file_type(file, types_allowed)) {
						jQuery(this).uploadifive('cancel', file);
						//jQuery(this).uploadifive('cancel',jQuery('.uploadifive-queue-item').first().data('file'));
					}
					
					
					
					if(uploaded_files.length >= files_allowed){
						alert('The maximum file are uploaded already');
						jQuery(this).uploadifive('cancel', file);
					}
					
				},
				'onQueueComplete' : function() {
					show_thumbs(files, file_input);
				}
			// Put your options here
			});
	
	//aling center the browser button
	jQuery('#uploadifive-nm_contact_file-'+file_input).css({'margin':'0 auto'});
	
}


function check_file_type(file, file_types_allowed) {

	if(file_types_allowed == 'all')
		return true;
	
	
	file_types_allowed = file_types_allowed.split(",");
	console.log(file_types_allowed);

	var file_name = file.name;
	var ext = file_name.substring(file_name.lastIndexOf('.') + 1); // Extract
																	// EXT

	var is_allowed = false;
	jQuery.each(file_types_allowed, function(i, allowed_ext) {

		// console.log(item);
		if (ext == allowed_ext) {

			is_allowed = true;
		}
	});

	if (!is_allowed) {

		alert(get_option('_filetype_error'));
		return false;
	} else {
		return true;
	}

}

function show_thumbs(files, file_input, uploaded_files){
	
	jQuery("#uploaded_files-"+file_input).html('');
	//console.log(files);
	
	var del_file = nm_webcontact_vars.plugin_url+'/images/delete_16.png';
	
	var ext,file_path,html,is_image;
	jQuery.each(uploaded_files, function(i, item){
		
		console.log('uploaded file item '+item);
				
		ext = item.substring(item.lastIndexOf('.') + 1);
		
		the_i++;
		
		if(ext == 'gif' || ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'PNG'){
			file_path = nm_webcontact_vars.file_upload_path + item;
			is_image = true;
		}else{
			file_path = nm_webcontact_vars.plugin_url+'/images/file.png';
			is_image = false;
		}
		
		html = '<div style="border-bottom: #ccc 1px solid;" id="f-'+the_i+'">';
			html += '<img style="float:left;" src="'+file_path+'">';
			html += '<span style="float:left;padding: 15px 0 0 5px">'+item.trunc(20)+'</span>';
			html += '<span style="float:right;padding: 15px 5px 0 0">';
				html += '<img src="'+del_file+'" onclick="remove_uploaded_file(\''+item+'\', '+the_i+', '+is_image+')">';
			html += '</span>';
		html += '</div>';
		
		html += '<div style="clear:both"></div>';
		
		jQuery("#uploaded_files-"+file_input).append(html);
		
	});
}

function remove_uploaded_file(filename, index, isimage){

	jQuery("#f-"+index).find('img').attr('src', nm_webcontact_vars.plugin_url+'/images/loading.gif');
	
	var data = {action: 'nm_webcontact_delete_file', file_name: filename, is_image: isimage};
	
	jQuery.post(nm_webcontact_vars.ajaxurl, data, function(resp){
		alert(resp);
		jQuery("#f-"+index).remove();
		
		
	});
	
	//updating files Array
	jQuery.each(files, function(i, item){
		
		if(item == filename)
			files.splice(i, 1);		
	});

}