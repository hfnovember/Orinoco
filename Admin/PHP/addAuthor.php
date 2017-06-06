<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["authorName"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "INSERT INTO bookauthors (BookAuthorName) VALUES
			(
			'" . $_POST["authorName"] . "'
			)";
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../authors.php?status=added");	
			else header("Location: ../authors.php?status=error");		
		
			
		}//end action
		
		else {
			header("Location: ../authors.php?status=error");	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>