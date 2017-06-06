<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1 && $_SESSION["Username"] == "admin") {
	
		if (isset($_GET["userID"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "DELETE FROM users WHERE UserID=" . $_GET["userID"];
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../createAdmin.php?status=deleted");	
			else header("Location: ../createAdmin.php?status=error");		
		
			
		}//end action
		
		else {
			header("Location: ../createAdmin.php?status=error");	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>