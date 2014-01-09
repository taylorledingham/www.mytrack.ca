<?php
session_start();

if($_POST['submitted'])
{
	$error_message = "";
	$firstname = $_POST['firstname'];
	$firstnameformat = preg_match("/^[A-Za-z -]+$/", $firstname);
	$lastname = $_POST['lastname'];
	$lastnameformat = preg_match("/^[A-Za-z ,.'-]+$/", $lastname);
	$email = $_POST['email'];
	$emailformat = preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email);
	$password = $_POST['password'];
	$passwordformat = preg_match("/^.*(?=.*[\W\d])(?=.*[a-zA-Z]).*$/", $password);
	$passwordcheck = $_POST['passwordcheck'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];
	
	
	if($firstname==null || $firstname=="")
		$error_message = "Please fill in your first name";
	else if($firstnameformat != 1)
		$error_message = "Your first name is not in the correct form";
	
	else if($lastname==null || $lastname=="")
		$error_message = "Please fill in your last name";
	else if($lastnameformat != 1)
		$error_message = "Your last name is not in the correct form";
	
	else if($month=="February" && ($day=="29" || $day=="30" || $day=="31"))
		$error_message = "Febuary does not have that many days";
	else if($month=="April" && $day=="31")
		$error_message = "April does not have that many days";
	else if($month=="June" && $day=="31")
		$error_message = "June does not have that many days";
	else if($month=="September" && $day=="31")
		$error_message = "September does not have that many days";
	else if ($month=="November" && $day=="31")
		$error_message = "November does not have that many days";
	else if($year==null || $year =="" || $year<1900 || $year>1999)
		$error_message = "You must be 13 to sign up for this site. The year is not valid";
	
	else if ($email==null || $email=="")
		$error_message = "Please fill in your email";
	else if ($emailformat != 1)
		$error_message = "Your email is not in the correct form";
	
	else if ($password==null || $password=="")
		$error_message = "Please fill in your password";
	else if ($passwordformat != 1)
		$error_message = "Password does not have a non-letter character or has spaces in it";
	else if (strlen($password) <= 8)
		$error_message = "Password is not 8 characters long";
	else if($password != $passwordcheck)
		$error_message = "Passwords are not the same";
	else
	{
		$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
		if(!$db)
			exit("Error with database connection");
		
		$date = $month . " " . $day . ", " . $year;
		$q = "INSERT INTO Users (firstname, lastname, email, date, password, gender) VALUES ('$firstname', '$lastname', '$email', '$date', '$password', '$_POST[gender]')";
		$result = mysqli_query($db, $q);
		
		if(mysqli_num_rows($result) < 0)
			die('Error: ' . mysqli_error());
		else 
			header("Location: http://www2.cs.uregina.ca/~stonge3n/Login.php");
	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up Form</title>
<link rel="stylesheet" type="text/css" href="http://www2.cs.uregina.ca/~stonge3n/koii.css"></link>
<script type="text/javascript" src="Validation.js"></script>
</head>

<body>

<p class="koii">
	Koii
</p>

<form action="http://www2.cs.uregina.ca/~stonge3n/SignUp.php" onsubmit="return validateSignUp()" method="post">
<fieldset>
	<legend class="whitetext">Personal Information</legend>
	<table class="whitetext" border="solid">
		<tr>
			<td>First name</td>
			<td> <input type="text" name="firstname" id="firstname" size="20" /> </td>
			<td id="firstnameerror"></td>
		</tr>
		<tr>
			<td>Last name</td>
			<td> <input type="text" name="lastname" id="lastname" size="20" /> </td>
			<td id="lastnameerror"></td>
		</tr>
		<tr>
			<td>Birth Date</td>
			<td><select name="month" id="month">
					<option>January</option> <option>February</option> <option>March</option>
					<option>April</option>   <option>May</option>      <option>June</option>
					<option>July</option>    <option>August</option>   <option>September</option>
					<option>October</option> <option>November</option> <option>December</option>
				</select>
				<select name="day" id="day">
					<option>1</option>	<option>2</option>	<option>3</option>	<option>4</option>
					<option>5</option>	<option>6</option>	<option>7</option>	<option>8</option>
					<option>9</option>	<option>10</option>	<option>11</option>	<option>12</option>
					<option>13</option>	<option>14</option>	<option>3</option>	<option>16</option>
					<option>17</option>	<option>18</option>	<option>19</option>	<option>20</option>
					<option>21</option>	<option>22</option>	<option>23</option>	<option>24</option>
					<option>25</option>	<option>26</option>	<option>27</option>	<option>28</option>
					<option>29</option>	<option>30</option>	<option>31</option>
				</select>
				<input type="text" name="year" id="year" size="5" />
			</td>
			<td id="birthdateerror"></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><input type="radio" name="gender" id="female" value="female" checked="checked" />Female
				<input type="radio" name="gender" id="male" value="male" />Male</td>
		</tr>
		<tr>
			<td>Email address</td>
			<td> <input type="text" name="email" id="email" size="30" /> </td>
			<td id="emailerror"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td> <input type="password" name="password" id="password" size="21" /> </td>
			<td id="passworderror"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td> <input type="password" name="passwordcheck" id="passwordcheck" size="21" /> </td>
			<td id="passwordcheckerror"></td>
		</tr>
		<tr>
			<td colspan="3"><?= $error_message ?></td>
		</tr>
		<tr>
			<td><input type="submit" name="signup" value="Sign Up" /></td>
			<td><input type="reset" name="clear" value="Reset" /></td>
		</tr>
	</table>
	<p><input type="hidden" name="submitted" id="submitted" value="1" /></p>
	
</fieldset>

</form> 


<p>
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/>
</a>
</p>

</body>
</html>