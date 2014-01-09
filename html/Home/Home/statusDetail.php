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
	else
	{
		$managerID = $_SESSION["manager_id"];
		$meetID = $_SESSION["meet_id"];
		$statusID = $_POST['status_id'];
		
		$q1 = "SELECT * FROM Comment WHERE StatusID = '$statusID' ORDER BY TIME DESC";
		$commentresults = mysqli_query($db, $q1);
		$q2 = "SELECT * FROM Status WHERE StatusID = '$statusID'";
		$statusresult = mysqli_query($db, $q2);		
?>

<html>

<body>

<div>
	<div id="comments">
		<table>
<?php
		if(mysqli_num_rows($statusresult) > 0)
		{
			while($row2 = mysqli_fetch_assoc($statusresult))
			{				
				$temp_statusID2 = $row2['StatusID'];
				$temp_userID2 = $row2['UserID'];
				$temp_statusdetail2 = $row2['StatusDetail'];
				$temp_likes2 = $row2['Likes'];
				$temp_comments2 = $row2['Comments'];
				$temp_image2 = "upload/" . $row2['Image'];
				$temp_time2 = $row2['Time'];
				
				$q = "SELECT U.NameFirst, U.NameLast FROM User U WHERE U.UserID = '$temp_userID2'";
				$nameresult = mysqli_query($db,$q);
					
				$temp_names = mysqli_fetch_assoc($nameresult);
				
				$temp_firstname2 = $temp_names['NameFirst'];
				$temp_lastname2 = $temp_names['NameLast'];
?>
			<div id="<?php echo 'status' . $temp_statusID2 ?>" >
				<tr>
					<td>
						<p><?php echo $temp_firstname2 . " " . $temp_lastname2 . " - " . $temp_statusdetail2 ?></p>
<?php
			 	if($row2['Image'] != NULL)
				{
?>
						<p><img src="<?php echo $temp_image2 ?>" alt="image" height="500"></img></p>
<?php
			 	}
?>
						<p><?php echo $temp_time2 . "  " ?>	<img id="<?php echo 'like' . $temp_statusID2 ?>" src="dislike.png" alt="Like icon" height="20"></img>
						Number of likes:<span id="<?php echo $temp_statusID2 ?>"><?php echo $temp_likes2 ?></span></p>
					</td>
				</tr>
				<script type="text/javascript">
				<!--
					var like_id1DOM = document.getElementById("<?php echo 'like' . $temp_comment_id1 ?>"); 
					like_id1DOM.addEventListener("click", change, false);
					like_id1DOM.addEventListener("click", updateCommentLike, false); 
				// -->
				</script>
			</div>	
<?php 
			}
		}
		if(mysqli_num_rows($commentresults) > 0)
		{
			while($row1 = mysqli_fetch_assoc($commentresults))
			{
				$temp_commentID1 = $row1['CommentID'];
				$temp_statusID1 = $row1['StatusID'];
				$temp_userID1 = $row1['UserID'];
				$temp_commentdetail1 = $row1['CommentDetail'];
				$temp_likes1 = $row1['Likes'];
				$temp_image1 = "upload/" . $row1['Image'];
				$temp_time1 = $row1['Time'];
		
				$q = "SELECT U.NameFirst, U.NameLast FROM User U WHERE U.UserID = '$temp_userID1'";
				$nameresult = mysqli_query($db,$q);
		
				$temp_names = mysqli_fetch_assoc($nameresult);
					
				$temp_firstname1 = $temp_names['NameFirst'];
				$temp_lastname1 = $temp_names['NameLast'];
?>
			<div id="<?php echo 'commentId' . $temp_commentID1 ?>" >
				<tr>
					<td>
						<p><?php echo $temp_firstname1 . " " . $temp_lastname1 . " - " . $temp_statusdetail1 ?></p>
<?php
			 	if($row1['Image'] != NULL)
				{
?>
						<p><img src="<?php echo $temp_image1 ?>" alt="image" height="500"></img></p>
<?php
			 	}
?>
						<p><?php echo $temp_time1 . "  " ?>	<img id="<?php echo 'like' . $temp_commentID1 ?>" src="dislike.png" alt="Like icon" height="20"></img>
						Number of likes:<span id="<?php echo $temp_commentID1 ?>"><?php echo $temp_likes1 ?></span></p>
					</td>
				</tr>
				<script type="text/javascript">
				<!--
					var like_id1DOM = document.getElementById("<?php echo 'like' . $temp_comment_id1 ?>"); 
					like_id1DOM.addEventListener("click", change, false);
					like_id1DOM.addEventListener("click", updateCommentLike, false); 
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