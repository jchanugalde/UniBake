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

  <title>HomePage Info</title>
</head>
<style>

</style>
<body>
<?php

//find the school that the student belongs to
try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$prepared = $db->prepare("Select count(*) from Pair where (user1 = :inputUserID OR user2 = :inputUserID)");
                $prepared = $db->prepare("Select * from Pair where (user1 = :inputUserID OR user2 = :inputUserID)");

                $prepared->bindParam(':inputUserID', $_SESSION['userID']);
                $prepared->execute();


echo " This is you".$_SESSION['userID']."</br>";
//$result = $prepared->fetch();
$result = $prepared->fetchAll();
//$count = $prepared->rowCount();
//$count = $prepared->fetchColumn();
print_r($result);
//Can only have a single pair
//if($result['count(*)'] == 1){
//if($result->fetchColumn() == 1){
if(count($result) == 1){

foreach($result as $tuple){
  //Find the other relevant information that you would want to print out like the time that you are baking 
//Might just need phone number, because we can't get a time anymore
$otherInfo =$db->prepare("Select startTime, endTime from BakeRequest where (userID = :user1)");
$otherInfo->bindParam(':user1', $_SESSION['userID']);
$otherInfo->execute();

$resultOther = $otherInfo->fetch();
//$resultOther = $otherInfo->fetchAll();

//If the first user is the user then print out information relevant to that if not

//Return user's phone number
$pairPhone = $db->prepare("SELECT phone FROM UserLogin WHERE (userID = :pairID)");
$pairPhone->bindParam(':pairID', $tuple['user2']);
$pairPhone->execute();
$phone = $pairPhone->fetch();
//

if($tuple['user1'] == $_SESSION['userID']){
//Print out their Pair with their information 
//print_r($tuple);
  echo " There was a result";
echo "This is who you are paired with".$tuple['user2']."</br>";
//echo "This is the recipe that you are baking".
echo "This is the time you are baking from ".$resultOther['startTime']." to ".$resultOther['endTime']."</br>";
echo "This is their number: ". $phone['phone'] ."</br>";
}else{
echo "this is the 2nd loop";
echo "This is who you are paired with".$tuple['user1']."</br>";
echo "This is the recipe that you are baking".$tuple['recipe']."</br>";
echo "This is the time you are baking from ".$resultOther['startTime']." to ".$resultOther['endTime']."</br>";

}
}


}else{
    echo "Sorry, you are not paired with anyone yet, you should submit a BakeRequest";
}
$db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>

<a href="LogOut.php">Logout</a>

</html>
