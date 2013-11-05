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
		$q = "SELECT * FROM `AgeGroup` WHERE `ManagerID`='$managerID' ORDER BY `Sort` ASC";
		$agegroupresults = mysqli_query($db,$q);

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

<script type="text/javascript" src="js/agegroupForm.js"> </script>

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
   <li><a href="http://www.mytrack.ca/EditEvents.php">Events</a></li>
   <li><a href="http://www.mytrack.ca/EditAgeGroups.php" class="selected">AgeGroups</a></li>  
   <li><a href="http://www.mytrack.ca/EditRecords.php">Records</a></li> 
   <li><a href="http://www.mytrack.ca/EditEnrollment.php">Enrollment in Events</a></li>  
   <li><a href="http://www.mytrack.ca/EditResults.php">Results</a></li>     
</ul> 

<div id="center_column">
	<p>
	<input type="button" id="addAgeGroup"  value="Add" /> 
	</p>
	
	<div id="dialog" style="display:none;" title="Add a School">
		<form id="addAgeGroupForm" name="addAgeGroupForm" method="post" action="" >
			<table>
				<tr>
				<td>Age Group:</td>
				<td><input name="agegroup" type="text"></input></td>
				</tr>
				<tr>
				<td>Abbreviation:</td>
				<td><input name="abbrev" type="text"></input></td>
				</tr>
				<tr>
				<td>Sort:</td>
				<td><input name="sort" type="text"></input></td>
				</tr>
			</table>
		</br>
		<div class="center"><button type="submit" id='enter'> Submit </button></div>
		</form>
	</div>
	
   
	<div id="ageGroups">
		<table>
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
					<form action="http://www.mytrack.ca/EditAgeGroups.php" method="post">
					<input type="hidden" name="age_group_id" value="<?= $temp_age_group_id ?>" />
					<input type="submit" id="<?= 'button' . $temp_age_group_id ?>" name="submit" value="Edit" />
					</form></td>
				<td><?php echo $temp_age_group_long ?></td>
				<td><?php echo $temp_age_group_short ?></td>
				<td><?php echo $temp_sort ?></td>
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