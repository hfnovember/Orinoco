<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["bookGenreName"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "INSERT INTO bookgenre (BookGenreName) VALUES
			(
			'" . $_POST["bookGenreName"] . "'
			)";
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../bookGenres.php?status=added");	
			else header("Location: ../bookGenres.php?status=error");		
		
			
		}//end action
		
		else {
			header("Location: ../bookGenres.php?status=error");	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>