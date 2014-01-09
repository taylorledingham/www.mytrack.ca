<?php
session_start();
$age_group_name = $_GET['age_group_name'];
$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$managerID = $_SESSION["manager_id"];
		echo "<select name='event' ><option value='--' >Select An Option:</option>" ;
		$q = "SELECT * FROM `AgeGroup` WHERE `AgeGroupLong`='$age_group_name'"; 
		$age_group_results = mysqli_query($db,$q);
		$row = mysqli_fetch_array($age_group_results);
		$age_group_id = $row['AgeGroupID'];

		
		
		
		 $q = "SELECT * FROM `Event` WHERE `ManagerID`= '$managerID' AND `AgeGroupID`=$age_group_id ORDER BY  `EventLong` ASC ";
	
		 $event_results = mysqli_query($db,$q);
		  
	
		  $row = mysqli_fetch_array($event_results);
	
		  $eventListResults = mysqli_query($db,$q);
		  			
		  if(mysqli_num_rows($eventListResults) > 0){
			while($row = mysqli_fetch_assoc($eventListResults))
		  {
		  	$temp_event = $row['EventLong'];
		  	echo "<option value=". "'$temp_event'" .">".  "$temp_event" . " </option>";
		  					
		  }
		  			} 
	
		//echo "<option value='6'>".  "$age_group_id" . " </option>";
		echo "<select/>";
}
?>
