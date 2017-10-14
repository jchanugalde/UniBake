<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>Make Request Page</title>
  <!-- Include the navbar file -->
  <?php include 'navbar.php'; ?>
</head>
<style>

</style>
<body>

	<h2> Please submit your request for when you would like to bake </h2>
	<div>
		<form action="finalMatchTest.php" method="post">
<!-- 		<input type="hidden" name="userID" value="$_COOKIE[userID]"<br>
 -->		
<!--  <input type="hidden" name="userValue" value="$_COOKIE[userID]"<br>
 -->
  <input type="hidden" name="userID" value="$_SESSION[userID]"<br>

		Start Time:<input type="time" name="startTime"<br>
		End Time:<input type="time" name="endTime"<br>
<?php
//To populate category preferences

	try{

		//Open database
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Obtain all possible categories
		$stmt = "SELECT DISTINCT category FROM Category;";
		//do we want to query the same thing or get the results in different ways?
		$result1 = $db->query($stmt);
		$result2 = $db->query($stmt);
		$result3 = $db->query($stmt);

		//Close database
		$db = null;

		//Selection for category preferences
		//Preference 1
		echo "Preference 1: <select name = 'category1'>";
		foreach($result1 as $tuple){
			echo "<option>$tuple[category]</option>";
		}
		echo "</select>";
		//Preference 2
		echo "Preference 2: <select name = 'category2'>";
		foreach($result2 as $tuple){
			echo "<option>$tuple[category]</option>";
		}
		echo "</select>";
		//Preference 3
		echo "Preference 3: <select name = 'category3'>";
		foreach($result3 as $tuple){
			echo "<option>$tuple[category]</option>";
		}
		echo "</select>";

		//header("Location: ../FormHandling/finalMatch.php");
		//Insert their selections into the database



	}catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

	} 
?>
		<input type="submit">
		</form>
	</div>
<a href="LogOut.php">Logout</a>
</body>

