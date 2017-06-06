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
    <script src="JS/validate.js"></script>

</head>
<body>

<?php 
	session_start();
	if (!isset($_SESSION["UserIsAdmin"])) header("Location: ../login.php?status=notAdmin");
	else {
		if (!$_SESSION["UserIsAdmin"]) header("Location: ../login.php?status=notAdmin");
	}//end else
?>

    <!------------------------------- HEADER ----------------------------------->
    <a name="top"></a>
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

            <h5 class="collection-header">Add new item (other)</h5>
            
            <?php
				if (!isset($_GET["status"])) 
					echo '<p>Enter item details below to add a new item.</p>';
				else {
					if ($_GET["status"] == "added") {
						echo '<p class="green white-text center">Item added.</p>';	
					}//end added
					if ($_GET["status"] == "deleted") {
						echo '<p class="green white-text center">Item deleted.</p>';	
					}//end deleted
					if ($_GET["status"] == "edited") {
						echo '<p class="green white-text center">Item edited.</p>';	
					}//end edited
					if ($_GET["status"] == "error") {
						echo '<p class="red white-text center">Operation failed.</p>';	
					}//end edited
					else echo '<p>Enter item details below to add a new item.</p>';
				}//end !isset
			?>

            <form id="addProductForm" action="php/addItem.php" method="post" onSubmit="return manageItemsV();">

                <div class="input-field col s6" style="margin: auto; margin-top: 20px;">
                    <input type="text" ID="itemName" name="itemName" class="validate"></input>
                    <label for="itemName">Item Name</label>
                </div>     

                <div class="input-field col s6" style="margin: auto; margin-top: 20px;">
                    <select id="itemCategory" name="itemCategory">
                        <?php
						
							include_once("../PHP/db_utils.php");
							dbLogin($host, $user, $pass, $db);
							
							$sqlGetCat = "SELECT ItemCategoryName FROM itemcategories";
							$sqlGetCatR = mysql_query($sqlGetCat) or die(mysql_error());
							
							while ($row = mysql_fetch_array($sqlGetCatR, MYSQL_ASSOC)) {
							
								echo '<option value="' . $row["ItemCategoryName"] . '">';
								echo $row["ItemCategoryName"];
								echo '</option>';	
								
							}//end while
							
							if (mysql_num_rows($sqlGetCatR) == 0)
								echo '<option value="" disabled>No categories found</option>';
						
						?>
                    </select>
                    <label>Select Category</label>
                </div>

                <div class="input-field col s6" style="margin: auto; margin-top: 20px;">
                    <select id="itemSupplier" name="itemSupplier">  
                        
						<?php
							
							$sqlGetSup = "SELECT SupplierName FROM suppliers";
							$sqlGetSupR = mysql_query($sqlGetSup) or die(mysql_error());
							
							while ($row = mysql_fetch_array($sqlGetSupR, MYSQL_ASSOC)) {
							
								echo '<option value="' . $row["SupplierName"] . '">';
								echo $row["SupplierName"];
								echo '</option>';	
								
							}//end while
							
							if (mysql_num_rows($sqlGetSupR) == 0)
								echo '<option value="" disabled>No suppliers found</option>';
						
						?>
                    </select>
                    <label>Select Supplier</label>
                </div>

                <div class="input-field col s6" style="margin: auto; margin-top: 20px;">
                    <input type="text" ID="itemPrice" name="itemPrice" class="validate"></input>
                    <label for="itemPrice">Item Price</label>
                </div>

                <div class="input-field col s6" style="margin: auto; margin-top: 20px;">
                    <input type="text" ID="itemQuantityToAdd" name="itemQuantityToAdd" class="validate"></input>
                    <label for="itemQuantityToAdd">Quantity to add</label>
                </div>

                <div class="input-field col s6 center-align center-block">
                    <input type="submit" ID="addItem" name="addItem" class="btn waves-effect waves-light" value="Add Item" />
                </div>

            </form>

            <div style="margin-top: 20px;"></div>

            <div class="divider"></div>

            <h5 class="collection-header">All Items</h5>

            <?php
			
				$sqlItems = "SELECT * FROM items";
				$sqlItemsR = mysql_query($sqlItems) or die(mysql_error());
				
				
				if (mysql_num_rows($sqlItemsR) == 0)
					echo '<p>No items exist.</p>';
				else {
					
					echo '<table><thead><tr>';
					echo '<th>Item Name</th>';
					echo '<th>Item Category</th>';
					echo '<th>Item Supplier</th>';
					echo '<th>Item Price</th>';
					echo '<th>Item Stock</th>';
					echo '</tr></thead>';
					
					while ($row = mysql_fetch_array($sqlItemsR, MYSQL_ASSOC)) {
						
						echo '<tr>';
						
						echo '<td>' . $row["ItemName"] . '</td>';
						echo '<td>' . $row["ItemCategory"] . '</td>';
						echo '<td>' . $row["ItemSupplier"] . '</td>';
						echo '<td>' . number_format((float)$row["ItemPrice"], 2, '.', '') . '</td>';
						echo '<td>' . $row["ItemStock"] . '</td>';
						echo '<td><a href="editItem.php?itemID=' . $row["ItemID"] . '"><i class="material-icons">edit</i></a></td>';					
						
						
						echo '</tr>';
						
					}//end while
					
					echo '</table>';
					
				}//end if
			?>

        </div>
        
		<div class="fixed-action-btn"><a href="#top" class="btn-floating right btn-medium waves-effect waves-light red"><i class="material-icons"><i class="material-icons">open_in_browser</i></i></a></div>
        
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