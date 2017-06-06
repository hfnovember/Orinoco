<?php

	//DATABASE LOGIN:
	
	//Default Credentials:
	$host 	= "localhost";
	$user 	= "root";
	$pass 	= "usbw";
	$db 	= "orinocodb";


	//Logs in to the database
	function dbLogin($host, $username, $password, $dbName) {
		mysql_connect("$host", "$username", "$password") or die("Cannot connect to database."); 	
		mysql_select_db("$dbName") or die("Cannot select database.");
	}//end dbLogin()

?>