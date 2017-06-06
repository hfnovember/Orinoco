<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["bookTitle"]) && isset($_POST["bookGenre"]) && isset($_POST["bookAuthor"]) && isset($_POST["bookPrice"]) && isset($_POST["bookQuantityToAdd"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "INSERT INTO books (BookTitle, ItemCategory, ItemSupplier, ItemPrice, ItemStock) VALUES
			(
			'" . $_POST["bookTitle"] . "',
			'" . $_POST["bookGenre"] . "',
			'" . $_POST["bookAuthor"] . "',
			" . $_POST["bookPrice"] . ",
			" . $_POST["bookQuantityToAdd"] . "
			)";
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../manageBooks.php?status=added");	
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