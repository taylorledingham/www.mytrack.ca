<?php
$newcomment_id = $_GET['newcomment_id'];
$status_id = $_GET['status_id'];

$db = mysqli_connect("localhost", "stonge3n", "*Ns292*", "stonge3n");
if(!$db)
	exit("Error in database connection");

$q = "SELECT * FROM Comment WHERE status_id='$status_id' and comment_id > '$newcomment_id'";

if($result = mysqli_query($db, $q))
{
	$json = array("UpdateCommentsStatusDetail" => array());
	while($row = mysqli_fetch_assoc($result))
		$json["UpdateCommentsStatusDetail"][] = $row;
	
	print json_encode($json);
	mysqli_free_result($result);
}

mysql_close($db);
?>