<?php
 echo '
 
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
						<li><a href="http://www.mytrack.ca/Home.php">HOME</a></li>
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
   	 		<select name="showMeet" id="showMeet" >
   	 		
   	 		<option value="--" >Select An Option: </option>
   	 		
';
					$q = "SELECT * FROM Meet WHERE `ManagerID` = '$managerID'";
					$meetResults = mysqli_query($db,$q);
					
					if(mysqli_num_rows($meetResults) > 0){
						while($row = mysqli_fetch_assoc($meetResults))
						{
							$temp_meetID = $row['MeetID'];
							$temp_meet = $row['Meet'];
							//$_SESSION["meet_id"] = $temp_meetID;
						echo '
						<option value="'.$temp_meet.'">'. $temp_meet. '</option>';
						
						
						
						}
					} 
	
echo '
			</select></form>		
	</div>
	<br>
	
</div>

<div id="main-wrap">';
	echo '<input type="hidden" id="MeetID" value="'. $_SESSION["meet_id"].'">';
 	echo'
 	<div id="sidebar">
 		<ul id="menu"> 
 			<li><a href="http://www.mytrack.ca/EditMeets.php"><b>Meets</b></a></li> 
 			<li><a href="http://www.mytrack.ca/EditEvents.php"><b>Events</b></a></li>   
 			<li><a href="http://www.mytrack.ca/EditAthletes.php"><b>Athletes</b></a></li>  
 			<li><a href="http://www.mytrack.ca/EditSchools.php"><b>Schools</b></a></li>  
   			<li><a href="http://www.mytrack.ca/EditAgeGroups.php"><b>Age Groups</b></a></li>  
   			<li><a href="http://www.mytrack.ca/EditRecords.php"><b>Records</b></a></li> 
   			<li><a href="http://www.mytrack.ca/EditEnrolment.php"><b>Enrolment in Events</b></a></li>  
   			<li><a href="http://www.mytrack.ca/EditResults.php"><b>Results</b></a></li>     
   		</ul> 
   </div>';

?>





 