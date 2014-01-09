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
		//$q = "SELECT * FROM `AgeGroup` WHERE `ManagerID`='$managerID' AND `MeetID`='$meetID' ORDER BY `Sort` ASC";
		$q = "SELECT * FROM `AgeGroup` WHERE `ManagerID`='$managerID' ORDER BY `Sort` ASC";
		$agegroupresults = mysqli_query($db,$q);
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

<!-- <script type="text/javascript" src="js/agegroupForm.js"> </script> -->
<script type="text/javascript" src="js/changeMeet.js"> </script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/tables.css">
<link rel="shortcut icon" href="pictures/logo.png">
<link rel="icon" href="pictures/man.png">

</head>

<body onload="SelectedMeet();">
	 <?php include 'php/Menu.php'; ?>
   	 
<div id="content-wrap">
	<p>
	<input type="button" class="button-add" id="addAgeGroup"  value="Add"> 
	</p>
	
	
	<div id="dialog" style="display:none;" title="Age Group Form">
		<form id="addAgeGroupForm" name="addAgeGroupForm" method="post" action="" >
		<div id="responce_event">
			<input type="hidden" name="id" value="" >
			<input type="hidden" name="managerID" value="<?php echo $managerID ?>" >
			<input type="hidden" name="meetID" value="<?php echo $meetID ?> " >
		</div>
			<table>
				<tr>
				<td>Age Group:</td>
				<td><input name="agegroup" type="text"></td>
				</tr>
				<tr>
				<td>Abbreviation:</td>
				<td><input name="abbrev" type="text"></td>
				</tr>
				<tr>
				<td>Sort:</td>
				<td><input name="sort" type="text"></td>
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
include 'Tables/agegroupTable.php';
?>
	
</div>
<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"></a></p>
</div>


</body>
</html>