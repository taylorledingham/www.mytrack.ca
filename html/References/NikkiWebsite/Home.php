<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www2.cs.uregina.ca/~stonge3n/Login.php");
else
{	
	$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
	if(!$db)
		exit("Error with database connection");
	
	$q = "SELECT * FROM Status ORDER BY time DESC";
	$result = mysqli_query($db, $q);
		
	if(mysqli_num_rows($result) < 0)
		die('Error: ' . mysqli_error());
	else 
	{
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koii-Home</title>
<link rel="stylesheet" type="text/css" href="http://www2.cs.uregina.ca/~stonge3n/koii.css"></link>
<script type="text/javascript" src="Validation.js"></script>
<script type="text/javascript" src="StatusLike.js"></script>
<script type="text/javascript" src="HomeAjax.js"></script>
</head>

<body onload="startTimer()">

<p class="koii">
	Koii
</p>

<div id="left_column">
	<p>
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/Home.php">Home</a><br />
		<?= $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?><br />
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/StatusForm.php">Make a Status</a><br />
		Dynamic Updates:
		<input type="button" id="ajax" value="ENABLED" onclick="return timerFunction(this)" /><br />
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/Logout.php">Sign Out</a><br />
	</p>
</div>

<div id="center_column">
	<div id="statuses">
		<table>
<?php
			while($row = mysqli_fetch_assoc($result))
			{
				$temp_status_id = $row['status_id'];
				$temp_user_id = $row['user_id'];
				$temp_statusdetail = $row['statusdetail'];
				$temp_image = "upload/" . $row['image'];
				$temp_commentnum = $row['commentnum'];
				$temp_firstname = $row['firstname'];
				$temp_lastname = $row['lastname'];
				$temp_time = $row['time'];
?>		
			<div id="<?= 'divId' . $temp_status_id ?>" >
				<tr>
					<td class="whitetext"><?= $temp_firstname . " " . $temp_lastname . " - " . $temp_statusdetail ?></td>
				</tr>
<?php		 	if($row['image'] != NULL)
				{
?>
				<tr>
					<td><img src="<?= $temp_image ?>" alt="image" height="500"></img></td>
				</tr>
<?php		 	}
?>
				<tr>
					<td><?= $temp_time . "  " ?><form action="http://www2.cs.uregina.ca/~stonge3n/StatusDetail.php" method="post">
							<input type="hidden" name="status_id" value="<?= $temp_status_id ?>" />
							<input type="submit" id="<?= 'button' . $temp_status_id ?>" name="submit" value="<?= $temp_commentnum . ' Comment(s)' ?>" />
						</form>
					<img id="<?= 'like' . $temp_status_id ?>" src="dislike.png" alt="Like icon" height="20"></img>
					Number of likes:<span id="<?= $temp_status_id ?>">0</span></td>
				</tr>
				<tr>
					<td><hr /></td>
				</tr>
				<script type="text/javascript">
				<!--
					var like_idDOM = document.getElementById("<?= 'like' . $temp_status_id ?>"); 
					like_idDOM.addEventListener("click", change, false); 
					like_idDOM.addEventListener("click", updateStatusLike, false); 
				// -->
				</script>
			</div>
<?php
			}
	}
}
?>
			<tr>
				<td><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></td>
			</tr>
	</table>
	</div>
</div>

</body>
</html>