<?php

if ($_POST['submited']==1){
  $u=trim($_POST["email"]);
  $p=trim($_POST["password1"]);
  if(strlen($u)>0 && strlen($p)>0){
    $db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
    if(!$db){
      exit("Error in database connection");
    }
    else{
    
    $encrypted_password = md5($p);
    
    $q = "SELECT `UserID`, `NameFirst` FROM `User` WHERE `Email`='$u' AND `Password`='$encrypted_password'";
	
	$result = mysqli_query($db,$q);
	
	if(mysqli_num_rows($result)>0){
	
	session_start();
	
	$_SESSION["logged_in"]=1;
	$row=mysqli_fetch_assoc($result);
	
	$_SESSION["user_id"]=$row["UserId"];
	$_SESSION["first_name"]=$row["NameFirst"];
	$_SESSION["manager_id"]=$row["ManagerID"];
	$_SESSION["type"]=$row["Type"];
	
	header("Location: http://www.mytrack.ca/Home.php");
	exit();
	}
	else {
	header("Location: http://www.mytrack.ca/Index/Login.php");
	?>
	<html lang="en">
	<head>
	</head>
	<body>
	<p id = "error_message"> Error with email or password </p>
	</body>
	</html>
	<?php
	//$error_message="Error with email or password";
	}
    }
  }
  else {
  header("Location: http://www.mytrack.ca/Index/Login.php");
  ?>
	<html lang="en">
	<head>
	</head>
	<body>
	<p id = "error_message"> Form Must Be Filled In </p>
	</body>
	</html>
	<?php
    //$error_message="Form Must Be Filled In";
  }
}


?>