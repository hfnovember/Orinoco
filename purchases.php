<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Orinoco - Purchases</title>
    <!-- CSS  -->
    <link href="Icons/icons.css" rel="stylesheet">
    <link href="Materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="CSS/Style.css" type="text/css" rel="stylesheet" media="screen,projection">


    <!--  Scripts-->
    <script src="JQuery/jQuery-2.1.1.min.js"></script>
    <script src="Materialize/js/materialize.min.js"></script>
    <script src="JS/Initialization.js"></script>

</head>
<body>

<?php session_start() ?>

<?php if (!isset($_SESSION["UserID"])) header("Location: login.php?status=noLogin"); ?>


<?php

	if (isset($_GET["status"])) {
		if ($_GET["status"] == "success") {
			echo '
			<div id="success" class="modal center green white-text">
			<div class="modal-content">
			<h4>Purchase Successful</h4>
			<i class="material-icons medium">done</i>
			<p>You have successfully purchased your products.</p>
			</div>
			<div class="modal-footer green white-text">
			<a href="purchases.php" class="white-text modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#success').modal().modal('open');</script>";	
		}//end if success	
		if ($_GET["status"] == "fail") {
			echo '
			<div id="fail" class="modal center red white-text">
			<div class="modal-content">
			<h4>Purchase Failed</h4>
			<i class="material-icons medium">warning</i>
			<p>We were not able to carry out your purchase.</p>
			</div>
			<div class="modal-footer red white-text">
			<a href="purchases.php" class="white-text modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#fail').modal().modal('open');</script>";	
		}//end if success	
	}//end if is set (status)
	
?>

    <!------------------------------- HEADER ----------------------------------->
<header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper teal">
                    <a style="margin-left: 20px" href="allproducts.php" class="brand-logo"><i class="material-icons medium">shopping_cart</i> Orinoco</a>
                    <a href="allproducts.php" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                                        <ul class="right hide-on-med-and-down">
                    	<li><a href="allproducts.php"><i class="material-icons left">list</i>Products</a></li>
						<?php if (!isset($_SESSION["UserID"])) echo '
                        <li><a href="login.php"><i class="material-icons left">lock_outline</i>Log In</a></li>
                        <li><a href="register.php"><i class="material-icons left">perm_identity</i>Register</a></li>
                        ';
                        ?>
                        <?php if (isset($_SESSION["UserID"])) {
						
						include("php/db_utils.php"); dbLogin($host, $user, $pass, $db);
			
							//Get # of items in wishlist
							$sqlFWL = "SELECT * FROM wishlist_items WHERE WishListID=" . $_SESSION["WishlistIndex"];
							$sqlFWLR = mysql_query($sqlFWL) or die(mysql_error());
							
							$numOfWishlistItems = mysql_num_rows($sqlFWLR);
							
							//Get # of items in shopping cart
							$sqlFSCL = "SELECT * FROM shoppingcart_items WHERE ShoppingCartID=" . $_SESSION["ShoppingCartIndex"];
							$sqlFSCLR = mysql_query($sqlFSCL) or die(mysql_error());
							
							$numOfShoppingCartItems = mysql_num_rows($sqlFSCLR);
							
							echo '<li><a href="wishlist.php"><i class="material-icons left">star</i>Wishlist';
							
							if ($numOfWishlistItems > 0) echo'<span class="new badge yellow black-text" data-badge-caption="Items">' . $numOfWishlistItems . '</span>';
							
							echo '</a></li>
                        	<li><a href="shoppingcart.php"><i class="material-icons left">shopping_cart</i>Shopping Cart';
							
							if ($numOfShoppingCartItems > 0) echo'<span class="new badge white black-text" data-badge-caption="Items">' . $numOfShoppingCartItems . '</span>';
							
							echo'</a></li>
							<li><a href="purchases.php"><i class="material-icons left">shop_two</i>Purchases</a></li>
							<li><a href="account.php"><i class="material-icons left">person_pin</i>Account</a></li>
							<li><a href="php/performLogout.php"><i class="material-icons left">power_settings_new</i>Log Out</a></li>
							'; 
						
						}
						
						?>
                    </ul>
                </div>
            </nav>
        </div>
        <ul class="side-nav" id="mobile-demo">
            <li class="z-depth-3 teal center-align white-text" style="padding-top: 9px;">
                <img src="Images/orinoco_Logo.png" width="60px" height="60px" />
                <p style="font-size: 150%; margin-top: 0px;">ORINOCO</p>
                <p class="lime-text">
                
					<?php 
					
						if (!isset($_SESSION["UserID"])) echo "Guest"; 
						else echo $_SESSION["UserFirstName"];
					
					
					?>
                
                </p>
            </li>
            <li><a href="allproducts.php"><i class="material-icons left">list</i>Products</a></li>
            <?php if (!isset($_SESSION["UserID"])) echo '
            <li><a href="login.php"><i class="material-icons left">lock_outline</i>Log In</a></li>
            <li><a href="register.php"><i class="material-icons left">perm_identity</i>Register</a></li>
			';
			?>
			<?php if (isset($_SESSION["UserID"])) echo '
            <li><a href="shoppingcart.php"><i class="material-icons left">shopping_cart</i>Shopping Cart</a></li>
            <li><a href="wishlist.php"><i class="material-icons left">star</i>Wishlist</a></li>
            <li><a href="purchases.php"><i class="material-icons left">shop_two</i>Purchases</a></li>
			<li><a href="account.php"><i class="material-icons left">person_pin</i>Account</a></li>
            <li><a href="php/performLogout.php"><i class="material-icons left">power_settings_new</i>Log Out</a></li>
            '; ?>
        </ul>
</header>
    <!-------------------------------------------------------------------------->

    <!-------------------------------- MAIN ------------------------------------>
    <main>
        <div class="container" style="margin-top: 30px;">
        
        <h5><?php echo $_SESSION["UserFirstName"];?>'s Purchases</h5>
        
        <p>These are all your purchases, chronologically sorted.</p>
                        
			<?php
            
                $sqlPurchase = "SELECT * FROM purchases WHERE PurchaseUserID=" . $_SESSION["UserID"];
                $sqlPurchaseR = mysql_query($sqlPurchase) or die(mysql_error());
                
                
                if (mysql_num_rows($sqlPurchaseR) == 0)
                    echo '<p>No purchases exist.</p>';
                else {
                    
                    while ($row = mysql_fetch_array($sqlPurchaseR, MYSQL_ASSOC)) {
                        
						$thisOrderTotal = 0;
						echo'<div class="card grey lighten-4">';
    					echo'<div class="card-content">';
                    	echo'<div class="card-title"></div>';
						
						$sqlPItems = "SELECT * FROM purchase_items WHERE PurchaseID=" . $row["PurchaseID"];
						$sqlPItemsR = mysql_query($sqlPItems) or die(mysql_error());
						
						if (mysql_num_rows($sqlPItemsR) == 0)
                    		echo '<p>No items exist.</p>';
						else {
						
							while ($rowI = mysql_fetch_array($sqlPItemsR, MYSQL_ASSOC)) {
								
								if ($rowI["ItemType"] == "book") {
									
									$sqlInfo = "SELECT * FROM books WHERE BookID=" . $rowI["ItemID"];
									$sqlInfoR = mysql_query($sqlInfo) or die(mysql_error());
									$rowP = mysql_fetch_array($sqlInfoR);
									
									$thisOrderTotal += $rowP["BookPrice"] * $rowI["ItemAmount"];
									
									echo '<p>' . $rowP["BookTitle"] . ' - ' . $rowP["BookAuthor"] . ' ($' . $rowP["BookPrice"] . ')   <b>x' . $rowI["ItemAmount"] . ' </b></p>';
									
								}//end if
								else if ($rowI["ItemType"] == "item") {
									
									$sqlInfo = "SELECT * FROM items WHERE ItemID=" . $rowI["ItemID"];
									$sqlInfoR = mysql_query($sqlInfo) or die(mysql_error());
									$rowP = mysql_fetch_array($sqlInfoR);
									
									$thisOrderTotal += $rowP["ItemPrice"] * $rowI["ItemAmount"];
									
									echo '<p>' . $rowP["ItemName"] . ' - ' . $rowP["ItemSupplier"] . ' ($' . $rowP["ItemPrice"] . ')   <b>x' . $rowI["ItemAmount"] . ' </b></p>';
									
								}//end if
								
							}//end while items
							
						}//end if items
						
						echo '<br/>';
						
						echo '<p class="red-text center"><b>Order Total:</b> $' . $thisOrderTotal . '</p>';
						echo '<p class="red-text center"><b>Bought on:</b> ' . $row["PurchaseDateTime"] . '</p>';
						
						echo'</div></div>';
                        
                    }//end while purchases
                    
                }//end if
            ?>

        </div>
    </main>
    <!-------------------------------------------------------------------------->
   
    <!------------------------------- FOOTER ----------------------------------->
    <footer class="page-footer teal">
        <div class="container">
            <div class="row center">


                <div class="col l4 s12">

                    <a class="grey-text text-lighten-3" href="contactUs.php">Contact Us</a>

                </div>

                <div class="col l4 s12">

                    <a class="grey-text text-lighten-3" href="privacyPolicy.php">Privacy Policy</a>

                </div>

                <div class="col l4 s12">

                    <a class="grey-text text-lighten-3" href="termsConditions.php">Terms & Conditions</a>

                </div>

            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center-align">
                © All Copyrights Reserved - Orinoco 2017
   
            </div>
        </div>
    </footer>
    <!-------------------------------------------------------------------------->

    <div class="hiddendiv common"></div><div class="drag-target" data-sidenav="nav-mobile" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); left: 0px;"></div>   


</body>
</html>