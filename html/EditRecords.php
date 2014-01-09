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
		//$q = "SELECT E.* FROM Event E, AgeGroup AG WHERE E.ManagerID='$managerID' AND E.MeetID='$meetID' AND AG.MeetID='$meetID' AND E.AgeGroup = AG.AgeGroupLong ORDER BY AG.Sort ASC";
		$q = "SELECT E.* FROM Event E, AgeGroup AG WHERE E.ManagerID='$managerID' ORDER BY AG.Sort ASC";
		$eventresults = mysqli_query($db,$q);

?>

<! doctype html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>
<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css"> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>
<script type="text/javascript" src="js/menu.js" > </script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">
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
	<input type="button" id="addAthlete" value="Add" class="button-add"> 
	</p> 
	
	
	<div id="dialog" style="display:none;" title="Record Form">
		<form id="addAthleteForm" name="myform" method="post" action="" >
			<table>
				<tr>
				<td>First Name:</td>
				<td><input name="fname" type="text"></input></td>
				</tr>
				<tr>
				<td>Last Name:</td>
				<td><input name="lname" type="text"></input></td>
				</tr>
				<tr>
				<td> School </td>
				<td><input name="school" type="text"></input></td>
				</tr>
				<tr>
				<td> Age Group </td>
				<td><input name="agegrp" type="text"></input></td>
				</tr>
			</table>
			</br>
			<div class="center"><button type="submit" id='enter'> Submit </button></div>
    	</form>
	</div>
	
<?php	
	}
}
?>

<?php 
include 'Tables/recordTable.php';
?>

</div>
<script type="text/javascript">

	
$('#addAthleteForm').trigger("reset");

//$(document).ready(function()  {
$(function() {
	$("#dialog").dialog({
				autoOpen: false,
				 maxWidth:600,
				 maxHeight: 500,
				 width: 500,
	            height: 460,
		});
$("#addAthlete").on("click", function() 
{

	$("#dialog").dialog("open");
			});



$("#addAthleteForm").submit(function(e)
	{ 
	e.preventDefault();
	$("#dialog").dialog("close")
	var postData = jQuery(this).serialize();
	$.ajax({
				type: "POST",
				url: "AddAthletes.php",
     			 data: postData,
     			 success: function(data){
	     			 alert(data); }


         });   
			});
		})
 </script>
<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></p>
</div>

</body>
</html>