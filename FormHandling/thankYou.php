<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<br><br><br>  <title>Thank You</title>
  <!-- Include the navbar file -->

</head>
<style>
body {
  background-color: #cc0000;
}
img {
  height: 450px;
  width: 450px;
  margin-left: 450px;
}
</style>
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


<body>
<?php
//This code will pair the user, then delete their previous bake request and Request Category information

//1. Get each user's information
//User1 is the user making the request, User2 is the paired person
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "This is you ".$_SESSION['userID']."<br/>";

		// echo "This is the other user ".$_SESSION['pairUser']."<br/>";

        //If any of the people are paired together, don't let them be paired additionally?
        $check = $db->prepare("Select * from Pair where (user1 = :inputUser1 OR user2 = :inputUser1 OR user2 = :inputUser2 OR user2 = :inputUser2)");
         $check->bindParam(':inputUser1', $_SESSION['userID']);
         $check->bindParam(':inputUser2', $_SESSION['pairUser']);
         $check->execute();
         $count = $check->fetchAll();

        //  print_r($count);
         //If the check was clean(i.e. neither were already paired)
         if(count($count) == 0){

         $pair = $db->prepare("INSERT into Pair (user1, user2, recipe) VALUES (:userD1, :userD2, :recipe)");
         //$recipe1->bindParam(':inputUserID', $_COOKIE['userID']);
         $pair->bindParam(':userD1', $_SESSION['userID']);
         $pair->bindParam(':userD2', $_SESSION['pairUser']);
         $pair->bindParam(':recipe', $_GET['filePath']);
         $pair->execute();

         //2. Delete their BakeRequestw
         $delete1 = $db->prepare("DELETE from BakeRequest where (userID = :userID1)");
         $delete1->bindParam('userID1', $_SESSION['userID']);
         $delete1->execute();

         $delete2 = $db->prepare("DELETE from BakeRequest where (userID = :userID2)");
         $delete2->bindParam('userID2', $_SESSION['pairUser']);
         $delete2->execute();

         //3. Delete their RequestCategory


         $deleteRequest1 = $db->prepare("DELETE from RequestCategory where (userID = :userDR1)");
         $deleteRequest1->bindParam('userDR1', $_SESSION['userID']);
         $deleteRequest1->execute();


         $deleteRequest2 = $db->prepare("DELETE from RequestCategory where (userID = :userDR2)");
         $deleteRequest2->bindParam('userDR2', $_SESSION['pairUser']);
         $deleteRequest2->execute();

         $db = null;
         }else{
            echo "Sorry those people are alrady paired, try again";
              // echo  "<br/><a href = 'HomePageTest.php'>Return Home</a>";

         }



?>


	<h1 align="center">Thank you for baking with us</h1><br/>
  <img align="center" src="../AvatarImgs/dessert.jpg">
	<?php
		echo "<p align=\"center\"><a href ='../Recipes/$_GET[filePath]' download>Download</a></p>";
	?>
	<p align="center"><a href = "welcome.php" >Return Home</a></p>

</body>
