var the_i=0;
files = new Array();

jQuery(function($){
	
	setup_uploader_flash();
});

function setup_uploader_flash(){
	
	var file_meta = nm_webcontact_vars.file_meta;
	
	//console.log(file_meta.button_text);
	
	var file_size_limit = (file_meta.size_limit == '') ? '100KB' : file_meta.size_limit+'KB';
	var button_text 	= (file_meta.button_text == '') ? 'Upload Files' : file_meta.button_text;
	var types_allowed 	= (file_meta.types_allowed == '') ? 'jpg,png,gif' : file_meta.types_allowed;
	var files_allowed 	= (file_meta.files_allowed == '') ? '1' : file_meta.files_allowed;

	//console.log(types_allowed);
	
	jQuery('#nm_contact_file').uploadify(
			{
				'swf' : nm_webcontact_vars.plugin_url
						+ '/js/uploadify-v-3-1-1/uploadify.swf',
				//'uploadLimit' : 5,
				'uploader' : nm_webcontact_vars.ajaxurl,
				'fileSizeLimit' : file_size_limit,
				'queueSizeLimit'  : files_allowed,
				'buttonText' : button_text,
				//'buttonImage' : nm_webcontact_vars.plugin_url+'/images/upload-button-bg.png',
				'formData' : {
					'action' : 'nm_webcontact_upload_file',
				},
				'onSelect' : function(file) {

					if (!check_file_type(file, types_allowed))
						jQuery('#nm_contact_file').uploadify('cancel', file);
				},
				'height' : 38,
				'width' : 150,
				'auto' : true,
				'buttonClass' : 'uploadify-button-nm',
				'onUploadComplete' : function(fileObj) {
					
					show_thumbs(files);					
				},
				'onUploadError' : function(file, errorCode, errorMsg, errorString) {
					jQuery(this).uploadify('cancel',jQuery('.uploadify-queue-item').first().data('file'));
				},
				'onUploadSuccess' : function(file, data, response) {
					
					console.log(jQuery.parseJSON(data));
		        	data = jQuery.parseJSON(data);
		        	if(data.status == 'error'){
		        		jQuery("#upload-response").html(data.message).css('color', 'red');	
		        	}else{
		        		jQuery("#upload-response").html('');
		        		
		        		files.push(data.filename);
			        	jQuery('input[name="_contact_file_name"]').attr('value', files);
			        	jQuery('.uploadify-queue-item').first().remove();			        	
			        }
		        	
				},
				'onFallback' : function() {

				},
				'onQueueComplete' : function() {

				}
			});
	
}


function check_file_type(file, file_types_allowed) {

	if(file_types_allowed == 'all')
		return true;
	
	
	file_types_allowed = file_types_allowed.split(",");
	//console.log(file_types_allowed);

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

function show_thumbs(files){
	
	jQuery("#uploaded_files").html('');
	//console.log(files);
	
	var del_file = nm_webcontact_vars.plugin_url+'/images/delete_16.png';
	
	var ext,file_path,html,is_image;
	jQuery.each(files, function(i, item){
		
		//console.log(item);
				
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
			html += '<span style="float:left;padding: 15px 0 0 5px">'+item+'</span>';
			html += '<span style="float:right;padding: 15px 5px 0 0">';
				html += '<img src="'+del_file+'" onclick="remove_uploaded_file(\''+item+'\', '+the_i+', '+is_image+')">';
			html += '</span>';
		html += '</div>';
		
		html += '<div style="clear:both"></div>';
		
		jQuery("#uploaded_files").append(html);
		
	});
}

function remove_uploaded_file(filename, index, isimage){

	jQuery("#f-"+index).find('img').attr('src', nm_webcontact_vars.plugin_url+'/images/loading.gif');
	
	var data = {action: 'delete_file', file_name: filename, is_image: isimage};
	
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