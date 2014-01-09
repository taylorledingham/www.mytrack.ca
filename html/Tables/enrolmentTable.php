<script type="text/javascript" src="js/enrolmentForm.js"> </script>

<?php
session_start();
//if($_SESSION["logged_in"] == 0)
//	header("Location: http://www.mytrack.ca/index.php");
//else if($_SESSION["type"] == "manager")
//	header("Location: http://www.mytrack.ca/Home.php");
//else
//{
	$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	if(!$db){
		exit("Error in database connection");
	}
	else{
		$managerID = $_SESSION["manager_id"];
		$meetID = $_SESSION["meet_id"];
		//$q = "SELECT * FROM `Enrolled` WHERE `ManagerID`='$managerID' AND `MeetID`='$meetID'";
		$q = "SELECT * FROM `Enrolled` WHERE `ManagerID`='$managerID'";
		$enrolmentresults = mysqli_query($db,$q);

?>

<html>
<body>
<div id="enrolment">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>School</th>
			<th>AgeGroup</th>
			<th>Event</th>
		</tr>	  
<?php
		if(mysqli_num_rows($enrolmentresults) > 0){
			while($row = mysqli_fetch_assoc($enrolmentresults))
			{
				$temp_enrolment_id = $row['EnrolledID'];
				$temp_enrolment_athleteID = $row['AthleteID'];
				$temp_enrolment_eventID = $row['EventID'];
				
				$q = "SELECT A.NameFirst, A.NameLast, A.SchoolID, A.AgeGroupID FROM Athlete A WHERE A.AthleteID = '$temp_enrolment_athleteID'";
				$athleteresult = mysqli_query($db,$q);
				if(mysqli_num_rows($athleteresult) > 0){
					while($row1 = mysqli_fetch_assoc($athleteresult))
					{
						$temp_enrolment_athlete_name_first = $row1['NameFirst'];
						$temp_enrolment_athlete_name_last = $row1['NameLast'];
						$temp_enrolment_athlete_schoolID = $row1['SchoolID'];
						$temp_enrolment_athlete_agegroupID = $row1['AgeGroupID'];
				
						$q = "SELECT `SchoolLong` FROM School WHERE `SchoolID` = '$temp_enrolment_athlete_schoolID'";
						$schoolresult = mysqli_query($db,$q);
						$q = "SELECT  `AgeGroupLong` FROM  `AgeGroup` WHERE  `AgeGroupID` = $temp_enrolment_athlete_agegroupID";
						$agegroupresult = mysqli_query($db,$q);
						
						$temp_enrolment_athlete_school = mysqli_fetch_assoc($schoolresult);
						$temp_enrolment_athlete_agegroup = mysqli_fetch_assoc($agegroupresult);
					}
				}
				
				$q = "SELECT `EventLong` FROM Event WHERE `EventID` = '$temp_enrolment_eventID'";
				$eventresult = mysqli_query($db,$q);
				$temp_enrolment_event = mysqli_fetch_assoc($eventresult);
					
?>
		<tr id="<?php echo "enrolment" . $temp_enrolment_id ?>">
			<td>
				<form  style='display:inline;' id="<?php echo "editEnrolment" . $temp_enrolment_id ?>" method="post" action="">
				<input type="hidden" name="enrolment_id" value="<?php echo $temp_enrolment_id ?>" >
				<input type="submit" id="<?php echo 'button' . $temp_enrolment_id ?>" name="submit" value="Edit" class="button-edit">
				</form>
				<form  style='display:inline;'id="<?php echo "deleteEnrolment" . $temp_enrolment_id ?>" method="post" action="">
				<input type="hidden" name="enrolment_id" value="<?php echo $temp_enrolment_id ?>" >
				<input type="submit" id="<?php echo 'button' . $temp_enrolment_id ?>" name="submit" value="Delete" class="button-delete">
				</form>
			</td>
			<td><?php echo $temp_enrolment_athlete_name_first ?></td>
			<td><?php echo $temp_enrolment_athlete_name_last ?></td>
			<td><?php echo $temp_enrolment_athlete_school['SchoolLong'] ?></td>
			<td><?php echo $temp_enrolment_athlete_agegroup['AgeGroupLong'] ?></td>
			<td><?php echo $temp_enrolment_event['EventLong'] ?></td>
		</tr>			

<?php
			}
		}
	}
?>			
		
	</table>
</div>
</body>	
</html>