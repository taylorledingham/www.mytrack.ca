<?php
$age_group_name = $_GET['age_group_name'];
$school_name = $_GET['school_name'];
session_start();
$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$managerID = $_SESSION["manager_id"];
		echo "<select name='athlete'><option value='--' >Select An Option:</option>" ;
		$q = "SELECT * FROM `AgeGroup` WHERE `AgeGroupLong`='$age_group_name'"; 
		$age_group_results = mysqli_query($db,$q);
		$row = mysqli_fetch_array($age_group_results);
		$age_group_id = $row['AgeGroupID'];

		
		$q = "SELECT * FROM `School` WHERE `SchoolLong`='$school_name'"; 
		$school_results = mysqli_query($db,$q);
		$row = mysqli_fetch_array($school_results);
		$school_id = $row['SchoolID'];
		
	 $q = "SELECT * FROM `Athlete` WHERE `ManagerID`= '$managerID' AND `AgeGroupID`=$age_group_id AND `SchoolID`=$school_id ORDER BY  `NameFirst` ASC ";

	 $event_results = mysqli_query($db,$q);
	  

	  $row = mysqli_fetch_array($event_results);

	  $eventListResults = mysqli_query($db,$q);
	  			
	  if(mysqli_num_rows($eventListResults) > 0){
		while($row = mysqli_fetch_assoc($eventListResults))
	  {
	  	$temp_first_name = $row['NameFirst'];
	  	$temp_last_name = $row['NameLast'];
	  	$temp_name="$temp_first_name" . " ". "$temp_last_name";
	  	echo "<option value=". "'$temp_name'" .">".  "$temp_first_name" . " ". "$temp_last_name" ." </option>";
	  					
	  }
	  			} 

//echo "<option value='6'>".  "$age_group_id" . " </option>";
echo "<select/>";
}
?>
