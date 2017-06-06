<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Orinoco - Administration</title>
    <!-- CSS  -->
    <link href="../Icons/icons.css" rel="stylesheet">
    <link href="../Materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="../CSS/Style.css" type="text/css" rel="stylesheet" media="screen,projection">


    <!--  Scripts-->
    <script src="../JQuery/jQuery-2.1.1.min.js"></script>
    <script src="../Materialize/js/materialize.min.js"></script>
    <script src="../JS/Initialization.js"></script>

</head>
<body>

    <!------------------------------- HEADER ----------------------------------->
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper teal darken-4">
                    <a href="#!" class="brand-logo">Orinoco Admin</a>
                    <ul class="right hide-on-med-and-down">
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-------------------------------------------------------------------------->

    <!-------------------------------- MAIN ------------------------------------>
    <main>
        <div class="container" style="margin-top: 30px;">

            <a href="index.php">Back to Admin Page</a>

            <h5 class="collection-header">Sales by day</h5>
            
            <p>The following is a list of sales for each day.</p>

            <?php
			
				include_once("../php/db_utils.php");
				dbLogin($host, $user, $pass, $db);
			
				
				$sqlGetPurchases = "SELECT DATE(PurchaseDateTime) AS d, PurchaseID FROM purchases";
				$sqlGetPurchasesR =  mysql_query($sqlGetPurchases) or die(mysql_error());
				
				while ($rowPurchase = mysql_fetch_array($sqlGetPurchasesR, MYSQL_ASSOC)) {
				
					echo'<div class="card grey lighten-3">';
					echo'<div class="card-content">';
					echo'<span class="card-title">' . $rowPurchase["d"] . '</span>';
					
					echo '<ul class="collection">';
					
					$sqlPurchaseItems = "SELECT * FROM purchase_items WHERE PurchaseID = " . $rowPurchase["PurchaseID"];
					$sqlPurchaseItemsR = mysql_query($sqlPurchaseItems) or die(mysql_error());
					
					while ($rowPurchaseItem = mysql_fetch_array($sqlPurchaseItemsR, MYSQL_ASSOC)) {
						
						$total = 0;
						
						if ($rowPurchaseItem["ItemType"] == "book") {
							$sqlBook = mysql_query("SELECT * FROM books WHERE BookID=" . $rowPurchaseItem["ItemID"]);
							$sqlBookR = mysql_fetch_array($sqlBook);
							echo '<li class="collection-item">' . $sqlBookR["BookTitle"] . ' x' . $rowPurchaseItem["ItemAmount"] . '($' . $sqlBookR["BookPrice"] . ')</li>';
							$total += $sqlBookR["BookPrice"] * $rowPurchaseItem["ItemAmount"];
						}//end if book
						else if ($rowPurchaseItem["ItemType"] == "item") {
							$sqlItem = mysql_query("SELECT * FROM items WHERE ItemID=" . $rowPurchaseItem["ItemID"]);
							$sqlItemR = mysql_fetch_array($sqlItem);
							echo '<li class="collection-item">' . $sqlItemR["ItemName"] . ' x' . $rowPurchaseItem["ItemAmount"] . '($' . $sqlItemR["ItemPrice"] . ')</li>';
							$total += $sqlItemR["ItemPrice"] * $rowPurchaseItem["ItemAmount"];
						}//end if item
						
						echo '<p class="green-text"><b>Total:</b> $' . $total . '</p>';
						
					}//end while purchaseItems
					
					echo '</ul';
					
					echo'</div></div>';
				
				}//end while purchases

				
				echo '</div></li>';
			
			echo '</ul>';
				
				
				
			?>

        </div>
    </main>
    <!-------------------------------------------------------------------------->

    <!------------------------------- FOOTER ----------------------------------->
    <footer class="page-footer teal darken-4">
        <div class="container">
            <div class="row center">

            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center-align">
                © All Copyrights Reserved - Orinoco 2017
   
            </div>
        </div>
    </footer>
    <!-------------------------------------------------------------------------->

    <div class="hiddendiv common"></div>
    <div class="drag-target" data-sidenav="nav-mobile" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); left: 0px;"></div>


</body>
</html>

