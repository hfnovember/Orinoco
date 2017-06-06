<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_GET["itemID"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "DELETE FROM items WHERE ItemID=" . $_GET["itemID"];
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../manageItems.php?status=deleted");	
			else header("Location: ../manageItems.php?status=error");		
		
			
		}//end action
		
		else {
			header("Location: ../manageItems.php?status=error");	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>