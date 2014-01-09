<?php
session_start();
$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	
	if(!$db){
		exit("Error in database connection");
		echo("couldn't connect to database");
	}
	else{
		$managerID = $_SESSION["manager_id"];
		echo "<select name='agegrp' onchange='change_category(this.value);'>";
		echo "<option value='--' >Select An Option:</option>";

		$q4 = "SELECT `AgeGroupID`, `AgeGroupLong` FROM `AgeGroup` WHERE `ManagerID` = '$managerID'";
		$ageGroupListResults = mysqli_query($db,$q4);
					
		if(mysqli_num_rows($ageGroupListResults) > 0){
		while($row4 = mysqli_fetch_assoc($ageGroupListResults))
		{
			$temp_age_group = $row4['AgeGroupLong'];
						
			echo "<option value=". "'$temp_age_group'" . " > " . "$temp_age_group" . "</option>";
						
						}
					} 

					echo "</select>";

}					
?>