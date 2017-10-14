<?php
session_start();

//If the user is already logged in, then redirect them to the home page
if(isset($_SESSION['userID'])){
         header("location: welcome.php");

}
?>

<?php
   $db = new PDO('sqlite:./../Database/unibake.db');
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $prepared =$db->prepare("SELECT userID FROM Login WHERE (email = :userEmail AND password = :userPassword)");
      $prepared->bindParam(':userEmail', $_POST['email']);
      $prepared->bindParam(':userPassword', $_POST['password']);


      //$result = $prepared->execute();
      $prepared->execute();
      //$result->fetchAll();
      //$row = $result->fetch(PDO::FETCH_ASSOC);
      //$active = $row['active'];
      //$user = $prepared->fetch(PDO::FETCH_ASSOC);
      //$count = $result->rowCount(PDO::);
      //$user = $prepared->fetchAll();
      $user = $prepared->fetch();
      //print_r($user);
      // If result matched $myusername and $mypassword, table row must be 1 row

      if(count($user['userID']) == 1) {
         //session_register("email");
         //$_SESSION['login_user'] = email;
         //Use cookies instead of session
         // setcookie('email', $_POST['email'], time() + (86400 * 30));
         // setcookie('password', $_POST['password'],time() + (86400 * 30));
         // setcookie('userID', $_POST['userID'], time() + (86400 * 30));
         //$userInfo = $user['userID'];
         //$_SESSION['userID'] = $userInfo;
         $_SESSION['userID'] = $user['userID'];
         //$_SESSION['userID'] = $_POST['userID'];
         //It was successful so go to next page
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

   <head>
      <title>Login Page</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }

         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }

         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>Email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>User ID  :</label><input type = "integer" name = "userID" class = "box"/><br /><br />

                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>

<!--                <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
 -->
                <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>

            </div>

         </div>

      </div>
      <h1>  <a href="addUser.php">Sign UP if you don't have an account </a></h1>

   </body>
</html>
