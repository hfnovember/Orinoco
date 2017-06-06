<?php

	session_start();

	if(!isset($_SESSION["UserID"]))	header("Location: ../login.php?status=noLogin");
	else {

		include_once("db_utils.php");
		dbLogin($host, $user, $pass, $db);
		date_default_timezone_set("America/Los_Angeles");
		
		//Books---------------------------------------------------------------------

		$sqlGetBookItems= "SELECT * FROM shoppingcart_items WHERE ShoppingCartID = " . $_SESSION["ShoppingCartIndex"] . " AND ItemType = 'book'";
		$sqlGetBookItemsR = mysql_query($sqlGetBookItems) or die(mysql_error());

		if( mysql_num_rows ($sqlGetBookItemsR) > 0) {
			$sqlCreatePurchaseBooks = "INSERT INTO purchases(PurchaseUserID, PurchaseDateTime, PurchaseType)
			VALUES(" . $_SESSION["UserID"] . ",'" . date("Y-m-d H:i:s") . "', 'book' )";
			$sqlCreatePurchaseBooksR = mysql_query ($sqlCreatePurchaseBooks)or die(mysql_error());
			if($sqlCreatePurchaseBooksR)  {
				//Get last ID:
				$sqlLatestID = mysql_query("SELECT MAX(PurchaseID) AS maxNum FROM purchases");
				$row = mysql_fetch_array($sqlLatestID);
				$sqlLastID = $row["maxNum"];
				
				
				//Add the items
				while ($row = mysql_fetch_array($sqlGetBookItemsR, MYSQL_ASSOC)) {
					$sqlAddToPurchase = "INSERT INTO purchase_items (PurchaseID, ItemType, ItemID, ItemAmount) VALUES(" . $sqlLastID . ",'book'," . $row["ItemID"] . "," . $row["ItemAmount"] . ")";
					$sqlAddToPurchaseR = mysql_query($sqlAddToPurchase) or die(mysql_error());
					
					
					//Find stock
					$sqlFS = "SELECT BookStock FROM books WHERE BookID=" . $row["ItemID"] . " LIMIT 1";
					$sqlFSR = mysql_query($sqlFS);
					$row2 = mysql_fetch_array($sqlFSR);
					$stock = $row2["BookStock"];
					
					//Decrease stock
					$sqlDecStock = "UPDATE books SET BookStock = " . ($stock - $row["ItemAmount"]) . " WHERE BookID=" . $row["ItemID"];
					$sqlDecStockR = mysql_query($sqlDecStock) or die(mysql_error());
					
				}//end while
				
			}//end if
		}//end if > 0
			
			
		//Items---------------------------------------------------------------------
		
		$sqlGetItems= "SELECT * FROM shoppingcart_items WHERE ShoppingCartID = " . $_SESSION["ShoppingCartIndex"] . " AND ItemType = 'item'";
		$sqlGetItemsR = mysql_query($sqlGetItems) or die(mysql_error());

		if( mysql_num_rows ($sqlGetItemsR) > 0) {
			$sqlCreatePurchaseItems = "INSERT INTO purchases(PurchaseUserID, PurchaseDateTime, PurchaseType)
			VALUES(" . $_SESSION["UserID"] . ",'" . date("Y-m-d H:i:s") . "', 'item' )";
			$sqlCreatePurchaseItemsR = mysql_query ($sqlCreatePurchaseItems)or die(mysql_error());
			if($sqlCreatePurchaseItemsR)  {
				//Get last ID:
				$sqlLatestID = mysql_query("SELECT MAX(PurchaseID) AS maxNum FROM purchases");
				$row = mysql_fetch_array($sqlLatestID);
				$sqlLastID = $row["maxNum"];
				
				
				//Add the items
				while ($row = mysql_fetch_array($sqlGetItemsR, MYSQL_ASSOC)) {
					$sqlAddToPurchase = "INSERT INTO purchase_items (PurchaseID, ItemType, ItemID, ItemAmount) VALUES(" . $sqlLastID . ",'item'," . $row["ItemID"] . "," . $row["ItemAmount"] . ")";
					$sqlAddToPurchaseR = mysql_query($sqlAddToPurchase) or die(mysql_error());
					
					
					//Find stock
					$sqlFS = "SELECT ItemStock FROM items WHERE ItemID=" . $row["ItemID"] . " LIMIT 1";
					$sqlFSR = mysql_query($sqlFS);
					$row2 = mysql_fetch_array($sqlFSR);
					$stock = $row2["ItemStock"];
					
					//Decrease stock
					$sqlDecStock = "UPDATE items SET ItemStock = " . ($stock - $row["ItemAmount"]) . " WHERE ItemID=" . $row["ItemID"];
					$sqlDecStockR = mysql_query($sqlDecStock) or die(mysql_error());
					
				}//end while
			}//end if
		}//end if > 0
		
		//---------------------------------------------------------------------------
				
		//Remove all items from Shopping Cart.
		
		$sqlRemove = "DELETE FROM shoppingcart_items WHERE ShoppingCartID=" . $_SESSION["ShoppingCartIndex"];
		$sqlRemoveR = mysql_query($sqlRemove) or die (mysql_error());
		
		if ($sqlRemoveR) header("Location: ../purchases.php?status=success");
		else header("Location: ../purchases.php?status=fail");
		
		
	}//end if login is ok
	
?>