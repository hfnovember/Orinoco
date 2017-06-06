<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["categoryName"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "INSERT INTO itemCategories (ItemCategoryName) VALUES
			(
			'" . $_POST["categoryName"] . "'
			)";
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../itemCategories.php?status=added");	
			else header("Location: ../itemCategories.php?status=error");		
		
			
		}//end action
		
		else {
			header("Location: ../itemCategories.php?status=error");	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>