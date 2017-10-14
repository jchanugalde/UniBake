<?php
   session_start();

   //remove all session variables
   session_unset();
   //Destroy the session
   session_destroy();

//Send them back to log in or home page
    header("Location: shinyLogIn.php");
    exit;
?>
