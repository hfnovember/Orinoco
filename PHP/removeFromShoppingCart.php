<?php

	session_start();

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
	
		if (!isset($_GET["ProductType"]) || !isset($_GET["ProductID"]) || !isset($_GET["ShoppingCartID"]))
			echo 'You need to provide a product type, product id and shopping cart id to remove an item from shopping cart';
		else {
			
			include_once("db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			//Check if current user is the owner of this wishlist:
			
			$sqlExists = 'SELECT * FROM shoppingcart_items WHERE ShoppingCartID=' . $_GET["ShoppingCartID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '"';
			$sqlExistsR = mysql_query($sqlExists) or die(mysql_error());
			
			if (mysql_num_rows($sqlExistsR) > 0) {
			
				$sqlRemove = 'DELETE FROM shoppingcart_items WHERE ShoppingCartID=' . $_GET["ShoppingCartID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '" LIMIT 1';
				$sqlRemoveR = mysql_query($sqlRemove) or die(mysql_error());
				
				header('Location: ../shoppingCart.php?status=itemDeleted');
			
			}//end if doesnt exist already
			else header('Location: ../shoppingCart.php?status=failedToDelete');
				
		}//end if params are ok
		
	}//end if login is ok
	
?>