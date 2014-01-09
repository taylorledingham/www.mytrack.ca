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
<title>Status Detail</title>
<link rel="stylesheet" type="text/css" href="http://www2.cs.uregina.ca/~stonge3n/koii.css"></link>
<script type="text/javascript" src="Validation.js"></script>
<script type="text/javascript" src="CommentLike.js"></script>
<script type="text/javascript" src="StatusDetailAjax.js"></script>
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
		<input type="radio" name="ajax" value="on" checked="checked" />On
		<input type="radio" name="ajax" value="off" />Off <br />
		<a class="greytext" style="text-decoration:none" href="http://www2.cs.uregina.ca/~stonge3n/Logout.php">Sign Out</a><br />
	</p>
</div>

<div id="center_column">
	<div id="comments">
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
			<div id="<?= 'status' . $temp_status_id2 ?>" >
				<tr>
					<td class="whitetext"><?= $temp_firstname2 . " " . $temp_lastname2 . " - " . $temp_statusdetail2 ?></td>
				</tr>
<?php 			if($row2['image'] != null)
				{
?>
				<tr>
					<td><img src="<?= $temp_image2 ?>" alt="image" height="500"></img></td>
				</tr>
<?php 			}
?>
				<tr>
					<td><?= $temp_time2 . "  " ?></td>
				</tr>
				<tr>
					<td><hr /></td>
				</tr>
			</div>
			
			
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
			<div id="<?= 'divId' . $temp_comment_id1 ?>" >
				<tr>
					<td class="whitetext"><?= $temp_firstname1 . " " . $temp_lastname1 . " - " . $temp_commentdetail1 ?></td>
				</tr>
<?php 			if($row1['image'] != null)
				{
?>
				<tr>
					<td><img src="<?= $temp_image1 ?>" alt="image" height="500"></img></td>
				</tr>
<?php 			}
?>
				<tr>
					<td><?= $temp_time1 . "  " ?><img id="<?= 'like' . $temp_comment_id1 ?>" src="dislike.png" alt="Like icon" height="20"></img>
					Number of likes:<span id="<?= $temp_comment_id1 ?>">0</span></td>
				</tr>
				<tr>
					<td><hr /></td>
				</tr>
				<script type="text/javascript">
				<!--
					var like_id1DOM = document.getElementById("<?= 'like' . $temp_comment_id1 ?>"); 
					like_id1DOM.addEventListener("click", change, false);
					like_id1DOM.addEventListener("click", updateCommentLike, false); 
				// -->
				</script>
			</div>
			
			
<?php
			}
	}
}
		?>
	</div>
			<tr>
				<td><form action="http://www2.cs.uregina.ca/~stonge3n/CommentForm.php" method="post">
						<p><input type="hidden" name="status_id" value="<?= $_SESSION['status_id'] ?>" />
						<input type="submit" name="submit" value="Comment" /></p></form></td>
			</tr>
			<tr>
				<td><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></td>
			</tr>
		</table>

</div>

</body>
</html>