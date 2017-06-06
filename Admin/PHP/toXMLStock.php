<?php

	session_start();
	include_once("../../php/db_utils.php");
	dbLogin($host, $user, $pass, $db);

	if ($_SESSION["UserIsAdmin"] == 1) {
	
		$export = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n"; 
		$export .= "<StockItems>";
		$export .= "\n\t<books>";
		
		$sqlBooks = "SELECT * FROM books";
		$sqlItems = "SELECT * FROM items";
		
		$sqlBooksR = mysql_query($sqlBooks) or die(mysql_error());
		$sqlItemsR = mysql_query($sqlItems) or die(mysql_error());
		
		while ($bookRow = mysql_fetch_array($sqlBooksR, MYSQL_ASSOC)) {
			$export .= "\n\t\t<book>";
			$export .= "\n\t\t\t<title>" . preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', trim($bookRow["BookTitle"])) . "</title>";
			$export .= "\n\t\t\t<genre>" . preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', trim($bookRow["BookGenre"])) . "</genre>";
			$export .= "\n\t\t\t<author>" . preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', trim($bookRow["BookAuthor"])) . "</author>";
			$export .= "\n\t\t\t<price>" . trim($bookRow["BookPrice"]) . "</price>";
			$export .= "\n\t\t\t<stock>". trim($bookRow["BookStock"]) . "</stock>";
			$export .= "\n\t\t</book>";
		}
		
		$export .= "\n\t</books>\n";
		
		//------ITEMS
		
		$export .= "\n\t<items>";
		
		while ($itemRow = mysql_fetch_array($sqlItemsR, MYSQL_ASSOC)) {
			$export .= "\n\t\t<item>";
			$export .= "\n\t\t\t<name>" . preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', trim($itemRow["ItemName"])) . "</name>";
			$export .= "\n\t\t\t<category>" . preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', trim($itemRow["ItemCategory"])) . "</category>";
			$export .= "\n\t\t\t<supplier>" . preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', trim($itemRow["ItemSupplier"])) . "</supplier>";
			$export .= "\n\t\t\t<price>" . trim($itemRow["ItemPrice"]) . "</price>";
			$export .= "\n\t\t\t<stock>". trim($itemRow["ItemStock"]) . "</stock>";
			$export .= "\n\t\t</item>";
		}//end while
		
		$export .= "\n\t</items>\n";
		
		$export .= "</StockItems>\n";
		
		
		file_put_contents("export.xml", $export);
		header("Location: export.xml");
		
		
	}
	else header("Location: ../../login.php?status=noLogin");

?>