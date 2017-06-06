<?php
	
	session_start();
	
	if (isset($_SESSION["UserID"])) header("Location: performLogout.php");
	else {
		
		include("db_utils.php");
		dbLogin($host, $user, $pass, $db);
		
		$currentUser = trim(strtolower($_POST["orinoco_username"]));
		$currentPass = md5($_POST["orinoco_password"]);
		
		$sqlStatement = "SELECT * FROM users";
		$sqlResult = mysql_query($sqlStatement) or die(mysql_error());
		
		while ($row = mysql_fetch_array($sqlResult, MYSQL_ASSOC)) {
			if (($row["Username"] == $currentUser) && ($row["UserPassword"] == $currentPass)) {
				$_SESSION["UserID"] = $row["UserID"];
				$_SESSION["Username"] = $row["Username"];
				$_SESSION["UserEmail"] = $row["UserEmail"];
				$_SESSION["UserFirstName"] = $row["UserFirstName"];
				$_SESSION["UserIsAdmin"] = $row["IsAdmin"];
				
				//Check the user's wishlist and cart (creates if they dont exist yet)
				$sqlCW = "SELECT UserID FROM wishlist WHERE UserID=" . $_SESSION["UserID"];
				$sqlCWResult = mysql_query($sqlCW) or die(mysql_error());
				$sqlCWCount = mysql_num_rows($sqlCWResult);
				
				$sqlCC = "SELECT UserID FROM shoppingcart WHERE UserID=" . $_SESSION["UserID"];
				$sqlCCResult = mysql_query($sqlCC) or die(mysql_error());
				$sqlCCCount = mysql_num_rows($sqlCCResult);
				
				//Create the wishlist
				if ($sqlCWCount < 1) {
					$sqlCreateWishlist = "INSERT INTO wishlist (UserID) VALUES (" . $_SESSION["UserID"] . ")";
					$sqlCreateWishlistR = mysql_query($sqlCreateWishlist) or die(mysql_error());
					if (!$sqlCreateWishlistR) die("A fatal DB error has occured - Cannot create wishlist for user " . $_SESSION["UserID"]);
				}//end if
				
				//Create the shopping cart
				if ($sqlCCCount < 1) {
					$sqlCreateCart = "INSERT INTO shoppingcart (UserID) VALUES (" . $_SESSION["UserID"] . ")";
					$sqlCreateCartR = mysql_query($sqlCreateCart) or die(mysql_error());
					if (!$sqlCreateCartR) die("A fatal DB error has occured - Cannot create shopping cart for user " . $_SESSION["UserID"]);
				}//end if
				
				//Set wishlist index
				$sqlFW = "SELECT * FROM wishlist WHERE UserID=" . $_SESSION["UserID"];
				$_SESSION["WishlistIndex"] = mysql_result(mysql_query($sqlFW), 0);
				
				//Set shopping cart index
				$sqlFW = "SELECT * FROM shoppingcart WHERE UserID=" . $_SESSION["UserID"];
				$_SESSION["ShoppingCartIndex"] = mysql_result(mysql_query($sqlFW), 0);
				
				if (!$_SESSION["UserIsAdmin"]) header("Location: ../allProducts.php");
				else header("Location: ../admin");
				
			}//end if authorized
		}//end while
		
		if ($_SESSION["UserID"] == "") header ('Location: ../login.php?status=badInfo');
			
	}//end if user not logged in
	

?>