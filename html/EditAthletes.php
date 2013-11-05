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

<! doctype html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>
<script type="text/javascript" src="js/menu.js" > </script>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">

<script type="text/javascript" src="js/athleteForm.js"> </script>


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
   <li><a href="http://www.mytrack.ca/EditAthletes.php" class="selected">Athletes</a></li>  
   <li><a href="http://www.mytrack.ca/EditSchools.php">Schools</a></li>  
   <li><a href="http://www.mytrack.ca/EditEvents.php">Events</a></li>
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
   
	<div id="athlete">
		<table>
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
				
				$q = "SELECT S.SchoolLong FROM School S, Athlete A WHERE A.SchoolID = '$temp_athlete_schoolID'";
				$schoolresult = mysqli_query($db,$q);
				$q = "SELECT AG.AgeGroupLong FROM AgeGroup AG, Athlete A WHERE A.AgeGroupID = '$temp_athlete_agegroupID'";
				$agegroupresult = mysqli_query($db,$q);
				
				$temp_school = mysqli_fetch_assoc($schoolresult);
				$temp_agegroup = mysqli_fetch_assoc($agegroupresult);
?>
			<tr id="<?php echo "athlete" . $temp_athlete_id ?>">
				<td>
					<form action="http://www.mytrack.ca/EditAthlete.php" method="post">
					<input type="hidden" name="athlete_id" value="<?= $temp_athlete_id ?>" />
					<input type="submit" id="<?= 'button' . $temp_athlete_id ?>" name="submit" value="Edit" />
					</form></td>
				<td><?php echo $temp_athlete_name_first ?></td>
				<td><?php echo $temp_athlete_name_last ?></td>
				<td><?php echo $temp_school['SchoolLong'] ?></td>
				<td><?php echo $temp_agegroup['AgeGroupLong'] ?></td>
			</tr>			
<!--		<script type="text/javascript">
			<!--
				var like_id1DOM = document.getElementById("<?= 'like' . $temp_comment_id1 ?>"); 
				like_id1DOM.addEventListener("click", change, false);
				like_id1DOM.addEventListener("click", updateCommentLike, false); 

			</script>	
// -->	
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




</body>
</html>