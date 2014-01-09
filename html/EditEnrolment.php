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
		$enrolmentresults = mysqli_query($db,$q);

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

<!-- <script type="text/javascript" src="js/enrolmentForm.js"> </script> -->
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
	<input type="button" id="addEnrolment" value="Add" class="button-add"> 
	</p> 
	
	
	<div id="dialog" style="display:none;" title="Enrolment Form">
		<form id="addEnrolmentForm" name="myform" method="post" action="" >
			<input type="hidden" name="id" value="" >
		
			<table>
				<tr>
				<td> School </td>
				<td><select name="school" id="school" onchange='change_category2(this.value);'>
				<option value="--" >Select An Option: </option>
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
<tr>
				<td> Age Group </td>
				<td><div class="selectbox" id="responce_event0">
					<select name="agegrp" id="agegrp" disabled="disabled" >
						<option value="--" >Select An Option:</option>
					</select>
				</div></td>	
				</tr>

				<tr>
				<td> Events </td>
				<td><div class="selectbox" id="responce_event">
					<select name="event" id="event" disabled="disabled" >
						<option value="--" >Select An Option:</option>
					</select>
				</div></td>	
				</tr>
				<tr>
				<td>Athlete Name:</td>
				<td><div class="selectbox" id="responce_event2">
					<select name="athlete" id="athlete" disabled="disabled" >
						<option value="--" >Select An Option:</option>
						<option value="anOption"> An Option </option>
					</select>
				</div>
				</td>
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
include 'Tables/enrolmentTable.php';
?>	

</div>
</div>

<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"></a></p>
</div>

</body>
</html>