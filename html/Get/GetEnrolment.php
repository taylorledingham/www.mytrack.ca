<?php

$enrolment_id = $_POST['enrolment_id'];

//$athlete_id = 2;

$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		
		$q = "SELECT * FROM `Enrolled` WHERE `EnrolledID`='$enrolment_id'"; 
		$enrolmentresults = mysqli_query($db,$q);
		
	$row = mysqli_fetch_array($enrolmentresults);
		$temp_enrolment_athleteID = $row['AthleteID'];
		$temp_enrolment_eventID = $row['EventID'];

		$q = "SELECT `EventLong` FROM Event WHERE `EventID` = '$temp_enrolment_eventID'"; 
		//echo($q);
		$eventresult = mysqli_query($db,$q);


		$q = "SELECT * FROM Athlete WHERE `AthleteID` = '$temp_enrolment_athleteID'"; 
		$athleteresult = mysqli_query($db,$q);
		$row2 = mysqli_fetch_array($athleteresult);
			$temp_athlete_first = $row2['NameFirst'];
			$temp_athlete_second = $row2['NameLast'];
			$temp_athlete_agegroupID= $row2['AgeGroupID'];
			$temp_athlete_schoolID= $row2['SchoolID'];
		
		$q = "SELECT `SchoolLong` FROM School WHERE `SchoolID` = '$temp_athlete_schoolID'"; 
		//echo($q);
		$schoolresult = mysqli_query($db,$q);
		$q = "SELECT  `AgeGroupLong` FROM  `AgeGroup` WHERE  `AgeGroupID` = $temp_athlete_agegroupID";
		$agegroupresult = mysqli_query($db,$q);
		//echo($q);
				
		$temp_school = mysqli_fetch_assoc($schoolresult);
		$temp_agegroup = mysqli_fetch_assoc($agegroupresult);
		$temp_event = mysqli_fetch_assoc($eventresult);
		//echo($temp_school['SchoolLong']);
		//echo($temp_agegroup['AgeGroupLong']);
		//echo($temp_enrolment_eventID);
		//echo($enrolment_id);
		//echo($temp_athlete_first." " . $temp_athlete_second);
		$temp_athlete_name= "$temp_athlete_first" . " ". "$temp_athlete_second";
		$enrolled = array
    (
          'id'=> $enrolment_id,
          'school' => $temp_school['SchoolLong'],
          'agegrp' => $temp_agegroup['AgeGroupLong'],
          'event' => $temp_event['EventLong'],
          'athlete' => $temp_athlete_name
     );
     echo json_encode($enrolled);
		
		}
		
	

//echo($enrolled);


?>