<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <title>Log In Page</title>
  <style>

  </style>
</head>
<body>
<div class ="navbar">
<?php include 'navbar.php';?>
</div>

<h2>Enter username and password</h2>
   <div class ="container form-signin">
   <?php
    $db = new PDO('sqlite:./../Database/unibake.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $prepared = $db-> prepare("Select * from Login where (email = :inputEmail AND password = :inputPassword)");
                //$prepared->bindParam(':inputID', $_POST[userID]);
                $prepared->bindParam(':inputPassword', $_POST[password]);

                $prepared->bindParam(':inputEmail', $_POST[email]);
                $result = $prepared->execute();
   ?>
        <h4><font color='red'>* required field.</font><br/></h4>

          <form action="LoginPageHandle.php" method="post">
			<table border="1">
        <tr>
        <td>E mail:<font color="red">*</font></td>
        <td><input type ="text" name="email" required=""/> <br/></td>
</tr>
<!-- 			<tr>
        <td>UserID:<font color="red">*</font></td>
        <td><input type ="integer" name="userID" required=""/> <br/></td>
</tr> -->
		<tr>
        <td>Password:<font color="red">*</font></td>
        <td><input type ="text" name="password" required=""/> <br/></td>
</tr>
<tr>
<tr>
</table>
                <div align="center"><input type="submit" name="submit" value="Log in"></div>
        </form>


</body>
</html>