<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["itemName"]) && isset($_POST["itemCategory"]) && isset($_POST["itemSupplier"]) && isset($_POST["itemPrice"]) && isset($_POST["itemQuantityToAdd"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "UPDATE items SET ItemName='" . $_POST["itemName"] . "', ItemCategory='" . $_POST["itemCategory"] . "', ItemSupplier='" . $_POST["itemSupplier"] . "', ItemPrice=" . $_POST["itemPrice"] . ", ItemStock=" . $_POST["itemQuantityToAdd"] . " WHERE ItemID = " . $_POST["itemID"];
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../editItem.php?status=success&itemID=" . $_POST["itemID"]);	
			else header("Location: ../editItem.php?status=error&itemID=" . $_POST["itemID"]);
		
			
		}//end action
		
		else {
			header("Location: ../editItem.php?status=error&itemID=" . $_POST["itemID"]);	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>