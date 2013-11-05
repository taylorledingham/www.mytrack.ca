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
		$q = "SELECT * FROM `School` WHERE `ManagerID`='$managerID'";
		$schoolresults = mysqli_query($db,$q);

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

<script type="text/javascript" src="js/schoolForm.js"> </script>
	

<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/tables.css">
<link rel="shortcut icon" href="pictures/icon.png">
<link rel="icon" href="pictures/man.png">

</head>

<body>
	 <?php include 'php/Menu.php'; ?>
   	 
   	 <div id="content-wrap">
   	 	<p>
   	 	<!--<form action="http://www.mytrack.ca/EditSchools.php" method="post"> -->	
   	 	<input type="button" id="addSchool"  value="Add" />
   	 	</p>
	
   	 	<div id="dialog" style="display:none;" title="Add a School">
			<form id="addSchoolForm" name="myform" method="post" action="" >
				<table>
					<tr>
						<td>School Name:</td>
						<td><input name="sname" type="text"></input></td>
					</tr>
					<tr>
						<td>Abbreviation:</td>
						<td><input name="abbrev" type="text"></input></td>
					</tr>
				</table>
				</br>
				<div class="center"><button type="submit" id='enter'> Submit </button></div>
			</form>
		</div>
   
		<div id="schools">
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
					<form  id="editSchool" method="post"> 
					<!--<form action="www.mytrack.ca/EditSchools.php" method="post"> -->
					<input type="hidden" name="school_id" value="<?= $temp_school_id ?>" />
		<input type="submit" id="<?php echo "button" . $temp_school_id ?>" name="submit" value="Edit" />
					</form></td>
				<td><?php echo $temp_school_long ?></td>
				<td><?php echo $temp_school_short ?></td>
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
		</table>
	</div>
</div>

</div>
<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"/></a></p>
</div>




</body>
</html>