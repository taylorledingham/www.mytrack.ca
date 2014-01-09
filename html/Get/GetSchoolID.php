<?php
$school_id = $_POST['school_id'];

//$school_id = 1;



$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$q = "SELECT * FROM `School` WHERE `SchoolID`='$school_id'";
		$schoolresults = mysqli_query($db,$q);
		

	$row = mysqli_fetch_array($schoolresults);
    $school = array
    (
           'id' => $school_id,
           'schoolname' => $row['SchoolLong'],
         'schoolabbrev' => $row['SchoolShort'],
     );
     echo json_encode($school);

		
		}
		
	

//echo($school_id);


?>