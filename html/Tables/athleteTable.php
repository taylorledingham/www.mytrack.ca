<script type="text/javascript" src="js/athleteForm.js"> </script>


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
		$q = "SELECT * FROM `Athlete` WHERE `ManagerID`='$managerID'";
		$athleteresults = mysqli_query($db,$q);

?>

<html>
<body>

<div id="athlete">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>School</th>
			<th>AgeGroup</th>
		</tr>	  

<?php
		if(mysqli_num_rows($athleteresults) > 0){
			while($row = mysqli_fetch_assoc($athleteresults))
			{
				$temp_athlete_id = $row['AthleteID'];
				$temp_athlete_name_first = $row['NameFirst'];
				$temp_athlete_name_last = $row['NameLast'];
				$temp_athlete_schoolID = $row['SchoolID'];
				$temp_athlete_agegroupID = $row['AgeGroupID'];
				$q = "SELECT `SchoolLong` FROM School WHERE `SchoolID` = '$temp_athlete_schoolID'";
				$schoolresult = mysqli_query($db,$q);
				$q = "SELECT  `AgeGroupLong` FROM  `AgeGroup` WHERE  `AgeGroupID` = $temp_athlete_agegroupID";
				$agegroupresult = mysqli_query($db,$q);
				
				$temp_school = mysqli_fetch_assoc($schoolresult);
				$temp_agegroup = mysqli_fetch_assoc($agegroupresult);
				
?>
		<tr id="<?php echo "athlete" . $temp_athlete_id ?>">
			<td>
				<form id="<?php echo "editAthlete". $temp_athlete_id ?>" method="post" action=""> 
					<input type="hidden" name="athlete_id" value="<?php echo $temp_athlete_id ?>" >
					<input type="submit" id="<?php echo 'button' . $temp_athlete_id ?>" name="submit" value="Edit" class="button-edit">
				</form>
				<form id= "<?php echo "deleteAthlete" . $temp_athlete_id ?>" method="post" action=""> 
					<input type="hidden" name="athlete_id" value="<?php echo $temp_athlete_id ?>" >
					<input type="submit" id="<?php echo 'button' . $temp_athlete_id ?>" name="submit" value="Delete" class="button-delete">
				</form>
			</td>
			<td><?php echo $temp_athlete_name_first ?></td>
			<td><?php echo $temp_athlete_name_last ?></td>
			<td><?php echo $temp_school['SchoolLong'] ?></td>
			<td><?php echo $temp_agegroup['AgeGroupLong'] ?></td>
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