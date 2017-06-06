<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Orinoco - Shopping Cart</title>
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
        
        	<h4>Purchase Checkout</h2>
            
            <?php

				if (isset($_GET["status"])) {
					
				}//end if is set (status)
				
			?>
        
        	<div class="row">
            	<h5>Books</h5>
            	<table>
        		<?php 
				
						$sumBooks = 0;
						$sumItems = 0;
					
					//include_once("php/dbLogin.php");
					//dbLogin($host,$user,$pass,$db);
					
					//Books Purchase
					
					$sqlGetBooks = "SELECT * FROM shoppingcart_items, books WHERE ShoppingCartID=" . $_SESSION["ShoppingCartIndex"] . " AND shoppingcart_items.ItemID = books.BookID AND ItemType='book'";
					
					$sqlGetBooksR = mysql_query($sqlGetBooks) or die(mysql_error());
					
					if (mysql_num_rows($sqlGetBooksR) < 1) {
						echo '
						<thead>
							<tr>
								<th>No books in shopping cart.</th>
							</tr>
						</thead>';	
					}
					else {
						
						echo '
						<thead>
							<tr>
								<th>Book Title</th>
								<th>Book Price</th>
								<th>Book Amount</th>
								<th>Book Total</th>
							</tr>
						</thead>';
						
						echo '<tbody>';
						
						while ($row = mysql_fetch_array($sqlGetBooksR, MYSQL_ASSOC)) {
							
							$sumBooks += $row["ItemAmount"] * $row["BookPrice"];
							
							echo '
							
							<tr>
								<td>' . $row["BookTitle"] . '</td>
								<td>' . $row["BookPrice"] . '</td>
								<td>' . $row["ItemAmount"] . '</td>
								<td>' . number_format((float)($row["ItemAmount"] * $row["BookPrice"]), 2, '.', '') . '</td>
							</tr>
							
							';
							
						}//end while
						
						echo '</tbody>';
						
					}//end while
				
				 ?>     


                 </table> 
                 
                 <!---------------------------------------------------------------->
                 <div style="margin-top: 20px; margin-bottom: 20px;"></div>
                 <!---------------------------------------------------------------->
                 
                 <h5>Other items</h5>
                 <table>
        		<?php 
					
					//include_once("php/dbLogin.php");
					//dbLogin($host,$user,$pass,$db);
					
					//Items Purchase
					
					$sqlGetItems = "SELECT * FROM shoppingcart_items, items WHERE ShoppingCartID=" . $_SESSION["ShoppingCartIndex"] . " AND shoppingcart_items.ItemID = items.ItemID AND ItemType='item'";
					
					$sqlGetItemsR = mysql_query($sqlGetItems) or die(mysql_error());
					
					if (mysql_num_rows($sqlGetItemsR) < 1) {
						echo '
						<thead>
							<tr>
								<th>No other products in shopping cart.</th>
							</tr>
						</thead>';	
					}
					else {
						
						echo '
						<thead>
							<tr>
								<th>Item Name</th>
								<th>Item Price</th>
								<th>Item Amount</th>
								<th>Item Total</th>
							</tr>
						</thead>';
						
						echo '<tbody>';
						
						while ($row = mysql_fetch_array($sqlGetItemsR, MYSQL_ASSOC)) {
							
							$sumItems += $row["ItemAmount"] * $row["ItemPrice"];
							
							echo '
							
							<tr>
								<td>' . $row["ItemName"] . '</td>
								<td>' . $row["ItemPrice"] . '</td>
								<td>' . $row["ItemAmount"] . '</td>
								<td>' . number_format((float)($row["ItemAmount"] * $row["ItemPrice"]), 2, '.', '') . '</td>
							</tr>
							
							';
							
						}//end while
						
						echo '</tbody>';
						
					}//end while
				
				 ?>     
                 </table> 
                 
                 <p class="center red-text" style="font-size: 130%; border: 2 px solid grey; padding: 5px; margin-top: 50px;"><span style="font-weight: 700;"><b>ORDER TOTAL: </b></span>
                 	<?php echo "$" . number_format((float)$sumBooks + $sumItems, 2, '.', '') ?>
                 </p>  
                         
            </div>
            
            <div class="row center">
            	<?php
                            if (mysql_num_rows($sqlGetItemsR) > 0 || mysql_num_rows($sqlGetBooksR) > 0) echo'
					<a class="btn green waves-effect" href="php/purchase.php">Purchase</a>  ';
				?>
            </div>

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