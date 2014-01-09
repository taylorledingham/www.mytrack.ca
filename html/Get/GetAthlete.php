<?php
$athlete_id = $_POST['athlete_id'];

//$athlete_id = 2;



$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$q = "SELECT * FROM `Athlete` WHERE `AthleteID`='$athlete_id'"; 
		$athleteresults = mysqli_query($db,$q);
		

	$row = mysqli_fetch_array($athleteresults);
		$temp_athlete_schoolID = $row['SchoolID'];
		$temp_athlete_agegroupID = $row['AgeGroupID'];
		$q = "SELECT `SchoolLong` FROM School WHERE `SchoolID` = '$temp_athlete_schoolID'"; 
		$schoolresult = mysqli_query($db,$q);
		$q = "SELECT  `AgeGroupLong` FROM  `AgeGroup` WHERE  `AgeGroupID` = $temp_athlete_agegroupID";
		$agegroupresult = mysqli_query($db,$q);
				
		$temp_school = mysqli_fetch_assoc($schoolresult);
		$temp_agegroup = mysqli_fetch_assoc($agegroupresult);  
    $athlete = array
    (
           'id' => $athlete_id,
           'fname' => $row['NameFirst'],
          'lname' => $row['NameLast'],
          'school' => $temp_school['SchoolLong'],
          'agegrp' => $temp_agegroup['AgeGroupLong']
          
     );
     echo json_encode($athlete);

		
		}
		
	

//echo($school_id);


?>