<?php

	session_start();
	
	if ($_SESSION["UserIsAdmin"] == 1) {
	
		if (isset($_POST["bookTitle"]) && isset($_POST["bookGenre"]) && isset($_POST["bookAuthor"]) && isset($_POST["bookPrice"]) && isset($_POST["bookQuantityToAdd"])) {
		
			//Valid:
			
			include_once("../../PHP/db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			$sqlAddItem = "UPDATE books SET BookTitle='" . $_POST["bookTitle"] . "', BookGenre='" . $_POST["bookGenre"] . "', BookAuthor ='" . $_POST["bookAuthor"] . "', BookPrice=" . $_POST["bookPrice"] . ", BookStock=" . $_POST["bookQuantityToAdd"] . " WHERE BookID = " . $_POST["bookID"];
			
			$sqlAddItemR = mysql_query($sqlAddItem) or die(mysql_error());
			
			if ($sqlAddItemR) header("Location: ../editBook.php?status=success&bookID=" . $_POST["bookID"]);	
			else header("Location: ../editBook.php?status=error&bookID=" . $_POST["bookID"]);
		
			
		}//end action
		
		else {
			header("Location: ../editBook.php?status=error&bookID=" . $_POST["bookID"]);	
		}//end if no info
		
	}//end if admin
	else {
		header("Location: ../../login.php?status=notAdmin");	
	}//end if no admin

?>