<?php
$event_id = $_POST['event_id'];

$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$q = "SELECT * FROM `Event` WHERE `EventID`='$event_id'"; 
		$event_results = mysqli_query($db,$q);
		

	$row = mysqli_fetch_array($event_results);
	
	$event_agegroupID = $row['AgeGroupID'];
	$q = "SELECT  `AgeGroupLong` FROM  `AgeGroup` WHERE  `AgeGroupID` = $event_agegroupID";
	$agegroupresult = mysqli_query($db,$q);
	$temp_agegroup = mysqli_fetch_assoc($agegroupresult);
    $event = array
    (
     	'id'=>$event_id,
     	'event'=> $row['EventLong'],
     	'eventType' => $row['EventType'],
     	'agegroup' => $temp_agegroup['AgeGroupLong']
     
     );
     echo json_encode($event);

		
		}



?>