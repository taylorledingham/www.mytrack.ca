<script type="text/javascript" src="js/agegroupForm.js"> </script>

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
		//$q = "SELECT * FROM `AgeGroup` WHERE `ManagerID`='$managerID' AND `MeetID`='$meetID' ORDER BY `Sort` ASC";
		$q = "SELECT * FROM `AgeGroup` WHERE `ManagerID`='$managerID' ORDER BY `Sort` ASC";
		$agegroupresults = mysqli_query($db,$q);

?>

<html>
<body>
<div id="ageGroups">
	<table align="Left">
		<tr>
			<th>Edit</th>
			<th>Age Group</th>
			<th>Abbreviation</th>
			<th>Sort</th>
		</tr>

<?php
		if(mysqli_num_rows($agegroupresults) > 0){
			while($row = mysqli_fetch_assoc($agegroupresults))
			{
				$temp_age_group_id = $row['AgeGroupID'];
				$temp_age_group_long = $row['AgeGroupLong'];
				$temp_age_group_short = $row['AgeGroupShort'];
				$temp_sort = $row['Sort'];
?>
		<tr id="<?php echo "age_group" . $temp_age_group_id ?>">
			<td>
				<form  name = "editAgeGroup" id="<?php echo "editAgeGroup" . $temp_age_group_id ?>" method="post" action=""> 
					<input type="hidden" name="age_group_id" value="<?php echo $temp_age_group_id ?>">
					<input type="submit" id="<?php echo "button" . $temp_age_group_id ?>" name="submit" value="Edit" class="button-edit">
				</form>
				<form  name = "editAgeGroup" id="<?php echo "deleteAgeGroup" . $temp_age_group_id ?>" method="post" action=""> 
					<input type="hidden" name="age_group_id" value="<?php echo $temp_age_group_id ?>">
					<input type="submit" id="<?php echo "button" . $temp_age_group_id ?>" name="submit" value="Delete" class="button-delete">
				</form>
			</td>
			<td><?php echo $temp_age_group_long ?></td>
			<td><?php echo $temp_age_group_short ?></td>
			<td><?php echo $temp_sort ?></td>
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