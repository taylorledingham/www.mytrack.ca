<?php
$statusID = $_GET['postID'];
$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
if(!$db)
	exit("Error in database connection");

$q = "SELECT * FROM Status WHERE StatusID > '$statusID'";

if($result = mysqli_query($db, $q))
{
	$json = array("UpdateStatus" => array());
	while($row = mysqli_fetch_assoc($result))
		$json["UpdateStatus"][] = $row;

	print json_encode($json);
	mysqli_free_result($result);
}

mysql_close($db);
?>