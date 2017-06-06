<?php

    include_once("db_utils.php");
	dbLogin($host, $user, $pass, $db);
	
	$sqlStatement = "SELECT * FROM books";
	$sqlResult = mysql_query($sqlStatement) or die(mysql_error());
	
	if (mysql_num_rows($sqlResult) > 0) {
		if (session_status() == PHP_SESSION_NONE) session_start();
		
		while ($row = mysql_fetch_array($sqlResult, MYSQL_ASSOC)) {
			
			
			if ($row["BookStock"] > 0) {
				
				echo '<!--Book #' . $row["BookID"] . '-->
								<div class="col s12 m12 l6">
									<div class="card center grey lighten-4" style="padding: 4px 7px;">
										<span class="card-title"><p>' . $row["BookTitle"] . '</p></span>
										<p Class="price">$' . number_format((float)$row["BookPrice"], 2, '.', '') . '</p>                            
										<div class="card-image itemImage">
											<img src="' . $row["BookImageURL"] . '">';
											
				if (isset($_SESSION["UserID"])) {
											
										echo '	<a class="btn-floating halfway-fab waves-effect waves-light orange" style="margin-right: 50px" href="' . 'php/addToWishlist.php?ProductType=book&ProductID=' . $row["BookID"] . '&WishlistID=' . $_SESSION["WishlistIndex"] . '"><i class="material-icons">star</i></a>
											<a class="btn-floating halfway-fab waves-effect waves-light blue" href="' . 'php/addToShoppingCart.php?ProductType=book&ProductID=' . $row["BookID"] . '&ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '"><i class="material-icons">shopping_cart</i></a> ';
											
				}//end if logged in
											
											
										echo '</div>
										<div class="card-content">
											<div class="divider"></div>
											<p style="margin-top: 20px;"><p>' . $row["BookAuthor"] . '</p>
											<a href="item.php?type=book&id=' . $row["BookID"] . '">View More >></a>
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