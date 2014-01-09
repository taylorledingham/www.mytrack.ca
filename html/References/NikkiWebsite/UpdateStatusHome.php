<?php
$status_id = $_GET['post_id'];
$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
if(!$db)
	exit("Error in database connection");

$q = "SELECT * FROM Status WHERE status_id>'$status_id'";

if($result = mysqli_query($db, $q))
{
	$json = array("UpdateStatusHome" => array());
	while($row = mysqli_fetch_assoc($result))
		$json["UpdateStatusHome"][] = $row;

	print json_encode($json);
	mysqli_free_result($result);
}

mysql_close($db);
?>