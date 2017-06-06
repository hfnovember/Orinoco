<?php

	session_start();

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
	
		if (!isset($_GET["ProductType"]) || !isset($_GET["ProductID"]) || !isset($_GET["WishlistID"]))
			echo 'You need to provide a product type, product id and wishlist id to remove an item from wishlist';
		else {
			
			include("db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			//Check if current user is the owner of this wishlist:
			
			$sqlExists = 'SELECT * FROM wishlist_items WHERE WishListID=' . $_GET["WishlistID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '"';
			$sqlExistsR = mysql_query($sqlExists) or die(mysql_error());
			
			if (mysql_num_rows($sqlExistsR) > 0) {
			
				$sqlRemove = 'DELETE FROM wishlist_items WHERE WishListID=' . $_GET["WishlistID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '"';
				$sqlRemoveR = mysql_query($sqlRemove) or die(mysql_error());
				
				header('Location: ../allProducts.php??status=itemDeleted');
			
			}//end if doesnt exist already
			else header('Location: ../allProducts.php??status=failedToDelete');
				
		}//end if params are ok
		
	}//end if login is ok
	
?>