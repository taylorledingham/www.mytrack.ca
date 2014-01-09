<?php
session_start();
if($_SESSION["logged_in"] == 0)
	header("Location: http://www.mytrack.ca/Index/Login.php");
else if($_SESSION["type"] == "general")
	header("Location: http://www.mytrack.ca");
else
{	
	$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
	if(!$db)
		exit("Error with database connection");
	else{
		$managerID = $_SESSION["manager_id"];
		$meetID = $_SESSION["meet_id"];
		$loading = $_POST['loading'];
		
		$q = "SELECT * FROM Status ORDER BY Time DESC";
		$result = mysqli_query($db, $q);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>

<script type = "text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css"> 
<script type="text/javascript" src="../js/menu.js" > </script>
<script type="text/javascript" src="../Updating/HomeAjax.js" > </script>
<script type="text/javascript" var loading = "<?php echo $loading ?>"; ></script>
<script type="text/javascript" src="../js/changeMeet.js"> </script>
<link rel="shortcut icon" href="../pictures/logo.png">
<link rel="icon" href="../pictures/man.png">

<link rel="stylesheet" type="text/css" href="../css/menu.css">
<link rel="stylesheet" type="text/css" href="../css/tables.css">

</head>

<body onload = "SelectedMeet(); startTimer();">
<div id="header">
<div id="demo_top_wrapper">
 
	<!-- a header with a logo just to have some content before the menu -->
	<div id="demo_top">
		<div class="demo_container">
			<div id="my_logo"><img border="0" src="../pictures/logo.png" alt="logo" width="117" height="70" align="left" ></div>
		</div>
	</div>
	<!-- this will be our navigation menu -->
	<div id="sticky_navigation_wrapper">
		<div id="sticky_navigation">
			<div class="demo_container">
				<ul>
					<li><a href="http://www.mytrack.ca/Home.php" class="selected">HOME</a></li>
					<li><a href="http://www.mytrack.ca/Home/AddEmployee.php">ADD EMPLOYEE</a></li>  
					<li><a href="http://www.mytrack.ca/Home/About.php">ABOUT</a></li>
					<li><a href="http://www.mytrack.ca/Home/Prices.php">PRICES</a></li>  
					<li><a href="http://www.mytrack.ca/Home/ContactUs.php">CONTACT US</a></li> 
					<li><a href="http://www.mytrack.ca/Home/Logout.php">SIGN-OUT</a></li>
				</ul>
			</div>
		</div>
	</div>
</div> 
<p id="noNewLine"> Meet Selected: </p>
	<div class="styled-select" onchange="change_categoryMeet(this.value);">
	   	 <form id="selectMeetForm" name="myform" method="post" action="get">
	   	 <input type="hidden" id="MeetID" value="'<?php echo $meetID ?>'">
   	 		<select name="showMeet" id="showMeet" >
   	 		<option value="--" >Select An Option: </option>
   	 		
<?php
		$q = "SELECT * FROM Meet WHERE `ManagerID` = '$managerID'";
		$meetResults = mysqli_query($db,$q);
		
		if(mysqli_num_rows($meetResults) > 0){
			while($row = mysqli_fetch_assoc($meetResults))
			{
				$temp_meetID = $row['MeetID'];
				$temp_meet = $row['Meet'];
?>
			<option value="'<?php echo $temp_meet ?>'"><?php echo $temp_meet ?></option>
			
<?php
			
			}
		} 
?>
			</select>
   	 	</form> 
	</div>
	<br>

</div>
<div id="main-wrap">
 	<?php include '../php/SideMenu.php'; ?>	
	<div id="content-wrap">
		<p>
		<input type="button" id="addComment" value="Comment"> 
		</p>
		<div id="dialog" style="display:none;" title="Add a Comment">
			<form id="addCommentForm" name="myform" method="post" action="" >
				<table>
					<tr>
					<td>Comment:</td>
					</tr>
					<td><textarea name="Text1" cols="40" rows="5"></textarea></td>
					</tr>
				</table>
				<br>
				<div class="center"><button type="submit" id='enter'> Submit </button></div>
	    	</form>
		</div>

<?php 
	}
}
if($loading == "detail")
	include 'Home/statusDetail.php';
else
	include 'Home/status.php';
?>
</div>
</div>

<div id="footer">
	<p align = "center" ><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88"></a></p>
</div>
</body>
</html>
