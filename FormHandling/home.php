<!DOCTYPE html>
<html lang="en">
<?php
if(!isset($_COOKIE['userID'])){
	//If the cookie is not set, send them to log In
	header("Location: ../TestLogIn.php");
}
?>
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>Home Page</title>
  <!-- Include the navbar file -->
  <?php include 'navbar.php'; ?>
</head>
<style>

</style>
<body>

<?php
//To populate category preferences

	try{


	}catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

	} 
?>
		

</body>

