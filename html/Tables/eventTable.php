<script type="text/javascript" src="js/eventForm.js"> </script>

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
		//$q = "SELECT DISTINCT E.EventID, E.EventLong, E.EventType, E.AgeGroupID FROM Event E, AgeGroup AG
		//WHERE E.ManagerID='$managerID' AND E.MeetID='$meetID' AND AG.MeetID='$meetID' AND E.AgeGroupID = AG.AgeGroupID ORDER BY AG.Sort ASC";
		$q = "SELECT DISTINCT E.EventID, E.EventLong, E.EventType, E.AgeGroupID FROM Event E, AgeGroup AG
		WHERE E.ManagerID='$managerID' AND E.AgeGroupID = AG.AgeGroupID ORDER BY AG.Sort ASC";
		$eventresults = mysqli_query($db,$q);

?>

<html>
<body>

<div id="event">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>Event Type</th>
			<th>Event</th>
			<th>Age Group</th>
		</tr>

<?php
		if(mysqli_num_rows($eventresults) > 0){
			while($row = mysqli_fetch_assoc($eventresults))
			{
				$temp_event_id = $row['EventID'];
				$temp_event_long = $row['EventLong'];
				$temp_event_type = $row['EventType'];
				$temp_event_agegroupID = $row['AgeGroupID'];
//				if($temp_event_type == "Track")
//					$temp_event_record = $row['RecordTrack'];
//				else
//					$temp_event_record = $row['RecordField'];
//				$temp_event_record_name_first = $row['RecordNameFirst'];
//				$temp_event_record_name_last = $row['RecordNameLast'];
//				$temp_event_record_school = $row['RecordSchool'];

				$q = "SELECT AG.AgeGroupLong FROM AgeGroup AG WHERE AG.AgeGroupID = '$temp_event_agegroupID'";
				$agegroupresult = mysqli_query($db,$q);

				$temp_agegroup = mysqli_fetch_assoc($agegroupresult);
				
?>
		<tr id="<?php echo "event" . $temp_event_id ?>">
			<td>
				<form  name = "editEvent" id="<?php echo "editEvent" . $temp_event_id ?>" method="post" action=""> 
					<input type="hidden" name="event_id" value="<?php echo $temp_event_id ?>" >
					<input type="submit" id="<?php echo 'button' . $temp_event_id ?>" name="submit" value="Edit" class="button-edit" >
				</form>
				<form  name = "editEvent" id="<?php echo "deleteEvent" . $temp_event_id ?>" method="post" action=""> 
					<input type="hidden" name="event_id" value="<?php echo $temp_event_id ?>" >
					<input type="submit" id="<?php echo 'button' . $temp_event_id ?>" name="submit" value="Delete" class="button-delete" >
				</form>
			</td>
			<td><?php echo $temp_event_type ?></td>
			<td><?php echo $temp_event_long ?></td>
			<td><?php echo $temp_agegroup['AgeGroupLong'] ?></td>
<!--			<td><?php echo $temp_event_record ?></td>
			<td><?php echo $temp_event_record_name_first . " " . $temp_event_record_name_last ?></td>
			<td><?php echo $temp_event_record_school ?></td>
-->
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