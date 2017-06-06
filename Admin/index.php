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

<?php 
	session_start();
	if (!isset($_SESSION["UserIsAdmin"])) header("Location: ../login.php?status=notAdmin");
	else {
		if (!$_SESSION["UserIsAdmin"]) header("Location: ../login.php?status=notAdmin");
	}//end else
?>

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


            <div class="row">
                <div class="collection with-header s6 m12">
                    <div class="collection-header">
                        <h4>Admin Panel</h4>
                    </div>
                    <a href="allusers.php" class="collection-item">Manage Users</a>
                    <a href="manageItems.php" class="collection-item">Manage Items</a>
                    <a href="manageBooks.php" class="collection-item">Manage Books</a>
                    <a href="itemCategories.php" class="collection-item">Manage Item Categories</a>
                    <a href="bookGenres.php" class="collection-item">Manage Book Genres</a>
                    <a href="suppliers.php" class="collection-item">Manage Suppliers</a>
                    <a href="authors.php" class="collection-item">Manage Authors</a>
                    <a href="allPurchases.php" class="collection-item">View all Purchases</a>
                    <a href="salesByDay.php" class="collection-item">Sales by day</a>
                    <a href="createadmin.php" class="collection-item">Mange administrator users</a> 
                    <a href="php/toXMLStock.php" class="collection-item">Export stock to XML</a>
                </div>
            </div>

            <a href="../allproducts.aspx" class="collection-item">Back to store</a>
            <a href="../php/performLogout.php" class="collection-item right">Log Out</a>

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