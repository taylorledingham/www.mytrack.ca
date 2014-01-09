<?php
session_start();
$comment_id=$_GET['comment_id'];
$enable=$_GET['enabled'];
$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
if(!$db)
	exit("Error in database connection");

$firstname=$_SESSION['firstname'];
$lastname=$_SESSION['lastname'];
$user_id=$_SESSION['user_id'];

if($enable=='true')
	$q="INSERT INTO LikeComment(user_id, firstname, lastname, comment_id) VALUES ('$user_id','$firstname', '$lastname','$comment_id')";
else
	$q="Delete from LikeComment where user_id='$user_id' and comment_id='$comment_id'";

$result = mysqli_query($db,$q);

$query = "SELECT COUNT(comment_id) FROM LikeComment WHERE comment_id='$comment_id'";
$results = mysqli_query($db, $query);

while($row = mysqli_fetch_assoc($results))
	$likenum = $row['COUNT(comment_id)'];

$updateoflikes = "UPDATE Comment SET likenum='$likenum' WHERE comment_id='$comment_id'";
$resultsofUpdate = mysqli_query($db,$updateoflikes);

print $likenum;

mysql_close($db);
?>