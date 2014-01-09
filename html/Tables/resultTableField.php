<script type="text/javascript" src="js/resultsForm.js"> </script>

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
		$enrollmentresults = mysqli_query($db,$q);

?>

<html>
<body>
 <div id="results">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>School</th>
			<th>Result 1</th>
			<th>Result 2</th>
			<th>Result 3</th>
			<th>Final Result</th>
		</tr>	  
<?php
		if(mysqli_num_rows($enrollmentresults) > 0){
			while($row = mysqli_fetch_assoc($enrollmentresults))
			{
				$temp_enrollment_id = $row['EnrolledID'];
				$temp_enrollment_athleteID = $row['AthleteID'];
				$temp_enrollment_eventID = $row['EventID'];
				$temp_emrollment_resultOne = $row['ResultOne'];
				$temp_enrollment_resultTwo = $row['ResultTwo'];
				$temp_enrollment_resultThree = $row['ResultThree'];
				$temp_enrollment_resultFinal = $row['ResultFinal'];
//				$temp_enrollment_timeHeat = $row['TimeHeat'];
//				$temp_enrollment_timeFinal = $row['TimeFinal'];
				
				$q = "SELECT A.NameFirst, A.NameLast, A.SchoolID, A.AgeGroupID FROM Athlete A WHERE A.AthleteID = '$temp_enrollment_athleteID'";
				$athleteresult = mysqli_query($db,$q);
				if(mysqli_num_rows($athleteresult) > 0){
					while($row1 = mysqli_fetch_assoc($athleteresult))
					{
						$temp_enrollment_athlete_name_first = $row1['NameFirst'];
						$temp_enrollment_athlete_name_last = $row1['NameLast'];
						$temp_enrollment_athlete_schoolID = $row1['SchoolID'];
				
						$q = "SELECT `SchoolLong` FROM School WHERE `SchoolID` = '$temp_enrollment_athlete_schoolID'";
						$schoolresult = mysqli_query($db,$q);
						
						$temp_enrollment_athlete_school = mysqli_fetch_assoc($schoolresult);
					}
				}
					
?>
		<tr id="<?php echo "Result" . $temp_result_id ?>">
			<td>
				<form  id="editResult" method="post" action="">
					<input type="hidden" name="result_id" value="<?php echo $temp_result_id ?>" >
					<input type="submit" id="<?php echo 'button' . $temp_result_id ?>" name="submit" value="Edit" class="button-edit">
				</form>
				<form  id="deleteResult" method="post" action="">
					<input type="hidden" name="result_id" value="<?php echo $temp_result_id ?>" >
					<input type="submit" id="<?php echo 'button' . $temp_result_id ?>" name="submit" value="Delete" class="button-delete">
				</form>
			</td>
			<td><?php echo $temp_enrollment_athlete_name_first ?></td>
			<td><?php echo $temp_enrollment_athlete_name_last ?></td>
			<td><?php echo $temp_enrollment_athlete_school['SchoolLong'] ?></td>
			<td><?php echo $temp_enrollment_resultOne ?></td>
			<td><?php echo $temp_enrollment_resultTwo ?></td>
			<td><?php echo $temp_enrollment_resultThree ?></td>
			<td><?php echo $temp_enrollemnt_resultFinal ?></td>
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