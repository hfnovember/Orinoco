<?php

    include_once("db_utils.php");
	dbLogin($host, $user, $pass, $db);
	
	$sqlStatement = "SELECT * FROM items";
	$sqlResult = mysql_query($sqlStatement) or die(mysql_error());
	
	if (mysql_num_rows($sqlResult) > 0) {
		if (session_status() == PHP_SESSION_NONE) session_start();
		
		while ($row = mysql_fetch_array($sqlResult, MYSQL_ASSOC)) {
			
			
			if ($row["ItemStock"] > 0) {
				
				echo '<!--Item #' . $row["ItemID"] . '-->
					<div class="col s12 m12 l6">
						<div class="card center grey lighten-4" style="padding: 4px 7px;">
							<span class="card-title"><p>' . $row["ItemName"] . '</p></span>
							<p Class="price">$' . number_format((float)$row["ItemPrice"], 2, '.', '') . '</p>                            
							<div class="card-image itemImage">
								<img src="' . $row["ItemImageURL"] . '">';
								
				if (isset($_SESSION["UserID"])) {
								
							echo '	<a class="btn-floating halfway-fab waves-effect waves-light orange" style="margin-right: 50px" href="php/addToWishlist.php?ProductType=item&ProductID=' . $row["ItemID"] . '&WishlistID=' . $_SESSION["WishlistIndex"] . '"><i class="material-icons">star</i></a>
								<a href="php/addToShoppingCart.php?ProductType=item&ProductID=' . $row["ItemID"] . '&ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '" class="btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons">shopping_cart</i></a>';
								
				}//end if logged in
								
							echo '	
							</div>
							<div class="card-content">
								<div class="divider"></div>
								<p style="margin-top: 20px;"><p>' . $row["ItemSupplier"] . '</p>
								<a href="item.php?type=item&id=' . $row["ItemID"] . '">View More >></a>
							</div>
						</div>
					</div>
					<!--end product-->';
				
			}//end if stock > 0
			
			
		}//end while result
	}//end results found
	else {
		echo '<p> No Books Found </p>';
	}//end no results found

?>