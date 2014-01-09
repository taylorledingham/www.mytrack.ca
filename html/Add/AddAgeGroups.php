<?php
$agegroup = $_POST['agegroup'];
$abbrev = $_POST['abbrev'];
$sort = $_POST['sort'];
$id = $_POST['id'];
$managerID = $_POST['managerID'];
$meetID = $_POST['meetID'];


$db = mysqli_connect("localhost", "root", "imagroup123","mytrack");
if(!$db){
  exit("Error in database connection");
}

else{

if($agegroup=="" || $abbrev=="")
{
echo json_encode(1);

}

else
{
	    

$result = mysqli_query($db, "SELECT * FROM `AgeGroup` WHERE `AgeGroupLong`='$agegroup' AND `AgeGroupShort` = '$abbrev'");
$exists =  mysqli_query($db,"SELECT * FROM `AgeGroup` WHERE `AgeGroupID` = $id");
//$row = mysqli_fetch_array($result);



if($id == "")
	{
	
	
	mysqli_query($db, "INSERT INTO `AgeGroup` (`AgeGroupLong`,`AgeGroupShort`,`Sort` `ManagerID`, `MeetID`) VALUES ('$agegroup', '$abbrev', $sort, $managerID, $meetID)");
		
	
	}
	
	else
	{
	
	$row = mysqli_fetch_array($exists);
	$AgeGroup_id = $row['AgeGroupID'];

	
	mysqli_query($db, "UPDATE `AgeGroup` SET `AgeGroupLong`='$agegroup',`AgeGroupShort` = '$abbrev', `Sort`=$sort WHERE `AgeGroupID`=$id");
	
	
	

	
		
		
	}
	}
	
	//echo($fname);
	
$ageGroup = array
(
   'agegroup' => $_POST['agegroup'],
  'abbrev' => $_POST['abbrev'],
  'sort' => $_POST['sort']

);

echo json_encode($ageGroup);

}
	
	


?>