	<?php
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$school = $_POST['school'];
	$agegrp = $_POST['agegrp'];
	$id = $_POST['id'];
	$managerID = $_POST['managerID'];
	$meetID = $_POST['meetID'];
	
	
	$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	    if(!$db){
	      exit("Error in database connection");
	    }
	
	else{
	
	if($fname=="" || $lname=="")
	{
		echo json_encode(1);
		
	}
	
	else
	{
	 	    
	$exists =  mysqli_query($db,"SELECT * FROM `Athlete` WHERE `AthleteID` = $id");
	$result = mysqli_query($db, "SELECT * FROM `School` WHERE `SchoolLong`='$school'");
	$row = mysqli_fetch_array($result);
	$SchoolID = $row['SchoolID'];	
	
	$result = mysqli_query($db,"SELECT * FROM `AgeGroup` WHERE `AgeGroupLong`='$agegrp'");
	$row = mysqli_fetch_array($result);
	$AgeGroupID = $row['AgeGroupID'];
	
	
	//if(mysqli_num_rows($exists) > 0)
	if($id == "")
	{
	
		mysqli_query($db, "INSERT INTO `Athlete` (`NameFirst`,`NameLast`, `SchoolID`, `AgeGroupID`, `ManagerID`, `MeetID`) VALUES ('$fname', '$lname', $SchoolID, $AgeGroupID, $managerID,  $meetID)");	
	//echo("success");
	//echo($school);
	
	
	}
	
	else
	{
	
	$row = mysqli_fetch_array($exists);
		$athlete_id = $row['AthleteID'];

		
	mysqli_query($db, "UPDATE `Athlete` SET `NameFirst`='$fname',`NameLast` = '$lname', `SchoolID` = $SchoolID, `AgeGroupID` = $AgeGroupID WHERE `AthleteID`=$id");

	

	
		
		
	}
	}
	
	//echo($fname);
	
	    $athlete = array
    (
           'id' => $_POST['id'],
           'fname' => $_POST['fname'],
          'lname' => $_POST['lname'],
          'school' => $_POST['school'],
          'agegrp' => $_POST['agegrp']
     );
     echo json_encode($athlete);
     
     }

	
	?>