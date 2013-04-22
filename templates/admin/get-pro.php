<?php
/*
 * this is just to explain PRO features
 */

$proFeatures = '<ol>';
$proFeatures .= '<li>'.__('Set upload file as Required', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Save all enteries as Custom Post Type', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Date picker field input', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Search files and directory option', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Secure uploaded files from unauthorised download', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Allow multiple file upload', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Personalized validation message againest each input', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Set unlimited receivers emails', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '<li>'.__('Set different Reply to email', $this->plugin_meta['shortname']).'</li>';
$proFeatures .= '</ol>';

$proFeatures .= '<br><br>Purchase URL: <a href="http://www.najeebmedia.com/">Here</a>';
$proFeatures .= '<br>More information contact: <a href="mailto:sales@najeebmedia.com">sales@najeebmedia.com</a>';

echo $proFeatures;
?>
