<?php

$meatGeneral = array('thumb-size'	=> array(	'label'		=> __('Images thumb size', $this->plugin_meta['shortname']),
																								'desc'		=> __('Enter integer value for thumb size for images', $this->plugin_meta['shortname']),
																								'id'			=> $this->plugin_meta['shortname'].'_thumb_size',
																								'type'			=> 'text',
																								'default'		=> '75',
																								'help'			=> __('e.g: <strong>100</strong>', $this->plugin_meta['shortname'])
																								),
					'post-redirect'		=>  array(	'label'		=> __('Redirect?', $this->plugin_meta['shortname']),
																								'desc'		=> __('Type redirect url after form submitted, leave blank for alert on same page', $this->plugin_meta['shortname']),
																								'id'			=> $this->plugin_meta['shortname'].'_redirect_url',
																								'type'			=> 'text',
																								'default'		=> '',
																								'help'			=> __('', $this->plugin_meta['shortname'])
																								),
					'save-forms'		=>  array(	'label'		=> __('Do you want to save forms?', $this->plugin_meta['shortname']),
							'desc'		=> __('Do you want to save every form as Custom post type: <code>nm-forms</code>?', $this->plugin_meta['shortname']),
							'id'			=> $this->plugin_meta['shortname'].'_save_forms',
							'type'			=> 'checkbox',
							'default'		=> '',
							'options'		=> array('yes'	=> 'Yes', 'No'	=> 'No'),
							'help'			=> __('', $this->plugin_meta['shortname'])
					),
					);
					

$meatDialog = array('message-sent'	=> array(	'label'		=> __('Message Sent message', $this->plugin_meta['shortname']),
		'desc'		=> __('This message will be shown when message is sent', $this->plugin_meta['shortname']),
		'id'			=> $this->plugin_meta['shortname'].'_message_sent',
		'type'			=> 'textarea',
		'default'		=> '',
		'help'			=> ''),
		
		'filetype-error'	=> array('label'		=> __('File type not supported message', $this->plugin_meta['shortname']),
		'desc'		=> __('This message will be shown invalid file type is selected', $this->plugin_meta['shortname']),
		'id'			=> $this->plugin_meta['shortname'].'_filetype_error',
		'type'			=> 'textarea',
		'default'		=> '',
		'help'			=> ''),);


$this -> the_options = array('general-settings'	=> array(	'name'		=> __('Basic Setting', $this->plugin_meta['shortname']),
														'type'	=> 'tab',
														'desc'	=> __('Set options as per your need', $this->plugin_meta['shortname']),
														'meat'	=> $meatGeneral,
														
													),
						'email-template'	=> array(	'name'		=> __('Dialog Messages', $this->plugin_meta['shortname']),
								'type'	=> 'tab',
								'desc'	=> __('Set message as per your need', $this->plugin_meta['shortname']),
								'meat'	=> $meatDialog,
								
						),
	
					);

//print_r($repo_options);