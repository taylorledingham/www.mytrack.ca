<script type="text/javascript" src="js/recordsForm.js"> </script>

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
		//$q = "SELECT E.* FROM Event E, AgeGroup AG WHERE E.ManagerID='$managerID' AND E.MeetID='$meetID' AND AG.MeetID='$meetID' AND E.AgeGroup = AG.AgeGroupLong ORDER BY AG.Sort ASC";
		//$q = "SELECT E.* FROM Event E, AgeGroup AG WHERE E.ManagerID='$managerID' AND E.AgeGroupID= AG.AgeGroupID ORDER BY AG.Sort ASC";
		$q = "SELECT DISTINCT E.* FROM Event E, AgeGroup AG WHERE E.ManagerID='$managerID' ORDER BY AG.Sort ASC";
		$eventresults = mysqli_query($db,$q);

?>

<html>
<body>
<div id="event">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>Event</th>
			<th>Age Group</th>
			<th>Record</th>
			<th>Record Holder</th>
			<th>School</th>
		</tr>
	

<?php
		if(mysqli_num_rows($eventresults) > 0){
			while($row = mysqli_fetch_assoc($eventresults))
			{
				$temp_event_id = $row['EventID'];
				$temp_event_long = $row['EventLong'];
				$temp_event_type = $row['EventType'];
				$temp_event_agegroupID = $row['AgeGroupID'];
				if($temp_event_type == "Track")
					$temp_event_record = $row['RecordTrack'];
				else
					$temp_event_record = $row['RecordField'];
				$temp_event_record_name_first = $row['RecordNameFirst'];
				$temp_event_record_name_last = $row['RecordNameLast'];
				$temp_event_record_school = $row['RecordSchool'];
				
				
//				$q = "SELECT S.SchoolLong FROM School S, Athlete A WHERE A.SchoolID = '$temp_athlete_schoolID'";
//				$schoolresult = mysqli_query($db,$q);
				$q = "SELECT AG.AgeGroupLong FROM AgeGroup AG WHERE AG.AgeGroupID = '$temp_event_agegroupID'";
				$agegroupresult = mysqli_query($db,$q);
				
//				$temp_school = mysqli_fetch_assoc($schoolresult);
				$temp_event_agegroup_long = mysqli_fetch_assoc($agegroupresult);
?>
		<tr id="<?php echo "event" . $temp_event_id ?>">
			<td>
				<form action="http://www.mytrack.ca/EditEvents.php" method="post">
					<input type="hidden" name="event_id" value="<?= $temp_event_id ?>" />
					<input type="submit" id="<?= 'button' . $temp_event_id ?>" name="submit" value="Edit" class="button-edit">
				</form>
			</td>
			<td><?php echo $temp_event_long ?></td>
			<td><?php echo $temp_event_agegroup_long['AgeGroupLong'] ?></td>
			<td><?php echo $temp_event_record ?></td>
			<td><?php echo $temp_event_record_name_first . " " . $temp_event_record_name_last ?></td>
			<td><?php echo $temp_event_record_school ?></td>
		</tr>			
<!--		<script type="text/javascript">
			<!--
				var like_id1DOM = document.getElementById("<?= 'like' . $temp_comment_id1 ?>"); 
				like_id1DOM.addEventListener("click", change, false);
				like_id1DOM.addEventListener("click", updateCommentLike, false); 

			</script>	
// -->	
<?php
			}
		}
	}
?>
	</table>
</div>
</body>	
</html>