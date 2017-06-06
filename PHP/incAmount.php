<?php

	session_start();

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
	
		if (!isset($_GET["ShoppingCartItemID"]) || !isset($_GET["CurrentAmount"]))
			echo 'You need to provide a ShoppingCartItemID and current amount.';
		else {
			
			include("db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			//Check if current user is the owner of this wishlist:
			
			$sqlExists = 'SELECT * FROM shoppingcart_items WHERE ShoppingCartItemID=' . $_GET["ShoppingCartItemID"];
			$sqlExistsR = mysql_query($sqlExists) or die(mysql_error());
			if (mysql_num_rows($sqlExistsR) > 0) {
				
				$sqlInc = "UPDATE shoppingcart_items SET ItemAmount=" . ($_GET["CurrentAmount"] + 1) . " WHERE ShoppingCartItemID = " . $_GET["ShoppingCartItemID"];
				$sqlIncR = mysql_query($sqlInc) or die(mysql_error());
				
				if ($sqlIncR) header("Location: ../shoppingcart.php");
				else echo 'A problem has occured. System not working properly.';
				
			}//end if
			else header("Location: ../allproducts.php?status=unauthorizedShoppingCart");
				
		}//end if params are ok
		
	}//end if login is ok
	
?>