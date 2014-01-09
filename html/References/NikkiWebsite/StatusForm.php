<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www2.cs.uregina.ca/~stonge3n/Login.php");
else
{
	if($_POST['submitted'])
	{
		$status = addslashes($_POST['statustextarea']);
		$status_with_slashes = addslashes($_POST['statustextarea']);
		if ($status==null || $status=="")
			$error_message = "Please fill in your status";
		else if (strlen($status) > 1000 )
			$error_message = "Status must be less that 1000 characters";
		else
		{
			if (($_FILES['image']['type'] == "image/gif") || ($_FILES['image']['type'] == "image/jpeg") && ($_FILES['image']['size'] < 10000000))
			{
				if ($_FILES['image']['error'] > 0)
					$error_message = "Return Code: " . $_FILES['image']['error'];
				else
				{
					if (file_exists("upload/" . $_FILES['image']['name']))
						$error_message = $_FILES['image']['name'] . " already exists.";
					else
					{
						$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
						if(!$db)
							exit("Error with database connection");
						date_default_timezone_get();
						$date = date('m/d/Y H:i:s a', time());
						$imagename = $_FILES['image']['name'];
												
						$q = "INSERT INTO Status (user_id, statusdetail, image, firstname, lastname, time) VALUES ('$_SESSION[user_id]', '$status_with_slashes', '$imagename', '$_SESSION[firstname]', '$_SESSION[lastname]', '$date')";
						$result = mysqli_query($db, $q);
						mysqli_close($db);
						
						if(mysqli_num_rows($result) < 0)
							die('Error: ' . mysqli_error());
						else
						{
							move_uploaded_file($_FILES['image']['tmp_name'], "upload/" . $_FILES['image']['name']);
							header("Location: http://www2.cs.uregina.ca/~stonge3n/Home.php");
							exit();
						}
					}
				}
			}
			else if($_FILES['image']['size'] > 0)
				$error_message = "Invalid File";
			else 
			{
				$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
				if(!$db)
					exit("Error with database connection");
				date_default_timezone_get();
				$date = date('m/d/Y H:i:s a', time());
				
				$q = "INSERT INTO Status (user_id, statusdetail, image, firstname, lastname, time) VALUES ('$_SESSION[user_id]', '$status_with_slashes', null, '$_SESSION[firstname]', '$_SESSION[lastname]', '$date')";
				$result = mysqli_query($db, $q);
				mysqli_close($db);
				
				if(mysqli_num_rows($result) < 0)
					die('Error: ' . mysqli_error());
				else
				{
					header("Location: http://www2.cs.uregina.ca/~stonge3n/Home.php");
					exit();
				}
			}
					
		}
	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Status Form</title>
<link rel="stylesheet" type="text/css" href="http://www2.cs.uregina.ca/~stonge3n/koii.css"></link>
<script type="text/javascript" src="Validation.js"></script>
</head>

<body>
<p class="koii">
	Koii
</p>

<div id="left_column">
	<p>
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/Home.php">Home</a><br />
		<?= $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?><br />
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/StatusForm.php">Make a Status</a><br />
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/Logout.php">Sign Out</a><br />
	</p>
</div>

<div id="center_column">
	<table>
		<tr>
			<td class="whitetext">Status:</td>
		</tr>
		<tr>
			<td>
				<form action="http://www2.cs.uregina.ca/~stonge3n/StatusForm.php" onsubmit="return validateStatusForm()" method="post" enctype="multipart/form-data">
					<p>	<textarea rows="8" cols="50" id="statustextarea" name="statustextarea"></textarea><br /></p>
					<p id="statuserror" class="whitetext"></p>
					<p><?= $error_message ?></p>
					<p>
						<input type="submit" name="Post" value="Post Status"/>
						<input type="reset" name="reset" value="Reset" />
						<input type="file" name="image" value="Upload Image"/>
					</p>
					<p><input type="hidden" name="submitted" id="submitted" value="1" /></p>
				</form>
			</td>
		</tr>
		<tr>
			<td><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a>
		    </td>
		</tr>
	</table>
</div>

</body>
</html>