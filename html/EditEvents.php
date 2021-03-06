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
		$meetName = $_SESSION["meet_id"];
		//$q = "SELECT DISTINCT E.EventID, E.EventLong, E.EventType, E.AgeGroupID FROM Event E, AgeGroup AG
		//WHERE E.ManagerID='$managerID' AND E.MeetID='$meetID' AND AG.MeetID='$meetID' AND E.AgeGroupID = AG.AgeGroupID ORDER BY AG.Sort ASC";
		$q = "SELECT DISTINCT E.EventID, E.EventLong, E.EventType, E.AgeGroupID FROM Event E, AgeGroup AG
		WHERE E.ManagerID='$managerID' AND E.AgeGroupID = AG.AgeGroupID ORDER BY AG.Sort ASC";
		$eventresults = mysqli_query($db,$q);
		
		$result = mysqli_query($db, "SELECT * FROM `Meet` WHERE `Meet`='$meetName'");
		$row = mysqli_fetch_array($result);
		$meetID = $row['MeetID'];

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

<script type="text/javascript" src="js/eventsForm.js"> </script> 
<script type="text/javascript" src="js/changeMeet.js"> </script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/tables.css">
<link rel="shortcut icon" href="pictures/logo.png">
<link rel="icon" href="pictures/man.png">
<style type="text/css">     
    select {
        width:250px;
    }
</style>
</head>

<body onload="SelectedMeet();">
<?php include 'php/Menu.php'; ?>

<div id="content-wrap">
	<p>
	<input type="button" id="addEvent" value="Add" class="button-add"> 
	</p> 
	
	
	<div id="dialog" style="display:none;" title="Event Form">
		<form id="addEventForm" name="EventForm" method="post" action="" >
		<div id="responce_event">
			<input type="hidden" name="id" value="" >
			<input type="hidden" name="managerID" value="<?php echo $managerID ?>" >
			<input type="hidden" name="meetID" value="<?php echo $meetID ?> " >
		</div>
			<table>
			<tr>
				<td>Event Type:</td>
				<td>
				<input type="radio" id="eventType" name="eventType" value="Track">Track<br>
				<input type="radio" id="eventType" name="eventType" value="Field">Field
				
				</td>
				</tr>
				<tr>
				<td>Event:</td>
				<td><input name="event" type="text"></td>
				</tr>
				<tr>
				<td> Age Group </td>
				<td><select name="agegroup">
				<option value="--" >Select An Option: </option>
<?php
					$q4 = "SELECT `AgeGroupID`, `AgeGroupLong` FROM `AgeGroup` WHERE `ManagerID` = '$managerID'";
					$ageGroupListResults = mysqli_query($db,$q4);
					
					if(mysqli_num_rows($ageGroupListResults) > 0){
						while($row4 = mysqli_fetch_assoc($ageGroupListResults))
						{
							$temp_age_group = $row4['AgeGroupLong'];
						?>
						<option value="<?php echo $temp_age_group ?>"><?php echo $temp_age_group ?></option>
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
include 'Tables/eventTable.php';
?>

</div>
<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"></a></p>
</div>

</body>
</html>