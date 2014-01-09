<?php
$meet_id = $_POST['meet_id'];
$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$q = "SELECT * FROM `Meet` WHERE `MeetID`='$meet_id'"; 
		$meetresults = mysqli_query($db,$q);
		

	$row = mysqli_fetch_array($meetresults);
	
    $meet = array
    (
    	   'id' => $meet_id,
           'MeetName' => $row['Meet']
     );
     
     echo json_encode($meet);

		
		}
		

?>