<?php 

	session_start();
	
	if (!isset($_SESSION["UserID"])) header("Location: ../login.php?status=noLogin");
	else {
	
		include("db_utils.php");
		dbLogin($host, $user, $pass, $db);
		
		$newFirstName = $_POST["chg_firstname"];
		$newEmail = $_POST["chg_email"];
		$newPassword = md5($_POST["chg_password"]);
		
		$sqlUpdate = "UPDATE users SET UserFirstName='" . $newFirstName . "', UserEmail='" . $newEmail . "', UserPassword='" . $newPassword . "' WHERE UserID=" . $_SESSION["UserID"];
		
		$sqlUpdateResult = mysql_query($sqlUpdate) or die(mysql_error());
		
		if ($sqlUpdateResult) {
			$_SESSION["UserFirstName"] = $newFirstName;
			$_SESSION["UserEmail"] = $newEmail;
			header("Location: ../account.php?status=success");
		}
		else header("Location: ../account.php?status=failure");
	
	}//end if logged in

?>