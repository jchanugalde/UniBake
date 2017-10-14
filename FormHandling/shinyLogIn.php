<?php
session_start();
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
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>UniBake Login</title>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="LogInstyle.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Unibake</span></h1>
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
      <form action = "" method = "post">
			<label for="email">Email</label>
			<br/>
			<input type="text" name="email">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" name="password">
			<br/>
			<button type="submit" value = " Submit ">Sign In</button>
			<br/>
      <a href="shinySignUp.php"><p class="small"> Create an account </p></a>
      <br/>

		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>
