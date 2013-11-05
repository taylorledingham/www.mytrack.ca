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
		$q = "SELECT DISTINCT E.EventID, E.EventLong, E.EventType, E.AgeGroup FROM Event E, AgeGroup AG
		WHERE E.ManagerID='$managerID' AND E.AgeGroup = AG.AgeGroupLong
		ORDER BY AG.Sort ASC";
		$eventresults = mysqli_query($db,$q);

?>

<! doctype html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>
<script type="text/javascript" src="js/menu.js" > </script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/tables.css">
<div id="demo_top_wrapper">
	<!-- a header with a logo just to have some content before the menu -->
	<div id="demo_top">
		<div class="demo_container">
			<div id="my_logo"><img border="0" src="pictures/logo.png" alt="logo" width="117" height="70" align="left" ></div>
		</div>
	</div>
</div>
</head>

<body>
<!-- this will be our navigation menu -->
<div id="sticky_navigation_wrapper">
	<div id="sticky_navigation">
		<div class="demo_container">
			<ul>
				<li><a href="http://www.mytrack.ca/Home.php">HOME</a></li>
				<li><a href="http://www.mytrack.ca/Comment.php">COMMENT</a></li>  
				<li><a href="http://www.mytrack.ca/About.php">ABOUT</a></li>
				<li><a href="http://www.mytrack.ca/Prices.php">PRICES</a></li>  
				<li><a href="http://www.mytrack.ca/ContactUs.php">CONTACT US</a></li> 
				<li><a href="http://www.mytrack.ca/SignOut.php">SIGN-OUT</a></li>
			</ul>
		</div>
	</div>
</div>

<br/>

<ul id="menu">    
   <li><a href="http://www.mytrack.ca/EditAthletes.php">Athletes</a></li>  
   <li><a href="http://www.mytrack.ca/EditSchools.php">Schools</a></li>  
   <li><a href="http://www.mytrack.ca/EditEvents.php" class="selected">Events</a></li>
   <li><a href="http://www.mytrack.ca/EditAgeGroups.php">AgeGroups</a></li>  
   <li><a href="http://www.mytrack.ca/EditRecords.php">Records</a></li> 
   <li><a href="http://www.mytrack.ca/EditEnrollment.php">Enrollment in Events</a></li>  
   <li><a href="http://www.mytrack.ca/EditResults.php">Results</a></li>     
</ul> 

<div id="center_column">
	<p>
	<input type="button" id="addAthlete" value="Add" /> 
	</p> 
	
	
	<div id="dialog" style="display:none;" title="Add an Athlete">
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
   
	<div id="event">
		<table>
			<tr>
				<th>Edit</th>
				<th>Event</th>
				<th>Age Group</th>
			</tr>

<?php
		if(mysqli_num_rows($eventresults) > 0){
			while($row = mysqli_fetch_assoc($eventresults))
			{
				$temp_event_id = $row['EventID'];
				$temp_event_long = $row['EventLong'];
				$temp_event_type = $row['EventType'];
				$temp_event_age_group = $row['AgeGroup'];
//				if($temp_event_type == "Track")
//					$temp_event_record = $row['RecordTrack'];
//				else
//					$temp_event_record = $row['RecordField'];
//				$temp_event_record_name_first = $row['RecordNameFirst'];
//				$temp_event_record_name_last = $row['RecordNameLast'];
//				$temp_event_record_school = $row['RecordSchool'];
				
?>
			<tr id="<?php echo "event" . $temp_event_id ?>">
				<td>
					<form action="http://www.mytrack.ca/EditEvents.php" method="post">
					<input type="hidden" name="event_id" value="<?= $temp_event_id ?>" />
					<input type="submit" id="<?= 'button' . $temp_event_id ?>" name="submit" value="Edit" />
					</form></td>
				<td><?php echo $temp_event_long ?></td>
				<td><?php echo $temp_event_age_group ?></td>
<!--			<td><?php echo $temp_event_record ?></td>
				<td><?php echo $temp_event_record_name_first . " " . $temp_event_record_name_last ?></td>
				<td><?php echo $temp_event_record_school ?></td>
-->
			</tr>			
<!--		<script type="text/javascript">
			<!--
				var like_id1DOM = document.getElementById("<?= 'like' . $temp_comment_id1 ?>"); 
				like_id1DOM.addEventListener("click", change, false);
				like_id1DOM.addEventListener("click", updateCommentLike, false); 

			</script>	
-->	
<?php
			}
		}
	}
//}
?>
			<tr>
				<td><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></td>
			</tr>
		</table>
	</div>
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


</body>
</html>