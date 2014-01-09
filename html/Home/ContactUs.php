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
?>
<! doctype html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Track</title>
<link rel="shortcut icon" href="../pictures/logo.png">
<link rel="icon" href="../pictures/man.png">

<link rel="stylesheet" type="text/css" href="../css/menu.css"> 

<link rel="stylesheet" type="text/css" href="../css/tables.css">

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.css" rel="stylesheet">
  
<script type = "text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"> </script>

<script type="text/javascript" src="../js/menu.js" > </script>


<link rel="stylesheet" type="text/css" media="all" href="../css/progression.min.css">
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/progression.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/styles.css"> 

</head>



<body>
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
					<li><a href="http://www.mytrack.ca/Home.php" >HOME</a></li>
					<li><a href="http://www.mytrack.ca/Home/AddEmployee.php">ADD EMPLOYEE</a></li>  
					<li><a href="http://www.mytrack.ca/Home/About.php">ABOUT</a></li>
					<li><a href="http://www.mytrack.ca/Home/Prices.php">PRICES</a></li>  
					<li><a href="http://www.mytrack.ca/Home/ContactUs.php" class="selected">CONTACT US</a></li> 
					<li><a href="http://www.mytrack.ca/Home/Logout.php">SIGN-OUT</a></li>
				</ul>
			</div>
		</div>
	</div>
</div> 
<p id="noNewLine"> Meet Selected: </p>
	<div class="styled-select" >
   	 		<select name="event">
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
	</div>
<br>
</div>
<div id="main-wrap">
 	<?php include '../php/SideMenu.php'; ?>
	<div id="content-wrap">
	<div id="w" >
    <div id="content">
      <h1>Contact Us</h1>
      
      <form id="contactform" method="post" action="#">
        
        
        <div class="formrow">
          <label for="username">Email Address</label>
          <input data-progression="" type="email" name="email" id="email" class="basetxt">
          <p class="errmsg">Please Enter a Valid Email</p>
        </div>
        
        <div class="formrow">
          <label for="username">Comment</label>
          <input data-progression="" type="text" name="comment" id="comment" class="basetxt">
          <p class="errmsg">Please add some more characters</p>
        </div>
                
        <input type="submit" id="submitformbtn" class="submitbtn" value="Submit">
      </form>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script type="text/javascript">
$(function(){   
$("#contactform").submit(function(e){
 	var emailval =  document.getElementById("email").value;
 	var commentval = document.getElementById("comment").value;
 	var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(emailval)|| emailval.length < 1) {
    	//alert("Please enter a valid Email");
    	//document.getElementById("errEmail").next('.errmsg').slideDown();
    	//alert("here");
    	e.preventDefault();
    }
    else if(commentval.length < 6)
    {
	    e.preventDefault();
    }
    else
    {
	    alert("Thank You");
    } 	
  });
  
    $('#comment').on('blur', function(){
    var comment = $(this).val();
    
    if(comment.length < 6) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#email').on('blur', function(){
    var emailval = $(this).val();
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(emailval)|| emailval.length < 1) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
});
</script>
	</div>
</div>
</body>
</html>
<?php
}
?>