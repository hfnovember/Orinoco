<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Orinoco - Privacy Policy</title>
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

                    <div class="center card-title">Privacy Policy</div>

                      <p >This privacy policy sets out how Orinoco uses and protects any information that
                      you give Orinoco when you use this website.
                      </p>
                      <p >Orinoco is committed to ensuring that your privacy is protected. Should we ask
                      you to provide certain information by which you can be identified when using this
                      website, then you can be assured that it will only be used in accordance with this privacy
                      statement.</p>
                     <p >Orinoco may change this policy from time to time by updating this page. You
                      should check this page from time to time to ensure that you are happy with any changes.
                      This policy is effective from [date].</p>
                     <p > <b> What we collect</b></p>
                      <p >We may collect the following information:</p>
                      <ul >
                          <li>name and job title</li>
                          <li>contact information including email address</li>
                          <li>demographic information such as postcode, preferences and interests</li>
                          <li>other information relevant to customer surveys and/or offers</li>
                        </ul>
                      <p ><b>What we do with the information we gather</b></p>
                      <p >We require this information to understand your needs and provide you with a better service,
                      and in particular for the following reasons:</p>
                          <li>Internal record keeping. </li>
                          <li>We may use the information to improve our products and services. </li>
                          <li>We may periodically send promotional emails about new products, special offers or
                            other information which we think you may find interesting using the email address which
                            you have provided.</li>
                          <li>From time to time, we may also use your information to contact you for market research
                            purposes. We may contact you by email, phone, fax or mail. We may use the information
                            to customise the website according to your interests.</li>
                      <h5 >Security</h5>
                      <p >We are committed to ensuring that your information is secure. In order to prevent
                      unauthorised access or disclosure we have put in place suitable physical, electronic and
                      managerial procedures to safeguard and secure the information we collect online.
                      How we use cookies</p>
                      
                      <p >A cookie is a small file which asks permission to be placed on your computer’s hard drive.
                      Once you agree, the file is added and the cookie helps analyse web traffic or lets you
                      know when you visit a particular site. Cookies allow web applications to respond to you
                      as an individual. The web application can tailor its operations to your needs, likes and
                      dislikes by gathering and remembering information about your preferences.
                      Orinoco ltd | CY co. reg. no. 3933286| www.orinoco.com | 96353566
                      We use traffic log cookies to identify which pages are being used. This helps us analyse data
                      about webpage traffic and improve our website in order to tailor it to customer needs.
                      We only use this information for statistical analysis purposes and then the data is
                      removed from the system.</p>
                      
                      <p >Overall, cookies help us provide you with a better website, by enabling us to monitor which
                      pages you find useful and which you do not. A cookie in no way gives us access to your
                      computer or any information about you, other than the data you choose to share with
                      us.</p>
                      
                      <p >You can choose to accept or decline cookies. Most web browsers automatically accept
                      cookies, but you can usually modify your browser setting to decline cookies if you prefer.
                      This may prevent you from taking full advantage of the website.
                      Links to other websites</p>
                      
                      <p >Our website may contain links to other websites of interest. However, once you have used
                      these links to leave our site, you should note that we do not have any control over that
                      other website. Therefore, we cannot be responsible for the protection and privacy of any
                      information which you provide whilst visiting such sites and such sites are not governed
                      by this privacy statement. You should exercise caution and look at the privacy statement
                      applicable to the website in question.</p>
                      
                      <p >Controlling your personal information
                      You may choose to restrict the collection or use of your personal information in the
                      following ways:</p>
                          <li>whenever you are asked to fill in a form on the website, look for the box that you can
                            click to indicate that you do not want the information to be used by anybody for direct
                            marketing purposes</li>
                          <li>if you have previously agreed to us using your personal information for direct marketing
                            purposes, you may change your mind at any time by writing to or emailing us at [email
                            address]</li>
                      <p > We will not sell, distribute or lease your personal information to third parties unless we
                      have your permission or are required by law to do so. We may use your personal
                      information to send you promotional information about third parties which we think you
                      may find interesting if you tell us that you wish this to happen.</p>
                      <p > You may request details of personal information which we hold about you under the Data</p>
                      <p > Protection Act 1998. A small fee will be payable. If you would like a copy of the
                      information held on you please write to University Ave,7080, Pyla, Larnaca, Cyprus</p>
                      <p > If you believe that any information we are holding on you is incorrect or incomplete, please
                      write to or email us as soon as possible,at the above address. We will promptly correct
                      any information found to be incorrect.</p>
          
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