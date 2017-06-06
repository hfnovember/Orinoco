<?php

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
		
		include_once("db_utils.php");
		dbLogin($host, $user, $pass, $db);
	
	
		//BOOKS FIRST!
		
		$sqlGetItems = "SELECT * FROM wishlist_items, books WHERE wishlist_items.WishListID=" . $_SESSION["WishlistIndex"] . " AND wishlist_items.ItemType='book' AND wishlist_items.ItemID = books.BookID";
		$sqlGetItemsR = mysql_query($sqlGetItems) or die(mysql_error());
		
		echo '<p style="font-size: 130%">Books</p>';
		
		echo '<ul class="collection with-header col s12 grey lighten-4">';
		
		while ($row = mysql_fetch_array($sqlGetItemsR, MYSQL_ASSOC)) {
			
			
			echo '
			
				<li class="collection-item grey lighten-4 center" style="padding-top: 25px;">
				  <img class="center" id="bookImage' . $row["BookID"] . '" style="border-radius: 0% 10% 10% 0%; border: 2px solid black;" src="' . $row["BookImageURL"] . '">
				  <h4>' . $row["BookTitle"] . '</h4>
				  <p>by ' . $row["BookAuthor"] . '</p>
				  <a class="btn waves-effect red" style="margin: 10px" href="php/removeFromWishlist.php?WishlistID=' . $_SESSION["WishlistIndex"] . '&ProductType=book&ProductID=' . $row["BookID"] . '">Remove</a>
				  <a class="btn waves-effect blue" href="php/moveToShoppingCart.php?ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '&ProductType=book&ProductID=' . $row["BookID"] . '&WishlistItemID=' . $row["WishlistItemID"] . '">Move to Shopping Cart</a>
				  <div class="clearfix"></div>
				</li>
				
				<script>Materialize.fadeInImage("#bookImage' . $row["BookID"] . '");</script>
			
			';
			
		}//end while
		
		if (mysql_num_rows($sqlGetItemsR) < 1) echo '<li>No items found.</li>';
		
		echo '</ul><br/><br/>';
		
		
		//THEN ITEMS!
		
		$sqlGetItems = "SELECT * FROM wishlist_items, items WHERE wishlist_items.WishListID=" . $_SESSION["WishlistIndex"] . " AND wishlist_items.ItemType='item' AND wishlist_items.ItemID = items.ItemID";
		$sqlGetItemsR = mysql_query($sqlGetItems) or die(mysql_error());
		
		echo '<p style="font-size: 130%">Other Items</p>';
		
		echo '<ul class="collection with-header col s12 grey lighten-4">';
		
		while ($row = mysql_fetch_array($sqlGetItemsR, MYSQL_ASSOC)) {
			
			
			echo '
			
				<li class="collection-item grey lighten-4 center" style="padding-top: 25px;">
				  <img id="bookImage' . $row["ItemID"] . '" style="border-radius: 10%; border: 2px solid black;" src="' . $row["ItemImageURL"] . '">
				  <h4>' . $row["ItemName"] . '</h4>
				  <p>by ' . $row["ItemSupplier"] . '</p>
				  <a class="btn waves-effect red" style="margin: 10px" href="php/removeFromWishlist.php?WishlistID=' . $_SESSION["WishlistIndex"] . '&ProductType=item&ProductID=' . $row["ItemID"] . '">Remove</a>
				  <a class="btn waves-effect blue" href="php/moveToShoppingCart.php?ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '&ProductType=item&ProductID=' . $row["ItemID"] . '&WishlistItemID=' . $row["WishlistItemID"] . '">Move to Shopping Cart</a>
				  <div class="clearfix"></div>
				</li>
				
				<script>Materialize.fadeInImage("#bookImage' . $row["ItemID"] . '");</script>
			
			';
			
		}//end while
		
		if (mysql_num_rows($sqlGetItemsR) < 1) echo '<li>No items found.</li>';
		
		echo '</ul>';
		
	}//end if login is ok
	
?>