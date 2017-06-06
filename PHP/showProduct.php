<?php

	include_once("db_utils.php");
	dbLogin($host, $user, $pass, $db);
	
	if (isset($_GET["type"]) && isset($_GET["id"])) {
		
		if ($_GET["type"] == "book") { 
			$table = "books"; $column = "BookID"; $productName = "BookTitle";
			$productPrice = "BookPrice"; $productImage = "BookImageURL"; $productSupplier = "BookAuthor";
			$productType = "BookGenre"; $productStock = "BookStock"; $productID = "BookID";
			$productReviewTable = "bookreviews";
		}//end if book
		else if ($_GET["type"] == "item") {
			$table = "items"; $column = "ItemID"; $productName = "ItemName";
			$productPrice = "ItemPrice"; $productImage = "ItemImageURL"; $productSupplier = "ItemSupplier";
			$productType = "ItemCategory"; $productStock = "ItemStock"; $productID = "ItemID";
			$productReviewTable = "itemreviews";
		}//end if item
	
		$sqlStatement = "SELECT * FROM " . $table . " WHERE " . $column . "=" . $_GET["id"];
		$sqlResult = mysql_query($sqlStatement) or die(mysql_error());
		
		if (mysql_num_rows($sqlResult) > 0) {
			while ($row = mysql_fetch_array($sqlResult, MYSQL_ASSOC)) {
				
            	echo'<!--'. $_GET["type"] . ' ' . $row[$column] .'-->
                <div class="col s12 m12">
                    <div class="card center grey lighten-4" style="padding: 4px 7px;">
                        <span class="card-title">
                            <p>' . $row[$productName] . '</p></span>
                            <p Class="price">$'. number_format((float)$row[$productPrice], 2, '.', '') .'</p>
                        <div class="card-image itemImage">
                            <img src="'. $row[$productImage] .'">
                        </div>
                        <div class="card-content">
                            <div class="divider"></div>
                            <p style="margin-top: 20px;">
                                <p>'. $row[$productSupplier] .'</p>
								<p>'. $row[$productType] .'</p>
                            </p>';
							
							if ($row[$productStock] >= 10) {
								echo '<i class="material-icons green-text">done</i><p class="green-text">' . $row[$productStock] . ' items in stock</p>';	
							}//stock is ok
							else if ($row[$productStock] < 10) {
								echo '<i class="material-icons red-text">warning</i><p class="red-text">Only ' . $row[$productStock] . ' items remaining </p>';
							}//not much stock			
							
							echo '
                        </div>
                        <div class="card-action">';
						
						if (isset($_SESSION["UserID"])) {
						
							echo '
                            <a class="btn-flat orange white-text waves-effect" style="margin: 5px auto;" href="php/addToWishlist.php?ProductType=' . $_GET["type"] . '&ProductID=' . $row[$productID] . '&WishlistID=' . $_SESSION["WishlistIndex"] . '">Add to Wishlist</a>
                            <a class="btn-flat red white-text waves-effect" style="margin: 5px auto;" href="php/addToShoppingCart.php?ProductType=' . $_GET["type"] . '&ProductID=' . $row[$productID] . '&ShoppingCartID=' . $_SESSION["ShoppingCartIndex"] . '">Add to Shopping Cart</a>';
							
						}//end if logged in
							
						echo '	
                        </div>
                        <div class="card-content left-align">
                            <p>Reviews:</p>';
                            
							$sqlStatementR = "SELECT * FROM " . $productReviewTable . " WHERE " . $productID . "  = " . $row[$productID];
							$sqlResultR = mysql_query($sqlStatementR) or die(mysql_error());
		
							if (mysql_num_rows($sqlResultR) > 0) {
								while ($rowR = mysql_fetch_array($sqlResultR, MYSQL_ASSOC)) {
									echo '<div class="review"><small><strong>' . $rowR["UserFirstName"] . ' (Rated ' ; for( $i = 1; $i <= $rowR["ReviewRating"]; $i++)
echo '<img width=13 src="Images/star.png" />'; echo ') said: </strong><br/><i>"' . $rowR["ReviewText"] . '"</i></small></div>';
								}//end while
							}//end if items exist
							else {
								echo '<small>No reviews found for this item.</small>';
							}//end else
                        echo '</div>
                    </div>
                </div>
                <!--end product-->';
				
			}//end while
		}//end if
		else {
			echo '<p class="red-text">The item with this ID (' . $_GET["id"] . ') was not found.</p>';
		}//end else
		
	}//end if params set
	else {
		
	}//end if params not set

?>