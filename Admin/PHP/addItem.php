<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["itemName"]) && isset($_POST["itemCategory"]) && isset($_POST["itemSupplier"]) && isset($_POST["itemPrice"]) && isset($_POST["itemQuantityToAdd"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "INSERT INTO items (ItemName, ItemCategory, ItemSupplier, ItemPrice, ItemStock) VALUES
			(
			'" . $_POST["itemName"] . "',
			'" . $_POST["itemCategory"] . "',
			'" . $_POST["itemSupplier"] . "',
			" . $_POST["itemPrice"] . ",
			" . $_POST["itemQuantityToAdd"] . "
			)";
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../manageItems.php?status=added");	
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