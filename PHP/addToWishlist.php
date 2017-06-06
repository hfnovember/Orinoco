<?php

	session_start();

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
	
		if (!isset($_GET["ProductType"]) || !isset($_GET["ProductID"]) || !isset($_GET["WishlistID"]))
			echo 'You need to provide a product type, product id and wishlist id to add an item to wishlist';
		else {
			
			include("db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			//Check if current user is the owner of this wishlist:
			
			$sqlExists = 'SELECT * FROM wishlist_items WHERE WishListID=' . $_GET["WishlistID"] . ' AND ItemID = ' . $_GET["ProductID"] . ' AND ItemType="' . $_GET["ProductType"] . '"';
			$sqlExistsR = mysql_query($sqlExists) or die(mysql_error());
			if (mysql_num_rows($sqlExistsR) < 1) {
			
				$sqlFindMatch = "SELECT * FROM wishlist WHERE WishListID=" . $_GET["WishlistID"];
				$sqlFindMatchR = mysql_query($sqlFindMatch) or die(mysql_error());
				
				while ($row = mysql_fetch_array($sqlFindMatchR, MYSQL_ASSOC)) {
					if ($row["UserID"] == $_SESSION["UserID"]) {
						$sqlAdd = "INSERT INTO wishlist_items (WishListID, ItemID, ItemType) VALUES (" . $_GET["WishlistID"] . ", " . $_GET["ProductID"] . ", '" . $_GET["ProductType"] . "')";
						$sqlAddR = mysql_query($sqlAdd) or die(mysql_error());
						header("Location: ../allProducts.php?status=addedToWishlist");
					}//end if
					else header("Location: ../allproducts.php?status=unauthorizedWishlist");
				}//end while
			
			}//end if doesnt exist already
			else header('Location: ../allproducts.php?status=existsInWishlist');
				
		}//end if params are ok
		
	}//end if login is ok
	
?>