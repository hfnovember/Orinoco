<?php

	session_start();

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
	
		if (!isset($_GET["ProductType"]) || !isset($_GET["ProductID"]) || !isset($_GET["WishlistItemID"]) || !isset($_GET["ShoppingCartID"]))
			echo 'You need to provide a product type, product id, wishlist id and shopping cart id to move an item to shopping cart';
		else {
			
			include_once("db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			//Check if current user is the owner of this wishlist:
			
			$sqlExists = 'SELECT * FROM wishlist_items WHERE WishlistItemID=' . $_GET["WishlistItemID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '"';
			$sqlExistsR = mysql_query($sqlExists) or die(mysql_error());
			
			if (mysql_num_rows($sqlExistsR) > 0) {
			
				//Remove item from wishlist
				$sqlRemove = 'DELETE FROM wishlist_items WHERE WishlistItemID=' . $_GET["WishlistItemID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '"';
				$sqlRemoveR = mysql_query($sqlRemove) or die(mysql_error());
				
				//Add item to shopping cart
				$sqlInsert = 'INSERT INTO shoppingcart_items (ShoppingCartID, ItemID, ItemType) VALUES (' . $_SESSION["ShoppingCartIndex"] . ', ' . $_GET["ProductID"] . ', "' . $_GET["ProductType"] . '" )';
				$sqlInsertR = mysql_query($sqlInsert) or die(mysql_error());
				
				
				header('Location: ' . $_SERVER['HTTP_REFERER'] . '?status=itemMoved');
			
			}//end if doesnt exist already
			else header('Location: ' . $_SERVER['HTTP_REFERER'] . '?status=failedToMove');
				
		}//end if params are ok
		
	}//end if login is ok
	
?>