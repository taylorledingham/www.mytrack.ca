<?php
//start the session
session_start();

//remove session variables
$_SESSION["logged_in"]=0;
session_destroy();

//redirect back to login page
header("Location: http://www2.cs.uregina.ca/~stonge3n/Login.php");
exit();
?>