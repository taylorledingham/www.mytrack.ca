<?php
$age_group_id = $_POST['age_group_id'];

$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$q = "SELECT * FROM `AgeGroup` WHERE `AgeGroupID`='$age_group_id'"; 
		$age_group_results = mysqli_query($db,$q);
		

	$row = mysqli_fetch_array($age_group_results);
    $ageGroup = array
    (
    	'id' => $age_group_id,
     	'agegroup'=> $row['AgeGroupLong'],
     	'abbrev'=> $row['AgeGroupShort'],
     	'sort'=> $row['Sort']
     
     );
     echo json_encode($ageGroup);

		
		}



?>