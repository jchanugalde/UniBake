<?php
//To populate category preferences

	try{

		//Open database
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



		$prepared1 = $db->prepare("Insert into RequestCategory (userID,category) VALUES (:userID, :category1) ");
		$prepared1->bindParam(':category1', $_POST['category1']);
		$prepared1->bindParam(':userID', $_COOKIE['userID']);

		$prepared2 = $db->prepare("Insert into RequestCategory (userID,category) VALUES (:userID, :category2) ");
		$prepared2->bindParam(':category2', $_POST['category2']);
		$prepared2->bindParam(':userID', $_COOKIE['userID']);

		$prepared3 = $db->prepare("Insert into RequestCategory (userID,category) VALUES (:userID, :category3) ");
		$prepared3->bindParam(':category3', $_POST['category3']);
		$prepared3->bindParam(':userID', $_COOKIE['userID']);


		//header("Location: ../FormHandling/finalMatch.php");
		//Insert their selections into the database
		


	}catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

	} 
	
?>