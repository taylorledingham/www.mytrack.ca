<?php
$topStatus_id=$_GET['topStatus_id'];
$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
if(!$db)
	exit("Error in database connection");

$q = "SELECT comment_id, likenum FROM Comment WHERE status_id='$topStatus_id' ORDER BY TIME DESC";

if($result = mysqli_query($db, $q))
{
	$json = array("updateLikesStatusDetail" => array());
	while($row = mysqli_fetch_assoc($result))
		$json["updateLikesStatusDetail"][] = $row;

	print json_encode($json);
	mysqli_free_result($result);
}

mysql_close($db);
?>