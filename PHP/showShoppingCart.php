<?php

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {
		
		include_once("db_utils.php");
		dbLogin($host, $user, $pass, $db);
	
	
		//BOOKS FIRST!
		
		$sqlGetItems = "SELECT * FROM shoppingcart_items, books WHERE shoppingcart_items.ShoppingCartID=" . $_SESSION["ShoppingCartIndex"] . " AND shoppingcart_items.ItemType='book' AND shoppingcart_items.ItemID = books.BookID";
		$sqlGetItemsR = mysql_query($sqlGetItems) or die(mysql_error());
		
		echo '<p style="font-size: 130%">Books</p>';
		
		echo '<ul class="collection with-header col s12 grey lighten-4">';
		
		while ($row = mysql_fetch_array($sqlGetItemsR, MYSQL_ASSOC)) {
			
			
			echo '
			
				<li class="collection-item grey lighten-4 center" style="padding-top: 25px;">
				  <img id="bookImage' . $row["BookID"] . '" style="border-radius: 0% 10% 10% 0%; border: 2px solid black;" src="' . $row["BookImageURL"] . '">
				  <h4>' . $row["BookTitle"] . '</h4>
				  <p>by ' . $row["BookAuthor"] . '</p>
				  
				  
				  <div class="center">
					  <form name="amountForm" action="php/changeAmount.php" method="post">
						<p> Purchase Amount: 
							<a style="margin-right: 20px;" href="php/decAmount.php?CurrentAmount=' . $row["ItemAmount"] . '&ShoppingCartItemID=' . $row["ShoppingCartItemID"] . '">🠟</a>' 
							. $row["ItemAmount"] . 
							'<a style="margin-left: 20px;" href="php/incAmount.php?CurrentAmount=' . $row["ItemAmount"] . '&ShoppingCartItemID=' . $row["ShoppingCartItemID"] . '">🠝</a>
						</p>
					  </form>
				  </div>
				  
				  
				  <a class="red-text left" href="php/removeFromShoppingCart.php?ProductType=book&ProductID=' . $row["BookID"] . '&ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '">Remove</a>
				  <span class="new badge right" data-badge-caption="">$' . number_format((float)$row["BookPrice"], 2, '.', '') . '</span>
				  <div class="clearfix"></div>
				</li>
				
				<script>Materialize.fadeInImage("#bookImage' . $row["BookID"] . '");</script>
			
			';
			
		}//end while
		
		if (mysql_num_rows($sqlGetItemsR) < 1) echo '<li>No items found.</li>';
		
		echo '</ul><br/><br/>';
		
		
		//THEN ITEMS!
		
		$sqlGetItems = "SELECT * FROM shoppingcart_items, items WHERE shoppingcart_items.ShoppingCartID=" . $_SESSION["ShoppingCartIndex"] . " AND shoppingcart_items.ItemType='item' AND shoppingcart_items.ItemID = items.ItemID";
		$sqlGetItemsR = mysql_query($sqlGetItems) or die(mysql_error());
		
		echo '<p style="font-size: 130%">Other Items</p>';
		
		echo '<ul class="collection with-header col s12 grey lighten-4">';
		
		while ($row = mysql_fetch_array($sqlGetItemsR, MYSQL_ASSOC)) {
			
			
			echo '
			
				<li class="collection-item grey lighten-4 center" style="padding-top: 25px;">
				  <img id="bookImage' . $row["ItemID"] . '" style="border-radius: 10%; border: 2px solid black;" src="' . $row["ItemImageURL"] . '">
				  <h4>' . $row["ItemName"] . '</h4>
				  <p>by ' . $row["ItemSupplier"] . '</p>
				  
				  <div class="center">
					  <form name="amountForm" action="php/changeAmount.php" method="post">
						<p> Purchase Amount: 
							<a style="margin-right: 20px;" href="php/decAmount.php?CurrentAmount=' . $row["ItemAmount"] . '&ShoppingCartItemID=' . $row["ShoppingCartItemID"] . '">🠟</a>' 
							. $row["ItemAmount"] . 
							'<a style="margin-left: 20px;" href="php/incAmount.php?CurrentAmount=' . $row["ItemAmount"] . '&ShoppingCartItemID=' . $row["ShoppingCartItemID"] . '">🠝</a>
						</p>
					  </form>
				  </div>
				  
				  <a class="red-text left" href="php/removeFromShoppingCart.php?ProductType=item&ProductID=' . $row["ItemID"] . '&ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '">Remove</a>
				  <span class="new badge right" data-badge-caption="">$' . number_format((float)$row["ItemPrice"], 2, '.', '') . '</span>
				  <div class="clearfix"></div>
				 
				</li>
				
				<script>Materialize.fadeInImage("#bookImage' . $row["ItemID"] . '");</script>
			
			';
			
		}//end while
		
		if (mysql_num_rows($sqlGetItemsR) < 1) echo '<li>No items found.</li>';
		
		echo '</ul>';
		
	}//end if login is ok
	
?>