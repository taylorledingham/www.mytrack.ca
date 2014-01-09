<script type="text/javascript" src="js/schoolForm.js"> </script>

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
		//$q = "SELECT * FROM `School` WHERE `ManagerID`='$managerID' AND `MeetID`='$meetID'";
		$q = "SELECT * FROM `School` WHERE `ManagerID`='$managerID'";
		$schoolresults = mysqli_query($db,$q);

?>

<html>
<body>
		
<div id="school">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>Schools</th>
			<th>Abbreviation</th>
		</tr>

<?php
		if(mysqli_num_rows($schoolresults) > 0){
			while($row = mysqli_fetch_assoc($schoolresults))
			{
				$temp_school_id = $row['SchoolID'];
				$temp_school_long = $row['SchoolLong'];
				$temp_school_short = $row['SchoolShort'];
?>
		<tr id="<?php echo "school" . $temp_school_id ?>">
			<td>
				<form  id="<?php echo "editSchool". $temp_school_id ?>" method="post" action=""> 
					<!--<form action="www.mytrack.ca/EditSchools.php" method="post"> -->
					<input type="hidden" name="school_id" value="<?php echo $temp_school_id ?>" >
					<input type="submit" id="<?php echo "button" . $temp_school_id ?>" name="submit" value="Edit" class="button-edit" >
				</form>
				<form  id="<?php echo "DeleteSchool". $temp_school_id ?>" method="post" action=""> 
					<!--<form action="www.mytrack.ca/EditSchools.php" method="post"> -->
					<input type="hidden" name="school_id" value="<?php echo $temp_school_id ?>" >
					<input type="submit" id="<?php echo "button" . $temp_school_id ?>" name="submit" value="Delete" class="button-delete" >
				</form>
			</td>
			<td><?php echo $temp_school_long ?></td>
			<td><?php echo $temp_school_short ?></td>
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