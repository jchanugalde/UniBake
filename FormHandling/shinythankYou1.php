<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Thank You</title>
  <!-- Include the navbar file -->
  <?php include 'navbar.php'; ?>
</head>
<style>
  body {
    background-color: #cc0000;
  }
  img {
    height: 150px;
    width: 150px;
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
  /** {
   border: 1px dashed #0000FF;
  }*/

</style>

<?php
//This code will pair the user, then delete their previous bake request and Request Category information

//1. Get each user's information
//User1 is the user making the request, User2 is the paired person
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "This is you ".$_SESSION['userID']."<br/>";

		echo "This is the other user ".$_SESSION['pairUser']."<br/>";

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


?>
<body>

	<h1 align="center">Thank you for baking with us</h1><br/>
	<?php
		echo "<a href ='../Recipes/$_GET[filePath]' download>Download</a>";
	?>
	<br/><a href = "HomePageTest.php">Return Home</a>

</body>
