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
		//$q = "SELECT * FROM `Meet` WHERE `ManagerID`='$managerID' AND `MeetID`='$meetID'";
		$q = "SELECT * FROM `Meet` WHERE `ManagerID`='$managerID'";
		$meetresults = mysqli_query($db,$q);
		

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

<script type="text/javascript" src="js/meetsForm.js"> </script>
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
   	 	<!--<form action="http://www.mytrack.ca/EditMeets.php" method="post"> -->	
   	 	<input type="button" class="button-add" id="addMeet"  value="Add" >
   	 	</p>
   	 	
	
   	 	<div id="dialog" style="display:none;" title="Meet Form">
			<form id="addMeetForm" name="myform" method="post" action="" >
			<div id="responce_event">
				<input type="hidden" name="id" value="" >
			</div>
				<table>
					<tr>
						<td>Meet Name:</td>
						<td><input name="MeetName" type="text"></td>
					</tr>
				</table>
				<br>
				<div class="center"><button type="submit" id='enter'> Submit </button>
				</div>
			</form>
		</div>
   
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
}
?>
		</table>
	</div>
</div>

<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"></a></p>
</div>

</body>
</html>