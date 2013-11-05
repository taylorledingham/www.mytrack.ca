<?php
$school_id = $_POST['school_id'];



/*
$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$q = "SELECT * FROM `School` WHERE `SchoolID`='$school_id'";
		$schoolresults = mysqli_query($db,$q);
		
		$row = mysqli_fetch_assoc($schoolresults)
		$school["name"] = $row['SchoolLong'];
		$school["abbrev"] = $row['SchoolShort'];
		
		echo json_encode($school);
		
		}
		
		
*/

echo($school_id);


?>