<?php
session_start();
if(!isset($_SESSION['userID'])){
echo"Please Log In to use this feature";
header("Location: TestLogIn.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

<br>
  <title>Make Request Page</title>
  <!-- Include the navbar file -->

</head>
<style>
  body {
    background-color: #cc0000;
  }
  h1 {
    color: black;
  }
  p {
    color: black;
  }
  img {
    height: 150px;
    width: 150px;
  }
  input {
  	font-family: 'Helvetica';
  }
  .options-box {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 10px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin-top: 50px;
    /*margin-left: 50px;*/
  }
  .container {
    height: 100%;
    position: relative;
  }
  .matchContainer {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 30px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin: auto;
    /*margin-left: 50px;*/
  }
  .row{
    background-color: #FAEBD7;
    width: 95%;
    position: center;
    padding: 10px 10px 10px 10px;
    /*padding-left: 200px;*/
    margin: auto;
  }
  .col-md-6 {
    border: 1px solid #2e2e1f;
    border-radius: 2px;
  }
  img {
    height: 450px;
    width: 450px;
    margin-left: 450px;
  }

</style>
<body>
  <div class="container">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html">Cook4Two</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.html">Home</a></li>
          <li  class="active"><a href="matches.html">My Matches</a></li>
          <li><a href="recipes.html">Recipes</a></li>
          <li><a href="bio.html">My Bio</a></li>
          <li><a href="LogOut.php" style="margin-left:800px">Logout</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <br>
	<h2 align="center"> When (and what), would you like to bake? </h2>
	<div>
		<form action="mfA.php" method="post">
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
    echo "<input type=\"submit\" padding-left=\"20px\">";

		//header("Location: ../FormHandling/finalMatch.php");
		//Insert their selections into the database



	}catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

	}
?>
		</form>
    <img src ="../AvatarImgs/skeltal.jpg">
	</div>
<!-- <a href="LogOut.php">Logout</a> -->
</body>
