var the_i=0;
files = new Array();

jQuery(function($){
	
	$('.uploadifive-button').css({'margin': '0 auto'});
});

String.prototype.trunc = 
    function(n){
        return this.substr(0,n-1)+(this.length>n?'&hellip;':'');
 };
 
 function setup_uploader(file_input, button_text, files_allowed, types_allowed, file_size_limit, button_width, photo_editing, editing_tools) {
		

		if (nm_webcontact_vars.is_html5 == "1") {

			setup_uploader_html5(file_input, button_text, files_allowed, types_allowed, file_size_limit, button_width, photo_editing, editing_tools);

		} else {

			setup_uploader_flash(file_input, button_text, files_allowed, types_allowed, file_size_limit, button_width, photo_editing, editing_tools);
		}
	}



 function setup_uploader_html5(file_input, button_text, files_allowed, types_allowed, file_size_limit, button_width, photo_editing, editing_tools){
	 
	 	
	 	var input_file_name = file_input;
		var hidden_file_name = 'files_'+file_input;
		
		
		var file_size_limit = (file_size_limit == '') ? '100KB' : file_size_limit+'KB';
		var button_text 	= (button_text == '') ? 'Upload Files' : button_text;
		var types_allowed 	= (types_allowed == '') ? 'jpg,png,gif' : types_allowed;
		var files_allowed 	= 1;
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
			        		
			        		
			        		 var existing_files = Array();
			        		    
		        		     existing_files.push( data.filename );
	        		    
			        		 jQuery('input[name="'+hidden_file_name+'"]').each(function(){
			        		        console.log( jQuery(this).val());
			        		        if(jQuery(this).val() != '')
			        		        	existing_files.push( jQuery(this).val() );
		        		    });
			        		 
			        		//console.log('existing file '+existing_files);
			        		    
			        		
				        	jQuery('input[name="'+hidden_file_name+'"]').attr('value', existing_files);
				        	jQuery('.uploadifive-queue-item').first().remove();
				        	
				        	
				        }
					},
					'onError' : function(errorType) {
						alert('The error was: ' + errorType);
						jQuery(this).uploadifive('cancel',jQuery('.uploadifive-queue-item').first().data('file'));
					},
					'onAddQueueItem' : function(file) {
						
						if (!check_file_type(file, types_allowed)) {
							jQuery(this).uploadifive('cancel', file);
							//jQuery(this).uploadifive('cancel',jQuery('.uploadifive-queue-item').first().data('file'));
						}
						
						var existing_files = jQuery('input[name="'+hidden_file_name+'"]').val().split(",");
						if(existing_files != ''){
							if(existing_files.length >= files_allowed){
									alert('The maximum file are uploaded already');
									jQuery(this).uploadifive('cancel', file);
							}
						}
						
					},
					'onQueueComplete' : function() {
						show_thumbs(files, file_input, photo_editing, editing_tools);
					}
				// Put your options here
				});
		
		//aling center the browser button
		jQuery('#uploadifive-nm_contact_file-'+file_input).css({'margin':'0 auto'});
 }

 function setup_uploader_flash(file_input, button_text, files_allowed, types_allowed, file_size_limit, button_width, photo_editing, editing_tools) {

	 	var input_file_name = file_input;
		var hidden_file_name = 'files_'+file_input;

		var file_size_limit = (file_size_limit == '') ? '100KB' : file_size_limit + 'KB';
		var button_text = (button_text == '') ? 'Upload Files' : button_text;
		var types_allowed = (types_allowed == '') ? 'jpg,png,gif' : types_allowed;
		var files_allowed = 1;
		var button_width = (button_width == '') ? 100 : button_width;

		jQuery('#' + input_file_name).uploadify(
				{
					'swf' : nm_webcontact_vars.plugin_url
							+ '/js/uploadify-v-3-1-1/uploadify.swf',
					'uploadLimit' : files_allowed,
					'uploader' : 	nm_webcontact_vars.ajaxurl,
					'fileSizeLimit' : file_size_limit,
					'buttonText' : button_text,
					'formData' : {
						'action' : 'nm_webcontact_upload_file',
					},
					'width' : button_width,
					'auto' : true,
					'buttonClass' : 'uploadifive-button-nm',
					'onSelect' : function(file) {
						if (!check_file_type(file, types_allowed)) {
							jQuery(this).uploadify('cancel', file);
							// jQuery(this).uploadifive('cancel',jQuery('.uploadifive-queue-item').first().data('file'));
						}

						var existing_files = jQuery(
								'input[name="' + hidden_file_name + '"]').val()
								.split(",");
						if (existing_files != '') {
							if (existing_files.length >= files_allowed) {
								alert('The maximum file are uploaded already');
								jQuery(this).uploadify('cancel', file);
							}
						}
					},
					'auto' : true,
					'onUploadComplete' : function(fileObj) {
						jQuery("#upload-response").html(
								fileObj.name + ' file uploaded successfully')
								.fadeIn(200);
					},
					'onUploadError' : function(file, errorCode, errorMsg,
							errorString) {
						alert('The error was: ' + errorType);
						jQuery(this).uploadifive(
								'cancel',
								jQuery('.uploadifive-queue-item').first().data(
										'file'));
					},
					'onUploadSuccess' : function(file, data, response) {

						// console.log(jQuery.parseJSON(data));
						data = jQuery.parseJSON(data);
						if (data.status == 'error') {
							jQuery("#upload-response-" + file_input).html(
									data.message).css('color', 'red');
						} else {
							jQuery("#upload-response-" + file_input).html('');

							var existing_files = Array();

							existing_files.push(data.filename);

							jQuery('input[name="' + hidden_file_name + '"]')
									.each(
											function() {
												console.log(jQuery(this).val());
												if (jQuery(this).val() != '')
													existing_files
															.push(jQuery(this)
																	.val());
											});

							// console.log('existing file '+existing_files);

							jQuery('input[name="' + hidden_file_name + '"]').attr(
									'value', existing_files);
							jQuery('.uploadifive-queue-item').first().remove();

						}
					},
					'onQueueComplete' : function() {
						show_thumbs(files, file_input, photo_editing, editing_tools);
					},
					'onProgress' : function() {

						jQuery("#upload-response").html(
								'Please wait for thumb ... ');
					},
				});

		// aling center the browser button
		jQuery('#uploadifive-nm_contact_file-' + file_input).css({
			'margin' : '0 auto'
		});
	}

function check_file_type(file, file_types_allowed) {

	if(file_types_allowed == 'all')
		return true;
	
	
	file_types_allowed = file_types_allowed.split(",");
	console.log(file_types_allowed);

	var file_name = file.name;
	var ext = file_name.substring(file_name.lastIndexOf('.') + 1); // Extract
																	// EXT
	ext = ext.toLowerCase();

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

function show_thumbs(files, file_input, photo_editing, editing_tools){
	
	jQuery("#uploaded_files-"+file_input).html('');
	//console.log(files);
	
	var del_file = nm_webcontact_vars.plugin_url+'/images/delete_16.png';
	var edit_file = nm_webcontact_vars.plugin_url+'/images/edit-photo.png';
	
	var ext,file_path,html,is_image;
	
	var hidden_file_name = 'files_'+file_input;
	var existing_files = jQuery('input[name="'+hidden_file_name+'"]').val().split(",");
	
	//console.log( existing_files );
	
	jQuery.each(existing_files, function(i, item){
        
		if(item != ''){
			//console.log('show thumb of'+item);
					
			ext = item.substring(item.lastIndexOf('.') + 1);
			
			ext = ext.toLowerCase();
			the_i++;
			
			if(ext == 'png' || ext == 'gif' || ext == 'jpg' || ext == 'jpeg'){
				file_path = nm_webcontact_vars.file_upload_path_thumb + item;
				is_image = true;
			}else{
				file_path = nm_webcontact_vars.plugin_url+'/images/file.png';
				is_image = false;
			}
			
			var image_id = 'thumb-'+new Date().getTime();;
			
			html = '<div style="border-bottom: #ccc 1px solid;" id="f-'+the_i+'">';
				html += '<img style="float:left;" src="'+file_path+'" id="'+image_id+'">';
				html += '<span style="float:left;padding: 15px 0 0 5px">'+item.trunc(20)+'</span>';
				html += '<span style="float:right;padding: 15px 5px 0 0">';
					html += '<img src="'+del_file+'" onclick="remove_uploaded_file(\''+item+'\', '+the_i+', '+is_image+', \''+file_input+'\')">';
				html += '</span>';
				
				if(photo_editing === 'on'){
					html += '<span style="float:right;padding: 15px 5px 0 0">';
					html += '<img src="'+edit_file+'" onclick="return launch_aviary_editor(\''+image_id+'\', \''+nm_webcontact_vars.file_upload_path + item+'\', \''+item+'\', \''+editing_tools+'\')">';
				html += '</span>';
				}
			html += '</div>';
			
			html += '<div style="clear:both"></div>';
			
			jQuery("#uploaded_files-"+file_input).append(html);
		}
			
		});
}

function remove_uploaded_file(filename, index, isimage, file_input){

	var hidden_file_name = 'files_'+file_input;
	var existing_files = jQuery('input[name="'+hidden_file_name+'"]').val().split(",");
	
	jQuery("#f-"+index).find('img').attr('src', nm_webcontact_vars.plugin_url+'/images/loading.gif');
	
	var data = {action: 'nm_webcontact_delete_file', file_name: filename, is_image: isimage};
	
	jQuery.post(nm_webcontact_vars.ajaxurl, data, function(resp){
		//alert(resp);
		jQuery("#f-"+index).remove();		
		
	});
	
	//updating files Array
	jQuery.each(existing_files, function(i, item){
		
		if(item == filename)
			existing_files.splice(i, 1);
		
		//now updating hiddend input
		jQuery('input[name="'+hidden_file_name+'"]').attr('value', existing_files);
	});

}

function launch_aviary_editor(id, src, file_name, editing_tools) {
	editing_tools = (editing_tools == '' && editing_tools == undefined) ? 'all' : editing_tools;
    featherEditor.launch({
        image: id,
        url: src,
        tools: editing_tools,
        postData			: {filename: file_name},
    });
   return false;
}