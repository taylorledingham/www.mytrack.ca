<?php

$enrolment_id = $_POST['result_id'];


$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		
		$q = "SELECT * FROM `Enrolled` WHERE `EnrolledID`='$enrolment_id'"; 
		$enrolmentresults = mysqli_query($db,$q);
		
		$row = mysqli_fetch_array($enrolmentresults);
		$temp_enrolment_eventID = $row['EventID'];
		$temp_time_heat = $row['TimeHeat'];
		$temp_time_final = $row['TimeFinal'];
		$temp_result_one= $row['ResultOne'];
		$temp_result_two = $row['ResultTwo'];
		$temp_result_three = $row['ResultThree'];
		$temp_result_final = $row['ResultFinal'];

		$q = "SELECT `EventType` FROM Event WHERE `EventID` = '$temp_enrolment_eventID'"; 
		$eventresult = mysqli_query($db,$q);
		$temp_event_type = mysqli_fetch_assoc($eventresult);
		
		$enrolled = array
    (
          'id'=> $enrolment_id,
          'type'=> $temp_event_type['EventType'],
          'timeHeat' => $temp_time_heat,
          'timeFinal' => $temp_time_final,
          'resultOne' => $temp_result_one,
          'resultTwo' => $temp_result_two,
          'resultThree' => $temp_result_three,
          'resultFinal' => $temp_result_final

     );
     echo json_encode($enrolled);
		
		}


?>