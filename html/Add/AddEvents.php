	<?php
	$eventType = $_POST['eventType'];
	$eventName = $_POST['name'];
	$agegrp = $_POST['agegroup'];
	$id = $_POST['id'];
	$managerID = $_POST['managerID'];
	$meetID = $_POST['meetID'];
	
	
	$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	    if(!$db){
	      exit("Error in database connection");
	    }
	
	else{
	
	if($eventType=="" || $eventName=="")
	{
		echo json_encode(1);
		
	}
	
	else
	{
	 	    
	$exists =  mysqli_query($db,"SELECT * FROM `Event` WHERE `EventID` = $id");
	$result = mysqli_query($db, "SELECT * FROM `AgeGroup` WHERE `AgeGroupLong`='$agegrp'");
	$row = mysqli_fetch_array($result);
	$AgeGroupID = $row['AgeGroupID'];
	
	
	//if(mysqli_num_rows($exists) > 0)
	if($id == "")
	{
	
		mysqli_query($db, "INSERT INTO `Event` (`EventLong`,`EventType`, `AgeGroupID`, `ManagerID`, `MeetID`) VALUES ('$eventName', '$eventType', $AgeGroupID, $managerID,  $meetID)");	
	//echo("success");
	//echo($school);
	
	
	}
	
	else
	{
	
	$row = mysqli_fetch_array($exists);
		$event_id = $row['EventID'];

		
	mysqli_query($db, "UPDATE `Event` SET `EventLong`='$eventName',`EventType` = '$eventType', `AgeGroupID` = $AgeGroupID WHERE `EventID`=$id");

	

	
		
		
	}
	}
	
	//echo($fname);
	
	    $event = array
    (
           'id' => $_POST['id'],
           'eventName' => $_POST['eventName'],
          'eventType' => $_POST['eventType'],
          'agegrp' => $_POST['agegroup']
     );
     echo json_encode($event);
     
     }

	
	?>