<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<title>Orinoco - Terms & Conditions</title>
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
      <div class="nav-wrapper teal"> <a style="margin-left: 20px" href="#!" class="brand-logo"><i class="material-icons medium">shopping_cart</i> Orinoco</a> <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
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
    <li class="z-depth-3 teal center-align white-text" style="padding-top: 9px;"> <img src="Images/orinoco_Logo.png" width="60px" height="60px" />
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

                    <div class="center card-title">Usage terms and conditions</div>

                        <p>Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern Orinocos relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.</p>
                        <p>The term ‘Orinoco or ‘us’ or ‘we’ refers to the owner of the website whose registered office is University Ave,7080, Pyla, Larnaca, Cyprus. The term ‘you’ refers to the user or viewer of our website.</p>
                        
                        <p><b>The use of this website is subject to the following terms of use:</b></p>
                        <ul>
                         <li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>
                         <li>This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties: [insert list of information]. </li>
                         <li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>
                         <li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>
                         <li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>
                         <li>All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.</li>
                         <li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>
                         <li>From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>
                         <li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li>
                        </ul>
                        
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
    <div class="container center-align"> © All Copyrights Reserved - Orinoco 2017 </div>
  </div>
</footer>
<!-------------------------------------------------------------------------->

<div class="hiddendiv common"></div>
<div class="drag-target" data-sidenav="nav-mobile" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); left: 0px;"></div>
</body>
</html>