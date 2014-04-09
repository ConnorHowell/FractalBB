<?php

class Database {

	// Function to the database and tables and fill them with the default data
	function create_database($data)
	{
		// Connect to the database
		$mysql = mysql_connect($data['val_hostname'],$data['val_username'],$data['val_password']);

		// Check for errors
		if(mysql_errno())
			return false;

		// Create the prepared statement
		mysql_query("CREATE DATABASE IF NOT EXISTS ".$data['val_database']);

		// Close the connection
		mysql_close($mysql);

		return true;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysql = mysql_connect($data['val_hostname'],$data['val_username'],$data['val_password']);
		mysql_select_db($data['val_database']);

		// Check for errors
		if(mysql_errno())
			return false;

		// Open the default SQL file
		$filename = 'assets/install.sql';

		// Execute a multi query
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line_num => $line) {
		// Only continue if it's not a comment
		if (substr($line, 0, 2) != '--' && $line != '') {
		// Add this line to the current segment
		$templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';') {
		// Perform the query
		mysql_query($templine) or print('Error performing query \'<b>' . $templine . '</b>\': ' . mysql_error() . '<br /><br />');
		// Reset temp variable to empty
		$templine = '';
		}
		}
		}

		// Close the connection
		mysql_close($mysql);

		return true;
	}
}