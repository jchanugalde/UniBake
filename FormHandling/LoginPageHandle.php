<!DOCTYPE html>
<?php

//Try to set the cookies
$cookie_name = "userID";
//Get the cookie based off of the userID
$cookie_value = $_POST["userID"];
//Sets the cookie for a whole month
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
	<head>
<!-- 		<link rel="stylesheet" type="text/css" href="UniBakeStyle.css"/>
 -->	
 </head>
<body>

<?php
 try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $prepared = $db-> prepare("Select * from Login where (userID = inputID AND email = inputEmail AND password =inputPassword)");
                $prepared->bindParam(':inputID', $_POST[userID]);
                $prepared->bindParam(':inputEmail', $_POST[email]);
                $result = $prepared->execute();
                //Query - Select * from BakeRequest where startTime >= $_POST[startTime] AND endTime <= $_POST[endTime]
                foreach($result as $tuple){
                  print_r($tuple);
                }

                $db=null;

              }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
//Page redirect after login
header("Location: home.php");
?> 

</body>
</html>