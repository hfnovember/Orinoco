<?php

	session_start();
	
	if (!isset($_SESSION["UserID"])) header("Location: ../login.php?status=noLogin");
	else {

		if (!isset($_GET["UserID"])) header("Location: ../account.php?status=invalidUserID");
		else {
			
			include("db_utils.php");
			dbLogin($host, $user, $pass, $db);
			
			//Delete the user
			
			$sqlDelete = "DELETE FROM users WHERE UserID=" . $_GET["UserID"];
			$sqlDeleteResult = mysql_query($sqlDelete) or die(mysql_error());
			
			//Delete his wishlist and its items
			
			$sqlDeleteWishlist = "DELETE FROM wishlist WHERE UserID=" . $_GET["UserID"];
			$sqlDeleteWishlistResult = mysql_query($sqlDeleteWishlist) or die(mysql_error());
			
			$sqlDeleteWishlistItems = "DELETE FROM wishlist_items WHERE WishlistID=" . $_SESSION["WishlistIndex"];
			$sqlDeleteWishlistItemsResult = mysql_query($sqlDeleteWishlistItems) or die(mysql_error());
			
			//Delete his shopping cart and its items
			
			$sqlDeleteShoppingCart = "DELETE FROM shoppingcart WHERE UserID=" . $_GET["UserID"];
			$sqlDeleteShoppingCartResult = mysql_query($sqlDeleteShoppingCart) or die(mysql_error());
			
			$sqlDeleteShoppingCartItems = "DELETE FROM shoppingcart_items WHERE ShoppingCartID=" . $_SESSION["ShoppingCartIndex"];
			$sqlDeleteShoppingCartItemsResult = mysql_query($sqlDeleteShoppingCartItems) or die(mysql_error());
			
			if ($sqlDeleteResult && $sqlDeleteWishlistResult && $sqlDeleteWishlistItemsResult && $sqlDeleteShoppingCartResult && $sqlDeleteShoppingCartItemsResult) header("Location: ../allproducts.php?status=accountDeleted");
			else if (!$sqlDeleteWishlistResult || !$sqlDeleteWishlistItemsResult || !$sqlDeleteShoppingCartResult || !$sqlDeleteShoppingCartItemsResult) header("Location: ../allproducts.php?status=accountDeletedButErrors");
			else header("Location: ../account.php?status=cannotDeleteAccount");
			
		}//end if ok
		
	}//end if logged in

?>