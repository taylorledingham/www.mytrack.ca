<?php
$sname = $_POST['sname'];
$abbrev = $_POST['abbrev'];
$id = $_POST['id'];
$managerID = $_POST['managerID'];
$meetID = $_POST['meetID'];


$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
if(!$db){
  exit("Error in database connection");
}

else{

if($sname=="" || $abbrev=="")
{
echo json_encode(1);

}

else
{
	    

$result = mysqli_query($db, "SELECT * FROM `School` WHERE `SchoolLong`='$sname' AND `SchoolShort` = '$abbrev'");
$exists =  mysqli_query($db,"SELECT * FROM `School` WHERE `SchoolID` = $id");
//$row = mysqli_fetch_array($result);
//$SchoolID = $row['SchoolID'];	


if($id == "")
	{
	
	
	//mysqli_query($db, "INSERT INTO `School` (`SchoolLong`,`SchoolShort`,`ManagerID`,`MeetID` ) VALUES ('$sname', '$abbrev', $managerID, $meetID)");
	mysqli_query($db, "INSERT INTO `School` (`SchoolLong`,`SchoolShort`,`ManagerID`,`MeetID` ) VALUES ('$sname', '$abbrev', $managerID, $meetID)");
	
	
	}
	
	else
	{
	
	$row = mysqli_fetch_array($exists);
		$school_id = $row['SchoolID'];

	
	mysqli_query($db, "UPDATE `School` SET `SchoolLong`='$sname',`SchoolShort` = '$abbrev' WHERE `SchoolID`= $id");


	

	
		
		
	}
	}
	
	//echo($fname);
	
$school = array
(
   'sname' => $_POST['sname'],
  'abbrev' => $_POST['abbrev']

);
echo json_encode($school);

}
	
	


?>