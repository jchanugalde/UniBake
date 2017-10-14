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
<h1> Which recipe would you like to bake with your partner?</h1>
<?php
//find the school that the student belongs to 
try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Should probably check to see how many distinct categories they have before we do this
                //Get the two people we need to pair 
                $recipe1 = $db->prepare("Select distinct filePath from Category NATURAL JOIN RequestCategory where (userID = :inputUserID);"); 
                //$recipe1->bindParam(':inputUserID', $_COOKIE['userID']);
                $recipe1->bindParam(':inputUserID', $_SESSION['userID']);

                $recipe1->execute();

                // $recipe2 = $db->prepare("Select distinct filePath from Category NATURAL JOIN RequestCategory where (userID = :inputUserID);"); 
                // $recipe2->bindParam(':inputUserID', $_COOKIE['userID']);
                // $recipe2->execute();

                // $recipe3 = $db->prepare("Select distinct filePath from Category NATURAL JOIN RequestCategory where (userID = :inputUserID);"); 
                // $recipe3->bindParam(':inputUserID', $_COOKIE['userID']);
                // $recipe3->execute();
                    //$result = $db->query($stmt);
                $result1 = $recipe1->fetchAll();
                // $result2 = $recipe2->fetchAll();
                // $result3 = $recipe3->fetchAll();

                foreach($result1 as $tuple){
                    echo "This is an option".$tuple['filePath']."<br/>";
                }
                // foreach($result2 as $tuple2){
                //     echo $tuple2['filePath'];
                // }
                //         foreach($result3 as $tuple3){
                //     echo $tuple3['filePath'];
                // }

                //Delete their bake requests

                $db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>

</html>