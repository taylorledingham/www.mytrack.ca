<?php

if($_POST['submitted'])
{
	//get email and password
	$u = trim($_POST['email']);
	$p = trim($_POST['password']);
	
	if(strlen($u) > 0 && strlen($p) > 0)
	{
		$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
		if(!$db)
			exit("Error in data base connection");
		else 
		{
			$q = "SELECT user_id, firstname, lastname FROM Users WHERE email = '$u' AND password = '$p'";
			$result = mysqli_query($db, $q);
			if(mysqli_num_rows($result) <= 0)
				$error_message = "Incorrect email or password";
			else 
			{
				//successful login
				session_start();
				$_SESSION['logged_in'] = 1;
				$row=mysqli_fetch_assoc($result);
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['lastname'] = $row['lastname'];
				header("Location: http://www2.cs.uregina.ca/~stonge3n/Home.php");
				exit();
			}
		}
	}
	else
		$error_message = "You must enter your Email and Password";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="http://www2.cs.uregina.ca/~stonge3n/koii.css"></link>
<script type="text/javascript" src="Validation.js"></script>
</head>

<body>

<p class="koii">
	Koii
</p>

<form action="http://www2.cs.uregina.ca/~stonge3n/Login.php" onsubmit="return validateLogin()" method="post">
	<table class="whitetext">
		<tr>
			<td>Email Address</td>
			<td> <input type="text" name="email" id="email" size="30" /> </td>
			<td id="emailerror"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td> <input type="password" name="password" id="password" size="30" /> </td>
			<td id="passworderror"></td>
		</tr>
		<tr>
			<td colspan="3"><?= $error_message ?></td>
		</tr>
		<tr>
			<td> <input type="submit" name="Login" value="Login" /> </td>
		</tr>
	</table>
	<p><input type="hidden" name="submitted" id="submitted" value="1" /></p>
</form>

<p class="whitetext">Not a Member? <a class="bluetext" href="http://www2.cs.uregina.ca/~stonge3n/SignUp.php">Sign Up Now</a>
</p>

<p>
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/>
</a>
</p>

</body>
</html>
