<?php
	
	//This is gonna clean up the pair stuff
	session_start();

	//Remove pair TODO add at make new request
	$cleanPair = $db->prepare("DELETE FROM Pair WHERE (user1 = user OR user2 = user);");
	$cleanPair->bindParam(':user', $_SESSION[userID]);
	$cleanPair->execute();

	//Does anything else need to be cleaned up?

	header("Location: welcome.php");
?>