<?php
session_start();
//do we know this user?
// if (isset($_COOKIE['email'])){
//  $email = $_COOKIE['email']; //get the value of the cookie from browser
//  $password = $_COOKIE['password'];
//  //logUserIn($email, $password);
// } else {
//  //don't know this person (or cookie expired)
// 	echo $_COOKIE['email'];

// 	echo "Don't know you!";
// }
?>
<!DOCTYPE html>
<head>
      <title>Welcome</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
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

</style>

   <body>

    <div class="container">

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.html">UniBake</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="index.html">Home</a></li>
            <li  class="active"><a href="matches.html">My Matches</a></li>
            <li><a href="recipes.html">Recipies</a></li>
            <li><a href="bio.html">My Bio</a></li>
            <li><a href="LogOut.php" style="margin-left:800px">Logout</a></li>
          </ul>
        </div>
      </nav>
    </div>

<br><br><br>
      <h1 align="center">Welcome Baker</h1> <!--<?php //echo $_COOKIE['userID'] ?></h1>; -->

       <!--<p><a href="makeRequest.php">Go to make request page</a></p>-->
       <p align="center" style = "font-size:400%;"><a href="mfAMake.php">Get Baking!</a></p>

      <h2 align="center"><a href = "LogOut.php">Sign Out</a></h2>
   </body>


</html>
