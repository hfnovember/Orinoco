<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <?php session_start(); ?>
    <title>Orinoco - <?php echo $_SESSION["UserFirstName"] . "'s "; ?> Account</title>
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

<?php if (!isset($_SESSION["UserID"])) header("Location: login.php?status=noLogin"); ?>

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
    	<script src="JS/accmanagement.js" language="javascript"></script>
        <div class="container" style="margin-top: 30px;">
        
        <div class="card grey lighten-4">
        
            <div class="card-content">
            
            	<div class="center card-title">Manage Account</div>
        
                    <form name="editInfo" action="php/changeInfo.php" method="post" onsubmit="return validatePasswordFields();">
                    
                        <?php 
                            if (isset($_GET["status"])) {
                                if ($_GET["status"] == "success") {
                                    echo '<div class="center"><i class="material-icons medium green-text">done</i><p class="green-text center">Your account information was sucessfully updated.</p></div>';	
                                }//end if success
								else if ($_GET["status"] == "failure") {
									echo '<div class="center"><i class="material-icons medium red">warning</i><p class="red-text center">Unable to update your account information.</p></div>';
								}//end if failure
								else if ($_GET["status"] == "invalidUserID") {
									echo '<div class="center"><i class="material-icons medium red">warning</i><p class="red-text center">You have provided an invalid user ID.</p></div>';
								}//end if invalid id
                                else {
                                    echo '<p class="center">You may change your name, email, password or delete your account.</p>';
                                }
                            }//end if set status
                        ?>
                
                        <p Class="center red-text"></p>
                      
                        <!--First Name field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="text" ID="chg_firstname" name="chg_firstname" Class="validate" title="Name should be between 2 and 30 characters long and may only contain letters and -" value="<?php echo $_SESSION["UserFirstName"]; ?>" maxlength="30" required></input>
                            <label for="chg_firstname">Change name</label>
                        </div>
                
                        <!--Email field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="email" ID="chg_email" name="chg_email" Class="validate" onKeyPress="return avoidSpaces(event)" title="Email should be in the format example@domain.com" value="<?php echo $_SESSION["UserEmail"]; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-z]{2,24}$" maxlength="50" required></input>
                            <label for="chg_email">Change e-Mail</label>
                        </div>
                
                        <!--Password field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="password" ID="chg_password" name="chg_password" Class="validate"></input>
                            <label for="chg_password">Change password</label>
                        </div>
                
                        <!--Password Confirmation field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="password" ID="chg_confirmPassword" name="chg_confirmPassword" Class="validate" ></input>
                            <label for="chg_confirmPassword">Confirm password</label>
                        </div>
                
                        <div class="input-field col s6 center-align center-block">
                            <input type="Submit" ID="save" Class="btn waves-effect waves-light" Value="Save"></input>
                        </div>
                    
                    </form>
                    
                      <!-- Modal Structure -->
                      <div id="delAccModal" class="modal">
                        <div class="modal-content red white-text center" style="border: 2px solid white;">
                          <h4>Delete Account</h4>
                          <i class="material-icons large white-text">warning</i>
                          <p>Are you sure you would like to delete your account? All of your information including purchases, wishlists, shopping carts etc will be lost. There is no going back!</p>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
                          <a href="php/deleteAccount.php?UserID=<?php echo $_SESSION["UserID"]; ?>" class="modal-action modal-close waves-effect waves-red btn-flat">I am sure, delete my account</a>
                        </div>
                      </div>
                    
                     <div style="margin-top: 50px;">
                        <a class="red-text" href="#delAccModal">Delete Account</a>
                    </div>

                </div>

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