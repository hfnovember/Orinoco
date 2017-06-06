<?php

	if (!isset($_POST["txt_reg_username"]) || !isset($_POST["txt_reg_firstname"]) || !isset($_POST["txt_reg_email"]) || !isset($_POST["txt_reg_confirmPass"])) {
		
		header("Location: ../createAdmin.php?status=error");
			
	}//end param checking
	
	else {
		
		include("../../php/db_utils.php");
		dbLogin($host, $user, $pass, $db);

		$username = strtolower($_POST["txt_reg_username"]);
		$firstname = $_POST["txt_reg_firstname"];
		$email = $_POST["txt_reg_email"];
		$password = md5($_POST["txt_reg_password"]);
		
		$sqlValidUsername = "SELECT Username FROM users WHERE Username='" . $username . "'";
		$sqlVUResult = mysql_query($sqlValidUsername) or die(mysql_error());
		
		if (mysql_num_rows($sqlVUResult) > 0) header("Location: ../createAdmin.php?status=error");
		else {
			
			//Create the user
			$sqlCU = "INSERT INTO users (Username, UserEmail, UserPassword, UserFirstName, IsAdmin)
					VALUES ('" . $username . "',
							'" . $email . "',
							'" . $password . "',
							'" . $firstname . "',
							1)";
							
			$resultCU = mysql_query($sqlCU);
	
			if(!$resultCU ) header("Location: ../createAdmin.php?status=error");
			else {
				header("Location: ../createAdmin.php?status=added");
			}//end if user created
			
		}//end if user not existing already
		
	}//end if

?>