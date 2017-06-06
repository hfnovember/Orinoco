<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_GET["bookID"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "DELETE FROM books WHERE BookID=" . $_GET["bookID"];
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../manageBooks.php?status=deleted");	
			else header("Location: ../manageBooks.php?status=error");		
		
			
		}//end action
		
		else {
			header("Location: ../manageBooks.php?status=error");	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>