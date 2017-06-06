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

            <h5 class="collection-header">Add new Administrator user</h5>
            
            <?php
			session_start();
				if (!isset($_GET["status"])) 
					echo '<p>Enter details below to add a new administrator.</p>';
				else {
					if ($_GET["status"] == "added") {
						echo '<p class="green white-text center">Administrator added.</p>';	
					}//end added
					if ($_GET["status"] == "deleted") {
						echo '<p class="green white-text center">Administrator deleted.</p>';	
					}//end deleted
					if ($_GET["status"] == "error") {
						echo '<p class="red white-text center">Operation failed.</p>';	
					}//end edited
					else echo '<p>Enter details below to add a new administrator.</p>';
				}//end !isset
			?>

			<script src="../JS/registration.js"></script>

            <form id="addAdminForm" method="post" onsubmit="validatePasswordFields();" action="php/addAdministrator.php">
           

               <!--Username field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="text" ID="txt_reg_username" name="txt_reg_username" Class="validate" onKeyPress="return avoidSpaces(event)" title="Username should be between 5 to 20 characters and can only contain letters, numbers, - and _" pattern="[a-zA-Z0-9_-]{5,20}" maxlength="20" required></input>
                            <label for="txt_reg_username">New Username</label>
                        </div>

                        <!--First Name field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="text" ID="txt_reg_firstname" name="txt_reg_firstname" Class="validate" title="Name should be between 2 and 30 characters long and may only contain letters and -" maxlength="30" required></input>
                            <label for="txt_reg_firstname">Your Name</label>
                        </div>

                        <!--Email field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="email" ID="txt_reg_email" name="txt_reg_email" Class="validate" onKeyPress="return avoidSpaces(event)" title="Email should be in the format example@domain.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-z]{2,24}$" maxlength="50" required></input>
                            <label for="txt_reg_email">E-Mail</label>
                        </div>

                        <!--Password field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="password" ID="txt_reg_password" name="txt_reg_password" Class="validate"required></input>
                            <label for="txt_reg_password">Password</label>
                        </div>

                        <!--Password Confirmation field-->
                        <div class="input-field col s6" style="margin:auto; margin-top: 20px;">
                            <input type="password" ID="txt_reg_confirmPass" name="txt_reg_confirmPass" Class="validate" required></input>
                            <label for="txt_reg_confirmPass">Confirm Password</label>
                        </div>



                        <div class="input-field col s6 center-align center-block">
                            <input type="Submit" ID="btn_login" Class="btn waves-effect waves-light" Value="Register"></input>
                        </div>	

            </form>

            <div style="margin-top: 20px;"></div>

            <div class="divider"></div>

            <h5 class="collection-header">Administrators</h5>

			<?php
			
				include_once("../PHP/db_utils.php");
				dbLogin($host, $user, $pass, $db);
			
				$sqlItems = "SELECT * FROM users WHERE IsAdmin=1";
				$sqlItemsR = mysql_query($sqlItems) or die(mysql_error());
				
				
				if (mysql_num_rows($sqlItemsR) == 0)
					echo '<p>No administrators exist.</p>';
				else {
					
					echo '<table><thead><tr>';
					echo '<th>Username</th>';
					echo '<th>First Name</th>';
					echo '<th>E-Mail</th>';
					echo '</tr></thead>';
					
					while ($row = mysql_fetch_array($sqlItemsR, MYSQL_ASSOC)) {
						
						echo '<tr>';
						
						echo '<td>' . $row["Username"] . '</td>';
						echo '<td>' . $row["UserFirstName"] . '</td>';
						echo '<td>' . $row["UserEmail"] . '</td>';	
						
						if ($_SESSION["Username"] == "admin") {
							if ($row["Username"] != "admin") {
								echo '<td><a href="php/deleteAdmin.php?UserID=' . $row["UserID"] . '"><i class="material-icons">delete</i></a></td>';
							}
						}

						echo '</tr>';
						
					}//end while
					
					echo '</table>';
					
				}//end if
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

