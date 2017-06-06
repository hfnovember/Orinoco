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

            <h5 class="collection-header">Add new supplier</h5>
            
            <?php
				if (!isset($_GET["status"])) 
					echo '<p>Enter details below to add a new supplier.</p>';
				else {
					if ($_GET["status"] == "added") {
						echo '<p class="green white-text center">Supplier added.</p>';	
					}//end added
					if ($_GET["status"] == "deleted") {
						echo '<p class="green white-text center">Supplier deleted.</p>';	
					}//end deleted
					if ($_GET["status"] == "error") {
						echo '<p class="red white-text center">Operation failed.</p>';	
					}//end edited
					else echo '<p>Enter details below to add a new supplier.</p>';
				}//end !isset
			?>

            <form id="addSupplierForm" method="post" action="php/addSupplier.php">

                <div class="input-field col s6" style="margin: auto; margin-top: 20px;">
                    <input type="text" ID="supplierName" name="supplierName" class="validate" required></input>
                    <label for="supplierName">Supplier name</label>
                </div>

                <div class="input-field col s6 center-align center-block">
                    <input type="submit" ID="addSupplier" name="addSupplier" class="btn waves-effect waves-light" value="Add Supplier" />
                </div>

            </form>

            <div style="margin-top: 20px;"></div>

            <div class="divider"></div>

            <h5 class="collection-header">Suppliers</h5>

			<?php
			
				include_once("../PHP/db_utils.php");
				dbLogin($host, $user, $pass, $db);
			
				$sqlItems = "SELECT * FROM suppliers";
				$sqlItemsR = mysql_query($sqlItems) or die(mysql_error());
				
				
				if (mysql_num_rows($sqlItemsR) == 0)
					echo '<p>No suppliers exist.</p>';
				else {
					
					echo '<table><thead><tr>';
					echo '<th>Supplier Name</th>';
					echo '</tr></thead>';
					
					while ($row = mysql_fetch_array($sqlItemsR, MYSQL_ASSOC)) {
						
						echo '<tr>';
						
						echo '<td>' . $row["SupplierName"] . '</td>';
						echo '<td><a href="php/deleteSupplier.php?supplierID=' . $row["SupplierID"] . '"><i class="material-icons">delete</i></a></td>';					
						
						
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

