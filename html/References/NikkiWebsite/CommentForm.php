<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www2.cs.uregina.ca/~stonge3n/Login.php");
else
{
	$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
	if(!$db)
		exit("Error with database connection");
	$_SESSION['status_id'] = $_POST['status_id'];
	
	$query = "SELECT COUNT(status_id) FROM Comment WHERE status_id='$_SESSION[status_id]'";
	$results = mysqli_query($db, $query);
	
	while($row = mysqli_fetch_assoc($results))
		$commentnum = $row['COUNT(status_id)'];
		
	if($commentnum < 0)
		die('Error: ' . mysqli_error());
	mysqli_close($db);
	
	
	if($_POST['submitted'])
	{
		$comment = $_POST['commenttextarea'];
		$comment_with_slashes = addslashes($_POST['commenttextarea']);
		if ($comment==null || $comment=="")
			$error_message = "Please fill in your comment";
		else if (strlen($comment) > 1000 )
			$error_message = "Comment must be less that 1000 characters";
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
						$commentnum = $commentnum + 1;
						
						$updateofcomments = "UPDATE Status SET commentnum='$commentnum' WHERE status_id='$_SESSION[status_id]'";
						$resultsofupdate = mysqli_query($db, $updateofcomments);
						
						$q = "INSERT INTO Comment (status_id, user_id, commentdetail, image, firstname, lastname, time) VALUES ('$_SESSION[status_id]', '$_SESSION[user_id]', '$comment_with_slashes', '$imagename', '$_SESSION[firstname]', '$_SESSION[lastname]', '$date')";
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
				$commentnum = $commentnum + 1;
				
				$updateofcomments = "UPDATE Status SET commentnum='$commentnum' WHERE status_id='$_SESSION[status_id]'";
				$resultsofupdate = mysqli_query($db, $updateofcomments);
				
				$q = "INSERT INTO Comment (status_id, user_id, commentdetail, image, firstname, lastname, time) VALUES ('$_SESSION[status_id]', '$_SESSION[user_id]', '$comment_with_slashes', null, '$_SESSION[firstname]', '$_SESSION[lastname]', '$date')";
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
	
	$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
	if(!$db)
		exit("Error with database connection");
	$_SESSION['status_id'] = $_POST['status_id'];
	
	$q1 = "SELECT * FROM Comment WHERE status_id = '$_SESSION[status_id]' ORDER BY TIME DESC";
	$commentresults = mysqli_query($db, $q1);
	$q2 = "SELECT * FROM Status WHERE status_id = '$_SESSION[status_id]'";
	$statusresult = mysqli_query($db, $q2);
	
	if(mysqli_num_rows($commentresults) < 0)
		die('Error: ' . mysqli_error());
	else
	{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comment Form</title>
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
		<?php
			while($row2 = mysqli_fetch_assoc($statusresult))
			{
				$temp_status_id2 = $row2['status_id'];
				$temp_user_id2 = $row2['user_id'];
				$temp_statusdetail2 = $row2['statusdetail'];
				$temp_image2 = "upload/" . $row2['image'];
				$temp_firstname2 = $row2['firstname'];
				$temp_lastname2 = $row2['lastname'];
				$temp_time2 = $row2['time'];
		?>
		<tr>
			<td class="whitetext"><?= $temp_firstname2 . " " . $temp_lastname2 . " - " . $temp_statusdetail2 ?></td>
		</tr>
		<?php 	if($row2['image'] != null)
				{
		?>
		<tr>
			<td><img src="<?= $temp_image2 ?>" alt="image" height="500"></img></td>
		</tr>
		<?php 	}
		?>
		<tr>
			<td><?= $temp_time2 . "  " ?><img id="<?= 'likeicon_' . $temp_status_id2 ?>" src="dislike.png" onclick="return change(this)" alt="Like icon" height="20"></img></td>
		</tr>
		<tr>
			<td><hr /></td>
		</tr>
		<?php
			}
			while($row1 = mysqli_fetch_assoc($commentresults))
			{
				$temp_comment_id1 = $row1['comment_id'];
				$temp_status_id1 = $row1['status_id'];
				$temp_user_id1 = $row1['user_id'];
				$temp_commentdetail1 = $row1['commentdetail'];
				$temp_image1 = "upload/" . $row1['image'];
				$temp_firstname1 = $row1['firstname'];
				$temp_lastname1 = $row1['lastname'];
				$temp_time1 = $row1['time'];
		?>
		<tr>
			<td class="whitetext"><?= $temp_firstname1 . " " . $temp_lastname1 . " - " . $temp_commentdetail1 ?></td>
		</tr>
		<?php 	if($row1['image'] != null)
				{
		?>
		<tr>
			<td><img src="<?= $temp_image1 ?>" alt="image" height="500"></img></td>
		</tr>
		<?php 	}
		?>
		<tr>
			<td><?= $temp_time1 . "  " ?><img id="<?= 'likeicon_' . $temp_comment_id1 ?>" src="dislike.png" onclick="return change(this)" alt="Like icon" height="20"></img></td>
		</tr>
		<tr>
			<td><hr /></td>
		</tr>
		<?php
			}
	}
}
		?>
	
		<tr>
			<td><form action="http://www2.cs.uregina.ca/~stonge3n/CommentForm.php" onsubmit="return validateCommentForm()" method="post" enctype="multipart/form-data">
					<p class="whitetext">Comment:<br /><textarea rows="8" cols="50" id="commenttextarea" name="commenttextarea"></textarea><br /><br /></p>
					<p id="commenterror" class="whitetext"></p>
					<p><?= $error_message ?></p>
					<p>
						<input type="submit" name="Comment" value="Comment"/>
						<input type="reset" name="clear" value="Reset" />
						<input type="file" name="image" value="Upload Image"/>
						<input type="hidden" name="status_id" value="<?= $_SESSION['status_id'] ?>" />
						<input type="hidden" name="submitted" id="submitted" value="1" />
					</p>
				</form>
			</td>
		</tr>
			<tr>
			<td><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></td>
		</tr>
	</table>
</div>

</body>
</html>