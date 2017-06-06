<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Orinoco - Contact US</title>
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
	}//end if is set (status)
	
?>

    <!------------------------------- HEADER ----------------------------------->
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper teal">
                    <a style="margin-left: 20px" href="#!" class="brand-logo"><i class="material-icons medium">shopping_cart</i> Orinoco</a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
						<?php if (!isset($_SESSION["UserID"])) echo '
                        <li><a href="login.php"><i class="material-icons left">lock_outline</i>Log In</a></li>
                        <li><a href="register.php"><i class="material-icons left">perm_identity</i>Register</a></li>';
                        ?>
                        <?php if (isset($_SESSION["UserID"])) echo '
                        <li><a href="shoppingcart.php"><i class="material-icons left">shopping_cart</i>Shopping Cart</a></li>
                        <li><a href="wishlist.php"><i class="material-icons left">star</i>Wishlist</a></li>
                        <li><a href="allproducts.php"><i class="material-icons left">list</i>Products</a></li>
                        <li><a href="purchases.php"><i class="material-icons left">shop_two</i>Purchases</a></li>
						<li><a href="php/performLogout.php"><i class="material-icons left">power_settings_new</i>Log Out</a></li>
						'; ?>
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
            <?php if (!isset($_SESSION["UserID"])) echo '
            <li><a href="login.php"><i class="material-icons left">lock_outline</i>Log In</a></li>
            <li><a href="register.php"><i class="material-icons left">perm_identity</i>Register</a></li>';
			?>
			<?php if (isset($_SESSION["UserID"])) echo '
            <li><a href="shoppingcart.php"><i class="material-icons left">shopping_cart</i>Shopping Cart</a></li>
            <li><a href="wishlist.php"><i class="material-icons left">star</i>Wishlist</a></li>
            <li><a href="allproducts.php"><i class="material-icons left">list</i>Products</a></li>
            <li><a href="purchases.php"><i class="material-icons left">shop_two</i>Purchases</a></li>
            <li><a href="php/performLogout.php"><i class="material-icons left">power_settings_new</i>Log Out</a></li>
            '; ?>
        </ul>
</header>
    <!-------------------------------------------------------------------------->

    <!-------------------------------- MAIN ------------------------------------>
    <main>
    
        <div class="container" style="margin-top: 30px;">
    
                <div class="card grey lighten-4">
    
                    <div class="card-content">
    
                        <div class="center card-title">Contact Us</div>
                        
                        	<p> University Ave  
                                    <span>7080</span> <br>
                                    Pyla, Larnaca, Cyprus.
                            </p>
                            
                            <p>Telephone: <a href="tel:000000000">000000000</a> <br>
                                    <span>FAX: 24-724521</span> <br>
                                    E-mail: <a href="mailto:orinoco@orinoco.com">orinoco@orinoco.com</a> <br>
                            </p>
                            
                            
                            <div id="googleMap" style="width:100%;height:400px;">
                                
                                <script>
									function myMap() {
									var mapProp= {
										center:new google.maps.LatLng(35.0070946,33.6958481),
										zoom:15,
									};
									var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
									}
									</script>
									
									<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJkGYzenacKljiC_bex_zTw68XPyAjesA&callback=myMap"></script>
                                    
                            </div><!--end map-->
                        
                    </div><!--content-->
                    
                </div><!--card-->
        </div> <!--Container-->
   
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