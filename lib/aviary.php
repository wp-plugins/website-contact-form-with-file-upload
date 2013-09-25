<?php
/*
 * This class put file to local server
 * using classback: save_edited_photo
 * being called from plugin.class.php
 */


class NM_Aviary{
	
	var $dir_path;
	
	var $image_data;
	
	var $posted_data;
	
	
	public function save_file_locally(){
		

		$destination = $this -> dir_path . '/' . $this -> posted_data -> filename;
		file_put_contents($destination, $this -> image_data);
	}
}