<?php

class Core {

	// Function to validate the post data
	function validate_post($data)
	{
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['val_hostname']) && !empty($data['val_username']) && !empty($data['val_database']);
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}

	// Function to write the config file
	function write_config($data) {

		// Config path
		$template_path 	= 'config/database.php';
		$output_path 	= '../application/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%HOSTNAME%",$data['val_hostname'],$database_file);
		$new  = str_replace("%USERNAME%",$data['val_username'],$new);
		$new  = str_replace("%PASSWORD%",$data['val_password'],$new);
		$new  = str_replace("%DATABASE%",$data['val_database'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	function write_general($data) {

		// Config path
		$template_path 	= 'config/general.php';
		$output_path 	= '../application/config/general.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%NAME%",$data['val_name'],$database_file);
		$new  = str_replace("%HEADING%",$data['val_description'],$new);
		$new  = str_replace("%LICENSE_KEY%",$data['val_license_key'],$new);
		$new  = str_replace("%SERVER_IP%",$data['val_server_ip'],$new);
		$new  = str_replace("%SERVER_PORT%",$data['val_server_port'],$new);
		$new  = str_replace("%RCON_PASSWORD%",$data['val_rcon_password'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}
}