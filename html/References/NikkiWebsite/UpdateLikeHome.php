<?php
$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
if(!$db)
	exit("Error in database connection");

$q = "SELECT status_id, commentnum, likenum FROM Status ORDER BY TIME DESC";

if($result = mysqli_query($db, $q))
{
	$json = array("updateLikesStatus" => array());
	while($row = mysqli_fetch_assoc($result))
		$json["updateLikesStatus"][] = $row;

	print json_encode($json);
	mysqli_free_result($result);
}

mysql_close($db);
?>