<?php

	if (!isset($_POST["txt_reg_username"]) || !isset($_POST["txt_reg_firstname"]) || !isset($_POST["txt_reg_email"]) || !isset($_POST["txt_reg_confirmPass"])) {
		
		header("Location: ../register.php?status=badParams");
			
	}//end param checking
	
	else {
		
		include("db_utils.php");
		dbLogin($host, $user, $pass, $db);

		$username = strtolower($_POST["txt_reg_username"]);
		$firstname = $_POST["txt_reg_firstname"];
		$email = $_POST["txt_reg_email"];
		$password = md5($_POST["txt_reg_password"]);
		
		$sqlValidUsername = "SELECT Username FROM users WHERE Username='" . $username . "'";
		$sqlVUResult = mysql_query($sqlValidUsername) or die(mysql_error());
		
		if (mysql_num_rows($sqlVUResult) > 0) header("Location: ../register.php?status=userExists");
		else {
			
			//Create the user
			$sqlCU = "INSERT INTO users (Username, UserEmail, UserPassword, UserFirstName, IsAdmin)
					VALUES ('" . $username . "',
							'" . $email . "',
							'" . $password . "',
							'" . $firstname . "',
							0)";
							
			$resultCU = mysql_query($sqlCU);
	
			if(!$resultCU ) header("Location: ../register.php?status=failedToCreateUser");
			else {
				header("Location: ../login.php?status=userCreated");
			}//end if user created
			
		}//end if user not existing already
		
	}//end if

?>