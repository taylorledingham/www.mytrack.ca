<script type="text/javascript" src="../../js/commentForm.js"> </script>

<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www.mytrack.ca/Index/Login.php");
else if($_SESSION["type"] == "general")
	header("Location: http://www.mytrack.ca");
else
{	
	$db = mysqli_connect("localhost", "root", "imagroup123", "mytrack");
	if(!$db)
		exit("Error with database connection");
	else{
		$managerID = $_SESSION["manager_id"];
		$meetID = $_SESSION["meet_id"];
		
		$q = "SELECT * FROM Status ORDER BY Time DESC";
		$result = mysqli_query($db, $q);
		
?>

<html>
<body>
<!-- <body onload="startTimer()"> -->

<div>
	<div id="statuses">
		<table>
<?php
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$temp_statusID = $row['StatusID'];
				$temp_userID = $row['UserID'];
				$temp_statusdetail = $row['StatusDetail'];
				$temp_likes = $row['Likes'];
				$temp_comments = $row['Comments'];
				$temp_image = "upload/" . $row['Image'];
				$temp_time = $row['Time'];
				
				$q = "SELECT U.NameFirst, U.NameLast FROM User U WHERE U.UserID = '$temp_userID'";
				$nameresult = mysqli_query($db,$q);
				
				$temp_names = mysqli_fetch_assoc($nameresult);

				$temp_firstname = $temp_names['NameFirst'];
				$temp_lastname = $temp_names['NameLast'];				
?>		
			<div id="<?php echo 'divId' . $temp_statusID ?>" >
				<tr>
					<td>
						<p><?php echo $temp_firstname . " " . $temp_lastname . " - " . $temp_statusdetail ?></p>
<?php
			 	if($row['Image'] != NULL)
				{
?>
						<p><img src="<?php echo $temp_image ?>" alt="image" height="500"></img></p>
<?php
			 	}
?>
						<p><?php echo $temp_time . "  " ?><form action="http://www.mytrack.ca/Home/Home.php" method="post">
								<input type="hidden" name="status_id" value="<?php echo $temp_statusID ?>" />
								<input type="hidden" name="loading" value="<?php echo "detail" ?>" />
								<input type="submit" id="<?php echo 'button' . $temp_statusID ?>" name="submit" value="<?php echo $temp_comments . ' Comment(s)' ?>" />
							</form>
						<img id="<?php echo 'like' . $temp_statusID ?>" src="dislike.png" alt="Like icon" height="20"></img>
						Number of likes:<span id="<?php echo $temp_statusID ?>"><?php echo $temp_likes ?></span></p>
					</td>
				</tr>
				
				<script type="text/javascript">
				<!--
					var like_idDOM = document.getElementById("<?php 'like' . $temp_statusID ?>"); 
					like_idDOM.addEventListener("click", change, false); 
					like_idDOM.addEventListener("click", updateStatusLike, false); 
				// -->
				</script>
			</div>
<?php
			}
		}
	}
}

?>
		</table>
	</div>
</div>

</body>
</html>