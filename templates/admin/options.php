<?php

$meatGeneral = array('thumb-size'	=> array(	'label'		=> __('Images thumb size', 'nm_webcontact'),
																								'desc'		=> __('Enter integer value for thumb size for images', 'nm_webcontact'),
																								'id'			=> 'nm_webcontact'.'_thumb_size',
																								'type'			=> 'text',
																								'default'		=> '75',
																								'help'			=> __('e.g: <strong>100</strong>', 'nm_webcontact')
																								),
					'post-redirect'		=>  array(	'label'		=> __('Redirect?', 'nm_webcontact'),
																								'desc'		=> __('Type redirect url after form submitted, leave blank for alert on same page', 'nm_webcontact'),
																								'id'			=> 'nm_webcontact'.'_redirect_url',
																								'type'			=> 'text',
																								'default'		=> '',
																								'help'			=> __('', 'nm_webcontact')
																								),
					'filetype-error'	=> array('label'		=> __('File type not supported message', 'nm_webcontact'),
							'desc'		=> __('This message will be shown invalid file type is selected', 'nm_webcontact'),
							'id'			=> 'nm_webcontact'.'_filetype_error',
							'type'			=> 'textarea',
							'default'		=> '',
							'help'			=> ''),
					);
					


$meatPro = array('pro-feature'	=> array(	'desc'		=> $proFeatures,
		'type'		=> 'file',
		'id'		=> 'get-pro.php',
),);

$this -> the_options = array('general-settings'	=> array(	'name'		=> __('Basic Setting', 'nm_webcontact'),
														'type'	=> 'tab',
														'desc'	=> __('Set options as per your need', 'nm_webcontact'),
														'meat'	=> $meatGeneral,
														
													),
						
		'pro-features'	=> array(	'name'		=> __('Need more? Get PRO', 'nm_webcontact'),
				'type'	=> 'tab',
				'desc'	=> __('Following features are only available in PRO version', 'nm_webcontact'),
				'meat'	=> $meatPro,
				'class'	=> 'pro',
		
		),
	
					);

//print_r($repo_options);