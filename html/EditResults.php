<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www.mytrack.ca/Index/Login.php");
else if($_SESSION["type"] == "general")
	header("Location: http://www.mytrack.ca");
else
{
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

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>
<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css"> 
<script type = "text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>
<script type="text/javascript" src="js/menu.js" > </script>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">

<!-- <script type="text/javascript" src="js/athleteForm.js"> </script> -->
<script type="text/javascript" src="js/changeMeet.js"> </script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/tables.css">
<link rel="shortcut icon" href="pictures/logo.png">
<link rel="icon" href="pictures/man.png">
</head>

<body onload="SelectedMeet();">
<?php include 'php/Menu.php'; ?>


<div id="content-wrap">
<form id="getResultForm" name="myform" method="post" action="">
	<div class="styled-select" onchange="change_categoryMeet(this.value);">

	   	<form id="selectAgeGroup" name="myform" method="post" action="get">
<?php   	 	

		echo "<select name='agegroup' onchange='change_category(this.value);'>";
		echo "<option value='--' >Select An Age Group:</option>";

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
	
?>
			</form>	
	</div><br>
	
	
	
	
	
		<div class="styled-select" onchange="change_categoryMeet(this.value);" id="responce_event" >
					<select name="event" id="event" disabled="disabled" >
						<option value="--" >Select An Event:</option>
					</select>
		
	</div>
	</form>
	<br>
	<p>
	<input type="button" id="addResult" value="Add" class="button-add"> 
	</p> 
	<br>
	<div id="dialog" style="display:none;" title="Results Form">
		<form id="addResultForm" name="myform" method="post" action="" >
			<table>
				<tr>
				<td>ID (will be hidden):</td>
				<td><input name="id" value=""></td>
				</tr>
				<tr>
				<tr>
				<td>Type(will be hidden):</td>
				<td><input name="type" type="text"></td>
				</tr>
				<tr>
				<td>First Name:</td>
				<td><input name="fname" type="text"></td>
				</tr>
				<tr>
				<td>Last Name:</td>
				<td><input name="lname" type="text"></td>
				</tr>
				<tr>
				<td> School: </td>
				<td><select name="school">
<?php
		$q3 = "SELECT `SchoolLong` , `SchoolID` FROM `School` WHERE `ManagerID` = '$managerID'";
		$schoolListResults = mysqli_query($db,$q3);
		
		if(mysqli_num_rows($schoolListResults) > 0){
			while($row3 = mysqli_fetch_assoc($schoolListResults))
			{
				$temp_school_name = $row3['SchoolLong'];
			?>
			<option value="<?php echo $temp_school_name ?>"><?php echo $temp_school_name ?></option>
			<?php	
			}
		} 
?>
					</select></td>				
				</tr>
				
			</table>
			<br>
			<div class="center"><button type="submit" id='enter'> Submit </button></div>
    	</form>
	</div>
	
<?php	
	}
}
?>

<?php 
include 'Tables/resultTable.php';
?>

</div>

<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></p>
</div>

</body>
</html>