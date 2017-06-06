<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_GET["bookGenreID"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "DELETE FROM bookgenre WHERE BookGenreID=" . $_GET["bookGenreID"];
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../bookGenres.php?status=deleted");	
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