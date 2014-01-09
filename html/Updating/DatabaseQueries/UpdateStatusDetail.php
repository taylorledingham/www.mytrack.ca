<?php
$newcommentID = $_GET['newcomment_id'];
$statusID = $_GET['status_id'];

$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
if(!$db)
	exit("Error in database connection");

$q = "SELECT * FROM Comment WHERE StatusID='$statusID' and CommentID > '$newcommentID'";

if($result = mysqli_query($db, $q))
{
	$json = array("UpdateStatusDetail" => array());
	while($row = mysqli_fetch_assoc($result))
		$json["UpdateStatusDetail"][] = $row;
	
	print json_encode($json);
	mysqli_free_result($result);
}

mysql_close($db);
?>