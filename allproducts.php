<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Orinoco - Products</title>
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

<?php

	if (isset($_GET["status"])) {
		if ($_GET["status"] == "loggedOut") {
			echo '<!-- Log out modal -->
			<div id="logoutModal" class="modal center">
			<div class="modal-content">
			<h4>Log Out</h4>
			<i class="material-icons medium blue-text">info_outline</i>
			<p>You have successfully logged out.</p>
			</div>
			<div class="modal-footer">
			<a href="allProducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#logoutModal').modal().modal('open');</script>";	
		}//end if bad info
		if ($_GET["status"] == "accountDeleted") {
			echo '<!-- Deleted modal -->
			<div id="deletedModal" class="modal center">
			<div class="modal-content">
			<h4>Account Deleted</h4>
			<i class="material-icons medium blue-text">info_outline</i>
			<p>You have successfully deleted your account.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#deletedModal').modal().modal('open');</script>";	
		}//end if deleted
		if ($_GET["status"] == "accountDeletedButError") {
			echo '<!-- Deleted modal -->
			<div id="deletedModal" class="modal center">
			<div class="modal-content">
			<h4>Account Deleted</h4>
			<i class="material-icons medium blue-text">info_outline</i>
			<p>You have successfully deleted your account. However some data has not been deleted.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#deletedModal').modal().modal('open');</script>";	
		}//end if  deleted but error
		if ($_GET["status"] == "unauthorizedWishlist") {
			echo '<!-- unauth wishlist modal -->
			<div id="unauthWishlist" class="modal center">
			<div class="modal-content">
			<h4>Unauthorized</h4>
			<i class="material-icons medium red-text">lock</i>
			<p>You have tried to access a wishlist that you are not authorized for.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#unauthWishlist').modal().modal('open');</script>";	
		}//end if  deleted but error
		if ($_GET["status"] == "addedToWishlist") {
			echo '<!-- added wishlist modal -->
			<div id="addedToWishlist" class="modal center">
			<div class="modal-content">
			<h4>Wishlist</h4>
			<i class="material-icons medium blue-text">shopping_cart</i>
			<p>You have successfully added an item to your wishlist.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#addedToWishlist').modal().modal('open');</script>";	
		}//end if  added ti wishlist
		if ($_GET["status"] == "existsInWishlist") {
			echo '<!-- added wishlist modal -->
			<div id="existsInWishlist" class="modal center">
			<div class="modal-content">
			<h4>Wishlist</h4>
			<i class="material-icons medium blue-text">shopping_cart</i>
			<p>The item you tried to add already exists in your wishlist.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#existsInWishlist').modal().modal('open');</script>";	
		}//end if  added to wishlist
		if ($_GET["status"] == "unauthorizedShoppingCart") {
			echo '<!-- unauth sp modal -->
			<div id="unauthSP" class="modal center">
			<div class="modal-content">
			<h4>Unauthorized</h4>
			<i class="material-icons medium red-text">lock</i>
			<p>You have tried to access a shopping cart that you are not authorized for.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#unauthSP').modal().modal('open');</script>";	
		}//end if  deleted but error
		if ($_GET["status"] == "addedToShoppingCart") {
			echo '<!-- addedToShoppingCart modal -->
			<div id="addedToShoppingCart" class="modal center">
			<div class="modal-content">
			<h4>Shopping Cart</h4>
			<i class="material-icons medium blue-text">shopping_cart</i>
			<p>You have successfully added an item to your shopping cart.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#addedToShoppingCart').modal().modal('open');</script>";	
		}//end if  added ti wishlist
		if ($_GET["status"] == "existsInShoppingCart") {
			echo '<!-- existsInShoppingCart modal -->
			<div id="existsInShoppingCart" class="modal center">
			<div class="modal-content">
			<h4>Shopping Cart</h4>
			<i class="material-icons medium blue-text">shopping_cart</i>
			<p>The item you tried to add already exists in your shopping cart.</p>
			</div>
			<div class="modal-footer">
			<a href="allproducts.php" class="modal-action modal-close waves-effect waves-blue btn-flat">OK</a>
			</div>
			</div>';
			echo "<script>$('#existsInShoppingCart').modal().modal('open');</script>";	
		}//end if  added ti wishlist
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

            <div class="row" style="border-radius: 5px;">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a href="#books">Books</a></li>
                        <li class="tab col s3"><a href="#other">Other Products</a></li>
                    </ul>
                </div>
                <div id="books" class="col s12">

                    <div class="row">
                    
						 <?php include("PHP/showAllBooks.php");?>
                    
                    </div> <!--end row-->            

                </div><!--end tab-->

                <div id="other" class="col s12">

                    <div class="row">
                    
                    	<?php include("PHP/showAllItems.php");?>
                        
                    </div> <!--end row-->

                </div> <!--end tab-->
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