<script type="text/javascript" src="js/meetsForm.js"> </script>

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
		//$q = "SELECT * FROM `Meet` WHERE `ManagerID`='$managerID' AND `MeetID`='$meetID'";
		$q = "SELECT * FROM `Meet` WHERE `ManagerID`='$managerID'";
		$meetresults = mysqli_query($db,$q);

?>

<html>
<body>

<div id="meets">
	<table align="left">
		<tr>
			<th>Edit</th>
			<th>Meets</th>
		</tr>

<?php
		if(mysqli_num_rows($meetresults) > 0){
			while($row = mysqli_fetch_assoc($meetresults))
			{
				$temp_meet_id = $row['MeetID'];
				$temp_meet = $row['Meet'];
?>
		<tr id="<?php echo "meet" . $temp_meet_id ?>">
			<td>
				<form   id= "<?php echo "editMeet" . $temp_meet_id ?>" method="post" action=""> 
					<!--<form action="www.mytrack.ca/EditMeets.php" method="post"> -->
					<input type="hidden" name="meet_id" value="<?php echo $temp_meet_id ?>" >
					<input type="submit" id="<?php echo "button" . $temp_meet_id ?>" name="submit" value="Edit" class="button-edit"></form>
				<form id= "<?php echo "deleteMeet" . $temp_meet_id ?>" method="post" action=""> 
					<!--<form action="www.mytrack.ca/EditMeets.php" method="post"> -->
					<input type="hidden" name="meet_id" value="<?php echo $temp_meet_id ?>" >
					<input type="submit" id="<?php echo "button" . $temp_meet_id ?>" name="submit" value="Delete" class="button-delete">
				</form>
			</td>					
			<td><?php echo $temp_meet ?></td>
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