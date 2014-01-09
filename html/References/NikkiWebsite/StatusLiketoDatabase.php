<?php
session_start();
$status_id=$_GET['status_id'];
$enable=$_GET['enabled'];
$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
if(!$db)
	exit("Error in database connection");

$firstname=$_SESSION['firstname'];
$lastname=$_SESSION['lastname'];
$user_id=$_SESSION['user_id'];

if($enable=='true')
	$q="INSERT INTO LikeStatus(user_id, firstname, lastname, status_id)	VALUES('$user_id','$firstname', '$lastname','$status_id')";
else
	$q="Delete from LikeStatus where user_id='$user_id' and status_id='$status_id'";

$result = mysqli_query($db,$q);

$query = "SELECT COUNT(status_id) FROM LikeStatus WHERE status_id='$status_id'";
$results = mysqli_query($db, $query);

while($row = mysqli_fetch_assoc($results))
	$likenum = $row['COUNT(status_id)'];

$updateoflikes = "UPDATE Status SET likenum='$likenum' WHERE status_id='$status_id'";
$resultsofUpdate = mysqli_query($db,$updateoflikes);

print $likenum;

mysql_close($db);
?>